@extends('layouts.master')
@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Sub Services</h1>
        @if (isset($sub_service))
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
                <form action="{{ url('sub-services/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($sub_service) ? $sub_service->id : '' }}" />

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
                            {{-- Service --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="service_id">Service <span class="text-danger">*</span></label>
                                <select name="service_id" class="form-control" id="service_id" required>
                                    <option value="" selected disabled>--Select Service--</option>
                                    @foreach($services as $item)
                                    <option value="{{$item->id}}" @if(isset($sub_service)) {{($item->id==$sub_service->service_id)? 'selected':''}} @endif>{{$item->name??''}}</option>
                                    @endforeach
                                </select>
                                @error('service_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            {{-- Name --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input id="name" class="form-control" type="text" name="name"
                                    value="{{ old('name', isset($sub_service) ? $sub_service->name : '') }}" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                <input id="slug" class="form-control" type="text" name="slug"
                                    value="{{ old('slug', isset($sub_service) ? $sub_service->slug : '') }}" readonly required>
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- image --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="image">Image</label>
                                <input class="form-control" type="file" name="image">
                                @if (isset($sub_service) && $sub_service->image)
                                <img src="{{ asset('storage/app/public/' . $sub_service->image) }}" width="100"
                                    class="mt-2">
                                @endif
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- has_customer_form --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="has_customer_form">Has Customer Form</label>
                                <select id="has_customer_form" name="has_customer_form" class="form-control" required>
                                    <option value="0" {{ old('has_customer_form', isset($sub_service) ? $sub_service->has_customer_form : '') == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('has_customer_form', isset($sub_service) ? $sub_service->has_customer_form : '') == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                                @error('has_customer_form')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Full Description --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control summernote" name="description">{{ old('description', isset($sub_service) ? $sub_service->description : '') }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('sub-services') }}" class="btn btn-danger">Cancel</a>
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
        $('#service_id').select2();
    });

    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/[\s\W-]+/g, '-') // replace spaces & non-word chars with hyphens
            .replace(/^-+|-+$/g, ''); // trim starting/ending hyphens
    }

    $('#name').on('input', function() {
        const name = $(this).val();
        const slug = slugify(name);
        $('#slug').val(slug);
    });
</script>
@endsection