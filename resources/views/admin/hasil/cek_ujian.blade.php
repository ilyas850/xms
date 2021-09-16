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
      <div class="col-12 ">
        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">List Ujian/Tes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-hasil-tab" data-toggle="pill" href="#custom-tabs-one-hasil" role="tab" aria-controls="custom-tabs-one-hasil" aria-selected="true">Hasil Jawaban</a>
              </li>
              {{-- @foreach ($hasil1 as $keyh)
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-one-{{$keyh->id_tipetest}}-tab" data-toggle="pill" href="#custom-tabs-one-{{$keyh->id_tipetest}}" role="tab" aria-controls="custom-tabs-one-{{$keyh->id_tipetest}}" aria-selected="true">Hasil {{$keyh->tipe_test}}</a>
                </li>
              @endforeach --}}
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
                      <th style="width: 100px"><center>Benar</center></th>
                      <th style="width: 100px"><center>Salah</center></th>
                      <th style="width: 100px"><center>Jumlah Soal</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach ($hsl as $key)
                      <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$key->tipe_test}}</td>
                        <td><center>{{$key->nama_tingkat}}</center></td>
                        <td><center>
                          @foreach ($benar as $keybenar)
                              @if ($key->id_tipetest == $keybenar->id_tipetest)
                                  {{$keybenar->jml_benar}}
                                  @else
                                    0
                              @endif
                          @endforeach
                          {{-- @foreach ($hasil as $keyhsl)
                              @if ($keyhsl->id_tipetest == $key->id_tipetest)
                                  {{$keyhsl->jml_bs * 100 / $keysoal->jmlsoal}}

                                  {{$keysoal->jmlsoal}}
                                @else

                              @endif
                          @endforeach --}}
                        </center></td>
                        <td><center>
                          @foreach ($salah as $keysalah)
                              @if ($key->id_tipetest == $keysalah->id_tipetest)
                                  {{$keysalah->jml_salah}}
                                  @else
                                    0
                              @endif
                          @endforeach
                        </center></td>
                        <td><center>
                          @foreach ($soal as $keysoal)
                              @if ($key->id_tipetest == $keysoal->id_tipetest)
                                  {{$keysoal->jml_soal}}
                              @endif
                          @endforeach
                        </center></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="custom-tabs-one-hasil" role="tabpanel" aria-labelledby="custom-tabs-one-hasil-tab">
                <div class="row">
                    <div class="col-3">
                      <a href="/exporthasiljawaban/{{$id}}" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i> Export Data .xls</a>

                    </div>
                </div><hr>
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Soal</th>
                      <th style="width: 150px">Tipe Tes</th>
                      <th style="width: 10px"><center>Opsi</center></th>
                      <th style="width: 150px">Jawaban</th>
                      <th style="width: 20px"><center>Keterangan</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach ($jawab as $keyj)
                        <tr>
                          <td><center>{{$no++}}</center></td>
                          <td>{{$keyj->soal}}</td>
                          <td>{{$keyj->tipe_test}}</td>
                          <td><center>{{$keyj->opsi}}</center></td>
                          <td>{{$keyj->jawaban}}</td>
                          <td><center>
                            @if ($keyj->b_s == 'B')
                              Benar
                            @elseif ($keyj->b_s == 'S')
                              Salah
                            @endif
                          </center></td>
                        </tr>

                    @endforeach
                  </tbody>
                </table>
              </div>
              {{-- @foreach ($hasil1 as $keyl)
                <div class="tab-pane fade" id="custom-tabs-one-{{$keyl->id_tipetest}}" role="tabpanel" aria-labelledby="custom-tabs-one-{{$keyl->id_tipetest}}-tab">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th>Soal</th>
                        <th style="width: 10px"><center>Opsi</center></th>
                        <th style="width: 100px">Jawaban</th>
                        <th style="width: 50px"><center>Keterangan</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach ($jawab as $keyj)
                        @if ($keyl->id_tipetest == $keyj->id_tipetest)
                          <tr>
                            <td><center>{{$no++}}</center></td>
                            <td>{{$keyj->soal}}</td>
                            <td><center>{{$keyj->opsi}}</center></td>
                            <td>{{$keyj->jawaban}}</td>
                            <td><center>
                              @if ($keyj->b_s == 'B')
                                Benar
                              @elseif ($keyj->b_s == 'S')
                                Salah
                              @endif
                            </center></td>
                          </tr>
                        @endif

                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endforeach --}}
            </div>
          </div>
        </div>
      </div>
@endsection
