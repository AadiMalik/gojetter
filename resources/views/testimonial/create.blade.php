@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Testimonial</h1>
            @if (isset($testimonial))
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
                    <form action="{{ url('testimonial/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($testimonial) ? $testimonial->id : '' }}" />

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
                                <div class="col-md-6 form-group mb-3">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input id="name" class="form-control" type="text" name="name"
                                        value="{{ old('name', $testimonial->name ?? '') }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- profession --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="profession">profession <span class="text-danger">*</span></label>
                                    <input id="profession" class="form-control" type="text" name="profession"
                                        value="{{ old('profession', $testimonial->profession ?? '') }}" required>
                                    @error('profession')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Answer --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="image">Image</label>
                                    <input class="form-control" type="file" name="image">
                                    @if (isset($testimonial) && $testimonial->image)
                                        <img src="{{ asset('storage/app/public/' . $testimonial->image) }}" width="100"
                                            class="mt-2">
                                    @endif
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- message --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="message">Message <span class="text-danger">*</span></label>
                                    <textarea id="message" class="form-control" name="message"
                                        required>{{ old('message', $testimonial->message ?? '') }}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ url('testimonial') }}" class="btn btn-danger">Cancel</a>
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
@endsection
