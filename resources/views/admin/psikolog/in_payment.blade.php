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
            <h3 class="card-title">Input Payment Psikolog</h3>
        </div>
        <form action="{{url('calculate_payment')}}" method="post">
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
                        <th><center>Bayaran</center></th>
                        <th><center>Fee</center></th>
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
                            @if ($item->bayaran=='no')
                                <span class="badge bg-red">Belum</span>
                            @elseif($item->bayaran=='yes')
                                <span class="badge bg-green">Sudah</span>
                            @endif
                        </center></td>
                        <td><center>
                            <input onClick="this.form.nominal.value=checkChoice(this);" type="checkbox" value="{{$item->fee}}">
                            {{$item->fee}}
                        </center></td>
                        <td><center>
                            @if ($item->bayaran=='no')
                                <input type="checkbox" name="bayaran[]" value="{{$item->id_trans_pesertatest}},yes">
                            @elseif($item->bayaran=='yes')

                            @endif
                        </center></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                      <label>Tanggal Bayar</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" name="tgl_bayar" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                      
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <label>Nominal</label>
                      <input type="text" name="nominal" class="form-control" placeholder="Pilih di kolom fee" required readonly>
                      <input type=hidden name=hiddennominal value=0>
                      {{-- <input type="text" name="nominal" id="amount" class="form-control" placeholder="Klik Calculate" required readonly> --}}
                      {{-- <input type="hidden" class="form-control" id="amount" name="nominal" placeholder="Klik Calculate" required > --}}
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <label>No. Transfer</label>
                      <input type="number" class="form-control" name="no_trf" placeholder="Masukan Nomor Transfer" required>
                  </div>
              </div>
            </div>
            <div class="row">
              <button type="submit" class="btn btn-info btn-block">
                  Simpan
              </button>
            </div>
        </div>
        </form>
    </div>
</section>
<script type="text/javascript">
        // $(document).ready(function() {
        //     $(".my-activity").click(function(event) {
        //         var total = 0;
        //         $(".my-activity:checked").each(function() {
        //             total += parseInt($(this).val());
        //         });
        //
        //         if (total == 0) {
        //             $('#amount').val('');
        //         } else {
        //             $('#amount').val(total);
        //         }
        //     });
        // });
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
{{-- <script language="javascript">
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
</script> --}}

<script language="JavaScript">
    function checkChoice(whichbox){
     with (whichbox.form){
      if (whichbox.checked == false)
       hiddennominal.value = eval(hiddennominal.value) - eval(whichbox.value);
      else
       hiddennominal.value = eval(hiddennominal.value) + eval(whichbox.value);
       return(formatCurrency(hiddennominal.value));
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
