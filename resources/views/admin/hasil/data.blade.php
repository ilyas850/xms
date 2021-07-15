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
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Data Peserta Ujian/Tes</h3>
    </div>
    <div class="card-body">
      <table id="example3" class="table table-bordered">
        <thead>
          <tr>
            <td><center>No</center></td>
            <td><center>Nama</center></td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          @foreach ($hasil as $key)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td>{{$key->nama_peserta}}</td>
              <td><center> <a href="/cek_ujian/{{$key->id_peserta}}" class="btn btn-primary btn-xs">Cek Hasil Ujian</a>
              </center></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
