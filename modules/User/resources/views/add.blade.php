@extends('layouts.backend')
@section('content')
    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Tên</label>
                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        placeholder="Tên..." value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Email</label>
                    <input type="text" name="email"
                        class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email..."
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Nhóm</label>
                    <select name="group_id" id=""
                        class="form-select {{ $errors->has('group_id') ? ' is-invalid' : '' }}">
                        <option value="0">Chọn nhóm</option>
                        <option value="1">Admin</option>
                        <option value="2">Giảng viên</option>
                    </select>
                    @error('group_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Mật khẩu</label>
                    <input type="password" name="password"
                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Mật khẩu..."
                        value="">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.users.index') }}" type="submit" class="btn btn-warning">Quay lại</a>
            </div>
        </div>
        @csrf
    </form>
@endsection
