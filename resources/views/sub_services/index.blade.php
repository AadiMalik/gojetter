@extends('layouts.master')
@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Sub Services</h1>
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
                    @can('sub_service_create')
                    <a class="btn btn-primary btn-md m-1" href="{{ url('sub-services/create') }}"><i
                            class="fa fa-plus text-white mr-2"></i> Add Sub Service</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sub_service_table" class="table table-striped display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">slug</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Customer Form</th>
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
{data: 'name' , name: 'name'},
{data: 'slug' , name: 'slug'},
{data: 'service' , name: 'service' , 'sortable': false , searchable: false},
{data: 'image' , name: 'image' , 'sortable': false , searchable: false},
{data: 'has_customer_form' , name: 'has_customer_form' , 'sortable': false , searchable: false},
{data: 'is_active' , name: 'is_active' , 'sortable': false , searchable: false},
{data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
'route' => 'sub-services/data',
'buttons' => false,
'pageLength' => 10,
'class' => 'sub_service_table',
'variable' => 'sub_service_table',
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
    $("body").on("click", "#active", function() {
        var sub_service_id = $(this).data("id");
        $.ajax({
                type: "get",
                url: "{{ url('sub-services/status') }}/" + sub_service_id,
            })
            .done(function(data) {
                console.log(data);
                if (data.Success) {
                    successMessage(data.Message);
                    initDataTablesub_service_table();
                } else {
                    errorMessage(data.Message);
                }
            })
            .catch(function(err) {
                errorMessage(err.Message);
            });
    });
    $("body").on("click", "#deleteService", function() {
        var sub_service_id = $(this).data("id");
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
                        url: "{{ url('sub-services/destroy') }}/" + sub_service_id,
                    })
                    .done(function(data) {
                        if (data.Success) {
                            successMessage(data.Message);
                            initDataTablesub_service_table();
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