@extends('layouts.master')

@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Service Details</h1>
        <ul>
            <li>View</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    {{-- service Image --}}
                    @if ($service->image)
                        <div class="mb-4 border-bottom pb-3">
                            <h5 class="mb-3">Image</h5>
                            <img src="{{ asset('storage/app/public/' . $service->image) }}" width="200" class="img-thumbnail">
                        </div>
                    @endif

                    {{-- Basic Info --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Basic Info</h5>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label><strong>Name:</strong></label>
                                <p>{{ $service->name }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Slug:</strong></label>
                                <p>{{ $service->slug }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Has Contact Form:</strong></label>
                                <p>{{($service->has_contact_form==1)?'Yes':'No'}}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Descriptions --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Description</h5>
                        <div class="mb-3">
                            <div>{!! $service->description !!}</div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{ url('services') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ url('services/edit/'.$service->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
