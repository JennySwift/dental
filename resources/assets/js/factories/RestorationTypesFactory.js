angular.module('dentalApp')
    .factory('RestorationTypesFactory', function ($http) {
        return {
            index: function () {
                var $url = '/restoration-types';

                return $http.get($url);
            },
        }
    });