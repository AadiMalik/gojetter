@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Blogs</h1>
            @if (isset($blog))
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
                    <form action="{{ url('blogs/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($blog) ? $blog->id : '' }}" />

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
                                        value="{{ old('title', isset($blog) ? $blog->title : '') }}" required>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Slug --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="slug">Slug <span class="text-danger">*</span></label>
                                    <input id="slug" class="form-control" type="text" name="slug"
                                        value="{{ old('slug', isset($blog) ? $blog->slug : '') }}" readonly required>
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Category --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="blog_category_id">Category <span class="text-danger">*</span></label>
                                    <select name="blog_category_id" class="form-control" id="blog_category_id" required>
                                        <option value="" selected disabled>--Select Category--</option>
                                        @foreach ($blog_category as $item)
                                            <option value="{{ $item->id }}"
                                                @if (isset($blog)) {{ $item->id == $blog->blog_category_id ? 'selected' : '' }} @endif>
                                                {{ $item->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('blog_category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- image --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="image">Image</label>
                                    <input class="form-control" type="file" name="image">
                                    @if (isset($blog) && $blog->image)
                                        <img src="{{ asset('storage/app/public/' . $blog->image) }}" width="100"
                                            class="mt-2">
                                    @endif
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- video_url --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="video_url">Video Url</label>
                                    <input id="video_url" class="form-control" type="text" name="video_url"
                                        value="{{ old('video_url', isset($blog) ? $blog->video_url : '') }}">
                                    @error('video_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- author --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label>Author</label>
                                    <input class="form-control" type="text" name="author"
                                        value="{{ old('author', isset($blog) ? $blog->author : '') }}">
                                    @error('author')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- Short Description --}}
                                <div class="col-md-12 form-group mb-3">
                                    <label for="short_description">Short Description</label>
                                    <textarea class="form-control summernote" name="short_description">{{ old('short_description', isset($blog) ? $blog->short_description : '') }}</textarea>
                                    @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Full Description --}}
                                <div class="col-md-12 form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control summernote" name="description">{{ old('description', isset($blog) ? $blog->description : '') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('blogs') }}" class="btn btn-danger">Cancel</a>
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
            $('#blog_category_id').select2();
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
