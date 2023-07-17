@extends('admin.layout.auth')
@section('title','Register')
@section('section')
<div class="nk-content ">
    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
        <div class="brand-logo pb-4 text-center">
            <a href="" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/images/Logo-merge.jpg') }}" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/images/Logo-merge.jpg') }}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
            </a>
        </div>
        <div class="card">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Register</h4>
                        <div class="nk-block-des">
                            <p>Create New Account Password</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('register',$data->id_user) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label class="form-label" for="password">Passcode</label>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your Passcode">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Passcode</label>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password_confirmation">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirm your Passcode">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">Register</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="{{ route('login') }}"><strong>Sign in instead</strong></a>
                </div>
            </div>
        </div>
    </div>
<!-- wrap @e -->
</div>
<!-- content @e -->
@endsection