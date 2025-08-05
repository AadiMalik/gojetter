<div class="card mb-4">
    <form id="downloadsForm" action="{{ url('tour-additional/downloads-store') }}" method="post" enctype="multipart/form-data">
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
                {{-- file --}}
                <div class="col-md-12 form-group mb-3">
                    <label for="file">File <span class="text-danger">*</span></label>
                    <input type="file" id="file" class="form-control" name="file" required>
                    @error('file')
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
            <table id="downloads_table" class="table table-striped display" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">File</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

