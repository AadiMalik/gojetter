@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>FAQs</h1>
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
                        @can('faq_create')
                            <a class="btn btn-primary btn-md m-1" href="{{ url('faqs/create') }}" id="createNewProject"><i
                                    class="fa fa-plus text-white mr-2"></i> Add FAQ</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="faq_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Question</th>
                                        <th scope="col">Answer</th>
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
                         {data: 'question' , name: 'question'},
                         {data: 'answer' , name: 'answer'},
                         {data: 'is_active' , name: 'is_active' , 'sortable': false , searchable: false},
                        {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'faqs/data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'faq_table',
        'variable' => 'faq_table',
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
            var faq_id = $(this).data("id");
            $.ajax({
                    type: "get",
                    url: "{{ url('faqs/status') }}/" + faq_id,
                })
                .done(function(data) {
                    console.log(data);
                    if (data.Success) {
                        successMessage(data.Message);
                        initDataTablefaq_table();
                    } else {
                        errorMessage(data.Message);
                    }
                })
                .catch(function(err) {
                    errorMessage(err.Message);
                });
        });
        $("body").on("click", "#deleteFaq", function() {
            var faq_id = $(this).data("id");
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
                            url: "{{ url('faqs/destroy') }}/" + faq_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTablefaq_table();
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
