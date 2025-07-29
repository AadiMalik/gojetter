@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Blogs</h1>
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
                        <a class="btn btn-primary btn-md m-1" href="{{ url('blogs/create') }}"><i
                                class="fa fa-plus text-white mr-2"></i> Add Blog</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="blog_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">slug</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Author</th>
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
                 {data: 'title' , name: 'title'},
                 {data: 'slug' , name: 'slug'},
                 {data: 'category' , name: 'category' , 'sortable': false , searchable: false},
                 {data: 'author' , name: 'author'},
                 {data: 'is_active' , name: 'is_active' , 'sortable': false , searchable: false},
                {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'blogs/data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'blog_table',
        'variable' => 'blog_table',
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
            var blog_id = $(this).data("id");
            $.ajax({
                    type: "get",
                    url: "{{ url('blogs/status') }}/" + blog_id,
                })
                .done(function(data) {
                    console.log(data);
                    if (data.Success) {
                        successMessage(data.Message);
                        initDataTableblog_table();
                    } else {
                        errorMessage(data.Message);
                    }
                })
                .catch(function(err) {
                    errorMessage(err.Message);
                });
        });
        $("body").on("click", "#deleteBlog", function() {
            var blog_id = $(this).data("id");
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
                            url: "{{ url('blogs/destroy') }}/" + blog_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTableblog_table();
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
