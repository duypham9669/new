<?php

namespace App\Http\Controllers;

use App\TinTuc;
use App\TheLoai;
//use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class LoadMoreController extends Controller
{
    public function __construct()
    {
        $theloai = TheLoai::where('active', 1)->get();
//        $slide = Slide::where('active', 1)->get();
        view()->share('theloai', $theloai);
//        view()->share('slide', $slide);
        if(Auth::check()){
            view()->share('nguoidung', Auth::user());
        }
    }

    public function index()
    {
        return view('load_more');
    }

    public function load_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->id > 0)
            {
                $data = DB::table('loaitin')
                    ->where('id', '>', $request->id)
                    ->limit(5)
                    ->get();
            }
            else
            {
                $data = DB::table('loaitin')
                    ->limit(5)
                    ->get();
            }
            $output = '';
            $last_id = '';

            if(!$data->isEmpty())
            {
                foreach($data as $row)
                {
                    $output .= '
        <div class="row">
         <div class="col-md-12">
          <p>ID: '.$row->id.'</p>
          <p>ID thể loại: '.$row->idTheLoai.'</p>
           <p>Tên: '.$row->Ten.'</p>
          </div>
          <br />
          <hr />
         </div>         
        </div>
                 
                    ';
                    $last_id = $row->id;
                }
                $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="'.$last_id.'" id="load_more_button">Load More</button>
       </div>
       ';
            }
            else
            {
                $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
       </div>
       ';
            }
            echo $output;
        }
    }

    public function load_loaitin(Request $request){
        if($request->ajax()){
            $idLoaiTin = $request->idLoaiTin;
            if($request->id > 0){
                $data = DB::table('tintuc')->where([
                    ['id', '>', $request->id],
                    ['idLoaiTin', $idLoaiTin],
                    ['active', 1]
                ])->orderBy('NoiBat', 'desc')->limit(5)->get();

            }else
            {
                $data = DB::table('tintuc')->where([
                    ['idLoaiTin', $idLoaiTin],
                    ['active', 1],
                ])->orderBy('NoiBat', 'desc')->limit(5)->get();


            }
            $output = '';
            $last_id = '';
            if(!$data->isEmpty()){
                foreach($data as $tt) {
                    $output .= '<div class="row-item row">
                            <div class="col-md-3">
                                <a href="detail.html">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive" src="images/tintuc/'.$tt->Hinh.'" alt="">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <h3><a href="#">'. $tt->TieuDe.'</a></h3>
                                <p>'.$tt->TomTat.'</p>
                            </div>
                            <div class="break"></div>
                        </div>';
                    $last_id = $tt->id;
                }
                    $output .= '
                       <div id="load_more">
                        <button style="background-color: #337AB7;" type="button" name="load_more_button" class="btn btn-success form-control" data-id="'.$last_id.'" id="load_more_button">Load More</button>
                       </div>
                       ';
                }else
                {
                    $output .= '
                       <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
                       </div>
                       ';
                }
                echo $output;
            }
        }

        public function check(){
            $tintuc = TinTuc::where([
                ['idLoaiTin', 1],
                ['active', 0]
                ])->paginate(5);
            return view('pages.check')->with(['tintuc' => $tintuc]);
        }
    }
?>