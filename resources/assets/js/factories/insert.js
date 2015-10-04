app.factory('insert', function ($http, DatesFactory) {
	return {
		insert: function ($new_entry) {
			var $url = 'ajax/insert.php';
			var $table = 'info';
			var $OR_date = $("#original-restoration-date").val();
			var $LP_date = $("#last-photo-date").val();
			var $where_kept = [];
			
			$new_entry.original_restoration_date = DatesFactory.sqlFormat($OR_date);
			$new_entry.last_photo_date = DatesFactory.sqlFormat($LP_date);

			//$where_kept
			$.each($new_entry.folders, function (index, value) {
				if (value) {
					//this makes $where_kept an array of folder ids
					$where_kept.push(index);
				}
			});

			$new_entry.where_kept = $where_kept;

			//$data
			var $data = {
				table: $table,
				new_entry: $new_entry
			};

			return $http.post($url, $data);
		}
	};
});