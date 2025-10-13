<div class="modal fade" id="ajaxModel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form id="cityForm" name="cityForm" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Name:<span
                                        style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter name" maxlength="50" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country_id">Country <span class="text-danger">*</span></label>
                                <select name="country_id" class="form-control" id="country_id" required style="width: 100%;">
                                    <option value="" selected disabled>--Select Country--</option>
                                    @foreach($country as $item)
                                    <option value="{{$item->id}}">{{$item->name??''}}</option>
                                    @endforeach
                                </select>
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