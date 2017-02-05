<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-04
 * Time: 14:31
 */

namespace app\components;

/**
 * Class BaseController
 * @package app\components
 */
abstract class BaseController
{
    /**
     * Controller ID
     *
     * @var string
     */
    private $controllerID;

    /**
     * Action ID
     *
     * @var string
     */
    private $actionID;

    /**
     * Page title
     *
     * @var string
     */
    public $title;

    /**
     * Included js scripts
     *
     * @var array
     */
    private $_js = [];

    /**
     * Included css scripts
     *
     * @var array
     */
    private $_css = [];

    /**
     * Other included file (besides js, css)
     *
     * @var array
     */
    private $_asset_files = [];

    /**
     * BaseController constructor.
     *
     * @param string $controller
     * @param string|null $action
     * @return self
     */
    public function __construct(string $controller, string $action = null)
    {
        $this->controllerID = strtolower($controller);
        $this->actionID     = strtolower($action);

        return $this;
    }

    /**
     * Compare url with current route
     *
     * @return bool
     */
    public function compareUrl($url): bool
    {
        return $this->controllerID.'/'.$this->actionID === $url;
    }

    /**
     * Run action
     *
     * @return mixed
     */
    public function run()
    {
        $method = 'action'.ucfirst($this->actionID);

        if (method_exists($this, $method)) {
            echo $this->$method();
            exit();
        }

        exit('Page not found');
    }

    /**
     * Render view file
     *
     * @param string $view
     * @return string
     */
    public function render(string $view): string
    {
        $viewFile = implode(DIRECTORY_SEPARATOR, [
            ROOT_DIR,
            'views',
            $this->controllerID,
            strtolower($view).'.php'
        ]);

        $layout = implode(DIRECTORY_SEPARATOR, [
            ROOT_DIR,
            'views',
            'layout',
            'main.php'
        ]);

        if (file_exists($viewFile) && file_exists($layout)) {
            ob_start();
            require($viewFile);
            $content = ob_get_clean();

            require($layout);
            return ob_get_clean();
        }

        exit('View file or layout do not exist.');
    }

    /**
     * This simple function, for include css, js files in folder.
     *
     * @param string $dir
     * @return void
     */
    public function requireVendorDir(string $dir)
    {
        $path = BaseHelper::normalizeDirSepartor(VENDOR_DIR.$dir);

        if (file_exists($path)) {
            foreach (glob($path . '/*') as $file) {
                $this->requireVendorFile($dir.DIRECTORY_SEPARATOR.basename($file));
            }
        }
    }

    /**
     * This simple function, for include css, js files.
     * No time to write Asset class. :)
     *
     * @return void
     */
    public function requireVendorFile(string $path)
    {
        $file_path  = implode(DIRECTORY_SEPARATOR, explode('/', $path));
        $file       = VENDOR_DIR.$file_path;

        if (substr($file, -3) === 'css') {
            $this->_css[] = $file_path;
        } elseif (substr($file, -2) === 'js') {
            $this->_js[] = $file_path;
        } else {
            $this->_asset_files[] = $file_path;
        }
    }

    /**
     * Include assets on page
     *
     * @return void
     */
    public function assetsPrint()
    {
        $assets_path = ROOT_DIR.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'assets';

        if (!file_exists($assets_path)) {
            mkdir($assets_path);
        }

        $files_css   = $this->assetsPrepre($this->_css, $assets_path);
        $files_js    = $this->assetsPrepre($this->_js, $assets_path);
        $this->assetsPrepre($this->_asset_files, $assets_path);

        if (!empty($files_css)) {
            foreach ($files_css as $file_css) {
                echo '<link rel="stylesheet" type="text/css" href="'. $file_css .'">';
            }
        }

        if (!empty($files_js)) {
            foreach ($files_js as $file_js) {
                echo '<script src="'. $file_js .'"></script>';
            }
        }
    }

    /**
     * Prepare assets
     * Copy or update files in public dir (web)
     *
     * @param array $assets
     * @return array
     */
    private function assetsPrepre(array $assets, $assets_path): array
    {
        $files_included = [];

        if (!empty($assets)) {
            foreach ($assets as $asset_file) {

                $asset_folder    = $assets_path.DIRECTORY_SEPARATOR.(@filemtime(VENDOR_DIR.$asset_file));

                // Detect asset parent folder
                $file_dirs       = explode(DIRECTORY_SEPARATOR, $asset_file);
                $file_parent_dir = $file_dirs[count($file_dirs) - 2] ?? null;

                if (in_array($file_parent_dir, ['js', 'css', 'fonts'])) {
                    $file_parent_dir .= DIRECTORY_SEPARATOR;
                } else {
                    $file_parent_dir = null;
                }

                $full_name = $asset_folder.DIRECTORY_SEPARATOR.$file_parent_dir.basename($asset_file);

                if (file_exists(VENDOR_DIR.$asset_file)) { // Detect, local or vendor file
                    if (!file_exists($full_name)) {
                        if (!file_exists($asset_folder)) {
                            mkdir($asset_folder);
                        }

                        // Create asset parent folder
                        if (!file_exists($asset_folder . DIRECTORY_SEPARATOR . $file_parent_dir)) {
                            mkdir($asset_folder . DIRECTORY_SEPARATOR . $file_parent_dir);
                        }

                        copy(VENDOR_DIR . $asset_file, $full_name);
                    }
                } else {
                    $full_name = $asset_file;
                }

                $reltive = explode('web', str_replace('\\', '/', $full_name));

                $files_included[] = $reltive[1] ?? $reltive[0];
            }
        }

        return $files_included;
    }
}