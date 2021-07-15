<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\User;
use App\Models\Peserta;
use App\Models\No_master_soal;
use App\Models\Jawaban;
use App\Models\Jawaban_peserta;
use App\Models\Soal;
use App\Models\Tipe_test;
use App\Models\Peserta_ambil_test;
use App\Models\Rekomendasi;
use App\Models\Psikogram;
use App\Models\Gaya_belajar;
use App\Models\Level_kecerdasan;
use App\Models\Aspek_psikologis;
use App\Models\Pesertatest_record;
use App\Models\Peserta_recordtest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\SessionGuard;

class PesertaController extends Controller
{
  public function index()
  {
      $user = Auth::user();

      return view('peserta.home', compact('user'));
  }

  public function ambil_tes()
  {
    $tes = Auth::user()->username;

    $cek = Peserta::where('iduser', $tes)->get();
    foreach ($cek as $key) {
      // code...
    }

    $idc = $key->id_tingkat;
    $idskl = $key->id_sekolah;

    $list = Pesertatest_record::join('tipe_test', 'testsekolah_record.id_tipetest', '=', 'tipe_test.id_tipetest')
                            ->join('tingkat', 'tipe_test.id_tingkat', '=', 'tingkat.id_tingkat')
                            ->leftjoin('peserta_recordtest', 'testsekolah_record.id_tipetest', '=', 'peserta_recordtest.id_tipetest')
                            ->where('testsekolah_record.id_sekolah', $idskl)
                            ->select('peserta_recordtest.status','tipe_test.id_tipetest','tipe_test.tipe_test', 'tingkat.nama_tingkat', 'tipe_test.setup_timer', 'tipe_test.menit')
                            ->get();

    return view ('peserta/tes/ambil_tes', compact('list'));
  }

  public function ambil_tes_1()
  {
    $time = date('Y-m-d H:i:s');

    $usernm = $request->username;
    $idp = Peserta::where('iduser', $usernm)->get();
    foreach ($idp as $key) {
      // code...
    }
    $ids = $key->id_peserta;

    $cek = Peserta_ambil_test::where('id_peserta', $ids)->get();
    $ceks = count($cek);

    if ((($ceks) == 0)) {
      $pst                    = new Peserta_ambil_test;
      $pst->id_peserta        = $ids;
      $pst->status_peserta    = 'login';
      $pst->waktu             = $time;
      $pst->created_by        = Auth::user()->name;
      $pst->save();


    }else {


    }
  }

  public function mulai_tes($id)
  {
    $ceksoal = Soal::where('id_tipetest', $id)
                  ->where('status', 'ACTIVE')
                  ->get();
    if (count($ceksoal) > 0) {
      $tes = Auth::user()->username;

      $cek = Peserta::where('iduser', $tes)->get();
      foreach ($cek as $key) {
        // code...
      }

      $idc = $key->id_tingkat;
      $idskl = $key->id_sekolah;
      $idpeserta = $key->id_peserta;



      $tipe = Tipe_test::where('id_tipetest', $id)->get();

      foreach ($tipe as $keyt) {
        // code...
      }

      $tes = $keyt->tipe_test;
      $time = $keyt->menit;
      $idtes = $keyt->id_tipetest;

      $soal = Soal::where('id_tipetest', $id)
                  ->where('status', 'ACTIVE')
                  ->get();

      $jwban = Jawaban::where('status', 'ACTIVE')->get();
      foreach ($jwban as $jawab) {
        // code...
      }

      $cekrecord = Peserta_recordtest::where('id_peserta', $idpeserta)
                                    ->where('id_tipetest', $id)
                                    ->get();

      if (count($cekrecord) > 0) {

        return view ('peserta/tes/mulai_tes', compact('idtes','soal', 'tes', 'jawab', 'jwban', 'idpeserta', 'time'));
      }else {

        $ts = new Peserta_recordtest;
        $ts->id_peserta = $idpeserta;
        $ts->id_tipetest = $idtes;
        $ts->status = 'Onprogress';
        $ts->created_by = Auth::user()->name;
        $ts->save();

        return view ('peserta/tes/mulai_tes', compact('idtes','soal', 'tes', 'jawab', 'jwban', 'idpeserta', 'time'));
      }
    }else {

      Session::flash('hapus', 'soal belum ada');
      return redirect('ambil_tes');
    }


  }

  public function simpan_jawaban(Request $request)
  {
    $idpeserta = $request->id_peserta;
    $idnomor = $request->id_nomormaster;
    $idtes = $request->id_tipetest;
    $idjawab = $request->id_jawaban;
    $jml_jawab = count($idjawab);

    $fruits = collect($idjawab);
    $keys = $fruits->keys();

    for ($i=0; $i < $jml_jawab; $i++) {

      $pay = $keys[$i];

      $jwb = $idjawab[$pay];

      $idr = explode(',',$jwb, 4 );

      $jawaban_id = $idr[0];
      $soal_id = $idr[1];
      $opsi = $idr[2];
      $bs = $idr[3];

      $sl = new Jawaban_peserta;
      $sl->id_peserta    = $idpeserta;
      $sl->id_nomormaster   = $idnomor;
      $sl->id_soal          = $soal_id;
      $sl->id_tipetest  = $idtes;
      $sl->id_jawaban   = $jawaban_id;
      $sl->jawaban_peserta  = $opsi;
      $sl->ket_bs = $bs;
      $sl->created_by = Auth::user()->name;
      $sl->save();

    }

    $upd = Peserta_recordtest::where('id_peserta', $idpeserta)
                            ->where('id_tipetest', $idtes)
                            ->update(['status'=>'Selesai']);

    Session::flash('sukses', 'Jawaban Berhasil Disimpan!');
    return redirect('ambil_tes');
  }

  public function late($id)
  {
    $tes = Auth::user()->username;

    $cek = Peserta::where('iduser', $tes)->get();
    foreach ($cek as $key) {
      // code...
    }

    $idpeserta = $key->id_peserta;

    $upd = Peserta_recordtest::where('id_peserta', $idpeserta)
                            ->where('id_tipetest', $id)
                            ->update(['status'=>'Gagal']);

    Session::flash('hapus', 'Waktu ujian habis, silahkan ulangi ujian');
    return redirect('ambil_tes');
  }

  public function change($id)
  {
    return view ('peserta/change_pwd_psrt', ['adm' => $id]);
  }

  public function store_new_pass(Request $request, $id)
  {
    $this->validate($request, [
      'oldpassword' => 'required',
      'password' => 'required|min:7|confirmed',
    ]);

    $sandi = bcrypt($request->password);
    $user = User::find($id);
    $pass = password_verify($request->oldpassword, $user->password);

    if ($pass) {
      $user->password = $sandi;
      $user->save();

      Session::flash('sukses', 'Password Berhasil Diubah!');
      return redirect('home');
    }
    else
    {
      Session::flash('hapus', 'password lama yang anda ketikan salah !');
      return redirect('home');
    }
  }
}
