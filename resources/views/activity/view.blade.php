@extends('layouts.master')

@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Activity Details</h1>
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
                    @if ($activity->thumbnail)
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Thumbnail</h5>
                        <img src="{{ asset('storage/app/public/' . $activity->thumbnail) }}" width="200"
                            class="img-thumbnail">
                    </div>
                    @endif

                    {{-- Basic Info --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Basic Info</h5>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label><strong>Title:</strong></label>
                                <p>{{ $activity->title }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Category:</strong></label>
                                <p>{{ $activity->tour_category->name ?? '' }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Slug:</strong></label>
                                <p>{{ $activity->slug }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Tag:</strong></label>
                                <p>{{ $activity->tags ?? '' }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Is Featured:</strong></label>
                                <p>{{ $activity->is_featured == 1 ? 'Yes' : 'No' }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Wheelchair Accessible:</strong></label>
                                <p>{{ $activity->is_wheelchair_accessible == 1 ? 'Yes' : 'No' }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Stroller Friendly:</strong></label>
                                <p>{{ $activity->is_stroller_friendly == 1 ? 'Yes' : 'No' }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Difficulty Level:</strong></label>
                                <p>{{ ucfirst($activity->difficulty_level) }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Age Limit:</strong></label>
                                <p>{{ $activity->age_limit ?? '' }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Min Adults:</strong></label>
                                <p>{{ $activity->min_adults ?? '' }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Cut of Day:</strong></label>
                                <p>{{ $activity->cut_of_day ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Overview and Descriptions --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Descriptions</h5>
                        <div class="mb-3" style="max-height:300px; overflow: auto; ">
                            <label><strong>Overview:</strong></label>
                            <div>{!! $activity->overview !!}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3" style="max-height:300px; overflow: auto; ">
                                    <label><strong>Highlight:</strong></label>
                                    <div>{!! $activity->highlights !!}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3" style="max-height:300px; overflow: auto; ">
                                    <label><strong>Rules:</strong></label>
                                    <div>{!! $activity->rules??'' !!}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3" style="max-height:300px; overflow: auto; ">
                                    <label><strong>Requirements:</strong></label>
                                    <div>{!! $activity->requirements??'' !!}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3" style="max-height:300px; overflow: auto; ">
                                    <label><strong>Disclaimers:</strong></label>
                                    <div>{!! $activity->disclaimers??'' !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3" style="max-height:300px; overflow: auto; ">
                            <label><strong>Short Description:</strong></label>
                            <div>{!! $activity->short_description !!}</div>
                        </div>
                        <div style="max-height:300px; overflow: auto; ">
                            <label><strong>Full Description:</strong></label>
                            <div>{!! $activity->full_description !!}</div>
                        </div>
                    </div>

                    {{-- Duration and Type --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Duration & Type</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label><strong>Duration:</strong></label>
                                <p>{{ $activity->duration ?? '' }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Tour Type:</strong></label>
                                <p>{{ $activity->tour_type }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Group Size:</strong></label>
                                <p>{{ $activity->group_size }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Languages & Location --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Language & Location</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label><strong>Languages:</strong></label>
                                <p>{{ $activity->languages }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Location:</strong></label>
                                <p>{{ $activity->location }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Pick & Drop --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Pickup & Dropoff</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label><strong>Pickup Info:</strong></label>
                                <p>{{ $activity->pickup_info ?? '' }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Dropoff Info:</strong></label>
                                <p>{{ $activity->dropoff_info ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    {{-- Images --}}
                    @if (count($activity->activityImage) > 0)
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Images</h5>
                        <div class="row">
                            @foreach ($activity->activityImage as $item)
                            <div class="col-md-2 mb-2">
                                <img src="{{ asset('storage/app/public/' . $item->image) }}" width="100%"
                                    height="100%" class="img-thumbnail" alt="{{ $item->name ?? '' }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    {{-- activityDate --}}
                    @if (count($activity->activityDate) > 0)
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Dates</h5>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount Price</th>
                                            <th scope="col">Time Slots</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activity->activityDate as $item)
                                        <tr>
                                            <td>{{ $item->date ?? '' }}</td>
                                            <td>{{ $item->price ?? '' }}</td>
                                            <td>{{ $item->discount_price ?? '' }}</td>
                                            <td>
                                                @foreach($item->activityTimeSlot as $item)
                                                <span class="badge badge-primary">{{$item->start_time??''}} - {{$item->end_time??''}}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- activityExpectation --}}
                    @if (count($activity->activityExpectation) > 0)
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Downloads</h5>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped display"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activity->activityExpectation as $item)
                                        <tr>
                                            <td>{{ $item->title ?? '' }}</td>
                                            <td>{{ $item->description ?? '' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- Inclusion & Exclusion --}}
                    @if (count($activity->activityInclusion) > 0 || count($activity->activityExclusion) > 0)
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Inclusions & Exclusions</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-striped display"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Inclusion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activity->activityInclusion as $item)
                                            <tr>
                                                <td>{{ $item->item ?? '' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-striped display"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Exclusion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activity->activityExclusion as $item)
                                            <tr>
                                                <td>{{ $item->item ?? '' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- activityPolicy --}}
                    @if (count($activity->activityPolicy) > 0)
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">FAQs</h5>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped display"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activity->activityPolicy as $item)
                                        <tr>
                                            <td>{{ $item->title ?? '' }}</td>
                                            <td>{{ $item->description ?? '' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="card-footer">
                    <a href="{{ url('activity') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ url('activity/edit/' . $activity->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection