<?php

namespace App\Http\Controllers;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;
use Illuminate\Http\Request;

class TintucController extends Controller
{
    public function getDanhSach(){
        $tintuc = TinTuc::where('active', 1)->orderBy('id', 'desc')->get();
        return view('Admin.TinTuc.danhsach')->with(['tintuc' => $tintuc]);
    }

    public function getThem(){
        $theloai = TheLoai::where('active',1)->get();
        $loaitin = LoaiTin::where('active',1)->get();
        return view('Admin.Tintuc.them')->with(['theloai' => $theloai, 'loaitin' => $loaitin]);
    }

    public function postThem(Request $request){
        $this->validate($request,
            [
                'loaitin' => 'required',
                'tieude' => 'required|min:3|unique:tintuc,TieuDe',
                'tomtat' => 'required',
                'noidung' => 'required',
                'Hinh' => 'mimes:jpg,jpeg,png|max:2048'
            ],
            [
                'loaitin.required' => 'Bạn chưa nhập loại tin',
                'tieude.required' => 'Bạn chưa nhập tiêu đề',
                'tomtat.required' => 'Bạn chưa nhập tóm tắt',
                'noidung.required' => 'Bạn chưa nhập nội dung',
                'tieude.min' => 'Tên tiêu đề phải nhiều hơn 3 kí tự',
                'tieude.unique' => 'Tên tiêu đề bạn chọn đã tồn tại',
                'Hinh.mimes' => 'File của bạn không đúng định dạng',
                'Hinh.max' => 'Chỉ upload được ảnh có dung lượng không quá 2MB'
            ]
        );
        $tintuc = new TinTuc();
        $tintuc->idLoaiTin = $request->loaitin;
        $tintuc->TieuDe = $request->tieude;

        $tintuc->TomTat = $request->tomtat;
        $tintuc->NoiDung = $request->noidung;
        $tintuc->NoiBat  = $request->noibat;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $tenHinh = str_random(4)."_".$name;
            while(file_exists('images/tintuc/'.$tenHinh)){
                $tenHinh = str_random(4)."_".$name;
            }
            $file->move('images/tintuc', $tenHinh);
            $tintuc->Hinh = $tenHinh;
        }
        else {
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('success', 'Thêm thành công');
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->active = 0;
//        foreach($tintuc->comment as $comment){
//            $comment->active = 0;
//            $comment->save();
//        }
        $tintuc->save();
        return redirect('admin/tintuc/danhsach')->with('alert', 'Xóa tên thể loại thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::where('active',1)->get();
        $loaitin = LoaiTin::where('active',1)->get();
        $tintuc = TinTuc::find($id);
        $comment = Comment::where([
            ['idTinTuc', '=', $id],
            ['active', '=', 1],
        ])->get();
        return view('Admin.TinTuc.sua')->with(['tintuc' => $tintuc, 'theloai' => $theloai, 'loaitin' => $loaitin, 'comment' => $comment]);
    }
    public function postSua(Request $request, $id){
        $this->validate($request,
            [
                'loaitin' => 'required',
                'tieude' => 'required|min:3',
                'tomtat' => 'required',
                'noidung' => 'required',
            ],
            [
                'loaitin.required' => 'Bạn chưa nhập loại tin',
                'tomtat.required' => 'Bạn chưa nhập tóm tắt',
                'noidung.required' => 'Bạn chưa nhập nội dung',
                'tieude.min' => 'Tên tiêu đề phải nhiều hơn 3 kí tự',
            ]
        );
        $tintuc = TinTuc::find($id);
        $selected = TinTuc::where('TieuDe','!=', $tintuc->TieuDe)->get();
        foreach($selected as $tintucCheck){
            if($request->tieude == $tintucCheck->TieuDe){
                return redirect('admin/tintuc/sua/'.$id)->withErrors(['Tiêu đề bạn chọn đã tồn tại']);
            }
        }
        $tintuc->idLoaiTin = $request->loaitin;
        $tintuc->TieuDe = $request->tieude;

        $tintuc->TomTat = $request->tomtat;
        $tintuc->NoiDung = $request->noidung;
        $tintuc->NoiBat  = $request->noibat;

        if($request->hasFile('newImage')){
            $this->validate($request,
                [
                    'newImage' => 'mimes:jpg,jpeg,png|max:2048'
                ],
                [
                    'newImage.mimes' => 'File của bạn không đúng định dạng',
                    'newImage.max' => 'Chỉ upload được ảnh có dung lượng không quá 2MB'
                ]
            );
            $file = $request->file('newImage');
            $name = $file->getClientOriginalName();
            $tenHinh = str_random(4)."_".$name;
            while(file_exists('images/tintuc/'.$tenHinh)){
                $tenHinh = str_random(4)."_".$name;
            }
            $file->move('images/tintuc', $tenHinh);
            unlink('images/tintuc/'.$tintuc->Hinh);
            $tintuc->Hinh = $tenHinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('success', 'Sửa thành công');
    }

    public function xoaComment($id){
        $comment = Comment::find($id);
        $comment->active = 0;
        $comment->save();
        $id = $comment->tintuc->id;
        return redirect('admin/tintuc/sua/'.$id)->with('alert', 'Xóa comment thành công');
    }
}
