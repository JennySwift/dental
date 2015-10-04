<!-- ==============================for editing folder locations on existing entry============================== -->

<div ng-show="edit.show" class="popup-outer">
	<div class="popup-inner">
		<table class="table table-bordered">
			<caption class="bg-blue">edit entry</caption>
			<tr>
				<th>first name</th>
				<th>last name</th>
				<th>tooth #</th>
				<th>restoration type</th>
				<th>original restoration date</th>
				<th>last photo date</th>
				<th>restoration age</th>
			</tr>
			<tr>
				<td><input type="text" ng-model="edit.first_name"></td>
				<td><input type="text" ng-model="edit.last_name"></td>
				<td><input type="text" ng-model="edit.tooth_number"></td>
				<td>
					<select ng-model="edit.restoration_type_id" ng-options="type.id as type.name for type in restoration_types" ng-change="restorationTypeName(edit)" name="" id="">
					</select>
				</td>
				<td><input type="text" ng-model="edit.original_restoration_date.user" ng-keyup="restorationAge($event.keyCode, edit.original_restoration_date.user, edit.last_photo_date.user, edit)"></td>
				<td><input type="text" ng-model="edit.last_photo_date.user" ng-keyup="restorationAge($event.keyCode, edit.original_restoration_date.user, edit.last_photo_date.user, edit)"></td>
				<td><input type="text" ng-model="edit.restoration_age"></td>	
			</tr>
		</table>	
		
		<label ng-repeat="folder in folders" class="block">
			<input checklist-model="edit.where_kept" checklist-value="folder" type="checkbox">[[folder.name]]
		</label>

		<textarea ng-model="edit.note" name="" id="" cols="30" rows="10"></textarea>
		
		<div class="row">
			<div class="col-sm-12">
				<button ng-click="updateEntry(edit)" class="btn btn-default form-control">done</button>
			</div>
		</div>

	</div><!-- .popup-inner -->
</div><!-- .popup-outer -->