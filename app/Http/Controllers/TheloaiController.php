<?php

namespace App\Http\Controllers;
use App\TheLoai;
use Illuminate\Http\Request;
//use App\Http\Requests\TheloaiRequest;

class TheloaiController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::where('active',1)->get();
        return view('admin.TheLoai.danhsach',['theloai' => $theloai]);
    }

    public function getThem(){
        return view('admin.TheLoai.them');
    }

    public function postThem(Request $request){
        $this->validate($request,
            [
                'ten' => 'required|min:3'
            ],
            [
                'ten.required' => 'Bạn chưa nhập tên cho thể loại',
                'ten.min' => 'Tên thể loại phải có tối thiểu 3 kí tự'
            ]
        );
       $theloai = new TheLoai();
       $theloai->Ten = $request->ten;

       $theloai->save();
       return redirect('admin/theloai/them')->with('success', 'Thêm thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.TheLoai.sua')->with(['theloai' => $theloai]);
    }

    public function postSua(Request $request, $id){
        $this->validate($request,
            [
                'Ten' => 'required|min:2|max:100',
            ],
            [
                'Ten.min' => 'Tên thể loại không đủ chiều dài',
                'Ten.max' => 'Tên thể loại quá chiều dài',
            ]
        );
        $theloai = TheLoai::find($id);
        if($theloai->Ten != $request->Ten){
            $selected = TheLoai::where('Ten','!=',$theloai->Ten)->get();
            foreach($selected as $tl) {
                if ($request->Ten == $tl->Ten) {
                    return redirect('admin/theloai/danhsach/' . $id)->withErrors(['Tên thể loại đã tồn tại']);
                }
            }
            $theloai= TheLoai ::where('id', $id)->update(['ten' => $request->Ten]);

//            $theloai->active = 1;

            return redirect('admin/theloai/danhsach')->with('alert', 'Sửa tên thể loại thành công');

        }
        else{
            return redirect('admin/theloai/danhsach/'. $id)->withErrors(['Tên thể loại đã tồn tại']);
        }
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        foreach($theloai->loaitin as $loaitin){
            $loaitin->active = 0;
            $loaitin->save();
        };
        foreach($theloai->tintuc as $tintuc){
            $tintuc->active = 0;
            $tintuc->save();
        };
        $theloai->active = 0;
        $theloai->save();
        return redirect('admin/theloai/danhsach')->with('alert', 'Xóa tên thể loại thành công');
    }
}
