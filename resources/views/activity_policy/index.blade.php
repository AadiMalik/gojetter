@extends('layouts.master')
@section('content')
<div class="main-content pt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="breadcrumb">
                <h1>Activity Policies ({{ $activity->title ?? '' }})</h1>
                <ul>
                    <li>List</li>
                    <li>Create</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <a class="btn btn-primary btn-md m-1" href="{{ url('activity') }}"><i class="fa fa-retweet text-white mr-2"></i>
                Back</a>
            @include('activity.partials.other_link')
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
                <form id="activityPolicyForm" action="{{ url('activity-policy/store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="activity_id" id="activity_id" value="{{ isset($activity) ? $activity->id : '' }}" />

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
                            {{-- title --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input id="title" class="form-control" type="text" name="title" required>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea id="description" class="form-control" name="description" required></textarea>
                                @error('description')
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
                        <table id="activity_policy_table" class="table table-striped display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
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
    </div>

    <!-- end of row-->
</div>
@endsection
@section('js')
@include('includes.datatable', [
'columns' => "
{data: 'title' , name: 'title'},
{data: 'description' , name: 'description'},
{data: 'action' , name: 'action' , 'sortable': false , searchable: false},",
'route' => 'data',
'buttons' => false,
'pageLength' => 10,
'class' => 'activity_policy_table',
'variable' => 'activity_policy_table',
'datefilter' => false,
'params' => "activity_id:$('#activity_id').val()",
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

        $('#activityPolicyForm').on('submit', function(e) {
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
                        initDataTableactivity_policy_table();
                        $('#activityPolicyForm')[0].reset();
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
    $("body").on("click", "#deleteActivityPolicy", function() {
        var activity_policy_id = $(this).data("id");
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
                        url: "{{ url('activity-policy/destroy') }}/" + activity_policy_id,
                    })
                    .done(function(data) {
                        if (data.Success) {
                            successMessage(data.Message);
                            initDataTableactivity_policy_table();
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