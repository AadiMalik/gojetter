<div class="modal fade" id="ajaxModel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form id="currencyForm" name="currencyForm" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code" class="control-label">Code:<span
                                        style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="code" name="code"
                                    placeholder="Enter Code" maxlength="50" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="symbol" class="control-label">Symbol:<span
                                        style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="symbol" name="symbol"
                                    placeholder="Enter symbol" maxlength="50" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rate" class="control-label">Rate:<span
                                        style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="rate" name="rate"
                                    placeholder="Enter rate" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button type="submit" id="saveBtn" class="btn btn-primary" value="create">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>