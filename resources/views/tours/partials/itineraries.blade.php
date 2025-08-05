<div class="card mb-4">
    <form id="tourForm" action="{{ url('tour-additional/itineraries-store') }}" method="post" enctype="multipart/form-data">
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
                {{-- day_number --}}
                <div class="col-md-6 form-group mb-3">
                    <label for="day_number">Day # <span class="text-danger">*</span></label>
                    <input id="day_number" class="form-control" type="number" name="day_number" required>
                    @error('day_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- title --}}
                <div class="col-md-6 form-group mb-3">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input id="title" class="form-control" type="text" name="title" required>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- image --}}
                <div class="col-md-6 form-group mb-3">
                    <label for="image">Image</label>
                    <input id="image" class="form-control" type="file" name="image">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- description --}}
                <div class="col-md-12 form-group mb-3">
                    <label for="description">Description <span class="text-danger">*</span></label>
                    <textarea id="description" class="form-control" name="description" required></textarea>
                    @error('description')
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
            <table id="itineraries_table" class="table table-striped display" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Day #</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

