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
            <h3 class="card-title">Verifikasi Psikolog</h3>
        </div>
        <form action="{{url('save_verifikasi')}}" method="post">
            {{ csrf_field() }}
        <div class="card-body">
            <table id="" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th><center>Tanggal Test</center></th>
                        <th><center>Nama Peserta</center></th>
                        <th><center>Unit Sekolah</center></th>
                        <th><center>Tingkat</center></th>
                        <th><center>Nama Psikolog</center></th>
                        <th><center>Verifikasi</center></th>
                        <th><center>Pilih</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->tgl_test}}</td>
                        <td>{{$item->nama_peserta}}</td>
                        <td>{{$item->nama_sekolah}}</td>
                        <td>{{$item->nama_tingkat}}</td>
                        <td>{{$item->nama_psikolog}}</td>
                        <td><center>
                            @if ($item->verifikasi=='no')
                                <span class="badge bg-red">Belum</span>
                            @elseif($item->verifikasi=='yes')
                                <span class="badge bg-green">Sudah</span>
                            @endif
                        </center></td>
                        <td><center>
                            @if ($item->verifikasi=='no')
                                <input type="checkbox" name="verifikasi[]" value="{{$item->id_trans_pesertatest}},yes">
                            @elseif($item->verifikasi=='yes')

                            @endif
                        </center></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <input name="Check_All" value="Ceklis Semua" onclick="check_all()" type="button" class="btn btn-warning">
            <input name="Un_CheckAll" value="Hilangkan Ceklis" onclick="uncheck_all()" type="button" class="btn btn-warning">
        </div>
        <div class="card-footer">
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
          var chk = document.getElementsByName('verifikasi[]');
          for (i = 0; i < chk.length; i++)
          chk[i].checked = true ;
      }

      function uncheck_all()
      {
          var chk = document.getElementsByName('verifikasi[]');
          for (i = 0; i < chk.length; i++)
          chk[i].checked = false ;
      }
</script>
@endsection
