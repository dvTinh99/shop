<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Bill;
use App\Models\BillDetail;
use Carbon\Carbon;
use DB ;
class AdminController extends Controller
{
    function AdminIndex(){
        $product = Product::all();
        return view('admin.index',compact('product'));
    }
    function AdminInsert(){
        $type_product = ProductType::all();
        return view('admin.insert_product',compact('type_product'));
    }
    function AdminSave(Request $req){
        $product = new Product;
        $product->name = $req->name;
        $product->id_type = $req->loai;
        $product->description = $req->mota;
        $product->unit_price = $req->giagoc;
        $product->promotion_price = $req->giakhuyenmai;
        $product->image = $req->image;

        $product->save();
        return redirect()->route('adminIndex');
    }

    function AdminEdit($id){
        $product = Product::where('id',$id)->first();
        $type = ProductType::all() ;
        return view('admin.edit_product',compact('product','type'));
    }
    function AdminSaveAfterEdit(Request $req){
        $product = Product::find($req->id);
        $product->name = $req->name;
        $product->id_type = $req->loai;
        $product->description = $req->mota;
        $product->unit_price = $req->giagoc;
        $product->promotion_price = $req->giakhuyenmai;
        if($req->image != null) $product->image = $req->image;
        
        $product->save();
        return redirect()->route('adminIndex');
    }
    function AdminDelete($id){
        Product::find($id)->delete();
        return redirect()->route('adminIndex');
    }
    function AdminThongKe(){
        $bill = Bill::all();
        return view('admin.trang_thai',compact('bill'));
    }
    function AdminTrangthai(Request $req){
        $bill = Bill::find($req->id);
        $stt = $bill->trang_thai ;
        if($stt == 0){
            $bill->trang_thai = 1;
        }
        else{
            $bill->trang_thai = 0;
        }
        $bill->save();

        return redirect()->back();
    }
    function AdminDoanhThu(){
        $bill = Bill::where('trang_thai',1)->get();
        // dd($bill);
        return view('admin.thong_ke',compact('bill'));
    }

    function AdminBanChay(){
        $bill = BillDetail::select(DB::raw('id_product,count(id_product) as count'))
        ->groupBy('id_product')
        ->orderBy('count','DESC')
        ->get();
        // dd($bill);
        return view('admin.thong_ke.sp_banchay',compact('bill'));
    }

    function AdminBanCham(){
        return view('admin.thong_ke.sp_bancham');
    }
    function AdminTuan(){
        return view('admin.thong_ke.doanh_thu_tuan');
    }
    function AdminThang(){
        $bill= Bill::where('trang_thai',1)
        ->orderBy('created_at')
      ->get()
      ->groupBy(function($val) {
      return Carbon::parse($val->created_at)->format('M');
    });
    // dd($bill);
        return view('admin.thong_ke.doanh_thu_thang',compact('bill'));
    }
}
