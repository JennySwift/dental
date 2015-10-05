var app = angular.module('dentalApp', ['checklist-model']);

app.config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

(function () {

	app.controller('HomeController', function ($rootScope, $scope, RestorationTypesFactory, FoldersFactory, EntriesFactory) {

		$scope.new = {};
		$scope.filter = [];
		$scope.error_messages = [];
		$scope.edit = {}; //Used for the editing folders popup. not to be confused with $scope.info iteration edit property.
        $scope.show = {
            popups: {}
        };
        $scope.restorationTypes = restorationTypes;
        $scope.folders = folders;
        $scope.entries = entries;

        if (env === 'local') {
            $scope.new = {
                first_name: 'John',
                last_name: 'Doe',
                tooth_number: 3,
                restoration_type_id: 3,
                original_restoration_date: '1/1/2015',
                last_photo_date: '',
                folders: [],
                note: 'hi there'
            };
        }

        $rootScope.responseError = function (response) {
            $rootScope.$broadcast('provideFeedback', ErrorsFactory.responseError(response), 'error');
            //$rootScope.hideLoading();
        };

        $rootScope.closePopup = function ($event, $popup) {
            var $target = $event.target;
            if ($target.className === 'popup-outer') {
                $scope.show.popups[$popup] = false;
            }
        };

		$scope.myFilter = function ($keycode) {
			if ($keycode === 13) {
				select.filter($scope.filter).then(function (response) {
					$scope.entries = response.data;
				});
			}
		};

        function getEntries () {
            //$scope.showLoading();
            EntriesFactory.index()
                .then(function (response) {
                    $scope.entries = response.data;
                    //$scope.provideFeedback('');
                    //$scope.hideLoading();
                })
                .catch(function (response) {
                    $scope.responseError(response);
                });
        }

        $scope.insertEntry = function () {
            var $messages = [];

            if (!$scope.new.folders || $scope.new.folders.length === 0 ) {
                $messages.push("You haven't chosen a folder.");
            }
            else if (!$scope.new.first_name || $scope.new.first_name === "") {
                $messages.push("You haven't entered a first name.");
            }
            else if (!$scope.new.last_name || $scope.new.last_name === "") {
                $messages.push("You haven't entered a last name.");
            }
            else if (!$scope.new.tooth_number || $scope.new.tooth_number === "") {
                $messages.push("You haven't entered a tooth number.");
            }
            else if (!$scope.new.restoration_type_id) {
                $messages.push("You haven't selected a restoration type.");
            }

            if ($messages.length > 0) {
                for (var i = 0; i < $messages.length; i++) {
                    $rootScope.$broadcast('provideFeedback', $messages[i], 'error');
                }
                return false;
            }

			EntriesFactory.insert($scope.new).then(function (response) {
                $rootScope.$broadcast('provideFeedback', 'Entry added');
				getEntries();
				$scope.new = {};
				$("#original-restoration-date, #last-photo-date").val("");
			});
		};

        /**
         * to display the edit popup. updateEntry is to make the database changes.
         * @param $entry
         */
		$scope.editEntry = function ($entry) {
			$scope.edit = $entry;
			//$scope.edit.folders = {};
            $scope.edit.folders = $entry.folders;
			$scope.show.popups.editEntry = true;
		};

		$scope.updateEntry = function ($entry) {
			EntriesFactory.update($entry).then(function (response) {
                $rootScope.$broadcast('provideFeedback', 'Entry updated');
				$scope.show.popups.editEntry = false;
				getEntries();
			});
		};

		$scope.deleteEntry = function ($entry) {
            if (confirm('Are you sure?')) {
                EntriesFactory.destroy($entry).then(function (response) {
                    $rootScope.$broadcast('provideFeedback', 'Entry deleted');
                    $scope.entries = _.without($scope.entries, $entry);
                });
            }
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

		//$scope.dismiss = function ($message) {
		//	$scope.error_messages = _.without($scope.error_messages, $message);
		//};

		//$scope.restorationTypeName = function ($entry) {
		//	$restoration_type = _.find($scope.restoration_types, function ($type) {
		//		return $type.id === $entry.restoration_type_id;
		//	});
		//	$entry.restoration_type_name = $restoration_type.name;
		//};

	});

})();