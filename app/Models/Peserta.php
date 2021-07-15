<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';

    protected $primaryKey = 'id_peserta';

    protected $fillable = ['tgl_test','fee','tahun_reg','id_peserta', 'id_tingkat' ,'email_ortu', 'nama_peserta', 'tmpt_lahir', 'tgl_lahir', 'id_sekolah', 'kls_tujuan', 'nama_ortu', 'nohp_ortu', 'kota'];
}
