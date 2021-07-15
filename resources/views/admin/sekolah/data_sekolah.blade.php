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
        @if ($errors->has('Nama'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nama_sekolah') }}</strong>
                </span>
            </div>
        @endif

        @if ($errors->has('No Telepon'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('notelp_sekolah') }}</strong>
                </span>
            </div>
        @endif

        @if ($errors->has('PIC'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('pic_sekolah') }}</strong>
                </span>
            </div>
        @endif

        @if ($errors->has('alamat'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('alamat_sekolah') }}</strong>
                </span>
            </div>
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
                <h3 class="card-title">Data Sekolah</h3>
            </div>

        <div class="card-body">
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addsch">
                        <i class="fa fa-plus"></i> Input Data Sekolah
                    </button>
                </div>
            </div>
            <br>

            <!-- Add Data Sekolah -->
            <div class="modal fade" id="addsch">
                <div class="modal-dialog">
                    <form method="post" action="{{url('post_sch')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Add Sekolah</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Sekolah</label>
                                    <input type="text" class="form-control" name="nama_sekolah" placeholder="Masukan Nama Sekolah" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" class="form-control"  name="alamat_sekolah" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>PIC Sekolah</label>
                                    <input type="text" class="form-control" name="pic_sekolah" placeholder="Masukan Nama PIC" required>
                                </div>
                                <div class="form-group">
                                    <label>No. Telepon</label>
                                    <input type="number" class="form-control" name="notelp_sekolah" placeholder="Masukan No. Telepon" required>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th><center>Nama Sekolah</center></th>
                        <th><center>Alamat</center></th>
                        <th><center>PIC</center></th>
                        <th><center>No. Telp</center></th>
                        <th><center>Status</center></th>
                        <th><center></center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach ($sch as $item)
                        <tr>
                            <td><center>{{$no++}}</center></td>
                            <td><center>{{$item->nama_sekolah}}</center></td>
                            <td><center>{{$item->alamat_sekolah}}</center></td>
                            <td><center>{{$item->pic_sekolah}}</center></td>
                            <td><center>{{$item->notelp_sekolah}}</center></td>
                            <td><center>{{$item->status}}</center></td>
                            <td><center>
                                
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateBarang{{ $item->id_sekolah }}">Update</button>
                                @if ($item->status == 'ACTIVE')
                                  <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusBarang{{ $item->id_sekolah }}">Non Aktifkan</button>
                                @else
                                  <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAktifBarang{{ $item->id_sekolah }}">Aktifkan</button>
                                @endif
                            </center></td>
                        </tr>

                        <div class="modal fade" id="modalHapusBarang{{ $item->id_sekolah }}" tabindex="-1" aria-labelledby="modalHapusGaya" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <h4 class="text-center">Apakah anda yakin nonaktifkan sekolah soal ini ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{url('hapussch')}}" method="post">
                                         {{ csrf_field() }}
                                        <input type="hidden" name="id_sekolah" value="{{$item->id_sekolah}}"/>
                                        <button type="submit" class="btn btn-primary">Nonaktifkan data!</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalAktifBarang{{ $item->id_sekolah }}" tabindex="-1" aria-labelledby="modalHapusGaya" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <h4 class="text-center">Apakah anda yakin mengaktifkan sekolah ini ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{url('aktifsch')}}" method="post">
                                         {{ csrf_field() }}
                                        <input type="hidden" name="id_sekolah" value="{{$item->id_sekolah}}"/>
                                        <button type="submit" class="btn btn-primary">Aktifkan data!</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="modal fade" id="modalHapusBarang{{ $item->id_sekolah }}" tabindex="-1" aria-labelledby="modalHapusBarang" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <h4 class="text-center">Apakah anda yakin menghapus data sekolah ini ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <form action="/hapussch/{{ $item->id_sekolah }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-primary">Hapus data!</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Modal Update Sekolah-->
                        <div class="modal fade" id="modalUpdateBarang{{ $item->id_sekolah }}" tabindex="-1" aria-labelledby="modalUpdateBarang" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Sekolah</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <!--FORM UPDATE Sekolah-->
                                    <form action="/savesch/{{ $item->id_sekolah }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label>Nama Sekolah</label>
                                            <input type="text" class="form-control" name="nama_sekolah" value="{{$item->nama_sekolah}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea type="text" class="form-control"  name="alamat_sekolah" cols="20" rows="10">{{$item->alamat_sekolah}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>PIC Sekolah</label>
                                            <input type="text" class="form-control" name="pic_sekolah" value="{{$item->pic_sekolah}}">
                                        </div>
                                        <div class="form-group">
                                            <label>No. Telepon</label>
                                            <input type="number" class="form-control" name="notelp_sekolah" value="{{$item->notelp_sekolah}}">
                                        </div>
                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                    </form>
                                    <!--END FORM UPDATE BARANG-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal UPDATE Barang-->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
