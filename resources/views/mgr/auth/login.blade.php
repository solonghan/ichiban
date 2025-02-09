@extends('mgr.layouts.master-without-nav')
@section('title')
登入
@endsection
@section('content')
<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="index" class="d-inline-block auth-logo">
                                <!-- <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" height="20"> -->
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium"></p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">一番賞後台</h5>
                                <p class="text-muted"></p>
                                @if (session('error'))
                                <div class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>
                                    {{ session('error') }}
                                    </strong>
                                </div>
                                @endif
                            </div>
                            <div class="p-2 mt-4">
                                <form action="{{ route('mgr.login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">帳號</label>
                                        {{-- <input type="text" class="form-control @error('ID_number') is-invalid @enderror" value="{{ old('ID_number', 'admin') }}" id="username" name="ID_number" placeholder="Enter username"> --}}
                                        <input type="text" class="form-control @error('ID_number') is-invalid @enderror" value="" id="username" name="ID_number" placeholder="請輸入帳號">
                                        @error('ID_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <!-- <div class="float-end">
                                            <a href="auth-pass-reset-basic" class="text-muted">Forgot password?</a>
                                        </div> -->
                                        <label class="form-label" for="password-input">密碼</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            {{-- <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" placeholder="Enter password" id="password-input" value="1435"> --}}
                                            <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" placeholder="請輸入密碼" id="password-input" value="">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div> -->

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">登入</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <!-- <div class="mt-4 text-center">
                        <p class="mb-0">Don't have an account ? <a href="register" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                    </div> -->

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

</div>
@endsection
@section('script')
<script>
document.getElementById('password-addon').addEventListener('click', function () {
	var passwordInput = document.getElementById("password-input");
	if (passwordInput.type === "password") {
		passwordInput.type = "text";
	} else {
		passwordInput.type = "password";
	}
});
</script>
@endsection
