<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    // Get Menu Functions
    public function get()
    {
        $dt_meja=Menu::get();
        return response()->json($dt_meja);
    }

    // Post Meja Functions
    public function create(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'nama_menu'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'harga'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        // $image = $req->file('image');
        // $image->storeAs('public/images', $image->hashName());
        $image_path = $req->file('image')->store('images', 'public');

        $save = Menu::create([
            'nama_menu'    =>$req->get('nama_menu'),
            'jenis'    =>$req->get('jenis'),
            'deskripsi'    =>$req->get('deskripsi'),
            'image'    =>$image_path,
            'harga'    =>$req->get('harga'),
        ]);
        if($save){
            return Response()->json(['status'=>true, 'message' =>'Sukses Menambah Menu']);
        } else {
            return Response()->json(['status'=>false, 'message' =>'Gagal Menambah Menu']);
        }

    }
    
    // Put Menu Functions
    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(),[
            'nama_menu'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'harga'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }

        $image_path = $req->file('image')->store('images', 'public');

        $ubah=Meja::where('id',$id)->update([
            'nama_menu'    =>$req->get('nama_menu'),
            'jenis'    =>$req->get('jenis'),
            'deskripsi'    =>$req->get('deskripsi'),
            'image'    =>$image_path,
            'harga'    =>$req->get('harga'),
        ]);
        if($ubah){
            return Response()->json(['status'=>true, 'message' =>'Sukses Mengubah Nomor Meja']);
        } else {
            return Response()->json(['status'=>false, 'message' =>'Gagal Mengubah Nomor Meja']);
        }
    }
}
