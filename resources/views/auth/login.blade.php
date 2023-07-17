@extends('admin.layout.auth')
@section('title', 'Login')
@section('section')
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
            <div class="brand-logo pb-4 text-center">
                <a href="" class="logo-link">
                    <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/images/Logo-merge.jpg') }}" alt="logo">
                    <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/images/Logo-merge.jpg') }}"
                        alt="logo-dark">
                </a>
            </div>
            <div class="card">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Login</h4>
                            <div class="nk-block-des">
                                <p>Login Untuk Menggunakan Aplikasi</p>
                            </div>
                            @if (session('salah'))
                                <div class="alert alert-icon alert-danger" role="alert"> <em
                                        class="icon ni ni-alert-circle"></em> <strong> {{ session('salah') }}</strong></div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-icon alert-danger" role="alert">
                                        @foreach ($errors->all() as $error)
                                        <em class="icon ni ni-alert-circle"></em> <strong> {{ $error }}</strong> <br>
                                            @endforeach
                                    </div>
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="email">Email</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="text" name="email" value="{{ old('email') }}" required class="form-control form-control-lg" id="email"
                                    placeholder="Masukan Email / Nama Pengguna">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="form-control-wrap">
                                <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                    data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password" min="6" name="password" required class="form-control form-control-lg" id="password"
                                    placeholder="Masukan Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                        </div>
                    </form>
                    <div class="form-note-s2 text-center pt-4"><a href="{{ route('password.request') }}">Lupa Password? </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
