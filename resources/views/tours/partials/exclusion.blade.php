<div class="card mb-4">
    <form id="tourForm" action="{{ url('tour-additional/exclusion-store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tour_id" id="tour_id" value="{{ isset($tour) ? $tour->id : '' }}" />

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">
            <div class="row">
                {{-- item --}}
                <div class="col-md-12 form-group mb-3">
                    <label for="item">Item <span class="text-danger">*</span></label>
                    <input type="text" id="item" class="form-control" name="item" required>
                    @error('item')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<div class="card text-left">
    <div class="card-body">
        <div class="table-responsive">
            <table id="exclusion_table" class="table table-striped display" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

