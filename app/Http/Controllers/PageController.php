<?php

namespace App\Http\Controllers;
use App\Comment;
use App\LoaiTin;
use App\TheLoai;
use App\Slide;
use App\TinTuc;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;



class PageController extends Controller
{
    public function __construct()
    {
        $theloai = TheLoai::where('active', 1)->get();
        $tintuc = TinTuc::where('active', 1)->get();
//        $slide = Slide::where('active', 1)->get();
        view()->share('theloai', $theloai);
        view()->share('tintuc', $tintuc);
//        view()->share('slide', $slide);
        if(Auth::check()){
            view()->share('nguoidung', Auth::user());
        }
    }

    public function getTrangchu()
    {
        return view('pages.trangchu');
    }

    public function getLienhe(){
        return view('pages.lienhe');
    }

    public function getLoaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where([
            ['idLoaiTin', $id],
            ['active', 1],
            ])->orderBy('NoiBat', 'desc')->paginate(5);
        return view('pages.loaitin')->with(['loaitin' => $loaitin, 'tintuc' => $tintuc]);
    }
    public function getTheloai($id){
        $theloai = TheLoai::find($id);
        $tintuc = TinTuc::where([
            ['idTheLoai', $id],
            ['active', 1],
        ])->orderBy('NoiBat', 'desc')->paginate(5);
        return view('pages.theloai')->with(['theloai' => $theloai, 'tintuc' => $tintuc]);
    }

    public function getChiTiet($id){
        $tintuc = TinTuc::find($id);
        $noibat = TinTuc::where([
            ['NoiBat',1],
            ['active', 1]
        ])->orderBy('created_at','desc')->take(4)->get();
        $lienquan = TinTuc::where([
           ['idLoaiTin', $tintuc->idLoaiTin],
           ['active', 1]
        ])->orderBy('created_at','desc')->take(4)->get();
//        $time = $tintuc->created_at->format('l jS \\of F Y h:i:s A');
        return view('pages.chitiet')->with(['tintuc' => $tintuc, 'noibat' => $noibat, 'lienquan' => $lienquan]);
    }

    public function getDangNhap(){
        return view('pages.dangnhap');
    }

    public function postDangNhap(Request $request){
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
            return redirect('trangchu');
        }
        else{
            return redirect()->back()->withErrors(['Đăng nhập không thành công'])->withInput(['password' => $request->password, 'email' => $request->email]);
        }
    }

    public function getDangXuat(){
        if(Auth::check()){
            Auth::logout();
            return redirect('trangchu');
        }
    }

    public function getDangKy(){
        return view('pages.dangky');
    }

    public function postDangKy(Request $request){
        $this->validate($request,
            [
                'name' => 'required|min:6',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'name.min' => 'Tên của bạn không đủ chiều dài',
                'email.required' => 'Bạn chưa nhập email',
                'email.unique' => 'Email bạn chọn đã tồn tại',
                'email.email' => 'Email của bạn không đúng định dạng',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu không đủ chiều dài',
                'passwordAgain.required' => 'Bạn chưa nhập mật khẩu',
                'passwordAgain.same' => 'Mật khẩu không khớp nhau'
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        Auth::login($user);
        return redirect('trangchu');
    }

    public function postComment(Request $request, $id){
        $this->validate($request,
            [
                'name' => 'required',
                'noidung' => 'required|min:3'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'noidung.required' => 'Bạn chưa nhập bình luận',
                'noidung.min' => 'Bình luận không đủ chiều dài',
            ]
        );
        $tintuc = TinTuc::find($id);
        $comment = new Comment();
        $comment->idTinTuc = $tintuc->id;
        $comment->NoiDung = $request->noidung;
        $userDB = Auth::user();

            if(isset($userDB)){
                $comment->idUser = $userDB->id;
            }else{
                $user = new User();
                $user->name = $request->name;
                $userDB = User::all();
                $user->email = 'anonymous'.str_random(16).'@mymail.com';
                foreach($userDB as $us) {
                    while ($user->email == $us->email) {
                        $user->mail = 'anonymous' . str_random(16) . '@mymail.com';
                    }
                }
                $user->password = bcrypt('888888');
                $user->origin = 0;
                $user->save();
                $comment->idUser = $user->id;
                $comment->save();
            }
        $comment->save();
        return redirect()->back();
    }

    public function getTimKiem(Request $request){
        $search = $request->search;
        $alltintuc = TinTuc::where('TieuDe', 'like', '%'.$search.'%')->orWhere('TomTat', 'like', '%'.$search.'%')->orWhere('NoiDung', 'like', '%'.$search.'%')->get();
        $num = count($alltintuc);
        $tintuc = TinTuc::where('TieuDe', 'like', '%'.$search.'%')->orWhere('TomTat', 'like', '%'.$search.'%')->orWhere('NoiDung', 'like', '%'.$search.'%')->paginate(5);
        return view('pages.timkiem')->with(['tintuc' => $tintuc, 'search' => $search, 'num' => $num]);
    }

    public function getsuaUser(){
        $user = Auth::user();
        return view('pages.suaUser')-> with(['user' => $user]);
    }

    public function postsuaUser(Request $request, $id){
        $this->validate($request,
            [
                'name' => 'required|min:3|max:50',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng không đủ chiều dài',
                'ten.max' => 'Tên người dùng quá chiều dài',
            ]
        );
        $user = User::find($id);
        $user->name = $request->name;
        if($request->check == 1){
            $this->validate($request,
                [
                    'password' => 'required|min:6',
                    'passwordAgain' => 'required|same:password'
                ],
                [
                    'password.required' => 'Bạn chưa nhập mật khẩu',
                    'password.min' => 'Mật khẩu không đủ chiều dài',
                    'passwordAgain.required' => 'Bạn chưa nhập mật khẩu xác thực',
                    'passwordAgain.same' => 'Mật khẩu bạn nhập không khớp nhau'
                ]
            );
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->back()->with('success', 'Sửa thành công');
    }

    public function CommentAjax(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'noidung' => 'required|min:3',
        ]);

        if ($validator->passes()) {
            $comment = new Comment();
            $comment->idTinTuc = $request->idTinTuc;
            $comment->NoiDung = $request->noidung;
            $userDB = Auth::user();
            if(isset($userDB)){
                $comment->idUser = $userDB->id;
            }else {
                $user = new User();
                $user->name = $request->name;
                $userDB = User::all();
                $user->email = 'anonymous' . str_random(16) . '@mymail.com';
                foreach ($userDB as $us) {
                    while ($user->email == $us->email) {
                        $user->mail = 'anonymous' . str_random(16) . '@mymail.com';
                    }
                }
                $user->password = bcrypt('888888');
                $user->origin = 0;
                $user->save();
                $comment->idUser = $user->id;
            }
                $comment->save();
                $comment = Comment::where([
                    ['idTinTuc', $request->idTinTuc],
                    ['active', 1]
                ])->orderBy('created_at', 'desc')->paginate(5);
                $output = '';
                foreach($comment as $cm){
                    $now = Carbon::now();
                    $DBtime = $cm->created_at;
                    $interval = $now->diffForHumans($DBtime);
                    $output .= '<div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">'.$cm->user->name.'
                                    <small>'.$interval.'</small
                                    </h4>
                                    <p>'.$cm->NoiDung.'</p>
                                </div>
                            </div>';
                }
                return response()->json(['output'=>$output, 'success' => 'Tạo comment thành công']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
