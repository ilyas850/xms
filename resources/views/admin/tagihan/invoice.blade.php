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
    @if (count($errors) > 0)
            <div class="alert alert-danger">
            Error<br><br>
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
        @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Input Invoice</h3>
        </div> 
        <form action="{{url('save_invoice')}}" method="post">
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
                        <th><center>Fee</center></th>
                        <th><center>Pilih</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($tgl as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->tgl_test}}</td>
                        <td>{{$item->nama_peserta}}</td>
                        <td>{{$item->nama_sekolah}}</td>
                        <td>{{$item->nama_tingkat}}</td>
                        <td><center>
                            {{-- <div class="form-check">
                                <input class="my-ju" type="checkbox" value="{{$item->fee}}">
                                <label class="form-check-label">{{$item->fee}}</label>
                              </div> --}}
                            {{-- <input class="check" type="checkbox" value="{{$item->fee}}"> --}}
                            <input onClick="this.form.total_tagihan.value=checkChoice(this);" type="checkbox" value="{{$item->fee}}">
                            {{$item->fee}}
                        </center></td>
                        <td><center>
                            <input type="checkbox" name="id_peserta[]" value="{{$item->id_peserta}},{{$item->id_sekolah}}" required>
                        </center></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{-- <input name="Check_All" value="Ceklis Semua" onclick="check_all()" type="button" class="btn btn-warning">
            <input name="Un_CheckAll" value="Hilangkan Ceklis" onclick="uncheck_all()" type="button" class="btn btn-warning">
            <button type="submit" class="btn btn-info ">
                Hitung Pembayaran
            </button> --}}
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Tanggal Invoice</label>
                        <input type="text" class="form-control" name="tgl_invoice" value="{{$dt}}" readonly>
                    </div>  
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Nominal</label>
                        {{-- <input type="text" name="total" value=""  readonly> --}}
                        {{-- <input type=hidden name=hiddentotal value=0> --}}
                        <input type="text" name="total_tagihan" class="form-control" placeholder="Pilih di kolom fee" required readonly>
                        <input type=hidden name=hiddentotal_tagihan value=0>
                        {{-- <input type="text" name="total_tagihan" id="amount" class="form-control" placeholder="Pilih di kolom fee" required readonly> --}}
                    </div>  
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>No. Invoice</label>
                        <input type="text" class="form-control" name="no_invoice" value="{{$kode}}" required readonly>
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" cols="10" rows="3" required></textarea>
                    </div> 
                </div>
            </div>
            <button type="submit" class="btn btn-info btn-block">
                Simpan
            </button>
        </div>
        </form>
    </div>

    
</section>
<script type="text/javascript">
        $(document).ready(function() {        
            $(".my-class").click(function(event) {
                var total = 0;
                $(".my-class:checked").each(function() {
                    total += parseInt($(this).val());
                });
                
                if (total == 0) {
                    $('#amount').val('');
                } else {                
                    $('#amount').val(total);
                }
            });
        });    
        function check_all()
        {
            var chk = document.getElementsByName('nominal[]');
            for (i = 0; i < chk.length; i++)
            chk[i].checked = true ;
        }

        function uncheck_all()
        {
            var chk = document.getElementsByName('nominal[]');
            for (i = 0; i < chk.length; i++)
            chk[i].checked = false ;
        }
        
</script>

<script language="JavaScript">
    function checkChoice(whichbox){
     with (whichbox.form){
      if (whichbox.checked == false)
       hiddentotal_tagihan.value = eval(hiddentotal_tagihan.value) - eval(whichbox.value);
      else
       hiddentotal_tagihan.value = eval(hiddentotal_tagihan.value) + eval(whichbox.value);
       return(formatCurrency(hiddentotal_tagihan.value));
     }
    }
    function formatCurrency(num){
     num = num.toString().replace(/\$|\,/g,'');
     if(isNaN(num)) num = "0";
      cents = Math.floor((num*100+0.5)%100);
      num = Math.floor((num*100+0.5)/100).toString();
     if(cents < 10) cents = "0" + cents;
      for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
      num = num.substring(0,num.length-(4*i+3))+num.substring(num.length-(4*i+3));
    //   num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));
      return ( num );
    //   return ("Rp. " + num + "," + cents);
    }
</script>
@endsection