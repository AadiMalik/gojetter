<div class="card mb-4">
    <form id="tourForm" action="{{ url('tour-additional/date-slot-store') }}" method="post" enctype="multipart/form-data">
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
                {{-- start_date --}}
                <div class="col-md-6 form-group mb-3">
                    <label for="start_date">Start Date <span class="text-danger">*</span></label>
                    <input id="start_date" class="form-control" type="date" name="start_date" required>
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- end_date --}}
                <div class="col-md-6 form-group mb-3">
                    <label for="end_date">End Date <span class="text-danger">*</span></label>
                    <input id="end_date" class="form-control" type="date" name="end_date" required>
                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- price_type --}}
                <div class="col-md-6 form-group mb-3">
                    <label for="price_type">Price Type <span class="text-danger">*</span></label>
                    <select name="price_type" class="form-control" id="price_type" required>
                        <option value="per_person">Per Person</option>
                        <option value="per_group">Per Group</option>
                    </select>
                    @error('price_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- regular_price --}}
                <div class="col-md-6 form-group mb-3">
                    <label for="regular_price">Price <span class="text-danger">*</span></label>
                    <input id="regular_price" class="form-control" type="text" name="regular_price" required>
                    @error('regular_price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- discount_price --}}
                <div class="col-md-6 form-group mb-3">
                    <label for="discount_price">Price</label>
                    <input id="discount_price" class="form-control" type="text" name="discount_price" value="0">
                    @error('discount_price')
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
            <table id="date_slot_table" class="table table-striped display" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Price Type</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

