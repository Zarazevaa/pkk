<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Auth;
use App\pelatih_model;

class pelatih_controller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_pelatih=pelatih_model::get();
            return response()->json($dt_pelatih);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }
    }
    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_pelatih'=>'required',
            'no_ktp'=>'required',
            'telp'=>'required',
            'alamat'=>'required',
            'mobil'=>'required',
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=pelatih_model::create([
            'nama_pelatih'=>$req->nama_pelatih,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'no_ktp'=>$req->no_ktp,
            'mobil'=>$req->mobil,
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil_pelatih()
    {
        $data_pelatih=pelatih_model::count();
        $data_pelatih1=pelatih_model::all();
        return Response()->json(['count'=> $data_pelatih, 'pelatih'=> $data_pelatih1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_pelatih'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'no_ktp'=>'required',
            'mobil'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=pelatih_model::where('id',$id)->update([
            'nama_pelatih'=>$req->nama_pelatih,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'no_ktp'=>$req->no_ktp,
            'mobil'=>$req->mobil,


        ]);
        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    public function destroy($id)
    {
        $hapus=pelatih_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
