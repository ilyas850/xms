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
            <h3 class="card-title">Data Aspek Psikologis</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#addpsi">
                        <i class="fa fa-plus"></i> Input Data Aspek Psikologis
                    </button>
                </div>
            </div>
            <br>
            <!-- Add Data GAspek Psikologis -->
            <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <form method="post" action="{{url('post_psiko')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Pilih Tingkat</label>
                                    <select name="id_tingkat" class="form-control">
                                        <option>-pilih-</option>
                                        @foreach ($tkt as $item)
                                            <option value="{{$item->id_tingkat}}">{{$item->nama_tingkat}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Group Psikogram</label>
                                    <select name="id_psikogram" class="form-control">
                                        <option>-pilih-</option>
                                        @foreach ($group as $itemgr)
                                            <option value="{{$itemgr->id_psikogram}}">{{$itemgr->psikogram}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Aspek Psikologis</label>
                                    <input type="text" class="form-control" name="aspek_psikologis" placeholder="Masukan Aspek Psikologis">
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
                        <th><center>Tingkat</center></th>
                        <th><center>Psikogram</center></th>
                        <th><center>Aspek Psikologis</center></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($psiko as $item)
                    <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$item->nama_tingkat}}</td>
                        <td>{{$item->psikogram}}</td>
                        <td>{{$item->aspek_psikologis}}</td>
                        <td><center>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateAspek{{ $item->id_aspek }}">Update</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusAspek{{ $item->id_aspek }}">Delete</button>
                        </center></td>
                    </tr>

                    <div class="modal fade" id="modalHapusAspek{{ $item->id_aspek }}" tabindex="-1" aria-labelledby="modalHapusAspek" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="text-center">Apakah anda yakin menghapus data aspek psikologis ini ?</h4>
                            </div>
                            <div class="modal-footer">
                                <form action="{{url('hapuspsiko')}}" method="post">
                                    {{ csrf_field() }}
                                    {{-- @csrf
                                    @method('delete') --}}
                                    <input type="hidden" name="id_aspek" value="{{$item->id_aspek}}"/>
                                    <button type="submit" class="btn btn-primary">Hapus data!</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Update Aspek Psikologis-->
                        <div class="modal fade" id="modalUpdateAspek{{ $item->id_aspek }}" tabindex="-1" aria-labelledby="modalUpdateAspek" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Aspek Psikologis</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <!--FORM UPDATE Aspek Psikologis-->
                                    <form action="/savepsiko/{{ $item->id_aspek }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label>Pilih Tingkat</label>
                                            <select name="id_tingkat" class="form-control">
                                                <option value="{{$item->id_tingkat}}">{{$item->nama_tingkat}}</option>
                                                @foreach ($tkt as $tingkat)
                                                    <option value="{{$tingkat->id_tingkat}}">{{$tingkat->nama_tingkat}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Group Psikogram</label>
                                            <select name="id_psikogram" class="form-control">
                                                <option value="{{$item->id_psikogram}}">{{$item->psikogram}}</option>
                                                @foreach ($group as $psikogram)
                                                    <option value="{{$psikogram->id_psikogram}}">{{$psikogram->psikogram}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Aspek Psikologis</label>
                                            <input type="text" class="form-control" name="aspek_psikologis" value="{{$item->aspek_psikologis}}">
                                        </div>
                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                    </form>
                                    <!--END FORM UPDATE Aspek Psikologis-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal UPDATE Aspek Psikologis-->
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
