<?php

namespace App\Http\Controllers;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MejaController extends Controller
{
    // Get Meja Functions
    public function get()
    {
        $dt_meja=Meja::get();
        return response()->json($dt_meja);
    }

    // Post Meja Functions
    public function create(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'nomor_meja'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $save = Meja::create([
            'nomor_meja'    =>$req->get('nomor_meja'),
        ]);
        if($save){
            return Response()->json(['status'=>true, 'message' =>'Sukses Menambah Meja']);
        } else {
            return Response()->json(['status'=>false, 'message' =>'Gagal Menambah Meja']);
        }
    }
    
    // Put Meja Functions
    public function update(Request $req, $id)
        {
            $validator = Validator::make($req->all(),[
                'nomor_meja'=>'required',
            ]);
            if($validator->fails()){
                return Response()->json($validator->errors()->toJson());
            }
            $ubah=Meja::where('id',$id)->update([
                'nomor_meja'    =>$req->get('nomor_meja'),
            ]);
            if($ubah){
                return Response()->json(['status'=>true, 'message' =>'Sukses Mengubah Nomor Meja']);
            } else {
                return Response()->json(['status'=>false, 'message' =>'Gagal Mengubah Nomor Meja']);
            }
        }

    // Delete Meja Functions
    public function delete($id)
        {
            $hapus=Meja::where('id',$id)->delete();
            if($hapus){
                return Response()->json(['status'=>true, 'message' =>'Sukses Hapus Nomor Meja']);
            } else {
                return Response()->json(['status'=>false, 'message' =>'Gagal Hapus Nomor Meja']);
            }
        }
}
