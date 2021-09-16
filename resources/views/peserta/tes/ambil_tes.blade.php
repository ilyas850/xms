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
  <div class="row">
          <div class="col-12 ">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">List Ujian/Tes</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <table class="table table-sm">
                     <thead>
                       <tr>
                         <th style="width: 10px">No</th>
                         <th>Tipe Test</th>
                         <th style="width: 80px"><center>Tingkat</center></th>
                         <th style="width: 100px"><center>Setup Timer</center></th>
                         <th style="width: 100px"><center>Waktu</center></th>
                         <th style="width: 100px"><center>Ujian/Tes</center></th>
                         <th style="width: 100px"><center>Status</center></th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php $no=1; ?>
                       @foreach ($datates as $key)
                         <tr>
                           <td><center>{{$no++}}</center></td>
                           <td>{{$key->tipe_test}}</td>
                           <td><center>{{$key->nama_tingkat}}</center></td>
                           <td><center>{{$key->setup_timer}}</center></td>
                           <td><center>
                               @if ($key->menit != null)
                                 <span class="badge bg-success">{{$key->menit}} menit</span>
                               @elseif ($key->menit == null)
                                <span class="badge bg-danger">tidak ada</span>
                               @endif
                           </center></td>
                           <td><center>
                             {{-- @if ($key->id_peserta == $idsp)
                               <span class="badge bg-success">Sudah</span>
                             @elseif ($key->id_peserta == null)
                               @if ($key->status == 'Onprogress')
                                 <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">mulai tes</a>
                               @elseif ($key->status == 'Gagal')
                                 <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-warning btn-xs">ulangi tes</a>
                               @elseif ($key->status==null)
                                 <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">mulai tes</a>
                               @endif
                             @endif --}}
                             <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">mulai tes</a>
                             {{-- @if ($cekl > 0)
                               @foreach ($list as $keyls)
                                 @if ($key->id_tipetest == $keyls->id_tipetest && $keyls->status=='Selesai')
                                   <span class="badge bg-success">Sudah</span>
                                 @elseif ($key->id_tipetest == $keyls->id_tipetest && $keyls->status=='Onprogress')
                                   <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">mulai tes</a>
                                 @elseif ($key->id_tipetest == $keyls->id_tipetest && $keyls->status==null)
                                   <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">mulai tes</a>
                                 @elseif ($key->id_tipetest == $keyls->id_tipetest && $keyls->status=='Gagal')
                                   <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">ulangi tes</a>
                                 @endif
                               @endforeach
                             @else
                               <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">mulai tes</a>
                             @endif --}}

                             {{-- @if ($key->id_peserta == null or $key->id_peserta != $idsp)
                               <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">mulai tes</a>
                             @elseif ($key->id_peserta == $idsp)
                               sudah
                             @endif --}}
                             {{-- @if ($key->status == 'Selesai')
                               <span class="badge bg-success">Sudah</span>
                             @elseif ($key->status == 'Onprogress')
                               <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">mulai tes</a>
                             @elseif ($key->status == 'Gagal')
                               <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-warning btn-xs">ulangi tes</a>
                             @elseif ($key->status==null)
                               <a href="mulai_tes/{{$key->id_tipetest}}" class="btn btn-success btn-xs">mulai tes</a>
                             @endif --}}
                           </center></td>
                           <td><center>
                             @if ($cekl > 0)
                               @foreach ($list as $keyls)
                                 @if ($key->id_tipetest == $keyls->id_tipetest && $keyls->status=='Selesai')
                                   <span class="badge bg-primary"> {{$keyls->status}}</span>
                                 @elseif ($key->id_tipetest == $keyls->id_tipetest && $keyls->status=='Onprogress')
                                   <span class="badge bg-primary"> {{$keyls->status}}</span>
                                 @elseif ($key->id_tipetest == $keyls->id_tipetest && $keyls->status=='Gagal')
                                   <span class="badge bg-primary"> {{$keyls->status}}</span>
                                 @endif
                               @endforeach
                             @elseif ($cekl == 0)
                               <span class="badge bg-warning">Belum tes</span>
                             @endif

                             {{-- @if ($key->status==null)
                               <span class="badge bg-warning">Belum tes</span>
                             @elseif ($key->status=='Onprogress')
                               <span class="badge bg-primary"> {{$key->status}}</span>
                             @elseif ($key->status=='Selesai')
                               <span class="badge bg-success"> {{$key->status}}</span>
                             @elseif ($key->status=='Gagal')
                               <span class="badge bg-danger"> {{$key->status}}</span>
                             @endif --}}
                           </center></td>
                         </tr>
                       @endforeach
                     </tbody>
                   </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
