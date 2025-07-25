@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Terms & Conditions</h1>
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
                            <table id="term_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Description</th>
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
                     {data: 'description' , name: 'description'},
                    {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'terms/data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'term_table',
        'variable' => 'term_table',
    ])
@endsection
