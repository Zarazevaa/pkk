<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelatih_model extends Model
{
  protected $table="pelatih";
  protected $primaryKey="id";
  public $timestamps= false;
  protected $fillable = [
    'nama_pelatih', 'telp', 'no_ktp', 'alamat', 'mobil'
  ];
}
