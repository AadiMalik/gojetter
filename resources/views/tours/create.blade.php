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
                            <div class="col-md-4 form-group mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input id="title" class="form-control" type="text" name="title"
                                    value="{{ old('title', isset($tour) ? $tour->title : '') }}" required>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="col-md-4 form-group mb-3">
                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                <input id="slug" class="form-control" type="text" name="slug"
                                    value="{{ old('slug', isset($tour) ? $tour->slug : '') }}" readonly required>
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="col-md-4 form-group mb-3">
                                <label for="tour_category_id">Category <span class="text-danger">*</span></label>
                                <select name="tour_category_id" class="form-control" id="tour_category_id" required>
                                    <option value="" selected disabled>--Select Category--</option>
                                    @foreach ($tour_category as $item)
                                    <option value="{{ $item->id }}"
                                        @if (isset($tour)) {{ $item->id == $tour->tour_category_id ? 'selected' : '' }} @endif>
                                        {{ $item->name ?? '' }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('tour_category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Tags --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Tags <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="tags" required
                                    value="{{ old('tags', isset($tour) ? $tour->tags : '') }}">
                                @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Thumbnail --}}
                            <div class="col-md-4 form-group mb-3">
                                <label for="thumbnail">Thumbnail</label>
                                <input class="form-control" type="file" name="thumbnail">
                                @if (isset($tour) && $tour->thumbnail)
                                <img src="{{ asset('storage/app/public/' . $tour->thumbnail) }}" width="100"
                                    class="mt-2">
                                @endif
                                @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Duration --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Duration</label>
                                <input class="form-control" type="text" name="duration"
                                    value="{{ old('duration', isset($tour) ? $tour->duration : '') }}">
                                @error('duration')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Tour Type --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Tour Type</label>
                                <select name="tour_type" id="tour_type" class="form-control">
                                    <option value="private" {{ (isset($tour) && $tour->tour_type == 'private') ? 'selected' : '' }}>Private</option>
                                    <option value="group" {{ (isset($tour) && $tour->tour_type == 'group') ? 'selected' : '' }}>
                                        Group</option>
                                </select>
                                @error('tour_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Group Size --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Group Size</label>
                                <input class="form-control" type="number" name="group_size"
                                    value="{{ old('group_size', isset($tour) ? $tour->group_size : '') }}">
                                @error('group_size')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Languages --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Languages</label>
                                <input class="form-control" type="text" name="languages"
                                    value="{{ old('languages', isset($tour) ? $tour->languages : '') }}">
                                @error('languages')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            {{-- destination --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Destination <span class="text-danger">*</span></label>
                                <select name="destination_id" class="form-control" id="destination_id">
                                    @foreach($destinations as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('destination_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- age_limit --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Age Limit</label>
                                <input class="form-control" type="number" name="age_limit"
                                    value="{{ old('age_limit', isset($tour) ? $tour->age_limit : '') }}">
                                @error('age_limit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- difficulty_level --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Difficulty Level</label>
                                <select name="difficulty_level" id="difficulty_level" class="form-control">
                                    <option value="easy" {{ (isset($tour) && $tour->difficulty_level == 'easy') ? 'selected' : '' }}>Easy</option>
                                    <option value="moderate" {{ (isset($tour) && $tour->difficulty_level == 'moderate') ? 'selected' : '' }}>Moderate</option>
                                    <option value="challenging" {{ (isset($tour) && $tour->difficulty_level == 'challenging') ? 'selected' : '' }}>Challenging</option>
                                    <option value="hard" {{ (isset($tour) && $tour->difficulty_level == 'hard') ? 'selected' : '' }}>Hard</option>
                                    <option value="expert" {{ (isset($tour) && $tour->difficulty_level == 'expert') ? 'selected' : '' }}>Expert</option>
                                </select>
                                @error('difficulty_level')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- pickup_info --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Pickup Info</label>
                                <input class="form-control" type="text" name="pickup_info"
                                    value="{{ old('pickup_info', isset($tour) ? $tour->pickup_info : '') }}">
                                @error('pickup_info')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- dropoff_info --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Dropoff Info</label>
                                <input class="form-control" type="text" name="dropoff_info"
                                    value="{{ old('dropoff_info', isset($tour) ? $tour->dropoff_info : '') }}">
                                @error('dropoff_info')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- cut_of_day --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Cut of Day</label>
                                <input class="form-control" type="number" name="cut_of_day"
                                    value="{{ old('cut_of_day', isset($tour) ? $tour->cut_of_day : 0) }}">
                                @error('cut_of_day')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- is_featured --}}
                            <div class="col-md-4 form-group mb-3 mt-4">
                                <label class="switch pr-5 switch-primary mr-3"><input type="checkbox" name="is_featured" id="is_featured" @if(isset($tour) && $tour->is_featured==1) checked @endif ><span class="slider"></span> Is Featured</label>

                                @error('is_featured')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6"></div>
                            {{-- Overview --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="overview">Overview</label>
                                <textarea class="form-control" name="overview">{{ old('overview', isset($tour) ? $tour->overview : '') }}</textarea>
                                @error('overview')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- highlights --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="highlights">Highlights</label>
                                <textarea class="form-control" name="highlights">{{ old('highlights', isset($tour) ? $tour->highlights : '') }}</textarea>
                                @error('highlights')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Short Description --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="short_description">Short Description</label>
                                <textarea class="form-control" name="short_description">{{ old('short_description', isset($tour) ? $tour->short_description : '') }}</textarea>
                                @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Full Description --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="full_description">Full Description</label>
                                <textarea class="form-control" name="full_description">{{ old('full_description', isset($tour) ? $tour->full_description : '') }}</textarea>
                                @error('full_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
        $('#tour_category_id').select2();
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