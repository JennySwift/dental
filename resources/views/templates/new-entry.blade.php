<h2>New entry</h2>
<div id="new-entry">
    <div>
        <div>
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
                    <td><input ng-model="new.first_name" type="text" placeholder="first name"></td>
                    <td><input ng-model="new.last_name" type="text" placeholder="last name"></td>
                    <td><input ng-model="new.tooth_number" type="text" placeholder="tooth #"></td>
                    <td>
                        <select ng-model="new.restoration_type_id" name="" id="">
                            <option ng-repeat="type in restorationTypes" value="[[type.id]]">[[type.name]]</option>
                        </select>
                    </td>
                    <td><input ng-model="new.OR_date" ng-keyup="restorationAge($event.keyCode, new.OR_date, new.LP_date, new)" type="text" placeholder="original restoration date" id="original-restoration-date"></td>
                    <td><input ng-model="new.LP_date" ng-keyup="restorationAge($event.keyCode, new.OR_date, new.LP_date, new)" type="text" placeholder="last photo date" id="last-photo-date"></td>
                    <td><input ng-model="new.restoration_age" type="text" placeholder="restoration age"></td>
                </tr>
            </table>
        </div>

    </div>

    <div class="margin-bottom">

        <div class="flex-parent">
            <div ng-repeat="folder in folders" class="flex-grow-1 center">
                [[folder.name]]
                <input ng-model="new.folders[folder.id]" type="checkbox">
            </div>
        </div>

    </div>

    <div class="margin-bottom">

        <div>
            <textarea ng-model="new.note" name="" id="" cols="30" rows="10"></textarea>
        </div>

    </div>

    <div>
        <div>
            <button ng-click="addEntry()" class="btn btn-success form-control">Add new entry</button>
        </div>
    </div>

</div>

