<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Auth;
use App\jadwal_model;

class jadwal_controller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="pelanggan"){
            $dt_jadwal=jadwal_model::get();
            return response()->json($dt_jadwal);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }
    }
    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'hari_1'=>'required',
            'tarif'=>'required',
            'hari_3'=>'required',
            'hari_2'=>'required',
            'pukul'=>'required',
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=jadwal_model::create([
            'hari_1'=>$req->hari_1,
            'hari_2'=>$req->hari_2,
            'hari_3'=>$req->hari_3,
            'tarif'=>$req->tarif,
            'pukul'=>$req->pukul,
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil_jadwal()
    {
        $data_jadwal=jadwal_model::count();
        $data_jadwal1=jadwal_model::all();
        return Response()->json(['count'=> $data_jadwal, 'jadwal'=> $data_jadwal1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'hari_1'=>'required',
            'hari_2'=>'required',
            'hari_3'=>'required',
            'tarif'=>'required',
            'pukul'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=jadwal_model::where('id',$id)->update([
            'hari_1'=>$req->hari_1,
            'hari_2'=>$req->hari_2,
            'hari_3'=>$req->hari_3,
            'tarif'=>$req->tarif,
            'pukul'=>$req->pukul,


        ]);
        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    public function destroy($id)
    {
        $hapus=jadwal_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
