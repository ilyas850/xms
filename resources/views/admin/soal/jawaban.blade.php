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
        <h3 class="card-title">Data Jawaban</h3>
    </div>
    <div class="card-body">
      <form class="form" role="form" action="{{url('pilih_master')}}" method="POST">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-3">
                <label for="">Filter Sesuai Nomor Master</label>
                  <select class="form-control" name="id_nomormaster" required>
                      <option></option>
                      @foreach ($jawaban as $sch)
                          <option value="{{$sch->id_nomormaster}}">{{$sch->nomor_master_soal}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="col-3">
                <label for="">Filter Sesuai Tipe Test</label>
                  <select class="form-control" name="id_tipetest" required>
                      <option></option>
                      @foreach ($tes as $sch)
                          <option value="{{$sch->id_tipetest}}">{{$sch->tipe_test}} - {{$sch->nama_tingkat}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col-3">
              <button type="submit" class="btn btn-info " >Input Jawaban</button>
            </div>
          </div>
      </form>
      <hr>

      <table id="example1" class="table table-bordered">
        <thead>
          <tr>
            <th><center>No</center></th>
            <th><center>Master</center></th>
            <th><center>Tipe Test</center></th>
            <th><center>Tingkat</center></th>
            <th><center>Soal</center></th>
            <th><center>Opsi</center></th>
            <th><center>Jawaban</center></th>
            <th><center>B/S</center></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          @foreach ($jwbn as $key)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td><center>{{$key->nomor_master_soal}}</center></td>
              <td><center>{{$key->tipe_test}}</center></td>
              <td><center>{{$key->nama_tingkat}}</center></td>
              <td>{{$key->soal}}</td>
              <td><center>{{$key->opsi}}</center></td>
              <td>{{$key->jawaban}}</td>
              <td><center>
                @if ($key->b_s == 'B')
                  Benar
                @elseif ($key->b_s == 'S')
                  Salah
                @endif
              </center></td>
              <td><center>
                  <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUpdateGaya{{ $key->id_jawaban }}">Update</button>
                  <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapusGaya{{ $key->id_jawaban }}">Delete</button>
              </center></td>
            </tr>

            <div class="modal fade" id="modalHapusGaya{{ $key->id_jawaban }}" tabindex="-1" aria-labelledby="modalHapusGaya" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="text-center">Apakah anda yakin menghapus jawaban ini ?</h4>
                    </div>
                    <div class="modal-footer">
                        <form action="{{url('hapusjawaban')}}" method="post">
                             {{ csrf_field() }}
                            <input type="hidden" name="id_jawaban" value="{{$key->id_jawaban}}"/>
                            <button type="submit" class="btn btn-primary">Hapus data!</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalUpdateGaya{{ $key->id_jawaban }}" tabindex="-1" aria-labelledby="modalUpdateGaya" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Jawaban</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <!--FORM UPDATE Gaya Belajar-->
                        <form action="/savejawaban/{{ $key->id_jawaban }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Soal</label>
                                <input type="text" class="form-control" value="{{$key->soal}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Opsi</label>
                                <input type="text" class="form-control" value="{{$key->opsi}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jawaban</label>
                                <input type="text" class="form-control" name="jawaban" value="{{$key->jawaban}}">
                            </div>
                            <div class="form-group">
                              <label>Benar/Salah</label>
                              <select class="form-control" name="b_s" required>
                                  <option value="{{$key->b_s}}">
                                    @if ($key->b_s == 'S')
                                      Salah
                                    @elseif ($key->b_s == 'B')
                                      Benar
                                    @endif
                                  </option>
                                  <option value="B">Benar</option>
                                  <option value="S">Salah</option>
                              </select>
                            </div>
                        <button type="submit" class="btn btn-primary">Perbarui Data</button>
                        </form>
                        <!--END FORM UPDATE Gaya Belajar-->
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
