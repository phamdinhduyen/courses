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
                        <option value="0">Chọn nhóm</option>
                        <option value="1">Văn A</option>
                        <option value="2">Văn B</option>
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
                        class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Mã khóa học..."
                        value="">
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
                        <option value="0">Chọn nhóm</option>
                        <option value="1">Không</option>
                        <option value="2">Có</option>
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
                        <option value="0">Chọn nhóm</option>
                        <option value="1">Chưa ra mắt</option>
                        <option value="2">Đã ra mắt</option>
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
                    <textarea name="supports" {{ $errors->has('supports') ? ' is-invalid' : '' }} class="form-control"
                        placeholder="Hỗ trợ..." value=""></textarea>
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
                    <textarea name="detail" {{ $errors->has('detail') ? ' is-invalid' : '' }} class="form-control"
                        placeholder="Nội dung..." value=""></textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="row align-items-end">
                        <div class="col-7">

                            <label for="text">Ảnh đại diện</label>
                            <textarea name="thumbnail" {{ $errors->has('thumbnail') ? ' is-invalid' : '' }} class="form-control"
                                placeholder="Ảnh đại diện..." value=""></textarea>
                            @error('thumbnail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary">Chọn ảnh</button>
                        </div>
                        <div class="col-3">
                            <img src="https://scontent.fhan14-3.fna.fbcdn.net/v/t39.30808-6/363842483_1399568380623959_6911278077162584183_n.jpg?_nc_cat=104&cb=99be929b-59f725be&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=b5uY0Xk7uLoAX_-VWk8&_nc_ht=scontent.fhan14-3.fna&oh=00_AfCXqun91v_Xxc9NT-W5DamP628hJlAbBbCZ4vm3C3ynWA&oe=64D7DA12"
                                alt="">
                        </div>
                    </div>

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
@section('stylesheets')
    <style>
        img {
            max-width: 80%;
            height: auto;
        }
    </style>
@endsection
