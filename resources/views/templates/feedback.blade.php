<div class="row">
    <div class="col-sm-12">
        <div ng-repeat = "message in error_messages" class="error-messages">
            <p class="">[[message]]</p>
            <button ng-click="dismiss(message)" class="btn btn-xs btn-default">dismiss</button>
        </div>
    </div>
</div>