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
    {{-- notifikasi sukses --}}
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
        @if ($errors->has('tgl_test'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tgl_test') }}</strong>
                </span>
            </div>
        @endif

        @if ($errors->has('id_peserta'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('id_peserta') }}</strong>
                </span>
            </div>
        @endif

        @if ($errors->has('id_psikolog'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('id_psikolog') }}</strong>
                </span>
            </div>
        @endif


        <div class="card-body">
          <form class="form" role="form" action="{{url('view_peserta')}}" method="POST">
            {{ csrf_field() }}
                  <div class="row">
                      <div class="col-3">
                          <select class="form-control" name="id_sekolah">
                              <option>-pilih sekolah-</option>
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
                      <div class="col-2">
                          <select class="form-control" name="id_tingkat">
                              <option>-pilih tingkat-</option>
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
                      <div class="col-2">
                          <select class="form-control" name="tahun_reg">
                              <option>-pilih tahun-</option>
                              @foreach ($thn as $thn)
                                  <option value="{{$thn->tahun_reg}}" >{{$thn->tahun_reg}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-2">
                          <select class="form-control" name="tgl_test">
                              <option>-pilih tanggal tes-</option>
                              @foreach ($tes as $tes)
                                  <option value="{{$tes->tgl_test}}" >{{$tes->tgl_test}}</option>
                              @endforeach
                          </select>
                      </div>
                      <button type="submit" class="btn btn-info " >Entry psikolog by Admin</button>
                  </div>
            </form>
            <hr>

            <a href="{{url('verifikasi_all')}}" class="btn btn-info btn-sm"><i class="fa fa-check"></i> Verifikasi</a>
            {{-- <a href="{{url('addpayment_all')}}" class="btn btn-success btn-sm"><i class="fa fa-money"></i> Input Payment by Admin</a> --}}
            <a href="{{url('input_payment')}}" class="btn btn-success btn-sm"><i class="fa fa-money"></i> Input Payment</a>
            <hr>
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th><center>Tanggal Test</center></th>
                        <th><center>Nama Peserta</center></th>
                        <th><center>Unit Sekolah</center></th>
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
                        <td><center>{{$item->tgl_test}}</center></td>
                        <td>{{$item->nama_peserta}}</td>
                        <td>{{$item->nama_sekolah}}</td>
                        <td><center>{{$item->nama_tingkat}}</center></td>
                        <td>{{$item->nama_psikolog}}</td>
                        <td><center>
                          @if ($item->verifikasi=='no')
                            <form action="{{url('save_ver')}}" method="post">
                                <input type="hidden" name="id_trans_pesertatest" value="{{$item->id_trans_pesertatest}}">
                                <input type="hidden" name="verifikasi" value="yes">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="right">Verifikasi</button>
                            </form>
                          @elseif($item->verifikasi=='yes')
                            <form action="{{url('save_ver')}}" method="post">
                                <input type="hidden" name="id_trans_pesertatest" value="{{$item->id_trans_pesertatest}}">
                                <input type="hidden" name="verifikasi" value="no">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right">Cancel</button>
                            </form>
                          @endif</center></td>
                        <td><center>
                          @if ($item->verifikasi=='no')

                            @else
                              @if ($item->laporan==null)
                                  <center><span class="badge bg-red">Belum</span></center>
                              @elseif($item->laporan == 'yes')
                                  <form action="{{url('edit_report')}}" method="post">
                                      <input type="hidden" name="id_peserta" value="{{$item->id_peserta}}">
                                      <input type="hidden" name="id_psikolog" value="{{$item->id_psikolog}}">
                                      {{ csrf_field() }}
                                      <button type="submit" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="right">Sudah</button>
                                  </form>
                                @endif
                          @endif
                            </center></td>
                        <td><center>
                          @if ($item->verifikasi=='no')

                            @else
                              @if($item->laporan == 'yes')
                                  @if ($item->id_transpesertatest == null)
                                      <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addpym{{$item->id_trans_pesertatest}}">
                                          <i class="fa fa-money"></i> Input
                                      </button>
                                  @elseif($item->id_transpesertatest != null)
                                      @if ($item->bayaran=='no')
                                          <center><span class="badge bg-red">Belum</span></center>
                                      @elseif($item->bayaran=='yes')
                                          <center><span class="badge bg-blue">Sudah</span></center>
                                      @endif
                                  @endif
                                @else

                              @endif

                            @endif
                        </center></td>
                    </tr>
                    <!-- Modal Add Payment-->
                        <div class="modal fade" id="addpym{{ $item->id_trans_pesertatest }}" tabindex="-1" aria-labelledby="addpym" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Payment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <!--FORM  Add Payment-->
                                    <form action="{{url('save_pay')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="id_transpesertatest" value="{{ $item->id_trans_pesertatest }}">
                                        <div class="form-group">
                                            <label>Tanggal Bayar</label>
                                            <input type="date" class="form-control" name="tgl_bayar" placeholder="Masukan Tanggal Bayar">
                                        </div>
                                        <div class="form-group">
                                            <label>Nominal</label>
                                            <input type="number" class="form-control" name="nominal" placeholder="Masukan Nominal">
                                        </div>
                                        <div class="form-group">
                                            <label>No. Transfer</label>
                                            <input type="number" class="form-control" name="no_trf" placeholder="Masukan Nomor Transfer">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    </form>
                                    <!--END FORM  Add Payment-->
                                </div>
                            </div>
                        </div>
                        <!-- End Modal  Add Payment-->
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
