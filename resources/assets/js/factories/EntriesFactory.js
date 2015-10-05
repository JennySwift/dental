angular.module('dentalApp')
    .factory('EntriesFactory', function ($http, $filter, DatesFactory) {
        return {

            index: function () {
                var $url = '/entries';

                return $http.get($url);
            },

            filter: function ($data) {
                var $url = '/filter/entries';

                return $http.post($url, {last_names: $data});
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
                var $url = '/entries/' + $entry.id;
                var $folders = [];

                $entry.original_restoration_date = $filter('formatDate')($entry.original_restoration_date.user);
                $entry.last_photo_date = $filter('formatDate')($entry.last_photo_date.user);

                return $http.put($url, $entry);
            },
            destroy: function ($entry) {
                var $url = '/entries/' + $entry.id;

                return $http.delete($url);
            }
        }
    });