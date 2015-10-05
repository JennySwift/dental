angular.module('dentalApp')
    .factory('EntriesFactory', function ($http, $filter, DatesFactory) {
        return {

            index: function () {
                var $url = '/entries';

                return $http.get($url);
            },

            insert: function ($new_entry) {
                var $url = '/entries';
                var $folders = [];

                //$new_entry.original_restoration_date = DatesFactory.sqlFormat();
                $new_entry.original_restoration_date = $filter('formatDate')($("#original-restoration-date").val());
                //$new_entry.last_photo_date = DatesFactory.sqlFormat($("#last-photo-date").val());
                $new_entry.last_photo_date = $filter('formatDate')($("#last-photo-date").val());

                //folders
                $.each($new_entry.folders, function (index, value) {
                    if (value) {
                        //this makes $folders an array of folder ids
                        $folders.push(index);
                    }
                });

                $new_entry.folders = $folders;

                return $http.post($url, $new_entry);
            },
            update: function ($entry) {
                var $table = 'info';
                $entry.original_restoration_date.sql = DatesFactory.sqlFormat($entry.original_restoration_date.user);
                $entry.last_photo_date.sql = date.sqlFormat($entry.last_photo_date.user);

                $entry.original_restoration_date.user = DatesFactory.userFormat($entry.original_restoration_date.user);
                $entry.last_photo_date.user = DatesFactory.userFormat($entry.last_photo_date.user);

                var $data = {
                    url: $url,
                    table: $table,
                    entry: $entry
                };

                return $http.post($url, $data);
            },
            destroy: function ($entry) {
                var $url = '/entries/' + $entry.id;

                return $http.delete($url);
            }
        }
    });