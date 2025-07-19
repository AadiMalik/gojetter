<div class="modal fade" id="ajaxModel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form id="replyForm" name="replyForm" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="parent_id" id="parent_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="code" class="control-label">Reply:<span
                                        style="color:red;">*</span></label>
                                <textarea class="form-control summernote" name="reply" id="reply">{{ old('reply') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button type="submit" id="save-reply" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>