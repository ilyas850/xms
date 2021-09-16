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
        <h3 class="card-title">Data Tipe Test</h3>
    </div>
    <div class="card-body">
      <div class="row">
          <div class="col-xs-2">
              <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#addpsi">
                  <i class="fa fa-plus"></i> Input Tipe Test
              </button>
          </div>
      </div>
      <hr>
      <!-- Add Data Gaya Belajar -->
      <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" >
              <form method="post" action="{{url('post_tipetest')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <label>Tipe Test</label>
                              <input type="text" class="form-control" name="tipe_test" placeholder="Masukan Tipe Test" required>
                          </div>
                          <div class="form-group">
                              <label>Keterangan</label>
                              <textarea name="ket" rows="8" cols="80" class="form-control" placeholder="Masukan Keterangan"></textarea>
                          </div>
                          <div class="form-group">
                              <label>Pilih Tingkat</label>
                              <select class="form-control" name="id_tingkat" required>
                                  <option></option>
                                  @foreach ($tk as $tkt)
                                      <option value="{{$tkt->id_tingkat}}" >{{$tkt->nama_tingkat}}
                                      </option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Setup Timer</label>
                              <select class="form-control" name="setup_timer" >
                                  <option></option>
                                  <option value="Ada">Ada</option>
                                  <option value="Tidak">Tidak</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Timer (menit)</label>
                              <input type="number" class="form-control" name="menit" placeholder="Masukan Timer (menit)" >
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
            <th><center>No</center></th>
            <th><center>Tipe Test</center></th>
            <th><center>Keterangan</center></th>
            <th><center>Tingkat</center></th>
            <th><center>Setup Timer</center></th>
            <th><center>Durasi</center></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          @foreach ($tipe as $key)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td><center>{{$key->tipe_test}}</center></td>
              <td>{{$key->ket}}</td>
              <td><center>{{$key->nama_tingkat}}</center></td>
              <td><center>{{$key->setup_timer}}</center></td>
              <td><center>{{$key->menit}}</center></td>
              <td><center>
                  <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateGaya{{ $key->id_tipetest }}">Update</button>
                  <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusGaya{{ $key->id_tipetest }}">Delete</button>
              </center></td>
            </tr>

            <!-- Modal Update Tipe test-->
            <div class="modal fade" id="modalUpdateGaya{{ $key->id_tipetest }}" tabindex="-1" aria-labelledby="modalUpdateGaya" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Tipe Test</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <!--FORM UPDATE Gaya Belajar-->
                      <form action="/savetipetest/{{ $key->id_tipetest }}" method="post">
                          @csrf
                          @method('put')
                          <div class="form-group">
                              <label>Tipe Test</label>
                              <input type="text" class="form-control" name="tipe_test" value="{{$key->tipe_test}}" required>
                          </div>
                          <div class="form-group">
                              <label>Keterangan</label>
                              <textarea name="ket" rows="8" cols="80" class="form-control" value="{{$key->ket}}"></textarea>
                          </div>
                          <div class="form-group">
                              <label>Pilih Tingkat</label>
                              <select class="form-control" name="id_tingkat" required>
                                  <option value="{{$key->id_tingkat}}">{{$key->nama_tingkat}}</option>
                                  @foreach ($tk as $tkt)
                                      <option value="{{$tkt->id_tingkat}}" >{{$tkt->nama_tingkat}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Setup Timer</label>
                              <select class="form-control" name="setup_timer" required>
                                  <option value="{{$key->setup_timer}}">{{$key->setup_timer}}</option>
                                  <option value="Ada">Ada</option>
                                  <option value="Tidak">Tidak</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Timer (menit)</label>
                              <input type="number" class="form-control" name="menit" placeholder="Masukan Timer (menit)" value="{{$key->menit}}" required>
                          </div>
                          <button type="submit" class="btn btn-primary">Perbarui Data</button>
                        </form>
                      </div>
                    </div>
                  </div>
              </div>
                <!-- End Modal UPDATE Tipe test-->

                <div class="modal fade" id="modalHapusGaya{{ $key->id_tipetest }}" tabindex="-1" aria-labelledby="modalHapusGaya" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="text-center">Apakah anda yakin menghapus data tipe test ini ?</h4>
                        </div>
                        <div class="modal-footer">
                            <form action="{{url('hapustipetest')}}" method="post">
                                 {{ csrf_field() }}
                                <input type="hidden" name="id_tipetest" value="{{$key->id_tipetest}}"/>
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
