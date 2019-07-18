@extends('admin.layouts.master')
@section('title')
Thêm Sản Phẩm
@endsection
@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thêm mới sản phẩm</h6>
            </div>
            <div class="row" style="margin: 5px">
                <div class="col-lg-12">
                    <form role="form" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="form-group">
                            <label>Tên sản phẩm</label>
                            <input class="form-control" name="name" placeholder="Nhập tên sản phẩm ...">
                            @if($errors->has('name'))
                            <div class="alert alert-danger">{{$errors->first('name')}}</div>
                            @endif
                        </fieldset>
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea class="form-control" name="description" id="demo" cols="5" rows="5"></textarea>
                            @if($errors->has('description'))
                            <div class="alert alert-danger">{{$errors->first('description')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input class="form-control" type="number" name="quantity" min="1" value="1"
                                placeholder="Nhập số lượng sản phẩm ...">
                                @if($errors->has('quantity'))
                            <div class="alert alert-danger">{{$errors->first('quantity')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input class="form-control" type="number" name="price" placeholder="Nhập giá sản phẩm ...">
                            @if($errors->has('price'))
                            <div class="alert alert-danger">{{$errors->first('price')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="promotial">Giá khuyến mại</label>
                            <input class="form-control" type="text" name="promotional" value="0"
                                placeholder="Nhập giá khuyến mại sản phẩm ...">
                                @if($errors->has('promotional'))
                            <div class="alert alert-danger">{{$errors->first('promotional')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                                <label>Hình ảnh sản phẩm</label>
                                <input type="file" name="image" class="form-control" src="" alt="">
                                @if($errors->has('image'))
                            <div class="alert alert-danger">{{$errors->first('image')}}</div>
                            @endif
                            </div>
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label>
                            <select class="form-control cateProduct" name="category_id">
                                @foreach ($categories as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại Sản Phẩm</label>
                            <select class="form-control proTypeProduct" name="producttype_id">
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
