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
                                <img src="{{ asset('storage/app/public/' . $tour->thumbnail) }}" width="200"
                                    class="img-thumbnail">
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
                                    <p>{{ $tour->tour_category->name ?? '' }}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label><strong>Slug:</strong></label>
                                    <p>{{ $tour->slug }}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label><strong>Tag:</strong></label>
                                    <p>{{ $tour->tags ?? '' }}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label><strong>Is Featured:</strong></label>
                                    <p>{{ $tour->is_featured == 1 ? 'Yes' : 'No' }}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label><strong>Difficulty Level:</strong></label>
                                    <p>{{ ucfirst($tour->difficulty_level) }}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label><strong>Age Limit:</strong></label>
                                    <p>{{ $tour->age_limit ?? '' }}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label><strong>Min Adults:</strong></label>
                                    <p>{{ $tour->min_adults ?? '' }}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label><strong>Cut of Day:</strong></label>
                                    <p>{{ $tour->cut_of_day ?? 0 }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Overview and Descriptions --}}
                        <div class="mb-4 border-bottom pb-3">
                            <h5 class="mb-3">Descriptions</h5>
                            <div class="mb-3" style="max-height:300px; overflow: auto; ">
                                <label><strong>Overview:</strong></label>
                                <div>{!! $tour->overview !!}</div>
                            </div>
                            <div class="mb-3" style="max-height:300px; overflow: auto; ">
                                <label><strong>Highlight:</strong></label>
                                <div>{!! $tour->highlights !!}</div>
                            </div>
                            <div class="mb-3" style="max-height:300px; overflow: auto; ">
                                <label><strong>Short Description:</strong></label>
                                <div>{!! $tour->short_description !!}</div>
                            </div>
                            <div style="max-height:300px; overflow: auto; ">
                                <label><strong>Full Description:</strong></label>
                                <div>{!! $tour->full_description !!}</div>
                            </div>
                        </div>

                        {{-- Duration and Type --}}
                        <div class="mb-4 border-bottom pb-3">
                            <h5 class="mb-3">Duration & Type</h5>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label><strong>Duration:</strong></label>
                                    <p>{{ $tour->duration ?? '' }}</p>
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

                        {{-- Pick & Drop --}}
                        <div class="mb-4 border-bottom pb-3">
                            <h5 class="mb-3">Pickup & Dropoff</h5>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label><strong>Pickup Info:</strong></label>
                                    <p>{{ $tour->pickup_info ?? '' }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label><strong>Dropoff Info:</strong></label>
                                    <p>{{ $tour->dropoff_info ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- Images --}}
                        @if (count($tour->tourImage) > 0)
                            <div class="mb-4 border-bottom pb-3">
                                <h5 class="mb-3">Images</h5>
                                <div class="row">
                                    @foreach ($tour->tourImage as $item)
                                        <div class="col-md-2 mb-2">
                                            <img src="{{ asset('storage/app/public/' . $item->image) }}" width="100%"
                                                height="100%" class="img-thumbnail" alt="{{ $item->name ?? '' }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        {{-- tourDate --}}
                        @if (count($tour->tourDate) > 0)
                            <div class="mb-4 border-bottom pb-3">
                                <h5 class="mb-3">Dates</h5>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Start Date</th>
                                                    <th scope="col">End Date</th>
                                                    <th scope="col">Price Type</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Discount Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tour->tourDate as $item)
                                                    <tr>
                                                        <td>{{ $item->start_date ?? '' }}</td>
                                                        <td>{{ $item->end_date ?? '' }}</td>
                                                        <td>{{ $item->price_type ?? '' }}</td>
                                                        <td>{{ $item->price ?? '' }}</td>
                                                        <td>{{ $item->discount_price ?? '' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- tourDownload --}}
                        @if (count($tour->tourDownload) > 0)
                            <div class="mb-4 border-bottom pb-3">
                                <h5 class="mb-3">Downloads</h5>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">File Type</th>
                                                    <th scope="col">File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tour->tourDownload as $item)
                                                    <tr>
                                                        <td>{{ $item->file_type ?? '' }}</td>
                                                        <td>{{ $item->file_path ?? '' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- Inclusion & Exclusion --}}
                        @if (count($tour->tourInclusion) > 0 || count($tour->tourExclusion) > 0)
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
                                                    @foreach ($tour->tourInclusion as $item)
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
                                                    @foreach ($tour->tourExclusion as $item)
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
                        {{-- tourFaq --}}
                        @if (count($tour->tourFaq) > 0)
                            <div class="mb-4 border-bottom pb-3">
                                <h5 class="mb-3">FAQs</h5>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Question</th>
                                                    <th scope="col">Answer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tour->tourFaq as $item)
                                                    <tr>
                                                        <td>{{ $item->question ?? '' }}</td>
                                                        <td>{{ $item->answer ?? '' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- tourItinerary --}}
                        @if (count($tour->tourItinerary) > 0)
                            <div class="mb-4 border-bottom pb-3">
                                <h5 class="mb-3">Itineraries</h5>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Day</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tour->tourItinerary as $item)
                                                    <tr>
                                                        <td>{{ $item->day_number ?? '' }}</td>
                                                        <td>{{ $item->title ?? '' }}</td>
                                                        <td><img src="{{ asset('storage/app/public/' . $item->image) }}"  class="img-thumbnail" style="width:100; height:100px;"></td>
                                                        <td>{!! $item->description ?? '' !!}</td>
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
                        <a href="{{ url('tours') }}" class="btn btn-secondary">Back</a>
                        @can('tour_edit')
                        <a href="{{ url('tours/edit/' . $tour->id) }}" class="btn btn-primary">Edit</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
