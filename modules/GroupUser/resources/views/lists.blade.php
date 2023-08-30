@extends('layouts.backend')
@section('content')
    <p><a href="{{ route('admin.group_user.create') }}" class="btn btn-primary">Thêm mới</a></p>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Thời gian</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
    </table>
    @include('parts.backend.delete')
@endsection
@section('scripts')
    <script>
        new DataTable("#datatable", {
            processing: true,
            pageLength: 2,
            serverSide: true,
            ajax: "{{ route('admin.group_user.data') }}",
            "columns": [{
                    data: "name"
                },
                {
                    data: "created_at"
                },
                {
                    data: "edit"
                },
                {
                    data: "delete"
                },
            ]
        });
    </script>
@endsection
