<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pelanggan_model;
use App\petugas_model;
use App\transaksi_model;
use App\jadwal_model;
use JWTAuth;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class transaksi_controller extends Controller
{
  public function index($id)
  {
      if(Auth::user()->level=="petugas"){
          $dt_jenis=transaksi_model::get();
          return response()->json($dt_jenis);

  }else{
      return response()->json(['status'=>'anda bukan petugas']);
  }
  }
     public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'id_pelanggan'=>'required',
            'id_petugas'=>'required',
            'tgl_transaksi'=>'required',
            'tgl_mulai'=>'required',
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=transaksi_model::create([
            'id_pelanggan'=>$req->id_pelanggan,
            'id_petugas'=>$req->id_petugas,
            'tgl_transaksi'=>$req->tgl_transaksi,
            'tgl_mulai'=>$req->tgl_mulai

        ]);
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }

    public function tampil_transaksi($tgl1, $tgl2){
        $trans = DB::table('transaksi')
                -> join('pelanggan' , 'pelanggan.id' , 'transaksi.id_pelanggan' )
                ->join('petugas' , 'petugas.id' , 'transaksi.id_petugas') -> where('tgl_transaksi' , '>=' , $tgl1)
                -> where('tgl_transaksi' , '<=' , $tgl2) ->get();

                $data_trans=array(); $no=0;
                foreach($trans as $t) {
                    $data_trans [$no]['tgl_transaksi'] = $t ->tgl_transaksi;
                    $data_trans [$no]['nama_pelanggan'] = $t->nama_pelanggan;
                    $data_trans [$no]['alamat'] = $t->alamat;
                    $data_trans [$no]['telp'] = $t->telp;
                    $data_trans [$no]['tgl_mulai'] = $t->tgl_mulai;

                $grand = DB::table('detail_transaksi')->where('id_transaksi' , $t->id)->groupBy('id_transaksi')
                    ->select(DB::raw('sum(subtotal) as grandtotal'))->first();

                    $data_trans[$no]['grandtotal']=$grand->grandtotal;

                $detail = DB::table('detail_transaksi') -> join('jadwal' , 'jadwal.id' , 'detail_transaksi.id_jadwal')
                    ->where('id_transaksi' , $t -> id) -> get();

                    $data_trans[$no]['detail'] = $detail;
                    [$no++];
                }
                return Response()->json($data_trans);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'id_pelanggan'=>'required',
            'id_petugas'=>'required',
            'tgl_transaksi'=>'required',
            'tgl_mulai'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=transaksi_model::where('id',$id)->update([
            'id_pelanggan'=>$req->id_pelanggan,
            'id_petugas'=>$req->id_petugas,
            'tgl_transaksi'=>$req->tgl_transaksi,
            'tgl_mulai'=>$req->tgl_mulai

        ]);
        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    public function destroy($id)
    {
        $hapus=transaksi_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
