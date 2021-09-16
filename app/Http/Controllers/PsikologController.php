<?php

namespace App\Http\Controllers;


use Auth;
use Session;
use App\Models\User;
use App\Models\Tingkat;
use App\Models\Peserta;
use App\Models\Psikolog;
use App\Models\Sekolah;
use App\Models\Trans_peserta_test;
use App\Models\Trans_psikolog_bayar;
use App\Models\Laporan;
use App\Models\Rekomendasi;
use App\Models\Psikogram;
use App\Models\Gaya_belajar;
use App\Models\Level_kecerdasan;
use App\Models\Aspek_psikologis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PsikologController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('psikolog.home', compact('user'));
    }

    public function peserta_test_psi()
    {
        $id = Auth::user()->username;
        $ps = Psikolog::where('user_id', $id)->get();
        foreach ($ps as $key) {
            # code...
        }

        $test = Trans_peserta_test::leftjoin('peserta', 'trans_peserta_test.idpeserta', '=', 'peserta.id_peserta')
                                ->leftjoin('psikolog', 'trans_peserta_test.id_psikolog', '=', 'psikolog.id_psikolog')
                                ->leftjoin('trans_psikolog_bayar', 'trans_peserta_test.id_trans_pesertatest', '=', 'trans_psikolog_bayar.id_transpesertatest')
                                ->leftjoin('sekolah', 'peserta.id_sekolah', '=', 'sekolah.id_sekolah')
                                ->leftjoin('tingkat', 'peserta.id_tingkat', '=', 'tingkat.id_tingkat')
                                ->where('psikolog.id_psikolog', $key->id_psikolog)
                                ->select('trans_peserta_test.idpeserta', 'trans_peserta_test.id_psikolog','tingkat.nama_tingkat', 'sekolah.nama_sekolah', 'trans_peserta_test.id_trans_pesertatest', 'peserta.tgl_test', 'peserta.nama_peserta',  'psikolog.nama_psikolog', 'trans_peserta_test.verifikasi', 'trans_peserta_test.laporan', 'trans_peserta_test.bayaran', 'trans_psikolog_bayar.id_transpesertatest', 'trans_psikolog_bayar.tgl_bayar', 'trans_psikolog_bayar.nominal', 'trans_psikolog_bayar.no_trf')
                                ->get();

        $tes = Peserta::select(DB::raw('DISTINCT(tgl_test)'))->get();
        $sch = Peserta::select(DB::raw('DISTINCT(id_sekolah)'))->get();
        $tkt = Peserta::select(DB::raw('DISTINCT(id_tingkat)'))->get();
        $thn = Peserta::select(DB::raw('DISTINCT(tahun_reg)'))->get();
        $schl = Sekolah::all();
        $tk = Tingkat::all();
        $gy = Gaya_belajar::where('status', 'ACTIVE')->get();
        $lv = Level_kecerdasan::where('status', 'ACTIVE')->get();
        $rk = Rekomendasi::where('status', 'ACTIVE')->get();

        return view('psikolog/peserta/peserta_test_psi', ['rk'=>$rk,'lv'=>$lv,'gy'=>$gy,'tes' => $tes, 'data' => $test, 'sch' => $sch, 'tkt' => $tkt, 'thn' => $thn, 'schl' => $schl, 'tk' => $tk]);
    }

    public function view_peserta_psi(Request $request)
    {

        $psrt = Peserta::where('peserta.id_sekolah', $request->id_sekolah)
                        ->where('peserta.id_tingkat', $request->id_tingkat)
                        ->where('peserta.tahun_reg', $request->tahun_reg)
                        ->where('peserta.tgl_test', $request->tgl_test)
                        ->leftjoin('sekolah', 'peserta.id_sekolah', '=', 'sekolah.id_sekolah')
                        ->leftjoin('tingkat', 'peserta.id_tingkat', '=', 'tingkat.id_tingkat')
                        ->leftjoin('trans_peserta_test', 'peserta.id_peserta', '=', 'trans_peserta_test.idpeserta')
                        ->select('peserta.tgl_test', 'trans_peserta_test.idpeserta', 'peserta.id_peserta', 'peserta.nama_peserta', 'peserta.tmpt_lahir', 'peserta.tgl_lahir', 'sekolah.nama_sekolah', 'peserta.kls_tujuan', 'peserta.nama_ortu', 'peserta.nohp_ortu', 'peserta.email_ortu', 'peserta.kota', 'tingkat.nama_tingkat', 'peserta.tahun_reg', 'peserta.fee')
                        ->orderBy('peserta.id_peserta', 'DESC')
                        ->get();

        $psi = Psikolog::all();

        return view('psikolog/peserta/view_peserta_psi', ['data' => $psrt, 'psi' => $psi]);
    }

    public function save_pestes_psi(Request $request)
    {
        $id = Auth::user()->username;
        $ps = Psikolog::where('user_id', $id)->get();
        foreach ($ps as $key) {
            # code...
        }
        $jml_pes = count($request->id_peserta);
        for ($i = 0; $i < $jml_pes; $i++) {
            $pes = $request->id_peserta[$i];

            $test                 = new Trans_peserta_test;
            $test->idpeserta      = $pes;
            $test->id_psikolog    = $key->id_psikolog;
            $test->created_by       = Auth::user()->name;
            $test->save();
        }
        return redirect('peserta_test_psi');
    }

    public function entryaspek($id)
    {

        $gy = Gaya_belajar::where('status', 'ACTIVE')->get();
        $lv = Level_kecerdasan::where('status', 'ACTIVE')->get();
        $rk = Rekomendasi::where('status', 'ACTIVE')->get();

        $iden = Trans_peserta_test::where('id_trans_pesertatest', $id)->get();
        foreach ($iden as $key) {
            # code...
        }
        $pst = Peserta::where('id_peserta', $key->idpeserta)->get();
        foreach ($pst as $keypst) {
            # code...
        }

        $aspek = Aspek_psikologis::join('tingkat', 'aspek_psikologis.id_tingkat', '=', 'tingkat.id_tingkat')
                                ->join('psikogram', 'aspek_psikologis.id_psikogram', '=', 'psikogram.id_psikogram')
                                ->where('aspek_psikologis.id_tingkat', $keypst->id_tingkat)
                                ->select('aspek_psikologis.id_aspek', 'tingkat.nama_tingkat', 'psikogram.psikogram', 'aspek_psikologis.aspek_psikologis')
                                ->get();
        $peserta = $key->idpeserta;
        $psikolog = $key->id_psikolog;
        $nama = $keypst->nama_peserta;

        return view('psikolog/peserta/entryaspek', ['nama'=>$nama,'rk' => $rk, 'lv' => $lv, 'gy' => $gy, 'psikolog' => $psikolog, 'peserta' => $peserta, 'aspek' => $aspek]);
    }

    public function save_aspek_psikologis(Request $request)
    {
        $idpeserta = $request->id_peserta;
        $idpsikolog = $request->id_psikolog;
        $aspek = $request->id_aspek;
        $nilai = $request->nilai;

        $cek = Laporan::where('id_peserta', $idpeserta)
                        ->where('id_psikolog', $idpsikolog)
                        ->get();
        if (count($cek) > 0) {

            Session::flash('warning', 'Data Peserta Sudah ada!');
        } else {
            $jml = count($nilai);

            for ($i = 0; $i < $jml; $i++) {
                $aspekk = $request->id_aspek[$i];
                $nilaii = $request->nilai[$i];

                $entry              = new Laporan;
                $entry->id_peserta  = $idpeserta;
                $entry->id_psikolog = $idpsikolog;
                $entry->tipe_nilai  = 'aspek_psikologi';
                $entry->id_master   = $aspekk;
                $entry->nilai       = $nilaii;
                $entry->save();
            }

            if ($request->gaya_belajar != null) {
                $gy = new Laporan;
                $gy->id_peserta = $idpeserta;
                $gy->id_psikolog = $request->id_psikolog;
                $gy->id_master = $request->gaya_belajar;
                $gy->tipe_nilai = 'gaya_belajar';
                $gy->save();
            }

            if ($request->level_kecerdasan != null) {
                $gy = new Laporan;
                $gy->id_peserta = $idpeserta;
                $gy->id_psikolog = $request->id_psikolog;
                $gy->id_master = $request->level_kecerdasan;
                $gy->tipe_nilai = 'level_kecerdasan';
                $gy->save();
            }

            if ($request->rekomendasi != null) {
                $gy = new Laporan;
                $gy->id_peserta = $idpeserta;
                $gy->id_psikolog = $request->id_psikolog;
                $gy->id_master = $request->rekomendasi;
                $gy->tipe_nilai = 'rekomendasi';
                $gy->save();
            }

            if ($request->narasi_kesimpulan != null) {
                $gy = new Laporan;
                $gy->id_peserta = $idpeserta;
                $gy->id_psikolog = $request->id_psikolog;
                $gy->nilai = $request->narasi_kesimpulan;
                $gy->tipe_nilai = 'narasi_kesimpulan';
                $gy->save();
            }

            if ($request->narasi_saran != null) {
                $gy = new Laporan;
                $gy->id_peserta = $idpeserta;
                $gy->id_psikolog = $request->id_psikolog;
                $gy->nilai = $request->narasi_saran;
                $gy->tipe_nilai = 'narasi_saran';
                $gy->save();
            }

            $akun = Trans_peserta_test::where('idpeserta', $idpeserta)
                                    ->where('id_psikolog', $idpsikolog)
                                    ->update(['laporan' => 'yes']);

        }

        Session::flash('sukses', 'Data Nilai Sudah disimpan');
        return redirect('peserta_test_psi');
    }

    public function change($id)
  {
    return view ('psikolog/change_pwd_psi', ['adm' => $id]);
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
      Session::flash('salah', 'password lama yang anda ketikan salah !');
      return redirect('home');
    }
  }
}
