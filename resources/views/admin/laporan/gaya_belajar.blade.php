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
            <h3 class="card-title">Data Gaya Belajar</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#addpsi">
                        <i class="fa fa-plus"></i> Input Data Gaya Belajar
                    </button>
                </div>
            </div>
            <br>
            <!-- Add Data Gaya Belajar -->
            <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <form method="post" action="{{url('post_gy')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Gaya Belajar</label>
                                    <input type="text" class="form-control" name="gaya_belajar" placeholder="Masukan Gaya Belajar">
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
                        <th><center>Gaya Belajar</center></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($gy as $item)
                    <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$item->gaya_belajar}}</td>
                        <td><center>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateGaya{{ $item->id_gaya }}">Update</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusGaya{{ $item->id_gaya }}">Delete</button>
                        </center></td>
                    </tr>

                    <div class="modal fade" id="modalHapusGaya{{ $item->id_gaya }}" tabindex="-1" aria-labelledby="modalHapusGaya" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="text-center">Apakah anda yakin menghapus data gaya belajar ini ?</h4>
                            </div>
                            <div class="modal-footer">
                                <form action="{{url('hapusgy')}}" method="post">
                                     {{ csrf_field() }}
                                    <input type="hidden" name="id_gaya" value="{{$item->id_gaya}}"/>
                                    <button type="submit" class="btn btn-primary">Hapus data!</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Update Gaya Belajar-->
                        <div class="modal fade" id="modalUpdateGaya{{ $item->id_gaya }}" tabindex="-1" aria-labelledby="modalUpdateGaya" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Gaya Belajar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <!--FORM UPDATE Gaya Belajar-->
                                    <form action="/savegy/{{ $item->id_gaya }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label>Gaya Belajar</label>
                                            <input type="text" class="form-control" name="gaya_belajar" value="{{$item->gaya_belajar}}">
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
