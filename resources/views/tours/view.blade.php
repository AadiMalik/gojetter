@extends('layouts.master')

@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Tour Details</h1>
        <ul>
            <li>View</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    {{-- Thumbnail --}}
                    @if ($tour->thumbnail)
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Thumbnail</h5>
                        <img src="{{ asset('storage/app/public/'.$tour->thumbnail) }}" width="200" class="img-thumbnail">
                    </div>
                    @endif

                    {{-- Basic Info --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Basic Info</h5>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label><strong>Title:</strong></label>
                                <p>{{ $tour->title }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Category:</strong></label>
                                <p>{{ $tour->tour_category->name??'' }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Slug:</strong></label>
                                <p>{{ $tour->slug }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Overview and Descriptions --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Descriptions</h5>
                        <div class="mb-3">
                            <label><strong>Overview:</strong></label>
                            <div>{!! $tour->overview !!}</div>
                        </div>
                        <div class="mb-3">
                            <label><strong>Short Description:</strong></label>
                            <div>{!! $tour->short_description !!}</div>
                        </div>
                        <div>
                            <label><strong>Full Description:</strong></label>
                            <div>{!! $tour->full_description !!}</div>
                        </div>
                    </div>

                    {{-- Duration and Type --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Duration & Type</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label><strong>Duration Days:</strong></label>
                                <p>{{ $tour->duration_days }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Duration Nights:</strong></label>
                                <p>{{ $tour->duration_nights }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Tour Type:</strong></label>
                                <p>{{ $tour->tour_type }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Group Size:</strong></label>
                                <p>{{ $tour->group_size }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Languages & Location --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Language & Location</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label><strong>Languages:</strong></label>
                                <p>{{ $tour->languages }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Location:</strong></label>
                                <p>{{ $tour->location }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Pricing --}}
                    <div class="mb-4">
                        <h5 class="mb-3">Pricing</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label><strong>Price:</strong></label>
                                <p>{{ number_format($tour->price, 2) }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Min Adults:</strong></label>
                                <p>{{ $tour->min_adults }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{ url('tours') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ url('tours/edit/'.$tour->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
