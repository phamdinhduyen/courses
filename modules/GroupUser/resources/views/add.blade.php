@extends('layouts.backend')
@section('content')
    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Tên</label>
                    <input type="text" name="name"
                        class="form-control title{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Tên..."
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.group_user.index') }}" type="submit" class="btn btn-warning">Quay lại</a>
            </div>
        </div>
        @csrf
    </form>
@endsection
