<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PesertaImport implements ToModel, WithHeadingRow
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

    public function model(array $row)
    {
        return new Peserta([
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
        ]);
    }
}
