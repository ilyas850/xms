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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Peserta Test</h3>
        </div>
        <form action="{{url('save_pestes')}}" method="post">
            {{ csrf_field() }}
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px"><center>No</center></th>
                            <th><center>Nama Peserta</center></th>
                            <th><center>Unit Sekolah</center></th>
                            <th><center>Tingkat</center></th>
                            <th><center>Tahun Daftar</center></th>
                            <th><center>Tanggal Tes</center></th>
                            <th><center>Pilih</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data as $item)
                        <tr>
                            <td><center>{{$no++}}</center></td>
                            <td>{{$item->nama_peserta}}</td>
                            <td><center>{{$item->nama_sekolah}}</center></td>
                            <td><center>{{$item->nama_tingkat}}</center></td>
                            <td><center>{{$item->tahun_reg}}</center></td>
                            <td><center>{{$item->tgl_test}}</center></td>
                            <td><center>
                                @if ($item->idpeserta == null)
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="id_peserta[]" value="{{$item->id_peserta}}">

                                        </label>
                                    </div>
                                    @else
                                    Sudah
                                @endif
                            </center></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <input name="Check_All" value="Tandai Semua" onclick="check_all()" type="button" class="btn btn-warning">
                <input name="Un_CheckAll" value="Hilangkan Semua Tanda" onclick="uncheck_all()" type="button" class="btn btn-warning">
            </div>
            <div class="card-footer">

                <div class="col-4">
                    <div class="form-group">
                        <label>Nama Psikolog</label>
                        <select name="id_psikolog" class="form-control">
                            <option>-pilih psikolog-</option>
                            @foreach ($psi as $item)
                                <option value="{{$item->id_psikolog}}">{{$item->nama_psikolog}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-block">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</section>


<script language="javascript">
      function check_all()
      {
          var chk = document.getElementsByName('id_peserta[]');
          for (i = 0; i < chk.length; i++)
          chk[i].checked = true ;
      }

      function uncheck_all()
      {
          var chk = document.getElementsByName('id_peserta[]');
          for (i = 0; i < chk.length; i++)
          chk[i].checked = false ;
      }
</script>
@endsection
