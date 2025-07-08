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
                    <input type="hidden" name="id" value="{{ isset($tour) ? $tour->id : '' }}" />

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
                            {{-- Title --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input id="title" class="form-control" type="text" name="title"
                                    value="{{ old('title', $tour->title ?? '') }}" required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                <input id="slug" class="form-control" type="text" name="slug"
                                    value="{{ old('slug', $tour->slug ?? '') }}" readonly required>
                                @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Thumbnail --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="thumbnail">Thumbnail</label>
                                <input class="form-control" type="file" name="thumbnail">
                                @if(isset($tour) && $tour->thumbnail)
                                <img src="{{ asset('storage/app/public/'.$tour->thumbnail) }}" width="100" class="mt-2">
                                @endif
                                @error('thumbnail') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Overview --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="overview">Overview</label>
                                <textarea class="form-control summernote" name="overview">{{ old('overview', $tour->overview ?? '') }}</textarea>
                                @error('overview') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Short Description --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="short_description">Short Description</label>
                                <textarea class="form-control summernote" name="short_description">{{ old('short_description', $tour->short_description ?? '') }}</textarea>
                                @error('short_description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Full Description --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="full_description">Full Description</label>
                                <textarea class="form-control summernote" name="full_description">{{ old('full_description', $tour->full_description ?? '') }}</textarea>
                                @error('full_description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Duration Days --}}
                            <div class="col-md-6 form-group mb-3">
                                <label>Duration Days</label>
                                <input class="form-control" type="number" name="duration_days"
                                    value="{{ old('duration_days', $tour->duration_days ?? '') }}">
                                @error('duration_days') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Duration Nights --}}
                            <div class="col-md-6 form-group mb-3">
                                <label>Duration Nights</label>
                                <input class="form-control" type="number" name="duration_nights"
                                    value="{{ old('duration_nights', $tour->duration_nights ?? '') }}">
                                @error('duration_nights') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Tour Type --}}
                            <div class="col-md-6 form-group mb-3">
                                <label>Tour Type</label>
                                <input class="form-control" type="text" name="tour_type"
                                    value="{{ old('tour_type', $tour->tour_type ?? '') }}">
                                @error('tour_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Group Size --}}
                            <div class="col-md-6 form-group mb-3">
                                <label>Group Size</label>
                                <input class="form-control" type="number" name="group_size"
                                    value="{{ old('group_size', $tour->group_size ?? '') }}">
                                @error('group_size') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Languages --}}
                            <div class="col-md-6 form-group mb-3">
                                <label>Languages</label>
                                <input class="form-control" type="text" name="languages"
                                    value="{{ old('languages', $tour->languages ?? '') }}">
                                @error('languages') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Location --}}
                            <div class="col-md-6 form-group mb-3">
                                <label>Location</label>
                                <input class="form-control" type="text" name="location"
                                    value="{{ old('location', $tour->location ?? '') }}">
                                @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Price --}}
                            <div class="col-md-6 form-group mb-3">
                                <label>Price</label>
                                <input class="form-control" type="number" step="0.01" name="price"
                                    value="{{ old('price', $tour->price ?? '') }}">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Min Adults --}}
                            <div class="col-md-6 form-group mb-3">
                                <label>Min Adults</label>
                                <input class="form-control" type="number" name="min_adults"
                                    value="{{ old('min_adults', $tour->min_adults ?? '') }}">
                                @error('min_adults') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ url('tours') }}" class="btn btn-danger">Cancel</a>
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