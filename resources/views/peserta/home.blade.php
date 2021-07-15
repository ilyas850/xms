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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard {{ $user->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Peserta
                    <p><strong>Selamat datang {{ $user->name }}!</strong> Anda telah melakukan login sebagai Peserta</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
