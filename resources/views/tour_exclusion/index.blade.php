@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="breadcrumb">
                    <h1>Tour Exclusion ({{ $tour->title ?? '' }})</h1>
                    <ul>
                        <li>List</li>
                        <li>Create</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary btn-md m-1" href="{{ url('tours') }}"><i class="fa fa-retweet text-white mr-2"></i>
                    Back</a>
                <div class="btn-group">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Other
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-date') }}/{{ $tour->id }}">
                            <i class="fa fa-calendar mr-1"></i> Dates
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-itinerary') }}/{{ $tour->id }}">
                            <i class="fa fa-calendar mr-1"></i> Itinerary
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-inclusion') }}/{{ $tour->id }}">
                            <i class="fa fa-check mr-1"></i> Inclusion
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-exclusion') }}/{{ $tour->id }}">
                            <i class="fa fa-close mr-1"></i> Exclusion
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-faq') }}/{{ $tour->id }}">
                            <i class="fa fa-question-circle mr-1"></i> FAQs
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-image') }}/{{ $tour->id }}">
                            <i class="fa fa-image mr-1"></i> Gallery
                        </a>
                        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                            href="{{ url('tour-download') }}/{{ $tour->id }}">
                            <i class="fa fa-download mr-1"></i> Downloads
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-5">
                <div class="card mb-4">
                    <form id="tourExclusionForm" action="{{ url('tour-exclusion/store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tour_id" id="tour_id" value="{{ isset($tour) ? $tour->id : '' }}" />

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                {{-- day_number --}}
                                <div class="col-md-12 form-group mb-3">
                                    <label for="item">Item <span class="text-danger">*</span></label>
                                    <input id="item" class="form-control" type="text" name="item" required>
                                    @error('item')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tour_exclusion_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
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
        </div>

        <!-- end of row-->
    </div>
@endsection
@section('js')
    @include('includes.datatable', [
        'columns' => "
                {data: 'item' , name: 'item'},
                {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'tour_exclusion_table',
        'variable' => 'tour_exclusion_table',
        'datefilter' => false,
        'params' => "tour_id:$('#tour_id').val()",
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#tourExclusionForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let url = $(this).attr('action');

                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        console.log(res);
                        if (res.Success) {
                            successMessage(res.Message);
                            initDataTabletour_exclusion_table();
                            $('#tourExclusionForm')[0].reset();
                        } else {
                            errorMessage(res.Message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON?.Message) {
                            errorMessage(xhr.responseJSON.Message);
                        } else {
                            errorMessage("An unexpected error occurred.");
                        }
                    }
                });
            });
        });
        $("body").on("click", "#deleteTourExclusion", function() {
            var tour_exclusion_id = $(this).data("id");
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
                            url: "{{ url('tour-exclusion/destroy') }}/" + tour_exclusion_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTabletour_exclusion_table();
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
