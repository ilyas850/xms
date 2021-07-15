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

        @if ($hapus = Session::get('hapus'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $hapus }}</strong>
            </div>
        @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Nomor Master Soal</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#addpsi">
                        <i class="fa fa-plus"></i> Input Nomor Master Soal
                    </button>
                </div>
            </div>
            <hr>
            <!-- Add Data Gaya Belajar -->
            <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <form method="post" action="{{url('post_nmr')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nomor Master Soal</label>
                                    <input type="text" class="form-control" name="nomor_master_soal" placeholder="Masukan Nomor Master Soal">
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
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="3%"><center>No</center></th>
                        <th><center>Nomor Master Soal</center></th>
                        <th><center>Status</center></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($nmr as $item)
                    <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$item->nomor_master_soal}}</td>
                        <td><center>{{$item->status}}</center></td>
                        <td><center>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateGaya{{ $item->id_nomormaster }}">Update</button>
                            @if ($item->status == 'ACTIVE')
                              <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusGaya{{ $item->id_nomormaster }}">Non Aktifkan</button>
                            @elseif ($item->status == 'NOT ACTIVE')
                              <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAktifGaya{{ $item->id_nomormaster }}">Aktifkan</button>
                            @endif

                        </center></td>
                    </tr>

                    <div class="modal fade" id="modalHapusGaya{{ $item->id_nomormaster }}" tabindex="-1" aria-labelledby="modalHapusGaya" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="text-center">Apakah anda yakin nonaktifkan data nomor master soal ini ?</h4>
                            </div>
                            <div class="modal-footer">
                                <form action="{{url('hapusnmr')}}" method="post">
                                     {{ csrf_field() }}
                                    <input type="hidden" name="id_nomormaster" value="{{$item->id_nomormaster}}"/>
                                    <button type="submit" class="btn btn-primary">Nonaktifkan data!</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalAktifGaya{{ $item->id_nomormaster }}" tabindex="-1" aria-labelledby="modalHapusGaya" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="text-center">Apakah anda yakin mengaktifkan data nomor master soal ini ?</h4>
                            </div>
                            <div class="modal-footer">
                                <form action="{{url('aktifnmr')}}" method="post">
                                     {{ csrf_field() }}
                                    <input type="hidden" name="id_nomormaster" value="{{$item->id_nomormaster}}"/>
                                    <button type="submit" class="btn btn-primary">Aktifkan data!</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Update Gaya Belajar-->
                        <div class="modal fade" id="modalUpdateGaya{{ $item->id_nomormaster }}" tabindex="-1" aria-labelledby="modalUpdateGaya" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Nomor Master Soal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <!--FORM UPDATE Gaya Belajar-->
                                    <form action="/savenmr/{{ $item->id_nomormaster }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label>Nomor Master Soal</label>
                                            <input type="text" class="form-control" name="nomor_master_soal" value="{{$item->nomor_master_soal}}">
                                        </div>
                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                    </form>
                                    <!--END FORM UPDATE Gaya Belajar-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal UPDATE Gaya Belajar-->
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
