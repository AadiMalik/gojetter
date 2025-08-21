@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Orders</h1>
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
                            <table id="order_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Currency</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Total</th>
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
                             {data: 'order_date' , name: 'order_date'},
                             {data: 'quantity' , name: 'quantity'},
                             {data: 'currency' , name: 'currency'},
                             {data: 'sub_total' , name: 'sub_total'},
                             {data: 'discount' , name: 'discount'},
                             {data: 'total' , name: 'total'},
                             {data: 'status' , name: 'status' , 'sortable': false , searchable: false},
                            {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'order/data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'order_table',
        'variable' => 'order_table',
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
        $(document).on('change', '.order-status-dropdown', function() {
            let orderId = $(this).data('id');
            let newStatus = $(this).val();

            $.ajax({
                url: "{{ url('order/status') }}", // Adjust route as needed
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    order_id: orderId,
                    status: newStatus
                },
                success: function(data) {
                    if (data.Success) {
                        successMessage(data.Message);
                        initDataTableorder_table();
                    } else {
                        errorMessage(data.Message);
                        initDataTableorder_table();
                    }
                },
                error: function(xhr) {
                    errorMessage(xhr.Message);
                    initDataTableorder_table();
                }
            });
        });

        $("body").on("click", "#deleteOrder", function() {
            var order_id = $(this).data("id");
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
                            url: "{{ url('order/destroy') }}/" + order_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTableorder_table();
                            } else {
                                errorMessage(data.Message);
                                initDataTableorder_table();
                            }
                        })
                        .catch(function(err) {
                            errorMessage(err.Message);
                            initDataTableorder_table();
                        });
                }
            });
        });
    </script>
@endsection
