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
        <h3 class="card-title">Data Soal</h3>
    </div>
    <div class="card-body">
      <div class="row">
          <div class="col-xs-2">
              <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#addpsi">
                  <i class="fa fa-plus"></i> Input Soal
              </button>
          </div>
      </div>
      <hr>
      <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" >
              <form method="post" action="{{url('post_soal')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Nomor Master</label>
                            <select class="form-control" name="id_nomormaster" required>
                                <option></option>
                                @foreach ($nmr as $nmr)
                                    <option value="{{$nmr->id_nomormaster}}" >{{$nmr->nomor_master_soal}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilih Tipe Test</label>
                            <select class="form-control" name="id_tipetest" required>
                                <option></option>
                                @foreach ($tipe as $tipe)
                                    <option value="{{$tipe->id_tipetest}}" >{{$tipe->tipe_test}} - {{$tipe->nama_tingkat}}
                                    </option>

                                @endforeach
                            </select>
                        </div>
                          {{-- <div class="form-group">
                              <label>Pilih Tingkat</label>
                              <select class="form-control" name="id_tingkat" required>
                                  <option></option>
                                  @foreach ($tk as $tkt)
                                      <option value="{{$tkt->id_tingkat}}" >{{$tkt->nama_tingkat}}
                                      </option>

                                  @endforeach
                              </select>
                          </div> --}}
                          <div class="form-group">
                            <label>Nomor</label>
                            <input type="number" class="form-control" name="nomor" placeholder="Masukan Nomor (ex: 1-100)" required>
                          </div>
                          <div class="form-group">
                              <label>Soal</label>
                              <textarea class="form-control" name="soal" rows="2" cols="80" placeholder="Masukan Soal"></textarea>
                              {{-- <input type="text" class="form-control" name="soal" placeholder="Masukan Soal " required> --}}
                          </div>
                          <div class="form-group">
                              <label>Upload gambar</label>
                              <input type="file" name="gambar">
                              <p class="help-block">Format gambar .jpeg .jpg .png dengan maksimal size 1 mb (1024 kb)</p>
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
            <th><center>Nomor Master</center></th>
            <th><center>Tipe Test</center></th>
            <th><center>Tingkat</center></th>
            <th><center>Nomor</center></th>
            <th><center>Soal</center></th>
            <th>Aksi</th>
            <th>Jawaban</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          @foreach ($soal as $key)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td><center>{{$key->nomor_master_soal}}</center></td>
              <td><center>{{$key->tipe_test}}</center></td>
              <td><center>{{$key->nama_tingkat}}</center></td>
              <td><center>{{$key->nomor}}</center></td>
              <td>{{$key->soal}}</td>
              <td><center>
                  <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateGaya{{ $key->id_soal }}">Update</button>
                  <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusGaya{{ $key->id_soal }}">Delete</button>
              </center></td>
              <td><center>
                @if ($key->ids == null)
                  <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalInputjwb{{ $key->id_soal }}">Input</button>
                @elseif ($key->ids != null)
                  Sudah
                @endif
              </center></td>
            </tr>

            {{-- modal input jawaban--}}
            <div class="modal fade" id="modalInputjwb{{ $key->id_soal }}" tabindex="-1" aria-labelledby="modalUpdateGaya" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Input Jawaban </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{url('savejwb')}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="id_soal" value="{{$key->id_soal}}">
                      <div class="form-group">
                        <label>Nomor</label>
                        <input type="number" class="form-control" value="{{$key->nomor}}" readonly>
                      </div>
                      <div class="form-group">
                          <label>Soal</label>
                          <textarea class="form-control" rows="2" cols="80" readonly>{{$key->soal}}</textarea>
                      </div>
                      <div class="form-group">
                          <label>Soal gambar</label><br>
                          @if ($key->gambar == null)

                            @else
                              <img width="150px" src="{{ asset('Soal_gambar/'.$key->gambar) }}">
                              <br>
                          @endif
                          <br>
                      </div>
                      <div class="form-group">
                          <input type="checkbox" name="b_s[]" value="A,B">
                          <label for="">A</label>
                          <input type="hidden" name="opsi[]" value="A">
                          <input type="file" name="jawab_gambar[]">
                          <br>
                          <input type="checkbox" name="b_s[]" value="B,B">
                          <label for="">B</label>
                          <input type="hidden" name="opsi[]" value="B">
                          <input type="file" name="jawab_gambar[]">
                          <br>
                          <input type="checkbox" name="b_s[]" value="C,B">
                          <label for="">C</label>
                          <input type="hidden" name="opsi[]" value="C">
                          <input type="file" name="jawab_gambar[]">
                          <br>
                          <input type="checkbox" name="b_s[]" value="D,B">
                          <label for="">D</label>
                          <input type="hidden" name="opsi[]" value="D">
                          <input type="file" name="jawab_gambar[]">
                          <br>
                          <input type="checkbox" name="b_s[]" value="E,B">
                          <label for="">E</label>
                          <input type="hidden" name="opsi[]" value="E">
                          <input type="file" name="jawab_gambar[]">
                          <br>
                          <p class="help-block">Format gambar .jpeg .jpg .png dengan maksimal size 1 mb (1024 kb)</p>
                      </div>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>


            <!-- Modal Update soal-->
            <div class="modal fade" id="modalUpdateGaya{{ $key->id_soal }}" tabindex="-1" aria-labelledby="modalUpdateGaya" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Update Soal</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <form action="/savesoal/{{ $key->id_soal }}" method="post" enctype="multipart/form-data">
                      @csrf
                      @method('put')
                      <div class="form-group">
                          <label>Pilih Nomor Master</label>
                          <select class="form-control" name="id_nomormaster" required>
                              <option value="{{$key->id_nomormaster}}">{{$key->nomor_master_soal}}</option>
                              @foreach ($nmor as $nmr)
                                  <option value="{{$nmr->id_nomormaster}}" >{{$nmr->nomor_master_soal}}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Pilih Tipe Test</label>
                          <select class="form-control" name="id_tipetest" required>
                              <option value="{{$key->id_tipetest}}" >{{$key->tipe_test}} - {{$key->nama_tingkat}}</option>
                              @foreach ($tpts as $tipe)
                                  <option value="{{$tipe->id_tipetest}}" >{{$tipe->tipe_test}} - {{$tipe->nama_tingkat}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                        <label>Nomor</label>
                        <input type="number" class="form-control" name="nomor" value="{{$key->nomor}}" required>
                      </div>
                      <div class="form-group">
                          <label>Soal</label>
                          <textarea class="form-control" name="soal" rows="2" cols="80" >{{$key->soal}}</textarea>
                      </div>
                      <div class="form-group">
                          <label>Upload gambar</label><br>
                          @if ($key->gambar == null)

                            @else
                              {{-- <img src="{{ Storage::url($key->gambar) }}" height="75" width="75" alt="" /> --}}
                              <img width="150px" src="{{ asset('Soal_gambar/'.$key->gambar) }}">
                              <br>
                          @endif
                          <br>

                          <input type="file" name="gambar" class="form-control" >
                          <p class="help-block">Format gambar .jpeg .jpg .png dengan maksimal size 1 mb (1024 kb)</p>
                      </div>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="modalHapusGaya{{ $key->id_soal }}" tabindex="-1" aria-labelledby="modalHapusGaya" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="text-center">Apakah anda yakin menghapus soal ini ?</h4>
                    </div>
                    <div class="modal-footer">
                        <form action="{{url('hapussoal')}}" method="post">
                             {{ csrf_field() }}
                            <input type="hidden" name="id_soal" value="{{$key->id_soal}}"/>
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
