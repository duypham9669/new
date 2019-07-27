<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getDanhsach(){
        $user = User::where('level', '0')->get();
        return view('Admin.User.danhsach')->with(['user' => $user]);
    }

    public function getXoa($id){
        $user = User::find($id);
        $user->active = 0;
        foreach($user->comment as $cm){
            $cm->active = 0;
            $cm->save();
        }
        $user->save();
        return redirect()->back()->with('alert', 'Xóa thành công');
    }

    public function getThem(){
        return view('Admin.User.them');
    }

    public function postThem(Request $request){
        $this->validate($request,
            [
                'ten' => 'required|min:3|max:50',
                'email' => 'required|unique:users|email',
                'matkhau' => 'required|min:6',
            ],
            [
                'ten.required' => 'Bạn chưa nhập tên người dùng',
                'ten.min' => 'Tên người dùng không đủ chiều dài',
                'ten.max' => 'Tên người dùng quá chiều dài',
                'email.required' => 'Bạn chưa nhập email',
                'email.unique' => 'Tên email đã tồn tại',
                'email.regex' => 'Định dạng email bạn nhập chưa đúng',
                'matkhau.required' => 'Bạn chưa nhập mật khẩu',
                'matkhau.min' => 'Mật khẩu không đủ chiều dài',
            ]
        );
        $user = new User();
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->password = bcrypt($request->matkhau);
        $user->level = $request->level;
        $user->save();
        return redirect('admin/user/danhsach')->with('success', 'Thêm thành công');
    }

    public function getSua($id){
        $user = User::find($id);
        return view('Admin.User.sua')->with(['user' => $user]);
    }

    public function postSua(Request $request, $id){
        $this->validate($request,
            [
                'ten' => 'required|min:3|max:50',
                'email' => 'required|email',
            ],
            [
                'ten.required' => 'Bạn chưa nhập tên người dùng',
                'ten.min' => 'Tên người dùng không đủ chiều dài',
                'ten.max' => 'Tên người dùng quá chiều dài',
                'email.required' => 'Bạn chưa nhập email',
                'email.unique' => 'Tên email đã tồn tại',
            ]
        );
        $user = User::find($id);
        $bigUser = User::where('email','!=', $user->email)->get();
        foreach($bigUser as $userObj){
            if($request->email == $userObj->email){
                return redirect('admin/user/sua/'.$id)->withErrors(['Email bạn chọn đã tồn tại']);
            }
        }
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->level = $request->level;
        if($request->check == 1){
            $this->validate($request,
                [
                    'matkhau' => 'required|min:6',
                ],
                [
                    'matkhau.required' => 'Bạn chưa nhập mật khẩu',
                    'matkhau.min' => 'Mật khẩu không đủ chiều dài',
                ]
            );
            $user->password = bcrypt($request->matkhau);
        }
        $user->save();
        return redirect('admin/user/danhsach')->with('success', 'Sửa thành công');
    }

    public function getDangnhapAdmin(){
        return view('Admin/login');
    }

    public function postDangnhapAdmin(Request $request){
        $this->validate($request,
            [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Email của bạn không đúng định dạng',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu không đủ chiều dài',
            ]
        );
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('admin/theloai/danhsach');
        }
        else{
            return redirect()->back()->withErrors(['Đăng nhập không thành công'])->withInput(['password' => $request->password, 'email' => $request->email]);
        }
    }

    public function DangxuatAdmin(){
        if(Auth::check()){
            Auth::logout();
            return redirect('admin/dangnhap');
        }
    }
}
