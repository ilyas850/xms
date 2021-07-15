@extends('layouts.master')

@section('side')

  @include('layouts.side')

@endsection

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Nilai Peserta Test (Aspek Psikologis)</h3>
        </div> 
        <form action="{{url('save_aspek_psiko')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <table class="table table">
                    <thead>
                        <tr>
                            <th width="3%"><center>No</center></th>
                            <th><center>Tingkat</center></th>
                            <th><center>Psikogram</center></th>
                            <th><center>Aspek Psikologis</center></th>
                            <th><center>Nilai</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($aspek as $item)
                        <tr>
                            <td><center>{{$no++}}</center></td>
                            <td><center>{{$item->nama_tingkat}}</center></td>
                            <td><center>{{$item->psikogram}}</center></td>
                            <td><center>{{$item->aspek_psikologis}}</center></td>
                            <td><center>
                                <input type="hidden" name="id_peserta" value="{{$peserta}}">
                                <input type="hidden" name="id_psikolog" value="{{$psikolog}}">
                                <input type="hidden" name="id_aspek[]" value="{{$item->id_aspek}}">
                                <select name="nilai[]" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </center></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                
            </div>
            <div class="box-footer">
                
                <button type="submit" class="btn btn-info btn-block">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</section>
@endsection