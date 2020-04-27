<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class petugas_model extends Model
{
  protected $table="petugas";
  protected $primaryKey="id";
  public $timestamps= false;
  protected $fillable = [
    'nama_petugas', 'telp', 'username', 'password', 'level'
  ];
}
