<?php

namespace App\Http\Controllers;
use App\Models\Slide ;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use Session ;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\User;
use App\Models\Admin;
use Hash;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function getIndex(){
        $slide = Slide::all();
        // return view('page.trangchu',['slide'=>$slide]);
        // print_r($slide);
        // exit();
        $new_product = Product::where('new',1)->paginate(4);
        // dd($new_product);
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(4);
        // dd($sanpham_khuyenmai);
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

        }else{
            return view('page.thanhtoan');
        }
        
    }
    public function postCheckout(Request $req){
        $cart = Session::get('cart');
        // dd($cart);
        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->note;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->note;
        $bill->save();


        foreach($cart->items as $key => $value){
            $bill_detail = new BillDetail;
            $bill_detail->id_bill =  $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price']/$value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');
    }

    public function getLogin(){
        return view('page.dangnhap');
    }
    public function getSignin(){
        return view('page.dangki');
    }
    public function postSignin(Request $req){
        $user = new User;
        $user->full_name = $req->fullname;
        $user->email= $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Đã tạo tài khoảng thành công');

    }
    // public function AdminCheck($email , $pass){
    //     $user = User::where('email', $email)
    //         ->where('password',$pass)->get();
    //     dd($user);
    //     if($user[0]->chuc_vu == "1") return true;
    //     return false;
    // }
    public function postLogin(Request $req){
        $email = $req->email;
        $pass = $req->pass;

        $credentials = array('email'=>$req->email,'password'=>$req->pass);
        if(Auth::attempt($credentials)){
            
            return redirect()->back()->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
        }
        else{
                $admin = Admin::where('admin_name', $email)
                ->where('password',$pass)->get();

            if(!empty($admin[0])) return redirect()->route('adminIndex');
            else return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
                
            
        }
    }
    
    public function postLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function getSearch(Request $req){
        $product = Product::where('name','like','%'.$req->key.'%')
                    ->orwhere('unit_price',$req->key)
                    ->get();
        return view('page.search',compact('product'));
    }
}
