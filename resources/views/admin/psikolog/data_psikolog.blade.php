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
                    <strong>{{ $errors->first('nama_psikolog') }}</strong>
                </span>
            </div>
        @endif

        @if ($errors->has('nohp'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nohp_psikolog') }}</strong>
                </span>
            </div>
        @endif

        @if ($errors->has('email'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email_psikolog') }}</strong>
                </span>
            </div>
        @endif

        @if ($errors->has('noktp'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('noktp_psikolog') }}</strong>
                </span>
            </div>
        @endif

        @if ($errors->has('alamat'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('alamat_psikolog') }}</strong>
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
            <h3 class="card-title">Data Psikolog</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addpsi">
                        <i class="fa fa-plus"></i> Input Data Psikolog
                    </button>
                </div>
            </div>
            <br>
            <!-- Add Data Psikolog -->
            <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <form method="post" action="{{url('post_psi')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Psikolog</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama_psikolog" placeholder="Masukan Nama">
                                </div>
                               <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="number" class="form-control" name="nohp_psikolog" placeholder="Masukan No. HP">
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" name="email_psikolog" placeholder="Masukan E-mail">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" class="form-control" name="alamat_psikolog" placeholder="Masukan Alamat"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No. KTP</label>
                                    <input type="number" class="form-control" name="noktp_psikolog" placeholder="Masukan No. KTP">
                                </div>
                                <div class="form-group">
                                    <label>No. NPWP</label>
                                    <input type="number" class="form-control" name="npwp_psikolog" placeholder="Masukan No. NPWP">
                                </div>
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" class="form-control" name="bank" placeholder="Masukan Nama Bank">
                                </div>
                                <div class="form-group">
                                    <label>No. Rekening</label>
                                    <input type="number" class="form-control" name="norek" placeholder="Masukan No. Rekening">
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
            <table id="example1" class="table table-bordered ">
                <thead>
                    <tr>
                        <th width="3%"><center>No</center></th>
                        <th><center>Nama</center></th>
                        <th><center>No. HP</center></th>
                        <th><center>Email</center></th>
                        <th><center>Alamat</center></th>
                        <th><center>No. KTP</center></th>
                        <th><center>NPWP</center></th>
                        <th><center>Bank</center></th>
                        <th><center>No. Rekening</center></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $item)
                    <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$item->nama_psikolog}}</td>
                        <td><center>{{$item->nohp_psikolog}}</center></td>
                        <td>{{$item->email_psikolog}}</td>
                        <td>{{$item->alamat_psikolog}}</td>
                        <td><center>{{$item->noktp_psikolog}}</center></td>
                        <td><center>{{$item->npwp_psikolog}}</center></td>
                        <td><center>{{$item->bank}}</center></td>
                        <td><center>{{$item->norek}}</center></td>
                        <td><center>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdatePsikolog{{ $item->id_psikolog }}">Update</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusPsikolog{{ $item->id_psikolog }}">Delete</button>
                        </center></td>
                    </tr>

                    <div class="modal fade" id="modalHapusPsikolog{{ $item->id_psikolog }}" tabindex="-1" aria-labelledby="modalHapusPsikolog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="text-center">Apakah anda yakin menghapus data psikolog ini ?</h4>
                            </div>
                            <div class="modal-footer">
                                <form action="/hapuspsi/{{ $item->id_psikolog }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-primary">Hapus data!</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Update Psikolog-->
                        <div class="modal fade" id="modalUpdatePsikolog{{ $item->id_psikolog }}" tabindex="-1" aria-labelledby="modalUpdateBarang" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Psikolog</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <!--FORM UPDATE Psikolog-->
                                    <form action="/savepsi/{{ $item->id_psikolog }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama_psikolog" value="{{$item->nama_psikolog}}">
                                        </div>
                                        <div class="form-group">
                                            <label>No. HP</label>
                                            <input type="number" class="form-control" name="nohp_psikolog" value="{{$item->nohp_psikolog}}">
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control" name="email_psikolog" value="{{$item->email_psikolog}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea type="text" class="form-control" name="alamat_psikolog">{{$item->alamat_psikolog}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>No. KTP</label>
                                            <input type="number" class="form-control" name="noktp_psikolog" value="{{$item->noktp_psikolog}}">
                                        </div>
                                        <div class="form-group">
                                            <label>No. NPWP</label>
                                            <input type="number" class="form-control" name="npwp_psikolog" value="{{$item->npwp_psikolog}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Bank</label>
                                            <input type="text" class="form-control" name="bank" value="{{$item->bank}}">
                                        </div>
                                        <div class="form-group">
                                            <label>No. Rekening</label>
                                            <input type="number" class="form-control" name="norek" value="{{$item->norek}}">
                                        </div>
                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                    </form>
                                    <!--END FORM UPDATE Psikolog-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- End Modal UPDATE Psikolog-->
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
