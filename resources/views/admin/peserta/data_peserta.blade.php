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
    {{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
		@endif

		{{-- notifikasi sukses --}}
		@if ($sukses = Session::get('sukses'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $sukses }}</strong>
            </div>
        @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Peserta</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importExcel">
                        <i class="fa fa-file-excel"></i> Import Data Peserta
                    </button>
                </div>
            </div>
            <hr>
            <form class="form" role="form" action="{{url('view_data')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-3">
                        <select class="form-control" name="id_sekolah">
                            <option>-pilih sekolah-</option>
                            @foreach ($sch as $sch)
                                <option value="{{$sch->id_sekolah}}">{{$sch->nama_sekolah}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-control" name="id_tingkat">
                            <option>-pilih tingkat-</option>
                            @foreach ($tkt as $tkt)
                                <option value="{{$tkt->id_tingkat}}" >{{$tkt->nama_tingkat}}
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
                    <button type="submit" class="btn btn-info " >Lihat Data</button>
                </div>
            </form>

            <!-- Import Excel -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="{{url('peserta/import_excel')}}" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            </div>
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Pilih Sekolah</label>
                                    <select name="id_sekolah" class="form-control">
                                        <option>-pilih sekolah-</option>
                                        @foreach ($schl as $item)
                                            <option value="{{$item->id_sekolah}}">{{$item->nama_sekolah}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Tingkat</label>
                                    <select name="id_tingkat" class="form-control">
                                        <option>-pilih tingkat-</option>
                                        @foreach ($tk as $item)
                                            <option value="{{$item->id_tingkat}}">{{$item->nama_tingkat}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Tahun</label>
                                    <select name="tahun_reg" class="form-control">
                                        <option value="{{$thnnow}}">{{$thnnow}}</option>
                                        <option value="{{$thnmin}}">{{$thnmin}}</option>
                                        <option value="{{$thnmax}}">{{$thnmax}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Fee</label>
                                    <input type="number" class="form-control" name="fee" placeholder="Masukan Fee">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal tes</label>
                                    {{-- <input type="date" class="form-control" name="tgl_test" > --}}
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="tgl_test" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>File excel</label>
                                    <input type="file" name="file" required="required">
                                    <p class="help-block">Format dengan .xls .xlsx </p>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <hr>
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th><center>Nama Peserta</center></th>
                        <th><center>Tanggal Test</center></th>
                        <th><center>Unit Sekolah</center></th>
                        <th><center>Kelas Yang Dituju</center></th>
                        <th><center>Tingkat</center></th>
                        <th><center>Tahun Daftar</center></th>
                        <th><center>Nama Ortu</center></th>
                        <th><center>No. Telp Ortu</center></th>
                        <th><center>Email Ortu</center></th>
                        <th><center>Fee</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $item)
                    <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$item->nama_peserta}}</td>
                        <td>{{$item->tgl_test}}</td>
                        <td><center>{{$item->nama_sekolah}}</center></td>
                        <td><center>{{$item->kls_tujuan}}</center></td>
                        <td><center>{{$item->nama_tingkat}}</center></td>
                        <td><center>{{$item->tahun_reg}}</center></td>
                        <td>{{$item->nama_ortu}}</td>
                        <td><center>{{$item->nohp_ortu}}</center></td>
                        <td><center>{{$item->email_ortu}}</center></td>
                        <td><center>@currency ($item->fee)</center></td>

                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
