@extends('admin.layouts.master')
@section('title')
Danh sách loại sản phẩm
@endsection
@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Loại Sản Phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Slug</th>
                            <th>Mô tả</th>
                            <th>Số lượng</th>
                            <th>Thông tin</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Status</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Slug</th>
                            <th>Mô tả</th>
                            <th>Số lượng</th>
                            <th>Thông tin</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Status</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $key => $value)
                        <tr>
                            <td>{{$key + 1 }}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->slug}}</td>
                            <td>{!!$value->description!!}</td>
                            <td>{{$value->quantity}}</td>
                            <td>
                                <b>Đơn giá</b>: {{number_format($value->price,0,',','.')}} VNĐ
                                <br>
                                <b>Khuyến mại</b>: {{number_format($value->promotional,0,',','.')}} VNĐ
                                <br>
                                <b>Hình ảnh minh họa</b>: <img src="img/uploads/products/{{$value->image}}" width="100"
                                    height="60" alt="">
                            </td>
                            <td>{{$value->categories['name']}}</td>
                            <td>{{$value->productType['name']}}</td>
                            <td>
                                @if($value->status==1)
                                {{'Hiển thị'}}
                                @else
                                {{'Không hiển thị'}}
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary editProduct" title="{{"Sửa".$value->name}}"
                                    data-toggle="modal" data-target="#edit" data-id="{{$value->id}}" type="button"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn btn-danger deleteProduct" title="{{"Xóa".$value->name}}"
                                    data-toggle="modal" data-target="#delete" data-id="{{$value->id}}" type="button"><i
                                        class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pull-right">{{$products->links()}}</div>
        </div>
    </div>
</div>
<!-- Edit Modal-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sản phẩm<span class="titile"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 5px">
                    <div class="col-lg-12">
                        <form role="form" id="updateProduct" method="post" enctype="multipart/form-data">
                            @csrf
                            <fieldset class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control name" name="name" placeholder="Nhập tên sản phẩm ...">
                                <div class="alert alert-danger errorName"></div>
                            </fieldset>
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea class="form-control description" name="description" id="demo" cols="5"
                                    rows="5"></textarea>
                                <div class="alert alert-danger errorDescription"></div>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số lượng</label>
                                <input class="form-control quantity" type="number" name="quantity" min="1" value="1"
                                    placeholder="Nhập số lượng sản phẩm ...">
                                <div class="alert alert-danger errorQuantity"></div>
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input class="form-control price" type="number" id="price" name="price"
                                    placeholder="Nhập giá sản phẩm ...">
                                <div class="alert alert-danger errorPrice"></div>
                            </div>
                            <div class="form-group">
                                <label for="promotial">Giá khuyến mại</label>
                                <input class="form-control promotional" type="text" name="promotional" value="0"
                                    placeholder="Nhập giá khuyến mại sản phẩm ...">
                                <div class="alert alert-danger errorPromotional"></div>
                            </div>
                            <img src="" alt="" class="img img-thumbnail imageThumb" width="100" height="100"
                                lign="center">
                            <div class="form-group">
                                <label>Hình ảnh sản phẩm</label>
                                <input type="file" name="image" class="form-control image" src="" alt="">
                                <div class="alert alert-danger errorImage"></div>
                            </div>
                            <div class="form-group">
                                <label>Danh mục sản phẩm</label>
                                <select class="form-control cateProduct" name="category_id">

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
                            <input type="submit" class="btn btn-success" value="Sửa">
                            <button type="reset" class="btn btn-primary">Nhập lại</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="margin-left: 183px;">
                <button type="button" class="btn btn-success delProduct">Có</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
                <div>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
        <script>
            document.getElementById("number").onblur =function (){
                    this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            document.getElementById("display").value = this.value.replace(/,/g, "")
}
        </script>
        @endsection
