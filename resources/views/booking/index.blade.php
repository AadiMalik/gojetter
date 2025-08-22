@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Bookings</h1>
            <ul>
                <li>List</li>
                <li>All</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row mb-4">
            <div class="col-md-12 mb-3">
                <div class="card text-left">
                    <div class="card-header text-right bg-transparent">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="booking_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Tour</th>
                                        <th scope="col">Tour Date</th>
                                        <th scope="col">Participants</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
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
            <!-- end of col-->
        </div>
        <!-- end of row-->
    </div>
@endsection
@section('js')
    @include('includes.datatable', [
        'columns' => "
                             {data: 'booking_date' , name: 'booking_date'},
                             {data: 'tour' , name: 'tour', 'sortable': false , searchable: false},
                             {data: 'tour_date' , name: 'tour_date', 'sortable': false , searchable: false},
                             {data: 'total_participants' , name: 'total_participants'},
                             {data: 'total' , name: 'total'},
                             {data: 'status' , name: 'status' , 'sortable': false , searchable: false},
                            {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'booking/data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'booking_table',
        'variable' => 'booking_table',
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
        $(document).on('change', '.booking-status-dropdown', function() {
            let bookingId = $(this).data('id');
            let newStatus = $(this).val();

            $.ajax({
                url: "{{ url('booking/status') }}", // Adjust route as needed
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    booking_id: bookingId,
                    status: newStatus
                },
                success: function(data) {
                    if (data.Success) {
                        successMessage(data.Message);
                        initDataTablebooking_table();
                    } else {
                        errorMessage(data.Message);
                    }
                },
                error: function(xhr) {
                    errorMessage(xhr.Message);
                }
            });
        });

        $("body").on("click", "#deleteBooking", function() {
            var booking_id = $(this).data("id");
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
                            url: "{{ url('booking/destroy') }}/" + booking_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTablebooking_table();
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
