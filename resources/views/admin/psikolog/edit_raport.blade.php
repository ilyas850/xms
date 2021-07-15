@extends('layouts.master')

@section('navbar')

  @include('layouts.navbar')

@endsection

@section('sidebar')

  @include('layouts.sidebar')

@endsection

@section('content-wrapper')

  @include('layouts.content-wrapper')

@endsection

@section('content')
<section class="content">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Nilai Peserta Test (Aspek Psikologis)</h3>
        </div>
        <form action="{{url('post_aspek_psikologis')}}" method="post">
            {{ csrf_field() }}
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th width="3%"><center>No</center></th>
                            <th><center>Tingkat</center></th>
                            <th><center>Psikogram</center></th>
                            <th><center>Aspek Psikologis</center></th>
                            <th><center>Nilai</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($lap as $item)
                        <tr>
                            @if ($item->tipe_nilai == 'aspek_psikologi')
                            <td><center>{{$no++}}</center></td>
                            <td><center>{{$item->nama_tingkat}}</center></td>
                            <td><center>{{$item->psikogram}}</center></td>
                            <td><center>{{$item->aspek_psikologis}}</center></td>
                            <td><center>
                                {{-- <input type="hidden" name="id_peserta" value="{{$peserta}}">
                                <input type="hidden" name="id_psikolog" value="{{$psikolog}}">
                                <input type="hidden" name="id_aspek[]" value="{{$item->id_aspek}}"> --}}
                                <input type="hidden" name="id_laporan[]" value="{{$item->id_laporan}}">
                                <select name="nilai[]" class="form-control" required>
                                    <option value="{{$item->nilai}}">{{$item->nilai}}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </center></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Gaya Belajar</label>
                        <input type="hidden" name="id_laporan_gaya" value="{{$rap->id_laporan}}">
                        <select name="gaya_belajar" class="form-control" required>
                            <option value="{{$rap->id_master}}">{{$rap->gaya_belajar}}</option>
                            @foreach ($gy as $item)
                                <option value="{{$item->id_gaya}}">{{$item->gaya_belajar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    {{-- @if ($levell->tipe_nilai == 'level_kecerdasan') --}}
                    <div class="form-group">
                        <label>Pilih Level Kecerdasan</label>
                        <input type="hidden" name="id_laporan_level" value="{{$levell->id_laporan}}">
                        <select name="level_kecerdasan" class="form-control" required>
                            <option value="{{$levell->id_master}}">{{$levell->level_ind}}/{{$levell->level_ing}}</option>
                            @foreach ($lv as $itemgr)
                                <option value="{{$itemgr->id_level}}">{{$itemgr->level_ind}}/{{$itemgr->level_ing}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- @endif --}}
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Pilih Rekomendasi</label>
                        <input type="hidden" name="id_laporan_reko"value="{{$rekome->id_laporan}}">
                        <select name="rekomendasi" class="form-control" required>
                            <option value="{{$rekome->id_master}}">{{$rekome->rekomendasi}}</option>
                            @foreach ($rk as $itemgr)
                                <option value="{{$itemgr->id_rekomendasi}}">{{$itemgr->rekomendasi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Kesimpulan</label>
                        <input type="hidden" name="id_laporan_kes"value="{{$sar->id_laporan}}">
                        <textarea type="text" class="form-control" name="narasi_kesimpulan" >{{$sar->nilai}}</textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Saran</label>
                        <input type="hidden" name="id_laporan_sar"value="{{$saran->id_laporan}}">
                        <textarea type="text" class="form-control" name="narasi_saran" >{{$saran->nilai}}</textarea>
                    </div>
                </div>
              </div>
              <button type="submit" class="btn btn-info btn-block">
                  Simpan
              </button>
            </div>
        </form>
    </div>
</section>
@endsection
