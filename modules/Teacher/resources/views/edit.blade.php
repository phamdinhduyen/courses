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
                    <input type="text" name="name"
                        class="form-control title{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Tên..."
                        value="{{ old('name') ?? $teacher->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Slug</label>
                    <input type="text" name="slug"
                        class="form-control slug{{ $errors->has('slug') ? ' is-invalid' : '' }}" placeholder="Slug..."
                        value="{{ old('slug') ?? $teacher->slug }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Số năm kinh nghiệm</label>
                    <input type="number" name="epx" class="form-control {{ $errors->has('epx') ? ' is-invalid' : '' }}"
                        placeholder="Số năm kinh nghiệm..." value="{{ old('epx') ?? $teacher->epx }}">
                    @error('epx')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="text">Mô tả</label>
                    <textarea type="text" name="description"
                        class="form-control ckeditor {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Mô tả..."
                        value="">{{ old('description') ?? $teacher->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="row {{ $errors->has('image') ? 'align-items-center' : 'align-items-end' }} ">
                        <div class="col-7">
                            <label for="text">Hình ảnh</label>
                            <input type="text" name="image"
                                class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"
                                placeholder="Hình ảnh..." value="{{ old('image') ?? $teacher->image }}" id="image">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary" id="lfm" data-input="image"
                                data-preview="holder">Chọn ảnh</button>
                        </div>
                        <div class="col-3">
                            <div id="holder">
                                @if (old('image') || $teacher->image)
                                    <img src="{{ old('image') ?? $teacher->image }}" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.teachers.index') }}" type="submit" class="btn btn-warning">Quay lại</a>
            </div>
        </div>
        @csrf
        @method('PUT')
    </form>
@endsection
@section('stylesheets')
    <style>
        img {
            max-width: 80px;
            height: auto;
        }
    </style>
@endsection
