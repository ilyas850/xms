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

  <div class="card card-info">
    <div id="waktumundur">

      @if ($time != null)
        Examination closes in <span id="time"> {{$time}} menit</span>
      @elseif ($time == null)
        Tidak ada timer
      @endif

    </div><hr>
    <div class="card-header">
      <h3 class="card-title">Ujian {{$tes}}</h3>
    </div>
    <div class="card-body">
      <form class="" action="{{url('simpan_jawaban')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id_peserta" value="{{$idpeserta}}">
        <div class="form-group">
          <?php $no=1; ?>
          <?php $nos=0; ?>
          @foreach ($soal as $key)

            <label for="">{{$no++}}. {{$key->soal}}</label>
            <input type="hidden" name="id_nomormaster" value="{{$key->id_nomormaster}}">
            <input type="hidden" name="id_tipetest" value="{{$key->id_tipetest}}">
              @foreach ($jwban as $keyj)

              <div class="form-check">
                  @if ($key->id_soal == $keyj->id_soal)
                    <input class="form-check-input" type="radio" name="id_jawaban[{{$keyj->id_soal}}]" value="{{$keyj->id_jawaban}},{{$keyj->id_soal}},{{$keyj->opsi}},{{$keyj->b_s}}">
                    <label class="form-check-label">{{$keyj->opsi}}. {{$keyj->jawaban}}</label>
                    <input type="hidden" name="" value="">
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

  function startTimer(duration, display) {
      var timer = duration, minutes, seconds;
      var redirect = "/late/{{$idtes}}";
      setInterval(function () {
          minutes = parseInt(timer / 60, 10)
          seconds = parseInt(timer % 60, 10);

          minutes = minutes < 10 ? "0" + minutes : minutes;
          seconds = seconds < 10 ? "0" + seconds : seconds;

          display.textContent = minutes + ":" + seconds;

          if (--timer < 0) {
              timer = duration;
          }else if (timer == 0) {
              window.location.href = redirect;
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
