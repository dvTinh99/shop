<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
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
}
