var app = angular.module('dentalApp', ['checklist-model']);

app.config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

(function () {

	app.controller('HomeController', function ($scope, RestorationTypesFactory, FoldersFactory, EntriesFactory) {

		$scope.new = {};
		$scope.filter = [];
		$scope.error_messages = [];
		$scope.edit = {}; //Used for the editing folders popup. not to be confused with $scope.info iteration edit property.

        $scope.restorationTypes = restorationTypes;
        $scope.folders = folders;
        $scope.entries = entries;

		$scope.myFilter = function ($keycode) {
			if ($keycode === 13) {
				select.filter($scope.filter).then(function (response) {
					$scope.entries = response.data;
				});
			}
		};

		$scope.addEntry = function () {
			if (!$scope.new.folders || $scope.new.folders.length === 0 ) {
				$scope.error_messages.push("You haven't chosen a folder.");
				return;
			}
			else if (!$scope.new.first_name || $scope.new.first_name === "") {
				$scope.error_messages.push("You haven't entered a first name.");
				return;
			}
			else if (!$scope.new.last_name || $scope.new.last_name === "") {
				$scope.error_messages.push("You haven't entered a last name.");
				return;
			}
			else if (!$scope.new.tooth_number || $scope.new.tooth_number === "") {
				$scope.error_messages.push("You haven't entered a tooth number.");
				return;
			}
			else if (!$scope.new.restoration_type_id) {
				$scope.error_messages.push("You haven't selected a restoration type.");
				return;
			}
			EntriesFactory.insert($scope.new).then(function (response) {
				displayEntries();
				$scope.new = {};
				$("#original-restoration-date, #last-photo-date").val("");
			});
		};

		$scope.editEntry = function ($entry) {
			//to display the edit popup. updateEntry is to make the database changes.
			$scope.edit = $entry;
			$scope.edit.folders = {};
			$scope.edit.show = true;
		};

		$scope.updateEntry = function ($entry) {
			EntriesFactory.update($entry).then(function (response) {
				$scope.edit.show = false;
				displayEntries();
			});
		};

		$scope.deleteEntry = function ($entry_id) {
			EntriesFactory.deleteEntry('delete_entry', 'entry', $entry_id).then(function (response) {
				displayEntries();
			});
		};

		// ===========================other===========================

		$(".tooltipster").tooltipster();
		
		$scope.restorationAge = function ($keycode, $OR_date, $LP_date, $entry) {
			if ($keycode === 13) {
				//tab is pressed
				// var $OR_date = $("#original-restoration-date").val();
				// var $LP_date = $("#last-photo-date").val();
				$OR_date = Date.parseExact($OR_date, ['d MMM yyyy', 'd/M/yyyy', 'd MMM yy', 'd/M/yy']).toString('dd/MM/yyyy');
				$LP_date = Date.parseExact($LP_date, ['d MMM yyyy', 'd/M/yyyy', 'd MMM yy', 'd/M/yy']).toString('dd/MM/yyyy');

				$OR_date = moment($OR_date, 'DD/MM/YYYY');
				$LP_date = moment($LP_date, 'DD/MM/YYYY');
				var $diff = $LP_date.diff($OR_date, 'years', true); // 86400000
				$diff = Math.round($diff * 2) / 2;
				// $scope.new.restoration_age = $diff;
				$entry.restoration_age = $diff;
			}
		};

		$scope.dismiss = function ($message) {
			$scope.error_messages = _.without($scope.error_messages, $message);
		};

		$scope.restorationTypeName = function ($entry) {
			$restoration_type = _.find($scope.restoration_types, function ($type) {
				return $type.id === $entry.restoration_type_id;
			});
			$entry.restoration_type_name = $restoration_type.name;
		};

	});

})();