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
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="card card-info">
          <div class="card-header with-border">
            <h3 class="card-title"><b>Ubah Password</b></h3>
          </div>

          <form class="form-horizontal" role="form" method="POST" action="/pwd_psrt/{{$adm}}">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                  <label >Password lama</label>
                      <input type="text" class="form-control" name="oldpassword" value="{{ old('oldpassword') }}" placeholder="Masukan password lama anda" required autofocus>

                      @if ($errors->has('oldpassword'))
                          <span class="help-block">
                              <strong>{{ $errors->first('oldpassword') }}</strong>
                          </span>
                      @endif
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label >Password Baru</label>
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password Min. 7 karakter" required>
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
              </div>

              <div class="form-group">
                  <label >Konfirmasi Password</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi password" required>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-info pull-right" type="submit">Simpan</button>
              <input type="hidden" name="_method" value="PUT">
              <a href="{{ url('home') }}" class="btn btn-default">Kembali</a>
            </div>
          </form>
      </div>
    </div>
  </div>
</section>
@endsection
