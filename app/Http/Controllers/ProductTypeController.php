<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\Category;
use App\Http\Requests\ProductTypeRequest;
use Validator;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_types = ProductType::paginate(5);
        return view('admin.pages.producttype.list', compact('product_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', 1)->get();
        return view('admin.pages.producttype.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductTypeRequest $request)
    {

        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if(ProductType::create($data)){
            return redirect()->back()->with('success','Thêm loại sản phẩm thành công');
        }
        else{
            return back()->with('danger','Có lỗi xảy ra');
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
        $producttype = ProductType::find($id);
        $category  = Category::where('status', 1)->get();
        return response()->json(['category' => $category, 'producttype' => $producttype], 200);
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
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:3|max:255',
            ],

            [
                'required' => 'Tên loại sản phẩm không được để trống',
                'min' =>'Tên loại sản phẩm tối thiểu có 3 ký tự',
                'max' => 'Tên loại sản phẩm không vượt quá 255 ký tự',
            ]
        );

        if($validator->fails()){
            return response()->json(['error' => 'true', 'message' => $validator->errors()], 200);
        }
        $producttype = ProductType::find($id);
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if($producttype->update($data)){
            return response()->json(['result' => 'Đã sửa thành công loại sản phẩm có id '.$id], 200);
        }
        else
        {
            return response()->json(['result' => 'Thao tác thất bại, Sửa không thành công'], 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producttype = ProductType::find($id);
        if($producttype->delete()){
            return response()->json(['result' => 'Xóa thành công loại sản phẩm có id '.$id], 200);
        }
        else
        {
            return response()->json(['result' => 'Thao tác thất bại, đã xảy ra lỗi'], 200);
        }
    }
}
