<?php

namespace App\Http\Controllers;
use App\TheLoai;
use App\LoaiTin;
use Illuminate\Http\Request;

class LoaitinController extends Controller
{
    public function getDanhSach(){
        $loaitin = LoaiTin::where('active', 1)->get();
        return view('admin.LoaiTin.danhsach')->with(['loaitin' => $loaitin]);
    }

    public function getThem(){
        $theloai = TheLoai::where('active', 1)->get();
        return view('admin.LoaiTin.them')->with(['theloai' => $theloai]);
    }

    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|unique:loaitin|min:3|max:50'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập dữ liệu',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
                'Ten.min' => 'Tên loại tin không đủ chiều dài',
                'Ten.max' => 'Tên loại tin quá chiều dài'
            ]
        );
        $loaitin = new LoaiTin();
        $loaitin->Ten = $request->Ten;

        $loaitin->idTheLoai = $request->Theloai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('success', 'Thêm thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::where('active', 1)->get();
        $loaitin = LoaiTin::find($id);
        return view('Admin.LoaiTin.sua')->with(['theloai' => $theloai, 'loaitin' => $loaitin]);
    }

    public function postSua(Request $request, $id){
        $this->validate($request,
            [
                'Ten' => 'required|unique:loaitin|min:3|max:50'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập dữ liệu',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
                'Ten.min' => 'Tên loại tin không đủ chiều dài',
                'Ten.max' => 'Tên loại tin quá chiều dài'
            ]
        );
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;

        $loaitin->idTheLoai =  $request->Theloai;
        $loaitin->save();
        $loaitin = LoaiTin::where('active', 1)->get();
        return view('admin.Loaitin.danhsach')->with(['loaitin' => $loaitin]);
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        foreach($loaitin->tintuc as $tintuc){
            $tintuc->active = 0;
            $tintuc->save();
        };
        $loaitin->active = 0;
        $loaitin->save();
        return redirect('admin/loaitin/danhsach')->with('alert', 'Xóa tên loại tin thành công');
    }
}
