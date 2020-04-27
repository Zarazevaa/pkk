<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\detail_transaksi_model;
use App\jadwal_model;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class detail_transaksi_controller extends Controller
{
  public function index($id)
  {
      if(Auth::user()->level=="petugas"){
          $dt_jenis=detail_transaksi_model::get();
          return response()->json($dt_jenis);

  }else{
      return response()->json(['status'=>'anda bukan petugas']);
  }
  }
     public function store(Request $req){
        //   if(Auth::user()->level=="petugas"){

        $validator=Validator::make($req->all(),
        [
            'id_transaksi'=>'required',
            'id_jadwal'=>'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $id_jadwal=$req->id_jadwal;
            $harga=DB::table('jadwal')->where('id',$id_jadwal)->first();
            $harga_total=$harga->tarif;
            $subtotal=$harga_total;

        $simpan=detail_transaksi_model::create([
            'id_transaksi'=>$req->id_transaksi,
            'id_jadwal'=>$req->id_jadwal,
            'subtotal'=>$subtotal
        ]);
        $status=1;
        $message="Data Berhasil Ditambahkan!";
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
          }

    public function tampil_detail()
    {
        $data_pelanggan=detail_transaksi_model::count();
        $data_pelanggan1=detail_transaksi_model::all();
        return Response()->json(['count'=> $data_pelanggan, 'pelanggan'=> $data_pelanggan1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'id_transaksi'=>'required',
            'id_jadwal'=>'required',
            'subtotal'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=detail_transaksi_model::where('id',$id)->update([
            'id_transaksi'=>$req->id_transaksi,
            'id_jadwal'=>$req->id_jadwal,
            'subtotal'=>$req->subtotal
        ]);
        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    public function destroy($id)
    {
        $hapus=detail_transaksi_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
