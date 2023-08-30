@extends('layouts.auth')

@section('content')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">{{ $pageTitle }}</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('login') }}">
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com"
                        value="{{ old('email') }}" />
                    <label for="inputEmail">Nhập địa chỉ email</label>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" />
                    <label for="inputPassword">Mật khẩu</label>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                    <label class="form-check-label" for="inputRememberPassword">Nhớ mật khẩu</label>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="#">Quên mật khẩu?</a>
                    <button class="btn btn-primary" type="submit">Đăng nhập</button>
                </div>
                @csrf
            </form>
        </div>

    </div>
@endsection
