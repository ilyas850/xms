<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PsikologController;
use App\Http\Controllers\PesertaController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dash');
});

Route::get('login_xms', [AdminController::class, 'login']);

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index']);

        //master sekolah
        Route::get('data_sekolah', [AdminController::class, 'data_sekolah']);
        Route::post('post_sch', [AdminController::class, 'post_sch']);
        Route::get('editsch/{id}', [AdminController::class, 'editsch']);
        Route::put('/savesch/{id}', [AdminController::class, 'updatesch']);
        //Route::delete('/hapussch/{id}', [AdminController::class, 'destroysch']);
        Route::post('hapussch', [AdminController::class, 'destroysch']);
        Route::post('aktifsch', [AdminController::class, 'aktifsch']);

        //master tingkat
        Route::get('data_tingkat', [AdminController::class, 'data_tingkat']);
        Route::post('post_tk', [AdminController::class, 'post_tk']);
        Route::delete('/hapustk/{id}', [AdminController::class, 'destroytk']);
        Route::put('/savetk/{id}', [AdminController::class, 'updatetk']);

        //master peserta
        Route::get('data_peserta', [AdminController::class, 'data_peserta']);
        Route::post('peserta/import_excel', [AdminController::class, 'import_excel']);
        Route::post('view_data', [AdminController::class, 'view_data']);

        //tagihan peserta
        Route::get('peserta_sekolah', [AdminController::class, 'peserta_sekolah']);
        Route::post('pilih_tgl_test', [AdminController::class, 'pilih_tgl_test_pay']);
        Route::post('save_invoice', [AdminController::class, 'save_invoice']);

        //master psikolog
        Route::get('data_psikolog', [AdminController::class, 'data_psikolog']);
        Route::post('post_psi', [AdminController::class, 'post_psi']);

        //peserta test
        Route::get('peserta_test', [AdminController::class, 'peserta_test']);
        Route::post('view_peserta', [AdminController::class, 'view_peserta']);
        Route::post('save_pestes', [AdminController::class, 'save_pestes']);
        Route::get('verifikasi_all', [AdminController::class, 'verifikasi_all']);
        Route::post('save_verifikasi', [AdminController::class, 'save_verifikasi']);
        Route::post('save_ver', [AdminController::class, 'save_ver']);
        Route::get('input_payment', [AdminController::class, 'input_payment']);
        Route::post('view_payment', [AdminController::class, 'view_payment']);
        Route::post('calculate_payment', [AdminController::class, 'calculate_payment']);

        //master user
        Route::get('user', [AdminController::class, 'datauser']);
        Route::post('generate', [AdminController::class, 'generate']);
        Route::post('resetuser', [AdminController::class, 'resetuser']);
        Route::delete('hapususer/{id}', [AdminController::class, 'hapususer']);
        Route::get('user_peserta', [AdminController::class, 'user_peserta']);
        Route::post('generate_peserta', [AdminController::class, 'generate_peserta']);
        Route::post('resetuser_peserta', [AdminController::class, 'resetuser_peserta']);
        Route::delete('hapususer_peserta/{id}', [AdminController::class, 'hapususer_peserta']);

        //parameter laporan
        Route::get('level_kcd', [AdminController::class, 'level_kcd']);
        Route::post('post_lvl', [AdminController::class, 'post_lvl']);
        Route::post('hapuslvl', [AdminController::class, 'destroylvl']);
        Route::put('/savelvl/{id}', [AdminController::class, 'updatelvl']);
        Route::get('gaya_belajar', [AdminController::class, 'gaya_belajar']);
        Route::post('post_gy', [AdminController::class, 'post_gy']);
        Route::post('hapusgy', [AdminController::class, 'destroygy']);
        Route::put('/savegy/{id}', [AdminController::class, 'updategy']);
        Route::get('rekomendasi', [AdminController::class, 'rekomendasi']);
        Route::post('post_rkm', [AdminController::class, 'post_rkm']);
        Route::post('hapusrkm', [AdminController::class, 'destroyrkm']);
        Route::put('/saverkm/{id}', [AdminController::class, 'updaterkm']);
        Route::get('psikogram', [AdminController::class, 'psikogram']);
        Route::post('post_psgrm', [AdminController::class, 'post_psgrm']);
        Route::post('hapuspsgrm', [AdminController::class, 'destroypsgrm']);
        Route::put('/savepsikogram/{id}', [AdminController::class, 'updatepsigrm']);
        Route::get('aspek_psikologis', [AdminController::class, 'psikologis']);
        Route::post('post_psiko', [AdminController::class, 'post_psiko']);
        Route::post('hapuspsiko', [AdminController::class, 'destroypsiko']);
        Route::put('/savepsiko/{id}', [AdminController::class, 'updatepsikologis']);
        Route::post('edit_report', [AdminController::class, 'edit_report']); //edit laporan
        Route::post('post_aspek_psikologis', [AdminController::class, 'post_aspek_psikologis']); //save edit laporan
        Route::post('save_pay', [AdminController::class, 'save_pay']); //save payment satu persatu

        //ubah password
        Route::get('change_pass_adm/{id}', [AdminController::class, 'change']);
        Route::put('pwd_adm/{id}', [AdminController::class, 'store_new_pass']);

        //master soal
        Route::get('no_master_soal', [AdminController::class, 'no_master_soal']);
        Route::post('post_nmr', [AdminController::class, 'post_nmr']);
        Route::put('savenmr/{id}', [AdminController::class, 'updatenmr']);
        Route::post('hapusnmr', [AdminController::class, 'destroynmr']);
        Route::post('aktifnmr', [AdminController::class, 'aktifnmr']);

        Route::get('tipe_test', [AdminController::class, 'tipe_test']);
        Route::post('post_tipetest', [AdminController::class, 'post_tipetest']);
        Route::put('savetipetest/{id}', [AdminController::class, 'updatetipetest']);
        Route::post('hapustipetest', [AdminController::class, 'destroytipetest']);

        Route::get('soal', [AdminController::class, 'soal']);
        Route::post('post_soal', [AdminController::class, 'post_soal']);
        Route::put('savesoal/{id}', [AdminController::class, 'updatesoal']);
        Route::post('hapussoal', [AdminController::class, 'destroysoal']);

        //input jawaban
        Route::post('savejwb', [AdminController::class, 'savejwb']);

        Route::get('jawaban', [AdminController::class, 'jawaban']);
        Route::post('pilih_master', [AdminController::class, 'pilih_master']);
        Route::post('post_jawaban', [AdminController::class, 'post_jawaban']);
        Route::put('savejawaban/{id}', [AdminController::class, 'updatejawaban']);
        Route::post('hapusjawaban', [AdminController::class, 'destroyjawaban']);
        Route::post('save_jawaban', [AdminController::class, 'save_jawaban']);

        //jawaban bergambar
        Route::get('jawab_gambar', [AdminController::class, 'jawaban_gambar']);
        Route::post('pilih_master_gambar', [AdminController::class, 'pilih_master_gambar']);
        Route::post('save_jawaban_gambar', [AdminController::class, 'save_jawaban_gambar']);

        //tentukan test peserta
        Route::get('select_test', [AdminController::class, 'select_test']);
        Route::post('add_select', [AdminController::class, 'add_select']);
        Route::post('simpan_peserta', [AdminController::class, 'save_selected']);
        Route::post('hapustestrecord', [AdminController::class, 'destroytestrecord']);

        //hasil test peserta
        Route::get('result_test', [AdminController::class, 'result_test']);
        Route::get('cek_ujian/{id}', [AdminController::class, 'cek_ujian']);
        Route::get('exporthasiljawaban/{id}', [AdminController::class, 'exporthasiljawaban']);
    });

    Route::middleware(['psikolog'])->group(function () {
        Route::get('psikolog', [PsikologController::class, 'index']);

        //peserta test
        Route::get('peserta_test_psi', [PsikologController::class, 'peserta_test_psi']);
        Route::post('view_peserta_psi', [PsikologController::class, 'view_peserta_psi']);
        Route::post('save_pestes_psi', [PsikologController::class, 'save_pestes_psi']);

        //entri laporan
        Route::get('entryaspek/{id}', [PsikologController::class, 'entryaspek']);

        Route::post('entry_laporan', [PsikologController::class, 'entrylaporan']);
        Route::get('entrypsikologis/{id}', [PsikologController::class, 'entrypsikologis']);
        Route::post('save_aspek_psiko', [PsikologController::class, 'save_aspek_psiko']);

        Route::post('save_aspek_psikologis', [PsikologController::class, 'save_aspek_psikologis']);
        Route::get('change_pass_psi/{id}', [PsikologController::class, 'change']);
        Route::put('pwd_psi/{id}', [PsikologController::class, 'store_new_pass']);
    });

    Route::middleware(['peserta'])->group(function () {
        Route::get('peserta', [PesertaController::class, 'index']);

        //ambil tes
        Route::get('ambil_tes', [PesertaController::class, 'ambil_tes']);
        Route::get('mulai_tes/{id}', [PesertaController::class, 'mulai_tes']);
        Route::post('simpan_jawaban', [PesertaController::class, 'simpan_jawaban']);
        Route::get('late/{id}', [PesertaController::class, 'late']);

        //ubah password
        Route::get('change_pass_psrt/{id}', [PesertaController::class, 'change']);
        Route::put('pwd_psrt/{id}', [PsikologController::class, 'store_new_pass']);
    });

    Route::get('/logout', function() {
        Auth::logout();
        redirect('/home');
    });

    //test

});
