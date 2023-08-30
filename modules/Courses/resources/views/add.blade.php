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
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Slug</label>
                    <input type="text" name="slug"
                        class="form-control slug {{ $errors->has('slug') ? ' is-invalid' : '' }}" placeholder="Slug..."
                        value="{{ old('slug') }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Giảng Viên</label>
                    <select name="teacher_id" id=""
                        class="form-select {{ $errors->has('teacher_id') ? ' is-invalid' : '' }}">
                        <option value="0">Chọn giảng viên</option>
                        @if ($teacher)
                            {
                            @foreach ($teacher as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('teacher_id') == $item->id ? 'selected' : false }}>{{ $item->name }}</option>
                            @endforeach
                            }
                        @endif
                    </select>
                    @error('teacher_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Mã khóa học</label>
                    <input type="text" name="code"
                        class="form-control  {{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Mã khóa học..."
                        value="{{ old('code') }}">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Giá khóa học</label>
                    <input type="number" name="price"
                        class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Giá khóa học..."
                        value="">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Mã giá khuyến mãi</label>
                    <input type="number" name="sale_price"
                        class="form-control {{ $errors->has('sale_price') ? ' is-invalid' : '' }}"
                        placeholder="Mã giá khuyến mãi..." value="">
                    @error('sale_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Tài liệu đính kèm</label>
                    <select name="is_document" id=""
                        class="form-select {{ $errors->has('is_document') ? ' is-invalid' : '' }}">
                        <option value="0" {{ old('is_document') == 0 ? 'selected' : false }}>Không</option>
                        <option value="1" {{ old('is_document') == 1 ? 'selected' : false }}>Có</option>
                    </select>
                    @error('is_document')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="text">Trạng thái</label>
                    <select name="status" id=""
                        class="form-select {{ $errors->has('status') ? ' is-invalid' : '' }}">
                        <option value="0" {{ old('status') == 0 ? 'selected' : false }}>Chưa ra mắt</option>
                        <option value="1" {{ old('status') == 0 ? 'selected' : false }}>Đã ra mắt</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="text">Hỗ trợ</label>
                    <textarea type="text" name="supports" class="form-control {{ $errors->has('supports') ? ' is-invalid' : '' }}"
                        placeholder="Hỗ trợ..." value="">{{ old('supports') }}</textarea>
                    @error('supports')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="text">Nội dung</label>
                    <textarea type="text" name="detail" class="form-control ckeditor {{ $errors->has('detail') ? ' is-invalid' : '' }}"
                        placeholder="Hỗ trợ..." value="">{{ old('detail') }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label>Chuyên mục</label>
                    <div class="list_categories">
                        {{ getCategoriesCheckbox($categories, old('categories')) }}
                    </div>
                    @error('categories')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="row {{ $errors->has('thumbnail') ? 'align-items-center' : 'align-items-end' }} ">
                        <div class="col-7">
                            <label for="text">Ảnh đại diện</label>
                            <input type="text" name="thumbnail"
                                class="form-control {{ $errors->has('thumbnail') ? ' is-invalid' : '' }}"
                                placeholder="Ảnh đại diện..." value="{{ old('thumbnail') }}" id="thumbnail">
                            @error('thumbnail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary" id="lfm" data-input="thumbnail"
                                data-preview="holder">Chọn ảnh</button>
                        </div>
                        <div class="col-3">
                            <div id="holder">
                                @if (old('thumbnail'))
                                    {
                                    <img src="{{ old('thumbnail') }}" />
                                    }
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.courses.index') }}" type="submit" class="btn btn-warning">Quay lại</a>
            </div>
        </div>
        @csrf

    </form>
@endsection
@section('stylesheets')
    <style>
        img {
            max-width: 80%;
            height: auto;
        }

        .list_categories {
            max-height: 250px;
            overflow: auto
        }
    </style>
@endsection
