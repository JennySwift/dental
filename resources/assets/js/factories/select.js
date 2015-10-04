app.factory('select', function ($http) {
	return {
		getInfo: function () {
			var $url = '/entries';

			return $http.get($url);
		},
		restorationTypes: function () {
			var $url = '/restoration-types';

			return $http.get($url);
		},
		folders: function () {
			var $url = '/folders';

			return $http.get($url);
		},
		filter: function ($filter) {
			for (var i = 0; i < $filter.length; i++) {
				$filter[i] = "'" + $filter[i] + "'";
			}
			$filter = $filter.join(",");
			// $filter = JSON.stringify($filter);
			var $url = 'ajax/select.php';
			var $table = 'filter';
			var $data = {
				table: $table,
				filter: $filter
			};
			return $http.post($url, $data);
		}
	};
});