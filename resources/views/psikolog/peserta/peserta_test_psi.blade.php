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
    @if ($warning = Session::get('warning'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $warning }}</strong>
        </div>
    @endif

    @if ($sukses = Session::get('sukses'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $sukses }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Peserta Test</h3>
        </div>

        <div class="card-body">
          <form class="form" role="form" action="{{url('view_peserta_psi')}}" method="POST">
              {{ csrf_field() }}
                <div class="row">
                    <div class="col-3">
                      <label>Sekolah</label>
                        <select class="form-control" name="id_sekolah" required>
                            <option></option>
                            @foreach ($sch as $sch)
                                <option value="{{$sch->id_sekolah}}">
                                    @foreach ($schl as $schll)
                                        @if ($sch->id_sekolah == $schll->id_sekolah)
                                            {{$schll->nama_sekolah}}
                                        @endif
                                    @endforeach
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                      <label>Tingkat</label>
                        <select class="form-control" name="id_tingkat" required>
                            <option></option>
                            @foreach ($tkt as $tkt)
                                <option value="{{$tkt->id_tingkat}}" >
                                    @foreach ($tk as $tktt)
                                        @if ($tkt->id_tingkat == $tktt->id_tingkat)
                                            {{$tktt->nama_tingkat}}
                                        @endif
                                    @endforeach
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                      <label>Tahun</label>
                        <select class="form-control" name="tahun_reg" required>
                            <option></option>
                            @foreach ($thn as $thn)
                                <option value="{{$thn->tahun_reg}}" >{{$thn->tahun_reg}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                      <label>Tanggal tes</label>
                        <select class="form-control" name="tgl_test" required>
                            <option></option>
                            @foreach ($tes as $tes)
                                <option value="{{$tes->tgl_test}}" >{{$tes->tgl_test}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-4">
                      <button type="submit" class="btn btn-info " >Entry peserta by psikolog</button>
                    </div>
                  </div>

            </form>
            <hr>
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th><center>Tanggal Test</center></th>
                        <th><center>Peserta</center></th>
                        <th><center>Sekolah</center></th>
                        <th><center>Tingkat</center></th>
                        <th><center>Psikolog</center></th>
                        <th><center>Verifikasi</center></th>
                        <th><center>Laporan</center></th>
                        <th><center>Bayaran</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->tgl_test}}</td>
                        <td>{{$item->nama_peserta}}</td>
                        <td>{{$item->nama_sekolah}}</td>
                        <td>{{$item->nama_tingkat}}</td>
                        <td>{{$item->nama_psikolog}}</td>
                        <td><center>
                            @if ($item->verifikasi=='no')
                                <center><span class="badge bg-red">Belum</span></center>
                            @elseif($item->verifikasi=='yes')
                                <center><span class="badge bg-blue">Sudah </span></center>
                            @endif</center></td>
                        <td><center>
                            @if ($item->verifikasi=='no')
                                <center><span class="badge bg-red">Belum</span></center>
                            @elseif($item->verifikasi=='yes')
                                @if ($item->laporan==null)
                                <a href="/entryaspek/{{$item->id_trans_pesertatest}}" class="btn btn-success btn-xs"> Entry</a>
                                {{-- <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addpsi">
                                    <i class="fa fa-edit"></i> Entry laporan
                                </button> --}}
                                    {{-- <a href="/entrypsikologis/{{$item->id_trans_pesertatest}}" class="btn btn-success btn-xs"> Entry Psikologis</a> --}}
                                @elseif($item->laporan != null)

                                    <center><span class="badge bg-blue">Sudah </span></center>
                                @endif
                            @endif
                        </center></td>
                        <td><center>
                            @if ($item->bayaran=='no')
                                <center><span class="badge bg-red">Belum</span></center>
                            @elseif($item->bayaran=='yes')
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdatePsikolog{{ $item->id_transpesertatest }}">Sudah</button>
                            @endif
                        </center></td>
                    </tr>
                    <!-- Modal Update Psikolog-->
                        <div class="modal fade" id="modalUpdatePsikolog{{ $item->id_transpesertatest }}" tabindex="-1" aria-labelledby="modalUpdateBarang" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Cek Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <!--FORM UPDATE Psikolog-->
                                        <div class="form-group">
                                            <label>Nama Peserta</label>
                                            <input type="text" class="form-control" value="{{$item->nama_peserta}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit Sekolah</label>
                                            <input type="text" class="form-control" value="{{$item->nama_sekolah}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembayaran</label>
                                            <input type="text" class="form-control" value="{{$item->tgl_bayar}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nominal</label>
                                            <input type="text" class="form-control" value="@currency ($item->nominal)" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>No. Transfer</label>
                                            <input type="number" class="form-control" value="{{$item->no_trf}}" readonly>
                                        </div>

                                    <!--END FORM UPDATE Psikolog-->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- End Modal UPDATE Psikolog-->
                    <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" >
                            <form method="post" action="{{url('entry_laporan')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="idpeserta" value="{{$item->idpeserta}}"/>
                                <input type="hidden" name="id_psikolog" value="{{$item->id_psikolog}}"/>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Pilih Gaya Belajar</label>
                                            <select name="gaya_belajar" class="form-control">
                                                <option>-pilih-</option>
                                                @foreach ($gy as $item)
                                                    <option value="{{$item->id_gaya}}">{{$item->gaya_belajar}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Level Kecerdasan</label>
                                            <select name="level_kecerdasan" class="form-control">
                                                <option>-pilih-</option>
                                                @foreach ($lv as $itemgr)
                                                    <option value="{{$itemgr->id_level}}">{{$itemgr->level_ind}}/{{$itemgr->level_ing}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Rekomendasi</label>
                                            <select name="rekomendasi" class="form-control">
                                                <option>-pilih-</option>
                                                @foreach ($rk as $itemgr)
                                                    <option value="{{$itemgr->id_rekomendasi}}">{{$itemgr->rekomendasi}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="addaspek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" >
                            <form method="post" action="{{url('entry_laporan')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="idpeserta" value="{{$item->idpeserta}}"/>
                                <input type="hidden" name="id_psikolog" value="{{$item->id_psikolog}}"/>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                                    </div>
                                    <div class="modal-body">

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
