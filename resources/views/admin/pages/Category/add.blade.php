@extends('admin.layouts.master')
@section('title')
Thêm danh mục sản phẩm
@endsection
@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh mục sản phẩm</h6>
            </div>
            <div class="row" style="margin: 5px">
                <div class="col-lg-12">
                    <form role="form" action="{{route('category.store')}}" method="post">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <span>{{ $error }}</span>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <fieldset class="form-group">
                            <label>Tên danh mục</label>
                            <input class="form-control" name="name" placeholder="Nhập tên danh mục">
                        </fieldset>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control" name="status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Không hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Lưu</button>
                        <button type="reset" class="btn btn-primary">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
