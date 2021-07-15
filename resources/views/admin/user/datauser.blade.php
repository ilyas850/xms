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

  {{-- notifikasi sukses hapus --}}
		@if ($hapus = Session::get('hapus'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $hapus }}</strong>
        </div>
    @endif

  <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data User Psikolog</h3>
      </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered">
            <thead>
              <tr>
                <th width="3%"><center>No</center></th>
                <th width="35%">Nama Psikolog</th>
                <th width="20%"><center>Username</center></th>
                <th><center>Status</center></th>
                <th><center>Aksi</center></th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; ?>
              @foreach($user as $item)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td>{{$item->nama_psikolog}}</td>
                  <td><center>{{$item->username}}</center></td>
                  <td>
                    <center>
                    @if (($item->role ==2))
                          Psikolog

                      @endif
                    </center>
                  </td>
                  <td>
                    <center>
                      @if (($item->username) == null)
                        <form action="{{url('generate')}}" method="post">
                          {{ csrf_field() }}
                          <input type="hidden" name="id_psikolog" value="{{$item->id_psikolog}}">
                          <input class="btn btn-info btn-xs" type="submit" value="Generate">
                        </form>
                        {{-- <a class="btn btn-info btn-xs" href="/generate/{{$item->id_psikolog}}">Generate</a> --}}
    									@elseif(($item->username != null))
                        <div class="btn-group">
                          <button type="button" class="btn btn-warning btn-xs">Pilih</button>
                          <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><form method="POST" action="{{url('resetuser')}}">
                               <input type="hidden" name="password" value="{{$item->username}}">
                               <input type="hidden" name="id" value="{{$item->id}}">
                               {{ csrf_field() }}
                               <button type="submit" class="btn btn-success btn-block btn-xs" data-toggle="tooltip" data-placement="right">Reset</button>
                             </form></li>
                            <li><form action="/hapususer/{{ $item->user_id }}" method="post">
                    					<button class="btn btn-danger btn-block btn-xs" title="klik untuk hapus" type="submit" name="submit" onclick="return confirm('apakah anda yakin akan menghapus user ini?')">Hapus</button>
                    					{{ csrf_field() }}
                    					<input type="hidden" name="_method" value="DELETE">
                    				</form></li>
                          </ul>
                        </div>

    									@endif
                    </center>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
</section>
@endsection
