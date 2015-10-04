<!-- ==============================display entries============================== -->
<div class="row">
	<div class="col-sm-12">
		<table class="table table-bordered">
			<caption class="bg-blue">Entries</caption>
			<tr>
				<th>first name</th>
				<th>last name</th>
				<th>tooth #</th>
				<th>restoration type</th>
				<th>original restoration date</th>
				<th>last photo date</th>
				<th>restoration age</th>
				<th>where kept</th>
				<th>note</th>
			</tr>
			<tr ng-repeat="entry in entries">
				<td ng-if="!entry.edit">[[entry.first_name]]</td>
				<td ng-if="entry.edit"><input type="text" ng-model="entry.first_name"></td>

				<td ng-if="!entry.edit">[[entry.last_name]]</td>
				<td ng-if="entry.edit"><input type="text" ng-model="entry.last_name"></td>

				<td ng-if="!entry.edit">[[entry.tooth_number]]</td>
				<td ng-if="entry.edit"><input type="text" ng-model="entry.tooth_number"></td>

				<td ng-if="!entry.edit">[[entry.restoration_type_name]]</td>
				<td ng-if="entry.edit">
					<select ng-model="entry.restoration_type_id" ng-options="type.id as type.name for type in restoration_types" ng-change="restorationTypeName(entry)" name="" id="">
						<!-- <option value=""></option> -->
						<!-- <option ng-repeat="type in restoration_types" value="[[type.id]]">[[type.name]]</option> -->
					</select>
				</td>

				<td ng-if="!entry.edit">[[entry.original_restoration_date.user]]</td>
				<td ng-if="entry.edit"><input type="text" ng-model="entry.original_restoration_date.user" ng-keyup="restorationAge($event.keyCode, entry.original_restoration_date.user, entry.last_photo_date.user, entry)"></td>

				<td ng-if="!entry.edit">[[entry.last_photo_date.user]]</td>
				<td ng-if="entry.edit"><input type="text" ng-model="entry.last_photo_date.user" ng-keyup="restorationAge($event.keyCode, entry.original_restoration_date.user, entry.last_photo_date.user, entry)"></td>

				<td ng-if="!entry.edit">[[entry.restoration_age]]</td>
				<td ng-if="entry.edit"><input type="text" ng-model="entry.restoration_age"></td>

				<td ng-if="!entry.edit">
					<span ng-repeat="folder in entry.where_kept" class="badge">[[folder.name]]</span>
				</td>
				<td ng-if="entry.edit">
					<span ng-repeat="folder in entry.where_kept" class="badge">[[folder.name]]</span>
					<!-- <button ng-click="editFolders()" class="btn btn-xs btn-default">edit</button> -->
				</td>

				<td class="note-container">
					<div ng-if="entry.note">
						<i class="note-icon fa fa-pencil-square"></i>
						<div class="note-popup">[[entry.note]]</div>
					</div>
				</td>

				<td>
					<button ng-click="editEntry(entry)" class="btn btn-default">edit</button>
					<!-- <button ng-if="entry.edit" ng-click="updateEntry(entry); entry.edit = false" class="btn btn-default">done</button> -->
				</td>
				<td>
					<button ng-click="deleteItem(entry.entry_id)" class="btn btn-default">delete</button>
				</td>
			</tr>

		</table>
	</div>
</div>