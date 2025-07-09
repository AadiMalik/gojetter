@extends('layouts.master')
@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Social Media</h1>
        @if (isset($social_media))
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
                <form action="{{ url('social-media/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($social_media) ? $social_media->id : '' }}" />

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
                                    value="{{ old('name', $social_media->name ?? '') }}" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Url --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="url">URL/ID <span class="text-danger">*</span></label>
                                <input id="url" class="form-control" type="text" name="url"
                                    value="{{ old('url', $social_media->url ?? '') }}" required>
                                @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Icon --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="icon">Icon @if(!isset($social_media))<span class="text-danger">*</span>@endif</label>
                                <input class="form-control" type="file" name="icon" @if(!isset($social_media)) required @endif>
                                @if(isset($social_media) && $social_media->icon)
                                <img src="{{ asset('storage/app/public/'.$social_media->icon) }}" width="50" class="mt-2">
                                @endif
                                @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ url('social-media') }}" class="btn btn-danger">Cancel</a>
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