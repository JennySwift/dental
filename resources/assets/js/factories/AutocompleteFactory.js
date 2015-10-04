app.factory('AutocompleteFactory', function () {
	var $object = {};
	$object.autocompleteUpArrow = function () {
		if ($(".selected").prev(".autocomplete-dropdown-item").length > 0) {
			//there is an item before the selected one
			$(".selected").prev(".autocomplete-dropdown-item").addClass('selected');
			$(".selected").last().removeClass('selected');
		}
	};
	$object.autocompleteDownArrow = function () {
		if ($(".selected").next(".autocomplete-dropdown-item").length > 0) {
			//there is an item after the selected one
			$(".selected").next(".autocomplete-dropdown-item").addClass('selected');
			$(".selected").first().removeClass('selected');
		}
	};

	return $object;
});






