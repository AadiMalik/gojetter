@extends('layouts.master')
@section('content')
<div class="main-content pt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="breadcrumb">
                <h1>Activity Time Slots ({{ $activity_date->date ?? '' }})</h1>
                <ul>
                    <li>List</li>
                    <li>Create</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <a class="btn btn-primary btn-md m-1" href="{{ url('activity-date/'.$activity_date->activity_id) }}"><i class="fa fa-retweet text-white mr-2"></i>
                Back</a>
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
                <form id="activityTimeSlotForm" action="{{ url('activity-time-slot/store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="activity_date_id" id="activity_date_id" value="{{ isset($activity_date) ? $activity_date->id : '' }}" />

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
                            {{-- start_time --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="start_time">Start Time <span class="text-danger">*</span></label>
                                <input id="start_time" class="form-control" type="time" name="start_time" required>
                                @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- end_time --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="end_time">End Time <span class="text-danger">*</span></label>
                                <input id="end_time" class="form-control" type="time" name="end_time" required>
                                @error('end_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- total_seats --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="total_seats">Total Seats <span class="text-danger">*</span></label>
                                <input id="total_seats" class="form-control" type="text" name="total_seats" required>
                                @error('total_seats')
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
                        <table id="activity_time_slot_table" class="table table-striped display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Total Seats</th>
                                    <th scope="col">Available Seats</th>
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
{data: 'start_time' , name: 'start_time'},
{data: 'end_time' , name: 'end_time'},
{data: 'total_seats' , name: 'total_seats'},
{data: 'available_seats' , name: 'available_seats'},
{data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
'route' => 'data',
'buttons' => false,
'pageLength' => 10,
'class' => 'activity_time_slot_table',
'variable' => 'activity_time_slot_table',
'datefilter' => false,
'params' => "activity_date_id:$('#activity_date_id').val()",
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

        $('#activityTimeSlotForm').on('submit', function(e) {
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
                        initDataTableactivity_time_slot_table();
                        $('#activityTimeSlotForm')[0].reset();
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
    $("body").on("click", "#deleteActivityTimeSlot", function() {
        var activity_time_slot_id = $(this).data("id");
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
                        url: "{{ url('activity-time-slot/destroy') }}/" + activity_time_slot_id,
                    })
                    .done(function(data) {
                        if (data.Success) {
                            successMessage(data.Message);
                            initDataTableactivity_time_slot_table();
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