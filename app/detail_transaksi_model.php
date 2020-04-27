<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_transaksi_model extends Model
{
  protected $table="detail_transaksi";
protected $primaryKey="id";
public $timestamps= false;
protected $fillable = [
  'id_transaksi' , 'id_jadwal', 'subtotal'
];

public function jenis_cuci_model(){
      return $this->belongsTo('App\jadwal_model', 'id_jadwal');
  }
  public function transaksi_model(){
      return $this->belongsTo('App\transaksi_model', 'id_transaksi');

  }
}
