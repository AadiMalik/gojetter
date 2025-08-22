@extends('layouts.master')

@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Blog Details</h1>
        <ul>
            <li>View</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    {{-- Blog Image --}}
                    @if ($blog->image)
                        <div class="mb-4 border-bottom pb-3">
                            <h5 class="mb-3">Image</h5>
                            <img src="{{ asset('storage/app/public/' . $blog->image) }}" width="200" class="img-thumbnail">
                        </div>
                    @endif

                    {{-- Basic Info --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Basic Info</h5>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label><strong>Title:</strong></label>
                                <p>{{ $blog->title }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Slug:</strong></label>
                                <p>{{ $blog->slug }}</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label><strong>Category:</strong></label>
                                <p>{{ $blog->category->name ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Descriptions --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Descriptions</h5>
                        <div class="mb-3">
                            <label><strong>Short Description:</strong></label>
                            <div>{!! $blog->short_description !!}</div>
                        </div>
                        <div class="mb-3">
                            <label><strong>Full Description:</strong></label>
                            <div>{!! $blog->description !!}</div>
                        </div>
                    </div>

                    {{-- Author and Video --}}
                    <div class="mb-4 border-bottom pb-3">
                        <h5 class="mb-3">Author & Video</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label><strong>Author:</strong></label>
                                <p>{{ $blog->author }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label><strong>Video URL:</strong></label>
                                <p>
                                    @if ($blog->video_url)
                                        <a href="{{ $blog->video_url }}" target="_blank">{{ $blog->video_url }}</a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>

                        @if ($blog->video_url)
                            <div class="mt-3">
                                <iframe width="100%" height="400" src="{{ $blog->video_url }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endif
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{ url('blogs') }}" class="btn btn-secondary">Back</a>
                    @can('blog_edit')
                    <a href="{{ url('blogs/edit/'.$blog->id) }}" class="btn btn-primary">Edit</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
