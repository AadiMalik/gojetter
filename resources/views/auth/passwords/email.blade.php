<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gojetter</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/dist-assets/css/themes/lite-purple.min.css') }}">
</head>

<body>
    <div class="auth-layout-wrap" style="background-image: url({{asset('public/dist-assets/images/photo-wide-4.jpg') }})">
        <div class="auth-content">
            <div class="card o-hidden" style="background-color:#ffffff9c">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="p-4">
                            <div class="auth-logo text-center mb-4">
                                <img style="width:auto;" src="{{asset('public/dist-assets/images/logo.png') }}" alt="">
                            </div>
                            <h1 class="mb-3 text-18">{{ __('Reset Password') }}</h1>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button class="btn btn-rounded btn-primary btn-block mt-2">{{ __('Send Password Reset Link') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('public/dist-assets/js/common-bundle-script.js') }}"></script>

    <script src="{{asset('public/dist-assets/js/script.js') }}"></script>
</body>

</html>
