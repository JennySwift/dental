<!-- ==============================new entry============================== -->

<div class="row">
	<div class="col-sm-12">
		<table class="table table-bordered">
			<caption class="bg-blue">new entry</caption>
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
				<td><input ng-model="new.first_name" type="text" placeholder="first name"></td>
				<td><input ng-model="new.last_name" type="text" placeholder="last name"></td>
				<td><input ng-model="new.tooth_number" type="text" placeholder="tooth #"></td>
				<td>
					<select ng-model="new.restoration_type_id" name="" id="">
						<option ng-repeat="type in restoration_types" value="[[type.id]]">[[type.name]]</option>
					</select>
				</td>
				<td><input ng-model="new.OR_date" ng-keyup="restorationAge($event.keyCode, new.OR_date, new.LP_date, new)" type="text" placeholder="original restoration date" id="original-restoration-date"></td>
				<td><input ng-model="new.LP_date" ng-keyup="restorationAge($event.keyCode, new.OR_date, new.LP_date, new)" type="text" placeholder="last photo date" id="last-photo-date"></td>
				<td><input ng-model="new.restoration_age" type="text" placeholder="restoration age"></td>
			</tr>
		</table>
	</div>

</div> <!-- .row -->

<div class="row margin-bottom">

	<div class="flex-parent col-sm-12">
		<div ng-repeat="folder in folders" class="flex-grow-1 center">
			[[folder.name]][[folder.id]]
			<input ng-model="new.folders[folder.id]" type="checkbox">
		</div>
	</div>

</div>

<div class="row margin-bottom">
	
	<div class="col-sm-12">
		<textarea ng-model="new.note" name="" id="" cols="30" rows="10"></textarea>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">
		<button ng-click="add()" class="form-control">enter</button>
	</div>
</div>
