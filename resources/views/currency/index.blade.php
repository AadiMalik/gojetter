@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Currency</h1>
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
                            {{--@can('currency_create')--}}
                                <a class="btn btn-primary btn-md m-1" href="javascript:void(0)" id="createNewCurrency"><i
                                        class="fa fa-plus text-white mr-2"></i> Add Currency</a>
                            {{--@endcan--}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="currency_table" class="table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Symbol</th>
                                            <th>Rate</th>
                                            <th>Default</th>
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
    @include('currency/Modal/currency_form')
@endsection
@section('js')
    <script src="{{ asset('public/js/common-methods/toasters.js') }}" type="module"></script>
    <script src="{{ asset('public/js/common-methods/http-requests.js') }}" type="module"></script>
    <script src="{{ url('currency/js/currency.js') }}" type="module"></script>
    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
    </script>
    @include('includes.datatable', [
        'columns' => "
                        {data: 'code' , name: 'code'},
                        {data: 'symbol' , name: 'symbol'},
                        {data: 'rate' , name: 'rate'},
                        {data: 'is_default' , name: 'is_default' , 'sortable': false , searchable: false},
                        {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'currency/data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'currency_table',
        'variable' => 'currency_table',
    ])
@endsection
