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
    <div class="card card-danger">
            <div class="card-header with-border">
              <h3 class="card-title">Pilih Psikolog</h3>
            </div>
            <div class="card-body">
              <form class="form" role="form" action="{{url('view_payment')}}" method="POST">
              <div class="row">
                  {{ csrf_field() }}
                    <div class="col-4">
                  <select class="form-control" name="id_psikolog">
                    <option>-pilih psikolog-</option>
                    @foreach ($psi as $key)
                      <option value="{{$key->id_psikolog}}" >{{$key->nama_psikolog}}</option>
                    @endforeach
                  </select>
                </div>
                {{-- <input type="hidden" name="id_student" value="{{$idmhs->idstudent}}"> --}}
                    <button type="submit" class="btn btn-info " >Pilih</button>
              </div>
              </form>
            </div>
          </div>
  </section>
@endsection
