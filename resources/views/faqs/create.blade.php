@extends('layouts.master')
@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>FAQ</h1>
        @if (isset($faq))
        <ul>
            <li>Update</li>
            <li>Edit</li>
        </ul>
        @else
        <ul>
            <li>Create</li>
            <li>Add</li>
        </ul>
        @endif
    </div>
    <div class="separator-breadcrumb border-top"></div>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <form action="{{ url('faqs/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($faq) ? $faq->id : '' }}" />

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
                            {{-- Question --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="question">Question <span class="text-danger">*</span></label>
                                <input id="question" class="form-control" type="text" name="question"
                                    value="{{ old('question', $faq->question ?? '') }}" required>
                                @error('question') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Answer --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="answer">Answer <span class="text-danger">*</span></label>
                                <textarea class="form-control summernote" name="answer" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                                @error('answer') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ url('faqs') }}" class="btn btn-danger">Cancel</a>
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- end of main-content -->
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150,
        });
    });
</script>
@endsection