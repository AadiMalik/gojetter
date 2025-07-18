@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Tour Images</h1>
            <ul>
                <li>List</li>
                <li>Create</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row mb-4">
            <div class="col-md-5 mb-3">
                <div class="card mb-4">
                    <form id="tourForm" action="{{ url('tour-image/store') }}" method="post" enctype="multipart/form-data">
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
                                {{-- Name --}}
                                <div class="col-md-12 form-group mb-3">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input id="name" class="form-control" type="text" name="name" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Answer --}}
                                <div class="col-md-12 form-group mb-3">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="image" required>
                                    @error('image')
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
            <div class="col-md-7 mb-3">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tour_image_table" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Image</th>
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
                                             {data: 'image' , name: 'image'},
                                            {data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
        'route' => 'data',
        'buttons' => false,
        'pageLength' => 10,
        'class' => 'tour_image_table',
        'variable' => 'tour_image_table',
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

            $('#tourForm').on('submit', function(e) {
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
                            initDataTabletour_image_table();
                            $('#tourForm')[0].reset();
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
        $("body").on("click", "#deleteTourImage", function() {
            var tour_image_id = $(this).data("id");
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
                            url: "{{ url('tour-image/destroy') }}/" + tour_image_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTabletour_image_table();
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
