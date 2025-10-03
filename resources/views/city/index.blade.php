@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>City</h1>
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
                            @can('city_create')
                                <a class="btn btn-primary btn-md m-1" href="javascript:void(0)" id="createNewCity"><i
                                        class="fa fa-plus text-white mr-2"></i> Add City</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="city_table" class="table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Country</th>
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
    @include('city/Modal/city_form')
@endsection
@section('js')
    <script src="{{ asset('public/js/common-methods/toasters.js') }}" type="module"></script>
    <script src="{{ asset('public/js/common-methods/http-requests.js') }}" type="module"></script>
    <script src="{{ url('city/js/city.js') }}" type="module"></script>
    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
        // $(document).ready(function () {
        //     $('#country_id').select2();
        // })
    </script>
    @include('includes.datatable', [
        'columns' => "
                        {data: 'name' , name: 'name'},
                        {data: 'country' , name: 'country' , 'sortable': false , searchable: false},
                        {data: 'is_active' , name: 'is_active' , 'sortable': false , searchable: false},
                        {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'city/data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'city_table',
        'variable' => 'city_table',
    ])
@endsection
