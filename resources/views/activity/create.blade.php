@extends('layouts.master')
@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Activity</h1>
        @if (isset($activity))
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
                <form action="{{ url('activity/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($activity) ? $activity->id : '' }}" />

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
                                    value="{{ old('title', isset($activity) ? $activity->title : '') }}" required>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="col-md-4 form-group mb-3">
                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                <input id="slug" class="form-control" type="text" name="slug"
                                    value="{{ old('slug', isset($activity) ? $activity->slug : '') }}" readonly required>
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="col-md-4 form-group mb-3">
                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control" id="category_id" required>
                                    <option value="" selected disabled>--Select Category--</option>
                                    @foreach ($activity_category as $item)
                                    <option value="{{ $item->id }}"
                                        @if (isset($activity)) {{ $item->id == $activity->category_id ? 'selected' : '' }} @endif>
                                        {{ $item->name ?? '' }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Tags --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Tags <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="tags" required
                                    value="{{ old('tags', isset($activity) ? $activity->tags : '') }}">
                                @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Thumbnail --}}
                            <div class="col-md-4 form-group mb-3">
                                <label for="thumbnail">Thumbnail</label>
                                <input class="form-control" type="file" name="thumbnail">
                                @if (isset($activity) && $activity->thumbnail)
                                <img src="{{ asset('storage/app/public/' . $activity->thumbnail) }}" width="100"
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
                                    value="{{ old('duration', isset($activity) ? $activity->duration : '') }}">
                                @error('duration')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- activity Type --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>activity Type</label>
                                <select name="activity_type" id="activity_type" class="form-control">
                                    <option value="private" {{ (isset($activity) && $activity->activity_type == 'private') ? 'selected' : '' }}>Private</option>
                                    <option value="group" {{ (isset($activity) && $activity->activity_type == 'group') ? 'selected' : '' }}>
                                        Group</option>
                                </select>
                                @error('activity_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Group Size --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Group Size</label>
                                <input class="form-control" type="number" name="group_size"
                                    value="{{ old('group_size', isset($activity) ? $activity->group_size : '') }}">
                                @error('group_size')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Languages --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Languages</label>
                                <input class="form-control" type="text" name="languages"
                                    value="{{ old('languages', isset($activity) ? $activity->languages : '') }}">
                                @error('languages')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            {{-- Location --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Location</label>
                                <input class="form-control" type="text" name="location"
                                    value="{{ old('location', isset($activity) ? $activity->location : '') }}">
                                @error('location')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- age_limit --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Age Limit</label>
                                <input class="form-control" type="number" name="age_limit"
                                    value="{{ old('age_limit', isset($activity) ? $activity->age_limit : '') }}">
                                @error('age_limit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- difficulty_level --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Difficulty Level</label>
                                <select name="difficulty_level" id="difficulty_level" class="form-control">
                                    <option value="easy" {{ (isset($activity) && $activity->difficulty_level == 'easy') ? 'selected' : '' }}>Easy</option>
                                    <option value="moderate" {{ (isset($activity) && $activity->difficulty_level == 'moderate') ? 'selected' : '' }}>Moderate</option>
                                    <option value="challenging" {{ (isset($activity) && $activity->difficulty_level == 'challenging') ? 'selected' : '' }}>Challenging</option>
                                    <option value="hard" {{ (isset($activity) && $activity->difficulty_level == 'hard') ? 'selected' : '' }}>Hard</option>
                                    <option value="expert" {{ (isset($activity) && $activity->difficulty_level == 'expert') ? 'selected' : '' }}>Expert</option>
                                </select>
                                @error('difficulty_level')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- pickup_info --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Pickup Info</label>
                                <input class="form-control" type="text" name="pickup_info"
                                    value="{{ old('pickup_info', isset($activity) ? $activity->pickup_info : '') }}">
                                @error('pickup_info')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- dropoff_info --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Dropoff Info</label>
                                <input class="form-control" type="text" name="dropoff_info"
                                    value="{{ old('dropoff_info', isset($activity) ? $activity->dropoff_info : '') }}">
                                @error('dropoff_info')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- cut_of_day --}}
                            <div class="col-md-4 form-group mb-3">
                                <label>Cut of Day</label>
                                <input class="form-control" type="number" name="cut_of_day"
                                    value="{{ old('cut_of_day', isset($activity) ? $activity->cut_of_day : 0) }}">
                                @error('cut_of_day')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- is_featured --}}
                            <div class="col-md-4 form-group mb-3 mt-4">
                                <label class="switch pr-5 switch-primary mr-3"><input type="checkbox" name="is_featured" id="is_featured" @if(isset($activity) && $activity->is_featured==1) checked @endif ><span class="slider"></span> Is Featured</label>

                                @error('is_featured')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- is_wheelchair_accessible --}}
                            <div class="col-md-4 form-group mb-3 mt-4">
                                <label class="switch pr-5 switch-primary mr-3"><input type="checkbox" name="is_wheelchair_accessible" id="is_wheelchair_accessible" @if(isset($activity) && $activity->is_wheelchair_accessible==1) checked @endif ><span class="slider"></span> Wheelchair Accessible</label>

                                @error('is_wheelchair_accessible')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- is_stroller_friendly --}}
                            <div class="col-md-4 form-group mb-3 mt-4">
                                <label class="switch pr-5 switch-primary mr-3"><input type="checkbox" name="is_stroller_friendly" id="is_stroller_friendly" @if(isset($activity) && $activity->is_stroller_friendly==1) checked @endif ><span class="slider"></span> Stroller Friendly</label>

                                @error('is_stroller_friendly')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- rules --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="rules">Rules</label>
                                <textarea class="form-control" name="rules">{{ old('rules', isset($activity) ? $activity->rules : '') }}</textarea>
                                @error('rules')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>{{-- requirements --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="requirements">Requirements</label>
                                <textarea class="form-control" name="requirements">{{ old('requirements', isset($activity) ? $activity->requirements : '') }}</textarea>
                                @error('requirements')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>{{-- disclaimers --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="disclaimers">Disclaimers</label>
                                <textarea class="form-control" name="disclaimers">{{ old('disclaimers', isset($activity) ? $activity->disclaimers : '') }}</textarea>
                                @error('disclaimers')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- highlights --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="highlights">Highlights</label>
                                <textarea class="form-control" name="highlights">{{ old('highlights', isset($activity) ? $activity->highlights : '') }}</textarea>
                                @error('highlights')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Overview --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="overview">Overview</label>
                                <textarea class="form-control" name="overview">{{ old('overview', isset($activity) ? $activity->overview : '') }}</textarea>
                                @error('overview')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Short Description --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="short_description">Short Description</label>
                                <textarea class="form-control" name="short_description">{{ old('short_description', isset($activity) ? $activity->short_description : '') }}</textarea>
                                @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Full Description --}}
                            <div class="col-md-12 form-group mb-3">
                                <label for="full_description">Full Description</label>
                                <textarea class="form-control" name="full_description">{{ old('full_description', isset($activity) ? $activity->full_description : '') }}</textarea>
                                @error('full_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ url('activity') }}" class="btn btn-danger">Cancel</a>
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
        $('')({
            height: 150,
        });
        $('#category_id').select2();
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