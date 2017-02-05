/**
 * Created by Matthew Patell on 2017-02-05.
 */


$(function () {

    /**
     * Sorting table class
     *
     * @type {{init}}
     */
    var Sortable = (function () {

        /**
         * Table selector
         *
         * @type {null|jQuery}
         */
        var table = null;

        /**
         * Positions tr
         *
         * @type {Array}
         */
        var positions = [];

        /**
         * Sort tr
         *
         * @param {Array} sort_columns
         */
        var sort = function (sort_columns) {

            if (0 in sort_columns) {

                var n = positions.length;

                for (var i = 0; i < n-1; i++) {
                    for (var j = 0; j < n-1-i; j++) {

                        var char1 = sort_columns[0]['direction'] == 'asc' || !sort_columns[0]['direction'] ? 1 : 0;
                        var char2 = sort_columns[0]['direction'] == 'desc' ? 1 : 0;

                        if (_compare(sort_columns, 0, j)) {
                            var t = positions[j+char1];
                            positions[j+char1] = positions[j+char2];
                            positions[j+char2] = t;
                        }
                    }
                }

                for (var i = 0; i < positions.length; i++) {
                    $(positions[i]['element']).appendTo(table.find('tbody'));
                }
            }
        };

        /**
         * Compare values by multiple sort columns
         *
         * @param sort_columns
         * @param index_sort
         * @param index_element
         */
        var _compare = function (sort_columns, index_sort, index_element) {

            var char1 = sort_columns[index_sort]['direction'] == 'asc' || !sort_columns[0]['direction'] ? 1 : 0;
            var char2 = sort_columns[index_sort]['direction'] == 'desc' ? 1 : 0;

            var value1 = positions[index_element+char1]['origin_pos'];
            var value2 = positions[index_element+char2]['origin_pos'];

            if (sort_columns[index_sort]['direction'] == 'asc' || sort_columns[index_sort]['direction'] == 'desc') {
                var value1 = $(positions[index_element+char1]['element']).find('td').eq(sort_columns[index_sort]['index']).text();
                var value2 = $(positions[index_element+char2]['element']).find('td').eq(sort_columns[index_sort]['index']).text();
            }

            if (value1 == value2 && sort_columns[index_sort+1] !== undefined) {
                return _compare(sort_columns, index_sort+1, index_element);
            }

            return value1 < value2;
        };

        /**
         * Updating tr rows
         */
        var update_rows = function () {
            var all_tr = table.find('tbody tr');

            for (var i = 0; i < all_tr.length; i++) {

                var tr = $(all_tr[i]);

                if (tr.attr('date-sort') == undefined) {
                    positions[i] = [];
                    positions[i]['element']     = all_tr[i];
                    positions[i]['origin_pos']  = i;

                    tr.attr('date-sort', i);
                }
            }
        };

        /**
         * Sorting table by th columns
         */
        var click = function () {
            var el = $(this);
            var tr = el.parent();
            var direction = el.find('span');

            switch (direction.attr('data-direction')) {
                case 'desc':
                    direction
                        .attr('class', '')
                        .attr('data-direction', '');
                    break;

                case 'asc':
                    direction
                        .attr('class', tr.data('sort-desc'))
                        .attr('data-direction', 'desc');
                    break

                default:
                    if (!direction.length) {
                        el.append($('<span/>', {
                            class: tr.data('sort-asc'),
                            'data-direction': 'asc'
                        }));
                    } else {
                        direction
                            .attr('class', tr.data('sort-asc'))
                            .attr('data-direction', 'asc');
                    }
                    break;
            }

            var all_directions  = table.find('.sortable span[data-direction!=""]');
            var sort_columns    = [];

            for (var i = 0; i < all_directions.length; i++) {
                sort_columns[i] = [];
                sort_columns[i]['index']       = $(all_directions[i]).closest('th').index();
                sort_columns[i]['direction']   = $(all_directions[i]).attr('data-direction');
            }

            if (!sort_columns.length) {
                sort_columns[0] = [];
                sort_columns[0]['index']      = null;
                sort_columns[0]['direction']   = null;
            }

            update_rows();

            sort(sort_columns);
        };

        return {
            /**
             * Init class
             *
             * @param selector
             */
            init: function (selector) {
                table = $(selector);

                update_rows();

                table.find('.sortable').click(click);
            },
        };
    }());

    Sortable.init('.table');
});