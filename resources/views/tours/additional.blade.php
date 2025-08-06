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
                <div class="card text-left">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="tour-slots"
                                        data-toggle="list" href="#tab-tour-slots" role="tab"
                                        aria-controls="tab-tour-slots">Slots</a>
                                    <a class="list-group-item list-group-item-action" id="tour-itineraries"
                                        data-toggle="list" href="#tab-tour-itineraries" role="tab"
                                        aria-controls="tab-tour-itineraries">Itineraries</a>
                                    <a class="list-group-item list-group-item-action" id="tour-inclusions"
                                        data-toggle="list" href="#tab-tour-inclusions" role="tab"
                                        aria-controls="tab-tour-inclusions">Inclusions</a>
                                    <a class="list-group-item list-group-item-action" id="tour-exclusions"
                                        data-toggle="list" href="#tab-tour-exclusions" role="tab"
                                        aria-controls="tab-tour-exclusions">Exclusions</a>
                                    <a class="list-group-item list-group-item-action" id="tour-faqs" data-toggle="list"
                                        href="#tab-tour-faqs" role="tab" aria-controls="tab-tour-faqs">FAQs</a>
                                    <a class="list-group-item list-group-item-action" id="tour-gallery" data-toggle="list"
                                        href="#tab-tour-gallery" role="tab" aria-controls="tab-tour-gallery">Gallery</a>
                                    <a class="list-group-item list-group-item-action" id="tour-downloads" data-toggle="list"
                                        href="#tab-tour-downloads" role="tab" aria-controls="tab-tour-downloads">Downloads</a>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="tab-tour-slots" role="tabpanel" aria-labelledby="tour-slots">
                                        @include('tours.partials.date_slot')
                                    </div>
                                    <div class="tab-pane fade" id="tab-tour-itineraries" role="tabpanel"
                                        aria-labelledby="tour-itineraries">
                                        @include('tours.partials.itineraries')
                                    </div>
                                    <div class="tab-pane fade" id="tab-tour-inclusions" role="tabpanel"
                                        aria-labelledby="tour-inclusions">
                                        @include('tours.partials.inclusion')
                                    </div>
                                    <div class="tab-pane fade" id="tab-tour-exclusions" role="tabpanel"
                                        aria-labelledby="tour-exclusions">
                                        @include('tours.partials.exclusion')
                                    </div>
                                    <div class="tab-pane fade" id="tab-tour-faqs" role="tabpanel"
                                        aria-labelledby="tour-faqs">
                                        @include('tours.partials.faqs')
                                    </div>
                                    <div class="tab-pane fade" id="tab-tour-gallery" role="tabpanel" aria-labelledby="tour-gallery">
                                        @include('tours.partials.tour_image')
                                    </div>
                                    <div class="tab-pane fade" id="tab-tour-downloads" role="tabpanel"
                                        aria-labelledby="tour-downloads">
                                        @include('tours.partials.downloads')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of main-content -->
    </div>
@endsection
@section('js')
    <script>
        
    </script>
@endsection
