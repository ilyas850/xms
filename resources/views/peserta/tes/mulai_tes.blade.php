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
  @if ($hapus = Session::get('hapus'))
      <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $hapus }}</strong>
      </div>
  @endif
  <div class="card card-info">
    <div id="waktumundur">

      @if ($time != null)
        Examination closes in <span id="time"> {{$time}} menit</span>
      @elseif ($time == null)
        Tidak ada timer
      @endif

    </div><hr>
    <div class="alert alert-info alert-dismissible">
      <h5><i class="icon fas fa-info"></i> Informasi</h5>
      @if ($ket == null)
        Kerjakan soal dengan teliti
        @else
          {{$ket}}
      @endif

    </div>

    <div class="card-header">
      <h3 class="card-title">Ujian {{$tes}}</h3>
    </div>
    <div class="card-body">
      <form class="" action="{{url('simpan_jawaban')}}" method="post">
        {{ csrf_field() }}
        <input id="idpeserta" type="hidden" name="id_peserta" value="{{$idpeserta}}">
        <div class="form-group">
          <?php $no=1; ?>
          <?php $nos=0; ?>
          @foreach ($soal as $key)

            <label for="">{{$no++}}. {{$key->soal}}</label>
            <br>
            @if ($key->gambar == null)

              @else
                <img height="250" width="250" src="{{ asset('Soal_gambar/'.$key->gambar) }}">
                <br>
            @endif
            <input id="idnomor" type="hidden" name="id_nomormaster" value="{{$key->id_nomormaster}}">
            <input id="idtest" type="hidden" name="id_tipetest" value="{{$key->id_tipetest}}">
              @foreach ($jwban as $keyj)

              <div class="form-check">
                  @if ($key->id_soal == $keyj->id_soal)
                    <input id="idjawab" class="form-check-input" type="radio" name="id_jawaban[{{$keyj->id_soal}}]" value="{{$keyj->id_jawaban}},{{$keyj->id_soal}},{{$keyj->opsi}},{{$keyj->b_s}}">
                    <label class="form-check-label">{{$keyj->opsi}}. {{$keyj->jawaban}}</label><br>
                    @if ($keyj->jawab_gambar == null)

                      @else
                        <img src="{{asset('Jawaban_gambar/'.$keyj->jawab_gambar) }}" height="100" width="100" alt="" />
                        <br>
                    @endif
                    <br>
                  @endif
              </div>
              @endforeach
              <br>
          @endforeach
        </div>
        <div class="form-group">
          <button class="btn btn-info pull-right" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
  <style scoped="" type="text/css">
    #waktumundur
    {
       background: #31266b;
       color: #fec503;
       font-size: 150%;
       text-transform: uppercase;
       text-align: center;
       padding: 20px 0;
       font-weight: bold;
       border-radius: 5px;
       line-height: 1.8em;
       font-family: Arial, sans-serif;
    }
      .digit {
       color: white
      }
      .judul {
       color: white
      }
  </style>

  <script type="text/javascript">
  function SendData(){
      let id_peserta = $("input[name=id_peserta]").val();
      let id_nomormaster = $("input[name=id_nomormaster]").val();
      let id_tipetest = $("input[name=id_tipetest]").val();
      var id_jawaban = $("input[type='radio']");
      var _token = $("input[name='_token']").val();

      var a = id_jawaban.filter(":checked");
      var result = [];
        for (i = 0; i < a.length; i++) {
          var text = a[i]['name'];
          text = text.replace("id_jawaban[", "");
          text = text.replace("]", "");

          result[text] = a[i]['value'];
        }

      $.ajax({
            url: "{{ url('simpan_jawaban') }}",
            type:"POST",
            data:{
              _token: _token,
              id_peserta:id_peserta,
              id_nomormaster:id_nomormaster,
              id_tipetest:id_tipetest,
              id_jawaban:result
            },
            success: function(data) {
              var redirect = "ambil_tes";
              window.location.href = redirect;
            }
           });
  }

  function startTimer(duration, display) {
      var timer = duration, minutes, seconds;

      setInterval(function () {
          minutes = parseInt(timer / 60, 10)
          seconds = parseInt(timer % 60, 10);

          minutes = minutes < 10 ? "0" + minutes : minutes;
          seconds = seconds < 10 ? "0" + seconds : seconds;

          display.textContent = minutes + ":" + seconds;

          if (--timer < 0) {
              timer = duration;
          }else if (timer == 0) {
              SendData();
          }
      }, 1000);
  }

  window.onload = function () {
      var fiveMinutes = 60 * {{$time}},
          display = document.querySelector('#time');
      startTimer(fiveMinutes, display);
  };
  </script>

@endsection

{{-- window.location.href = redirect; --}}
