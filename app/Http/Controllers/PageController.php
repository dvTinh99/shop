<?php

namespace App\Http\Controllers;
use App\Models\Slide ;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use Session ;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex(){
        $slide = Slide::all();
        // return view('page.trangchu',['slide'=>$slide]);
        // print_r($slide);
        // exit();
        $new_product = Product::where('new',1)->paginate(4);
        // dd($new_product);
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(8);
        
        return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
    }

    public function getLoaiSp($type){
        $sp_theoloai = Product::where('id_type',$type)->get();
        $sp_khac = Product::where('id_type','<>',$type)->paginate(3);
        $loai = ProductType::all();
        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai'));
    }

    public function getChitiet(Request $req){
        $sanpham = Product::where('id',$req->id)->first();
        $sp_tuongtu =  Product::where('id_type',$sanpham->id_type)->paginate(8);
        return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu'));
    }

    public function getLienHe(){
        return view('page.lienhe');
    }
    public function getGioiThieu(){
        return view('page.gioithieu');
    }

    public function getAddToCart(Request $req,$id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null ;
        $cart = new Cart($oldCart);
        $cart->add($product,$id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null ;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        
        return redirect()->back();
    }
    public function getThanhToan(){
        if(Session('cart')){
            
            $cart = Session::get('cart');
            $product_cart = $cart->items;
            // dd($product_cart);
            $totalPrice = $cart->totalPrice;
            $totalQty = $cart->totalQty;
            return view('page.thanhtoan',compact('cart','product_cart','totalPrice','totalQty'));

        }
        
    }
}