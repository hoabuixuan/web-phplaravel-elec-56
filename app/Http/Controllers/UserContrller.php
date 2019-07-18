<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Auth;
use Hash;

class UserContrller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function redirectProvider($social){
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social){
        $user = Socialite::driver($social)->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser);
        return back()->with('success','Đăng nhập thành công!');
    }

    private function findOrCreateUser($user){
        $authUser = User::where('social_id',$user->id )->first();
        if($authUser){
            return $authUser;
        }else {
             return User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id' => $user->id,
                'password' => '',
                'rule' => 0,
                'status' => 0,
                'avatar' => $user->avatar
            ]);
        }
    }
    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return back()->with('success','Đăng xuất thành công!');
        }
    }

    public function updatePwClient(Request $request)
    {
        $this->validate($request,
        [
            'password' => 'required|min:6|max:30',
            're_password' => 'required|same:password'
        ],
        [
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không vượt quá 30 ký tự',
            're_password.required' => 'Không được bỏ trống',
            're_password.same' => 'Nhập không đúng với mật khẩu trên'
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Đã cập nhật mật khẩu thành công');

    }

    public function login(Request $request){
        $data = $request->only('email', 'password');
        if(Auth::attempt($data,$request->has('remember'))){
            return back()->with('success','Đăng nhập thành công!');
        }
        else
        {
            return back()->with('error', 'Đăng nhập thất bại. Xin vui lòng kiểm tra lại thông tin.');
        }
    }

   public function registerClient(Request $request){
    $this->validate($request,
    [
        'name' => 'required|min:2|max:30',
        'email' => 'reuqired|email',
        'password' => 'required|min:6|max:30',
        'confirm_password' => 'required|same:password'
    ],
    [
        'name.required' => 'Mật khẩu không được bỏ trống',
        'name.min' => 'Tên ít nhát 2 ký tự',
        'name.max' => 'Tên không cượt quá 30 ký tự',
        'email.required' => 'Không được bỏ trống',
        'email.email' => 'Không phải đạng địa chỉ email',
        'name.required' => 'Mật khẩu không được bỏ trống',
        'password.required' => 'Mật khẩu không được bỏ trống',
        'password.min' => 'Mật khẩu ít nhất 6 ký tự',
        'password.max' => 'Mật khẩu không vượt quá 30 ký tự',
        'confirm_password.required' => 'Không được bỏ trống',
        'confim_password.same' => 'Nhập không đúng với mật khẩu trên'
    ]);
    $data = $request->all();
    $data['password'] = Hash::make($request->passwrod);
    $user = User::create($data);
    Auth::login($user);
    return back()->with('success', 'Đăng ký tài khoản thành công');
   }
}
