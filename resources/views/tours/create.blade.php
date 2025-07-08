@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Tour</h1>
            @if (isset($tour))
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
                    <form action="{{ url('tours/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" value="{{ isset($tour) ? $tour->id : '' }}" />
                                <div class="col-md-6 form-group mb-3">
                                    <label for="name">Title<span class="text-danger">*</span> </label>
                                    <input class="form-control" type="text" name="title"
                                        value="{{ isset($tour) ? $tour->title : old('title') }}" maxlength="50"
                                        placeholder="Enter title" required />
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="slug">Slug<span class="text-danger">*</span> </label>
                                    <input class="form-control" type="text" name="name"
                                        value="{{ isset($tour) ? $tour->slug : old('slug') }}" maxlength="50"
                                        placeholder="Enter tour slug" required readonly />
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="name">Email<span class="text-danger">*</span> </label>
                                    <input class="form-control" type="email" name="email"
                                        value="{{ isset($tour) ? $tour->email : old('email') }}" maxlength="50"
                                        placeholder="Enter tour EMail" required />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="name">tour Phone</label>
                                    <input class="form-control" type="phone" name="phone"
                                        value="{{ isset($tour) ? $tour->phone : old('phone') }}" maxlength="50"
                                        placeholder="Enter tour Phone" />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="name">Password<span class="text-danger">*</span> </label>
                                    <input class="form-control" type="password" name="password" value=""
                                        maxlength="16" placeholder="Enter tour Password" required />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="name">Confirm Password<span class="text-danger">*</span> </label>
                                    <input class="form-control" type="password" name="password_confirmation" value=""
                                        maxlength="16" placeholder="Renter Password" required />
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="role">Role<span class="text-danger">*</span> </label>
                                    <select class="form-control select2" name="role" id="role" required
                                        style="width: 100%;">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ isset($tour) && $tour->hasRole($role->name) ? 'selected' : '' }}>
                                                {{ $role->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">

                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ url('tours') }}" class="btn btn-danger">Cancel</a>
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
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
            $('#summernote').summernote();
        });

        function slugify(text) {
            return text
                .toString()
                .toLowerCase()
                .trim()
                .replace(/[\s\W-]+/g, '-') // replace spaces & non-word chars with hyphens
                .replace(/^-+|-+$/g, ''); // trim starting/ending hyphens
        }

        $('#title').on('input', function() {
            const title = $(this).val();
            const slug = slugify(title);
            $('#slug').val(slug);
        });
    </script>
@endsection
