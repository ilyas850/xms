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
  @if ($errors->has('file'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('file') }}</strong>
        </span>
  @endif

  @if ($sukses = Session::get('sukses'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $sukses }}</strong>
      </div>
  @endif
  <div class="card">
      <div class="card-header">
          <h3 class="card-title">Pilih Sekolah</h3>
      </div>
      <div class="card-body">
      <form class="form" role="form" action="{{url('add_select')}}" method="POST">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <select class="form-control" name="id_sekolah" required>
                      <option></option>
                      @foreach ($skl as $sch)
                          <option value="{{$sch->id_sekolah}}">{{$sch->nama_sekolah}}
                          </option>
                      @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-info">Input Tipe Test by Admin</button>
              </div>
          </div>
      </form>
      <hr>
      <table id="example1" class="table table-bordered">
        <thead>
          <tr>
            <th><center>No</center></th>
            <th><center>Sekolah</center></th>
            <th><center>Tipe Test</center></th>
            <th><center>Tingkat</center></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          @foreach ($data as $key)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td><center>{{$key->nama_sekolah}}</center></td>
              <td><center>{{$key->tipe_test}}</center></td>
              <td><center>{{$key->nama_tingkat}}</center></td>
              <td><center>
                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusGaya{{ $key->id_testrecord }}">Delete</button>
              </center></td>
            </tr>

            <div class="modal fade" id="modalHapusGaya{{ $key->id_testrecord }}" tabindex="-1" aria-labelledby="modalHapusGaya" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="text-center">Apakah anda yakin menghapus data ini ?</h4>
                    </div>
                    <div class="modal-footer">
                        <form action="{{url('hapustestrecord')}}" method="post">
                             {{ csrf_field() }}
                            <input type="hidden" name="id_testrecord" value="{{$key->id_testrecord}}"/>
                            <button type="submit" class="btn btn-primary">Hapus data!</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                    </div>
                </div>
            </div>
          @endforeach
        </tbody>
      </table>
      </div>
  </div>
@endsection
