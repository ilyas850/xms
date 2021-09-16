<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PesertaImporttes implements WithHeadingRow, ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct($sch, $thn, $tk, $fee, $tes)
    {
        $this->id_sekolah = $sch;

        $this->tahun_reg = $thn;

        $this->id_tingkat = $tk;

        $this->fee = $fee;

        $this->tgl_test = $tes;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
          $nm = substr($row['nama_peserta'],0,2);
          $nm_new = strtoupper($nm);
          $tanggal = date('y');

          $kd="";
          $query = DB::table('peserta')
                      ->select(DB::raw('MAX(RIGHT(iduser,3)) as kd_max'));
          if ($query->count()>0) {
            foreach ($query->get() as $key ) {
              $tmp = ((int)$key->kd_max)+1;
              $kd = sprintf("%03s", $tmp);
            }
          }else {
            $kd = "001";
          }

          $kode = 'XMS'.$nm_new.$tanggal.$kd;

          Peserta::create([
            'email_ortu'        => $row['email'],
            'nama_peserta'      => $row['nama_peserta'],
            'tmpt_lahir'        => $row['tempat_lahir'],
            'tgl_lahir'         => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d'),
            'id_sekolah'        => $this->id_sekolah,
            'kls_tujuan'        => $row['kelas_tujuan'],
            'nama_ortu'         => $row['nama_orang_tua'],
            'nohp_ortu'         => $row['no_hp_orang_tua'],
            'kota'              => $row['kota'],
            'tahun_reg'         => $this->tahun_reg,
            'id_tingkat'        => $this->id_tingkat,
            'fee'               => $this->fee,
            'tgl_test'          => $this->tgl_test,
            'iduser'            => $kode,
          ]);

          User::create([
              'name'      => $row['nama_peserta'],
              'username'  => $kode,
              'role'      => 3,
              'password'  => bcrypt($kode),
          ]);
        }
    }

}
