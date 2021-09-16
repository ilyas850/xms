<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
  protected $table = 'tb_soal';

  protected $fillable = ['id_soal','id_nomormaster','id_tipetest','id_tingkat','nomor','soal','gambar','status'];

  protected $primaryKey = 'id_soal';
}
