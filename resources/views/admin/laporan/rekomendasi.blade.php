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
            <h3 class="card-title">Data Rekomendasi</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#addpsi">
                        <i class="fa fa-plus"></i> Input Rekomendasi
                    </button>
                </div>
            </div>
            <br>
            <!-- Add Data Rekomendasi -->
            <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <form method="post" action="{{url('post_rkm')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Rekomendasi</label>
                                    <input type="text" class="form-control" name="rekomendasi" placeholder="Masukan Data Rekomendasi">
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
                        <th><center>Rekomendasi</center></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($rkm as $item)
                    <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$item->rekomendasi}}</td>
                        <td><center>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateRekomen{{ $item->id_rekomendasi }}">Update</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusRekomen{{ $item->id_rekomendasi }}">Delete</button>
                        </center></td>
                    </tr>

                    <div class="modal fade" id="modalHapusRekomen{{ $item->id_rekomendasi }}" tabindex="-1" aria-labelledby="modalHapusRekomen" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="text-center">Apakah anda yakin menghapus data rekomendasi ini ?</h4>
                            </div>
                            <div class="modal-footer">
                                <form action="{{url('hapusrkm')}}" method="post">
                                     {{ csrf_field() }}

                                     <input type="hidden" name="id_rekomendasi" value="{{$item->id_rekomendasi}}"/>

                                    <button type="submit" class="btn btn-primary">Hapus data!</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Update Rekomendasi-->
                        <div class="modal fade" id="modalUpdateRekomen{{ $item->id_rekomendasi }}" tabindex="-1" aria-labelledby="modalUpdateRekomen" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Rekomendasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <!--FORM UPDATE Rekomendasi-->
                                    <form action="/saverkm/{{ $item->id_rekomendasi }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label>Rekomendasi</label>
                                            <input type="text" class="form-control" name="rekomendasi" value="{{$item->rekomendasi}}">
                                        </div>
                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                    </form>
                                    <!--END FORM UPDATE Rekomendasi-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal UPDATE Rekomendasi-->
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
