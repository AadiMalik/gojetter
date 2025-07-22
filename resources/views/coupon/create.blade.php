@extends('layouts.master')
@section('content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1>Coupon</h1>
            @if (isset($coupon))
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
                    <form action="{{ url('coupon/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($coupon) ? $coupon->id : '' }}" />

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
                                {{-- Code --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="code">Code <span class="text-danger">*</span></label>
                                    <input id="code" class="form-control" type="text" name="code"
                                        value="{{ old('code', $coupon->code ?? '') }}" required>
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Type --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="type">Type <span class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="amount" @if (isset($coupon) && $coupon->type == 'amount') selected @endif>Amount
                                        </option>
                                        <option value="percentage" @if (isset($coupon) && $coupon->type == 'percentage') selected @endif>
                                            Percentage</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- Value --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="value">Value <span class="text-danger">*</span></label>
                                    <input id="value" class="form-control" type="number" name="value"
                                        value="{{ old('value', $coupon->value ?? '') }}" required>
                                    @error('value')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- valid from --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="valid_from">Valid From <span class="text-danger">*</span></label>
                                    <input id="valid_from" class="form-control" type="date" name="valid_from"
                                        value="{{ old('valid_from', $coupon->valid_from ?? '') }}" required>
                                    @error('valid_from')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- valid untill --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label for="valid_until">Valid Until <span class="text-danger">*</span></label>
                                    <input id="valid_until" class="form-control" type="date" name="valid_until"
                                        value="{{ old('valid_until', $coupon->valid_until ?? '') }}" required>
                                    @error('valid_until')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ url('coupons') }}" class="btn btn-danger">Cancel</a>
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
        });
    </script>
@endsection
