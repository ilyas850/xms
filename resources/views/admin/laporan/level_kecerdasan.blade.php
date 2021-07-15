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
            <h3 class="card-title">Data Level Kecerdasan</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#addpsi">
                        <i class="fa fa-plus"></i> Input Data Level Kecerdasan
                    </button>
                </div>
            </div>
            <br>
            <!-- Add Data Level Kecerdasan -->
            <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <form method="post" action="{{url('post_lvl')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Level Kecerdasan (Indonesia)</label>
                                    <input type="text" class="form-control" name="level_ind" placeholder="Versi Bahasa Indonesia">
                                </div>
                                <div class="form-group">
                                    <label>Level Kecerdasan (Inggris)</label>
                                    <input type="text" class="form-control" name="level_ing" placeholder="English Version">
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
                        <th><center>Level Kecerdasan (Indnesia)</center></th>
                        <th><center>Level Kecerdasan (Inggris)</center></th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($lvl as $item)
                    <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$item->level_ind}}</td>
                        <td>{{$item->level_ing}}</td>
                        <td><center>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateLevel{{ $item->id_level }}">Update</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusLevel{{ $item->id_level }}">Delete</button>
                        </center></td>
                    </tr>

                    <div class="modal fade" id="modalHapusLevel{{ $item->id_level }}" tabindex="-1" aria-labelledby="modalHapusLevel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="text-center">Apakah anda yakin menghapus data level kecerdasan ini ?</h4>
                            </div>
                            <div class="modal-footer">
                                <form action="{{url('hapuslvl')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_level" value="{{$item->id_level}}"/>
                                    <button type="submit" class="btn btn-primary">Hapus data!</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Update Level Kecerdasan-->
                        <div class="modal fade" id="modalUpdateLevel{{ $item->id_level }}" tabindex="-1" aria-labelledby="modalUpdateLevel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Level Kecerdasan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <!--FORM UPDATE Level Kecerdasan-->
                                    <form action="/savelvl/{{ $item->id_level }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label>Level Kecerdasan (Indonesia)</label>
                                            <input type="text" class="form-control" name="level_ind" value="{{$item->level_ind}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Level Kecerdasan (Inggris)</label>
                                            <input type="text" class="form-control" name="level_ing" value="{{$item->level_ing}}">
                                        </div>
                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                    </form>
                                    <!--END FORM UPDATE Level Kecerdasan-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal UPDATE Level Kecerdasan-->
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
