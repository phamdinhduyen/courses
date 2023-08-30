@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Tên</label>
                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        placeholder="Tên..." value="{{ old('name') ?? $user->name }}">
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
                        value="{{ old('email') ?? $user->email }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Chọn nhóm</label>
                    <select name="group_id" id=""
                        class="form-select {{ $errors->has('group_id') ? ' is-invalid' : '' }}">
                        <option value="0">Chọn nhóm người dùng</option>
                        @if ($groupUser)
                            {
                            @foreach ($groupUser as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('group_id') == $item->id || $user->teacher_id == $item->id ? 'selected' : false }}>
                                    {{ $item->name }}</option>
                            @endforeach
                            }
                        @endif
                    </select>
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
                <a href="{{ route('admin.categories.index') }}" type="submit" class="btn btn-warning">Quay lại</a>
            </div>
        </div>
        @csrf
        @method('PUT')
    </form>
@endsection
