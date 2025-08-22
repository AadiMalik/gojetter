@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Permissions</h1>
            <ul>
                <li>List</li>
                <li>All</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row mb-4">
            <div class="col-md-12 mb-3">
                <div class="card text-left">
                    <div class="card-header text-right bg-transparent">
                        @can('permissions_create')
                        <a class="btn btn-primary btn-md m-1" href="javascript:void(0)" id="createNewPermission"><i
                                class="fa fa-plus text-white mr-2"></i> Add Permission</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="permission_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Permission Name</th>
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
    @include('permissions/Modal/permission_form')
@endsection
@section('js')
    <script src="{{ asset('public/js/common-methods/toasters.js') }}" type="module"></script>
    <script src="{{ asset('public/js/common-methods/http-requests.js') }}" type="module"></script>
    <script src="{{ url('permissions/js/permission.js') }}" type="module"></script>
    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
    </script>
    @include('includes.datatable', [
        'columns' => "
                     {data: 'name' , name: 'name'},
                    {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'permissions/data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'permission_table',
        'variable' => 'permission_table',
    ])
@endsection
