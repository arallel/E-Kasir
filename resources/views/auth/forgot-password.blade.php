@extends('admin.layout.auth')
@section('title','Login')
@section('section')
<div class="nk-content ">
    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
        <div class="brand-logo pb-4 text-center">
            <a href="" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/images/Logo-merge.jpg') }}" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/images/Logo-merge.jpg') }}" alt="logo-dark">
            </a>
        </div>
        <div class="card">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Reset password</h4>
                        <div class="nk-block-des">
                            <p>Reset Password</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="text" name="email" class="form-control form-control-lg" id="email" placeholder="Enter your email address">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">Send Reset Link</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4"><a href="{{ route('login') }}">Return To Login </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection