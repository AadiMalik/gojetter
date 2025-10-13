@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="breadcrumb">
                    <h1>Activity Dates ({{ $activity->title ?? '' }})</h1>
                    <ul>
                        <li>List</li>
                        <li>Create</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary btn-md m-1" href="{{ url('activity') }}"><i
                        class="fa fa-retweet text-white mr-2"></i>
                    Back</a>
                @include('activity.partials.other_link')

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
                    <form id="activityDateForm" action="{{ url('activity-date/store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="activity_id" id="activity_id"
                            value="{{ isset($activity) ? $activity->id : '' }}" />

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

                            {{-- dynamic section --}}
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5>Time Slots</h5>
                                <button type="button" id="addRow" class="btn btn-sm btn-success">
                                    + Add Slot
                                </button>
                            </div>

                            <div id="timeSlotsContainer">
                                {{-- First Row by default --}}
                                <div class="row time-slot mb-3">
                                    <div class="col-md-6 form-group">
                                        <label>Start Time</label>
                                        <input type="time" name="start_time[]" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>End Time</label>
                                        <input type="time" name="end_time[]" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Total Seats</label>
                                        <input type="number" name="total_seats[]" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group mt-4">
                                        <button type="button" class="btn btn-danger btn-sm removeRow">− Remove</button>
                                    </div>
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
                            <table id="activity_date_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
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
                            {data: 'date' , name: 'date'},
                            {data: 'price' , name: 'price'},
                            {data: 'discount_price' , name: 'discount_price'},
                            {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'activity_date_table',
        'variable' => 'activity_date_table',
        'datefilter' => false,
        'params' => "activity_id:$('#activity_id').val()",
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

            function toggleRemoveButtons() {
                let totalRows = $('#timeSlotsContainer .time-slot').length;
                if (totalRows <= 1) {
                    $('.removeRow').hide(); // hide if only 1 row
                } else {
                    $('.removeRow').show(); // show if more than 1
                }
            }

            toggleRemoveButtons();

            // Add new row
            $('#addRow').click(function() {
                let newRow = `
        <div class="row time-slot mb-3">
            <div class="col-md-6 form-group">
                <label>Start Time</label>
                <input type="time" name="start_time[]" class="form-control" required>
            </div>
            <div class="col-md-6 form-group">
                <label>End Time</label>
                <input type="time" name="end_time[]" class="form-control" required>
            </div>
            <div class="col-md-6 form-group">
                <label>Total Seats</label>
                <input type="number" name="total_seats[]" class="form-control" required>
            </div>
            <div class="col-md-6 form-group mt-4">
                <button type="button" class="btn btn-danger btn-sm removeRow">− Remove</button>
            </div>
        </div>`;
                $('#timeSlotsContainer').append(newRow);
                toggleRemoveButtons();
            });

            // Remove row
            $(document).on('click', '.removeRow', function() {
                $(this).closest('.time-slot').remove();
                toggleRemoveButtons();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // ✅ AJAX Submit Form
            $('#activityDateForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let url = $(this).attr('action');

                // Debug: print data in console
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
                            initDataTableactivity_date_table();
                            $('#activityDateForm')[0].reset();
                            $('#timeSlotsContainer').html(`
                        <div class="row time-slot mb-3">
                            <div class="col-md-6 form-group">
                                <label>Start Time</label>
                                <input type="time" name="start_time[]" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>End Time</label>
                                <input type="time" name="end_time[]" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Total Seats</label>
                                <input type="number" name="total_seats[]" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group mt-4">
                                <button type="button" class="btn btn-danger btn-sm removeRow">− Remove</button>
                            </div>
                        </div>
                    `);
                            toggleRemoveButtons();
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
        $("body").on("click", "#deleteActivityDate", function() {
            var activity_date_id = $(this).data("id");
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
                            url: "{{ url('activity-date/destroy') }}/" + activity_date_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTableactivity_date_table();
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
