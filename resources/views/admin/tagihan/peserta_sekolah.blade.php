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
            <h3 class="card-title">Data Peserta Sekolah</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#inputinvoice">
                        <i class="fa fa-plus"></i> Input Invoice
                    </button>
                </div>
            </div>
            <br><b></b>
            <div class="modal fade" id="inputinvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="{{url('pilih_tgl_test')}}" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pilih Tanggal Tes</h5>
                            </div>
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                     <select class="form-control" name="tgl_test">
                                        <option>-pilih tanggal tes-</option>
                                        @foreach ($tes as $tes)
                                            <option value="{{$tes->tgl_test}}" >{{$tes->tgl_test}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Pilih</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th>Tanggal Test</th>
                        <th>Nama Peserta</th>
                        <th>Sekolah</th>
                        <th>Tingkat</th>
                        <th>No. Invoice</th>
                        <th>Tanggal Invoice</th>
                        
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->tgl_test}}</td>
                        <td>{{$item->nama_peserta}}</td>
                        <td>@foreach ($skl as $items)
                                @if ($item->id_sekolah == $items->id_sekolah)
                                    {{$items->nama_sekolah}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$item->nama_tingkat}}</td>
                        <td>{{$item->no_invoice}}</td>
                        <td>{{$item->tgl_invoice}}</td>
                        <td align="right">@currency ($item->total_tagihan)</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection