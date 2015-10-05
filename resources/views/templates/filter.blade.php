<div id="filter-entries">
    <input
        ng-model="filter"
        ng-list
        ng-keyup="filterEntries($event.keyCode)"
        type="text"
        placeholder="Search last names, comma separated"
        class="form-control">
</div>