@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="breadcrumb">
                    <h1>Tour Dates ({{ $tour->title ?? '' }})</h1>
                    <ul>
                        <li>List</li>
                        <li>Create</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary btn-md m-1" href="{{ url('tours') }}"><i class="fa fa-retweet text-white mr-2"></i>
                    Back</a>
                <div class="btn-group">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Other
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-date') }}/{{ $tour->id }}">
                            <i class="fa fa-calendar mr-1"></i> Dates
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-itinerary') }}/{{ $tour->id }}">
                            <i class="fa fa-calendar mr-1"></i> Itinerary
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-inclusion') }}/{{ $tour->id }}">
                            <i class="fa fa-check mr-1"></i> Inclusion
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-exclusion') }}/{{ $tour->id }}">
                            <i class="fa fa-close mr-1"></i> Exclusion
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-faq') }}/{{ $tour->id }}">
                            <i class="fa fa-question-circle mr-1"></i> FAQs
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-image') }}/{{ $tour->id }}">
                            <i class="fa fa-image mr-1"></i> Gallery
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-download') }}/{{ $tour->id }}">
                            <i class="fa fa-download mr-1"></i> Downloads
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-5">
                <div class="card mb-4">
                    <form id="tourDateForm" action="{{ url('tour-date/store') }}" method="post"
                        enctype="multipart/form-data">
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
                                {{-- price --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input id="price" class="form-control" type="text" name="price" required>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- discount_price --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="discount_price">Discount Price</label>
                                    <input id="discount_price" class="form-control" type="text" name="discount_price"
                                        value="0">
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
            </div>
            <div class="col-md-7">
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
            </div>
        </div>

        <!-- end of row-->
    </div>
@endsection
@section('js')
    @include('includes.datatable', [
        'columns' => "
                                            {data: 'start_date' , name: 'start_date'},
                                            {data: 'end_date' , name: 'end_date'},
                                            {data: 'price_type' , name: 'price_type' , 'sortable': false , searchable: false},
                                            {data: 'price' , name: 'price'},
                                            {data: 'discount_price' , name: 'discount_price'},
                                            {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'date_slot_table',
        'variable' => 'date_slot_table',
        'datefilter' => false,
        'params' => "tour_id:$('#tour_id').val()",
    ])
    <script>
        function errorMessage(message) {

            toastr.error(message, "Error", {
                showMethod: "slideDown",
                hideMethod: "slideUp",
                timeOut: 2e3,
            });

        }

        function successMessage(message) {

            toastr.success(message, "Success", {
                showMethod: "slideDown",
                hideMethod: "slideUp",
                timeOut: 2e3,
            });

        }
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#tourDateForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let url = $(this).attr('action');

                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        console.log(res);
                        if (res.Success) {
                            successMessage(res.Message);
                            initDataTabledate_slot_table();
                            $('#tourDateForm')[0].reset();
                        } else {
                            errorMessage(res.Message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON?.Message) {
                            errorMessage(xhr.responseJSON.Message);
                        } else {
                            errorMessage("An unexpected error occurred.");
                        }
                    }
                });
            });
        });
        $("body").on("click", "#deleteTourDate", function() {
            var tour_date_id = $(this).data("id");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            type: "get",
                            url: "{{ url('tour-date/destroy') }}/" + tour_date_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTabledate_slot_table();
                            } else {
                                errorMessage(data.Message);
                            }
                        })
                        .catch(function(err) {
                            errorMessage(err.Message);
                        });
                }
            });
        });
    </script>
@endsection
