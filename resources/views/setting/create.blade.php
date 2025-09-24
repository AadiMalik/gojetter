@extends('layouts.master')
@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Setting</h1>
        <ul>
            <li>Update</li>
            <li>Edit</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <form action="{{ url('setting/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($setting) ? $setting->id : '' }}" />

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

                            {{-- App Name --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="app_name">Application Name</label>
                                <input id="app_name" class="form-control" type="text" name="app_name"
                                    value="{{ old('app_name', isset($setting) ? $setting->app_name : '') }}">
                                @error('app_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Support Email --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="support_email">Support Email</label>
                                <input id="support_email" class="form-control" type="email" name="support_email"
                                    value="{{ old('support_email', isset($setting) ? $setting->support_email : '') }}">
                                @error('support_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Contact Number --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="contact_number">Contact Number</label>
                                <input id="contact_number" class="form-control" type="text" name="contact_number"
                                    value="{{ old('contact_number', isset($setting) ? $setting->contact_number : '') }}">
                                @error('contact_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Website Tab Logo --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="tab_logo">Website Tab Logo</label>
                                <input class="form-control" type="file" name="tab_logo">
                                @if (isset($setting) && $setting->tab_logo)
                                <img src="{{ asset('storage/app/public/' . $setting->tab_logo) }}" width="100" class="mt-2 img-thumbnail">
                                @endif
                                @error('tab_logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Website Logo --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="website_logo">Website Logo</label>
                                <input class="form-control" type="file" name="website_logo">
                                @if (isset($setting) && $setting->website_logo)
                                <img src="{{ asset('storage/app/public/' . $setting->website_logo) }}" width="100" class="mt-2 img-thumbnail">
                                @endif
                                @error('website_logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Admin Panel Logo --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="admin_panel_logo">Admin Panel Logo</label>
                                <input class="form-control" type="file" name="admin_panel_logo">
                                @if (isset($setting) && $setting->admin_panel_logo)
                                <img src="{{ asset('storage/app/public/' . $setting->admin_panel_logo) }}" width="100" class="mt-2 img-thumbnail">
                                @endif
                                @error('admin_panel_logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mobile App Logo --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="mobile_application_logo">Mobile App Logo</label>
                                <input class="form-control" type="file" name="mobile_application_logo">
                                @if (isset($setting) && $setting->mobile_application_logo)
                                <img src="{{ asset('storage/app/public/' . $setting->mobile_application_logo) }}" width="100" class="mt-2 img-thumbnail">
                                @endif
                                @error('mobile_application_logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mobile App Home Image --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="mobile_application_home_image">Mobile App Home Image</label>
                                <input class="form-control" type="file" name="mobile_application_home_image">
                                @if (isset($setting) && $setting->mobile_application_home_image)
                                <img src="{{ asset('storage/app/public/' . $setting->mobile_application_home_image) }}" width="100" class="mt-2 img-thumbnail">
                                @endif
                                @error('mobile_application_home_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Website Page Image --}}
                            <div class="col-md-6 form-group mb-3">
                                <label for="website_page_image">Website Page Image</label>
                                <input class="form-control" type="file" name="website_page_image">
                                @if (isset($setting) && $setting->website_page_image)
                                <img src="{{ asset('storage/app/public/' . $setting->website_page_image) }}" width="100" class="mt-2 img-thumbnail">
                                @endif
                                @error('website_page_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- end of main-content -->
</div>
@endsection