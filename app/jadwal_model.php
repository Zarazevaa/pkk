<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jadwal_model extends Model
{
  protected $table="jadwal";
  protected $primaryKey="id";
  public $timestamps= false;
  protected $fillable = [
    'hari_1', 'hari_2', 'hari_3', 'tarif', 'pukul'
  ];
}
