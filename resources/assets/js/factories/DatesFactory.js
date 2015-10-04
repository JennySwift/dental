app.factory('DatesFactory', function () {
	return {
		changeDate: function ($keycode, $date) {
			$date = Date.parseExact($date, ['d MMM yyyy', 'd/M/yyyy', 'd MMM yy', 'd/M/yy']).toString('dd/MM/yyyy');
			return $date;
		},
		today: function () {
			var $date = Date.parse('today').toString('dd/MM/yyyy');
			return $date;
		},
		goToDate: function ($previous_date, $number) {
			var $date = Date.parse($previous_date).addDays($number).toString('dd/MM/yyyy');
			return $date;
		},
		sqlFormat: function ($entered_date) {
			if ($entered_date !== "" && $entered_date) {
				$sql_date = Date.parseExact($entered_date, ['d MMM yyyy', 'd/M/yyyy', 'd MMM yy', 'd/M/yy']).toString('yyyy/MM/dd');
			}
			else {
				$sql_date = null;
			}
			return $sql_date;
		},
		userFormat: function ($entered_date) {
			if ($entered_date !== "" && $entered_date) {
				$sql_date = Date.parseExact($entered_date, ['d MMM yyyy', 'd/M/yyyy', 'd MMM yy', 'd/M/yy']).toString('dd/MM/yyyy');
			}
			else {
				$sql_date = null;
			}
			return $sql_date;
		}

	};
});
