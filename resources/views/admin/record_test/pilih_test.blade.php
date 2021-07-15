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
  <div class="card">
      <div class="card-header">
          <table width="100%">
            <tr>
              <td><b>Nama Sekolah</b></td>
              <td>:</td>
              <td>{{$nama}}</td>

            </tr>
          </table>
      </div>
      <form action="{{url('simpan_peserta')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id_sekolah" value="{{$idtes}}">
      <div class="card-body">
        <table  class="table table-sm">
          <thead>
            <tr>
              <th><center>No</center></th>
              <th><center>Tipe Tes</center></th>
              <th><center>Tingkat</center></th>
              <th><center>Pilih</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            @foreach ($tkt as $key)
              <tr>
                <td><center>{{$no++}}</center></td>
                <td>{{$key->tipe_test}}</td>
                <td><center>{{$key->nama_tingkat}}</center></td>
                <td><center>
                    <input type="checkbox" name="id_tipetest[]" value="{{$key->id_tipetest}}">
                </center></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <br>
        <input name="Check_All" value="Ceklis Semua" onclick="check_all()" type="button" class="btn btn-primary btn-sm">
        <input name="Un_CheckAll" value="Hilangkan Ceklis" onclick="uncheck_all()" type="button" class="btn btn-primary btn-sm">

        <button type="submit" class="btn btn-success btn-sm">
            Simpan
        </button>
      </div>
      </form>
  </div>
  <script language="javascript">
        function check_all()
        {
            var chk = document.getElementsByName('id_tipetest[]');
            for (i = 0; i < chk.length; i++)
            chk[i].checked = true ;
        }

        function uncheck_all()
        {
            var chk = document.getElementsByName('id_tipetest[]');
            for (i = 0; i < chk.length; i++)
            chk[i].checked = false ;
        }
  </script>
@endsection
