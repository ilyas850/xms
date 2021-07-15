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
     @if ($errors->has('nama_tingkat'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nama_tingkat') }}</strong>
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
            <h3 class="card-title">Data Tingkat</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#addtk">
                        <i class="fa fa-plus"></i> Input Data Tingkat
                    </button>
                </div>
            </div>
            <br>
            <!-- Add Data Sekolah -->
            <div class="modal fade" id="addtk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <form method="post" action="{{url('post_tk')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Tingkat</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Tingkat</label>
                                    <input type="text" class="form-control" name="nama_tingkat" placeholder="Masukan Nama Tingkat">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="created_by" value="{{Auth::user()->name}}">
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
                        <th width="3%">No</th>
                        <th><center>Tingkat</center></th>
                        <th><center></center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach ($data as $item)
                    <tr>
                        <td><center>{{$no++}}</center></td>
                        <td><center>{{$item->nama_tingkat}}</center></td>
                        <td><center>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateTingkat{{ $item->id_tingkat }}">Update</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusTingkat{{ $item->id_tingkat }}">Delete</button>
                        </center></td>
                    </tr>

                    <div class="modal fade" id="modalHapusTingkat{{ $item->id_tingkat }}" tabindex="-1" aria-labelledby="modalHapusBarang" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <h4 class="text-center">Apakah anda yakin menghapus data tingkat ini ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <form action="/hapustk/{{ $item->id_tingkat }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-primary">Hapus data!</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Update Tingkat-->
                        <div class="modal fade" id="modalUpdateTingkat{{ $item->id_tingkat }}" tabindex="-1" aria-labelledby="modalUpdateBarang" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Sekolah</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <!--FORM UPDATE Tingkat-->
                                    <form action="/savetk/{{ $item->id_tingkat }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label>Tingkat</label>
                                            <input type="text" class="form-control" name="nama_tingkat" value="{{$item->nama_tingkat}}">
                                        </div>
                                          <input type="hidden" name="updated_by" value="{{Auth::user()->name}}">
                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                    </form>
                                    <!--END FORM Tingkat-->
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
