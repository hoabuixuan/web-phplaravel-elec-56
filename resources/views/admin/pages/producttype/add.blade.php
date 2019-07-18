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
                    <form role="form" action="{{route('product_type.store')}}" method="post">
                        @csrf
                        <fieldset class="form-group">
                            <label>Tên loại sản phẩm</label>
                            <input class="form-control" name="name" placeholder="Nhập tên loại sản phẩm">
                            @if($errors->has('name'))
                            <div class="alert alert-danger">{{$errors->first('name')}}</div>
                            @endif
                        </fieldset>
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label>
                            <select class="form-control" name="category_id">
                                @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control" name="status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Không hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Lưu</button>
                        <button type="reset" class="btn btn-primary">Nhập lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
