@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="breadcrumb">
                    <h1>Tour FAQs ({{ $tour->title ?? '' }})</h1>
                    <ul>
                        <li>List</li>
                        <li>Create</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary btn-md m-1" href="{{ url('tours') }}"><i class="fa fa-retweet text-white mr-2"></i>
                    Back</a>
                    @include('tours.partials.other_link')

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
                    <form id="tourFaqForm" action="{{ url('tour-faq/store') }}" method="post"
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
                                {{-- question --}}
                                <div class="col-md-12 form-group mb-3">
                                    <label for="question">Question <span class="text-danger">*</span></label>
                                    <input id="question" class="form-control" type="text" name="question" required>
                                    @error('question')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- answer --}}
                                <div class="col-md-12 form-group mb-3">
                                    <label for="answer">answer <span class="text-danger">*</span></label>
                                    <textarea id="answer" class="form-control" name="answer" required></textarea>
                                    @error('answer')
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
                            <table id="tour_faq_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Question</th>
                                        <th scope="col">Answer</th>
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
                {data: 'question' , name: 'question'},
                {data: 'answer' , name: 'answer'},
                {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'tour_faq_table',
        'variable' => 'tour_faq_table',
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

            $('#tourFaqForm').on('submit', function(e) {
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
                            initDataTabletour_faq_table();
                            $('#tourFaqForm')[0].reset();
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
        $("body").on("click", "#deleteTourFaq", function() {
            var tour_faq_id = $(this).data("id");
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
                            url: "{{ url('tour-faq/destroy') }}/" + tour_faq_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTabletour_faq_table();
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
