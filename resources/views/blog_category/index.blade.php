@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Blog Categories</h1>
            <ul>
                <li>List</li>
                <li>All</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <!-- end of row -->
        <section class="contact-list">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">
                        <div class="card-header text-right bg-transparent">
                            {{--@can('blog_category_create')--}}
                                <a class="btn btn-primary btn-md m-1" href="javascript:void(0)" id="createNewBlogCategory"><i
                                        class="fa fa-plus text-white mr-2"></i> Add Blog Category</a>
                            {{--@endcan--}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="blog_category_table" class="table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end of col -->
                    </div>
                    <!-- end of row -->
                </div>
            </div>
        </section>
    </div>
    @include('blog_category/Modal/blog_category_form')
@endsection
@section('js')
    <script src="{{ asset('public/js/common-methods/toasters.js') }}" type="module"></script>
    <script src="{{ asset('public/js/common-methods/http-requests.js') }}" type="module"></script>
    <script src="{{ url('blog-category/js/blog_category.js') }}" type="module"></script>
    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
    </script>
    @include('includes.datatable', [
        'columns' => "
                        {data: 'name' , name: 'name'},
                        {data: 'is_active' , name: 'is_active' , 'sortable': false , searchable: false},
                        {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'blog-category/data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'blog_category_table',
        'variable' => 'blog_category_table',
    ])
@endsection
