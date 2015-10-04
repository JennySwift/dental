app.factory('update', function ($http, DatesFactory) {
	var $url = 'ajax/update.php';
	return {
		entry: function ($entry) {
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
		}
	};
});