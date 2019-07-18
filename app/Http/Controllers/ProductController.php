<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use File;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', 1)->paginate(5);
        return view('admin.pages.product.list',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        $producttype = ProductType::where('status', 1)->get();
        $viewData = ([
            'categories' => $categories,
            'producttype' => $producttype
        ]);
        return view('admin.pages.product.add', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'promotional' => 'required|numeric',
            'image' => 'image',
        ],
        [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute tốt thiểu 2 ký tự',
            'max' => ':attribute không được vượt quá 255 ký tự',
            'image' => ':attrbute phải là định dạnh ảnh',
            'numeric' => ':attrbute phải là kiểu số'
        ],
        [
            'name' => 'Tên sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'quantity' => 'Số lượng sản phẩm',
            'price' => 'Giá sản phẩm',
            'promotional' => 'Giá khuyến mại',
            'image' => 'Hình ảnh'
        ]
    );
    if($validator->fails()){
        return response()->json(['error'=> 'true', 'message' => $validator->errors()], 200);
    }
        if($request->hasFile('image'))
        {
            $file = $request->image;
            //lấy tên file
            $file_name = $file->getClientOriginalName();
            //take type file
            $file_type = $file->getMimeType();
            //file size
            $file_size = $file->getSize();
            if($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif'){
                if($file_size <= 104857){
                    $file_name = date('D-m-yyyy').'_'.rand().'_'.utf8tourl($file_name);
                    if($file->move('img/uploads/products',$file_name)){
                        $data = $request->all();
                        $data['slug'] = utf8tourl($request->name);
                        $data['image'] = $file_name;
                        Product::create($data);
                        return redirect()->route('product.index')->with('success','Thêm sản phẩm thành công');
                    }
                }else
                {
                    return back()->with('error','Bạn không thể upload ảnh quá lớn');
                }
            }else{
                return back()->with('error','Định dạng file không phải là ảnh');
            }

        }
        else
        {
            return back()->with('error', 'Bạn chưa thêm ảnh sản phẩm');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('status',1)->get();
        $producttype = ProductType::where('status', 1)->get();
        $product = Product::find($id);
        $viewData = [
            'category' => $category,
            'producttype' => $producttype,
            'product' => $product
        ];
        return response()->json($viewData,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if($request->hasFile('image'))
        {
            $file = $request->image;
            //lấy tên file
            $file_name = $file->getClientOriginalName();
            //take type file
            $file_type = $file->getMimeType();
            //file size
            $file_size = $file->getSize();
            if($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif'){
                if($file_size <= 104857){
                    $file_name = date('D-m-yyyy').'_'.rand().'_'.utf8tourl($file_name);
                    if($file->move('img/uploads/products',$file_name)){
                        $data['image'] = $file_name;
                        if(File::exists('img/uploads/products'.$product->image)){
                            // Delete file image
                            unlink('img/uploads/products'.$product->image);
                        }
                    }
                }else
                {
                    return response()->json(['error' => 'Ảnh của bạn quá lớn chỉ được upload 1Mb'], 200);
                }
            }else{
                return response()->json(['error' => 'File bạn chọn không là hình ảnh'], 200);
            }

        }else
        {
            $data['image'] = $product->image;
        }
        $product->update($data);
        return response()->json(['result' => 'Đã sửa thành công sản phẩm có id là'. $id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(File::exists('img/uploads/products/'.$product->image)){
            unlink('img/uploads/products/'.$product->image);
        }
        $product->delete();
        return response()->json(['result' => 'Đã xóa thành công sản phẩm có id là'. $id], 200);
    }
}
