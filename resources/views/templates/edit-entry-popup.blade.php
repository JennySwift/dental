
<div
    ng-show="show.popups.editEntry"
    {{--ng-click="closePopup($event, 'editEntry')"--}}
    class="popup-outer">

    <div id="edit-entry-popup" class="popup-inner">
        <table class="table table-bordered">
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

        <div>
            <div>
                <button ng-click="updateEntry(edit)" class="btn btn-success form-control">Save</button>
            </div>
        </div>

        {{--<div class="popup-buttons">--}}
            {{--<button ng-click="show.popups.budget = false" class="btn btn-danger">Cancel</button>--}}
            {{--<button ng-click="updateBudget()" class="btn btn-success">Save</button>--}}
        {{--</div>--}}

    </div><!-- .popup-inner -->

</div>