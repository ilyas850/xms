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
      <form method="post" action="{{url('save_jawaban')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
        <div class="col-6">
            <?php $no=1; ?>
            @foreach ($soal as $key)

              <table width="100%">
                <tr>
                  <td colspan="4"><label for="">{{$no++}}. {{$key->soal}}</label></td>
                </tr>
                <tr>
                  <td  width="5%"> <input type="checkbox" name="b_s[]" value="{{$key->id_soal}},A,B"> </td>
                  <td  width="5%"><label>A</label></td>
                  <input type="hidden" name="opsi[]" value="{{$key->id_soal}},A">
                  <td  width="80%">
                    <input type="text"  name="jawaban[]" placeholder="Masukan jawaban">
                  </td>
                </tr>
                <tr>
                  <td  width="5%"> <input type="checkbox" name="b_s[]" value="{{$key->id_soal}},B,B"> </td>
                  <td  width="5%"><label>B</label></td>
                  <input type="hidden" name="opsi[]" value="{{$key->id_soal}},B">
                  <td  width="80%">
                    <input type="text"  name="jawaban[]" placeholder="Masukan jawaban">
                  </td>
                </tr>
                <tr>
                  <td  width="5%"> <input type="checkbox" name="b_s[]" value="{{$key->id_soal}},C,B"> </td>
                  <td  width="5%"><label>C</label></td>
                  <input type="hidden" name="opsi[]" value="{{$key->id_soal}},C">
                  <td  width="80%">
                    <input type="text"  name="jawaban[]" placeholder="Masukan jawaban">
                  </td>
                </tr>
                <tr>
                  <td  width="5%"> <input type="checkbox" name="b_s[]" value="{{$key->id_soal}},D,B"> </td>
                  <td  width="5%"><label>D</label></td>
                  <input type="hidden" name="opsi[]" value="{{$key->id_soal}},D">
                  <td  width="80%">
                    <input type="text"  name="jawaban[]" placeholder="Masukan jawaban">
                  </td>
                </tr>
                <tr>
                  <td  width="5%"> <input type="checkbox" name="b_s[]" value="{{$key->id_soal}},E,B"> </td>
                  <td  width="5%"><label>E</label></td>
                  <input type="hidden" name="opsi[]" value="{{$key->id_soal}},E">
                  <td  width="80%">
                    <input type="text"  name="jawaban[]" placeholder="Masukan jawaban">
                  </td>
                </tr>
              </table>

            @endforeach
        </div>
        <br>
        <div class="row">
          <button type="submit" class="btn btn-info ">
              Simpan
          </button>
        </div>
      </form>

      <hr>
      <div class="modal fade" id="addpsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" >
              <form method="post" action="{{url('post_jawaban')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" name="id_nomormaster" value="{{$idbank}}">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Soal</label>
                            <select class="form-control" name="id_soal" required>
                                <option></option>
                                @foreach ($soal as $soal)
                                    <option value="{{$soal->id_soal}}" >{{$soal->soal}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilihan</label>
                            <select class="form-control" name="opsi" required>
                                <option></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                          <div class="form-group">
                            <label>Jawaban</label>
                            <input type="text" class="form-control" name="jawaban" placeholder="Masukan Jawaban " required>
                          </div>
                          <div class="form-group">
                            <label>Benar/Salah</label>
                            <select class="form-control" name="b_s" required>
                                <option></option>
                                <option value="B">Benar</option>
                                <option value="S">Salah</option>
                            </select>
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

    </div>
  </div>

@endsection
