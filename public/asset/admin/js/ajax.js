$(document).ready(function () {
    $('.edit').click(function () {
        $('.error').hide();
        let id = $(this).data('id');
        //edit
        $.ajax({
            url: 'admin/category/' + id + '/edit',
            dataType: 'json',
            type: 'get',
            success: function ($result) {
                console.log($result);
                $('.name').val($result.name);
                $('.title').text($result.name);
                if ($result.status == 1) {
                    $('.ht').attr('selected', 'selected');
                } else {
                    $('.kht').attr('selected', 'selected');
                }
            }
        });
        $('.update').click(function () {
            let name = $('.name').val();
            let status = $('.status').val();
            $.ajax({
                url: 'admin/category/' + id,
                data: {
                    name: name,
                    status: status
                },
                type: 'put',
                dataType: 'json',
                success: function ($result) {
                    if ($result.error == 'true') {
                        $('.error').show();
                        $('.error').html($result.message.name[0]);
                    } else {
                        // toastr.success($result.success, 'Thông báo', {timeOut: 5000});
                        // $('#edit').modal('hide');
                        // location.reload();
                        toastr.success(
                            $result.success,
                            'Thông báo',
                            {
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    location.reload();
                                }
                            }
                        );
                    }
                }
            });
        });
    });
    //xóa
    $('.delete').click(function () {
        let id = $(this).data('id');
        $('.del').click(function () {
            $.ajax({
                url: 'admin/category/' + id,
                dataType: 'json',
                type: 'delete',
                success: function ($result) {
                    // toastr.success($result.success, 'Thông báo', {timeOut: 1000});
                    // $('#delete').modal('hide');
                    // location.reload();
                    $('#delete').modal('hide');
                    toastr.success(
                        $result.success,
                        'Thông báo',
                        {
                            timeOut: 3000,
                            fadeOut: 1000,
                            onHidden: function () {
                                location.reload();
                            }
                        }
                    );
                }
            });
        });
    });

    //Edit ProductTpye

    $('.editProtype').click(function () {
        $('.error').hide();
        let id = $(this).data('id');
        $.ajax({
            url: 'admin/product_type/' + id + '/edit',
            dataType: 'json',
            type: 'get',
            success: function ($result) {
                $('.name').val($result.producttype.name);
                var html = '';
                $.each($result.category, function ($key, $value) {

                    if ($value['id'] == $result.producttype.category_id) {
                        html += '<option value= ' + $value['id'] +' selected>';
                        html += $value['name'];
                        html += '</option>';
                    }
                    else {
                        html += '<option value=' + $value['id'] +'selected>';
                        html += $value['name'];
                        html += '</option>'
                    }
                });
                $('.category_id').html(html);
                if ($result.producttype.status == 1) {
                    $('.ht').attr('selected', 'selected');
                } else {
                    $('.kht').attr('selected', 'selected');
                }
            }
        });
        $('.updateProtype').click(function() {
            let category_id = $('.category_id').val();
            console.log(category_id);
            let name = $('.name').val();
            let status = $('.status').val();
            $.ajax({
                url: 'admin/product_type/' + id,
                dataType: 'json',
                data: {
                    category_id : category_id,
                    name : name,
                    status : status,
                },
                type: 'put',
                success: function ($data) {
                    if ($data.error == 'true') {
                        $('.error').show();
                        $('.error').html($data.message.name[0]);
                    } else {
                        // toastr.success($data.success, 'Thông báo', {timeOut: 5000});
                        // $('#edit').modal('hide');
                        // location.reload();
                        $('#edit').modal('hide');
                        toastr.success(
                            $data.result,
                            'Thông báo',
                            {
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    location.reload();
                                }
                            }
                        );
                    }
                }
            });
        });
    });
    //Delete product_type
    $('.deleteProtype').click(function(){
        let id = $(this).data('id');
        $('.delProtype').click(function(){
            $.ajax({
                url : 'admin/product_type/'+id,
                dataType : 'json',
                type : 'delete',
                success : function($data){
                    toastr.success($data.result, 'Thông báo', {timeOut : 5000});
                    $('#delete').modal('hide');
                    location.reload();
                }
            });
        });
    });
    $('.cateProduct').change(function(){
        let idCate = $(this).val();
        $.ajax({
            url: 'getproducttype',
            data : {
                idCate : idCate
            },
            type: 'get',
            dataType: 'json',
            success: function($data){
                let html = '';
                $.each($data, function($key,$value){
                    html += '<option value='+$value['category_id']+'>';
                    html += $value['name'];
                    html += '</option>';
                });
                $('.proTypeProduct').html(html);
            }
        });
    });
    //xóa sản phẩm
    $('.deleteProduct').click(function(){
        let id = $(this).data('id');
        $('.delProduct').click(function(){
            $.ajax({
                url : 'admin/product/'+id,
                type : 'delete',
                dataType : 'json',
                success : function($data){
                    toastr.success($data.result, 'Thông báo', {timeOut : 5000});
                    $('#delete').modal('hide');
                    location.reload();
                }
            });
        });
    });
    // Sửa sản phẩm
    $('.editProduct').click(function(){
        $('.errorName').hide();
        $('.errorQuantity').hide();
        $('.errorPrice').hide();
        $('.errorPromotional').hide();
        $('.errorImage').hide();
        $('.errorDescription').hide();
        let id = $(this).data('id');
        $.ajax({
            url : 'admin/product/'+id+'/edit',
            dataType : 'json',
            type : 'get',
            success : function($data){
                $('.name').val($data.product.name);
                $('.quantity').val($data.product.quantity);
                $('.price').val($data.product.price);
                $('.promotional').val($data.product.promotional);
                $('.imageThumb').attr('src','img/uploads/products/'+$data.product.image);
                $('.description').val($data.product.description);
                if($data.product.status == 1){
                    $('.ht').attr('selected','selected');
                }
                else
                {
                    $('.kht').attr('selected','selected');
                }
                CKEDITOR.instances['demo'].setData($data.product.description);
                let html1 = '';
                $.each($data.category,function($key, $value){
                    if($data.product.category_id == $value['id']){
                        html1 += '<option value="'+$value['id']+'" selected>';
                        html1 += $value['name'];
                        html1 += '</option>';
                    }
                    else
                    {
                        html1 += '<option value="'+$value['id']+'">';
                        html1 += $value['name'];
                        html1 += '</option>';
                    }
                });
                $('.cateProduct').html(html1);
                let html2 = '';
                $.each($data.producttype,function($key, $value){
                    if($data.product.producttype_id == $value['id']){
                        html2 += '<option value="'+$value['id']+'" selected>';
                        html2 += $value['name'];
                        html2 += '</option>';
                    }else
                    {
                        html2 += '<option value="'+$value['id']+'">';
                        html2 += $value['name'];
                        html2 += '</option>';
                    }
                });
                $('.proTypeProduct').html(html2);
            }
        });
        $('#updateProduct').on('submit',function(event){
            event.preventDefault();
            $.ajax({
                url : 'admin/updatePro/'+id,
                data : new FormData(this),
                contentType: false,
                processData : false,
                cache : false,
                type : 'post',
                success : function(data){
                    if(data.error == 'true'){
                        if(data.message.image){
                            $('.errorImage').show();
                            $('.errorImage').text(data.message.image[0]);
                            $('.image').val('');
                        }
                        if(data.message.name){
                            $('.errorName').show();
                            $('.errorName').text(data.message.name[0]);
                            $('.name').val('');
                        }
                        if(data.message.quantity){
                            $('.errorQuantity').show();
                            $('.errorQuantity').text(data.message.quantity[0]);
                            $('.quantity').val('');
                        }
                        if(data.message.price){
                            $('.errorPrice').show();
                            $('.errorPrice').text(data.message.price[0]);
                            $('.price').val('');
                        }
                        if(data.message.promotional){
                            $('.errorPromotional').show();
                            $('.errorPromotional').text(data.message.promotional[0]);
                            $('.promotional').val('');
                        }
                        if(data.message.description){
                            $('.errorDescription').show();
                            $('.errorDescription').text(data.message.description[0]);
                            $('.description').val('');
                        }
                    }
                    else{
                        toastr.success(data.result, 'Thông báo', {timeOut : 5000});
                        $('#edit').modal('hide');
                        location.reload();
                    }
                }
            });
        });
    });
});
