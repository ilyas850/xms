<?php

namespace App\Exports;

use App\Models\Jawaban;
use App\Models\Jawaban_peserta;
use App\Models\Soal;
use App\Models\Tipe_test;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HasilJawabanExport implements FromView, ShouldAutoSize
{
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
      return view('admin/hasil/export',[
        'jawab' => Jawaban_peserta::join('tipe_test', 'tb_jawabanpeserta.id_tipetest', '=', 'tipe_test.id_tipetest')
                                ->join('tb_soal', 'tb_jawabanpeserta.id_soal', '=', 'tb_soal.id_soal')
                                ->join('tb_jawaban', 'tb_jawabanpeserta.id_jawaban', '=', 'tb_jawaban.id_jawaban')
                                ->where('tb_jawabanpeserta.id_peserta', $this->id)
                                ->select('tb_soal.soal', 'tb_jawaban.opsi', 'tb_jawaban.jawaban', 'tb_jawaban.b_s', 'tb_jawabanpeserta.id_tipetest', 'tipe_test.tipe_test')
                                ->get()
      ]);
    }
}
