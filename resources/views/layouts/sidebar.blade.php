@if ((Auth::user()->role ==1))
    <li class="nav-item">
        <a href="/home" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard</p></a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>Master<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/data_sekolah" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Sekolah</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/data_tingkat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Tingkat</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/data_peserta" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Peserta</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/peserta_sekolah" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tagihan Peserta</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>Psikolog<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/data_psikolog" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Psikolog</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/peserta_test" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Peserta Test</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>Master User<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ url('user') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>User Psikolog</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('user_peserta') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>User Peserta Test</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Laporan<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Parameter Laporan<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('level_kcd')}}" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level Kecerdasan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('gaya_belajar')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Gaya Belajar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('rekomendasi')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Rekomendasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('psikogram')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Group Psikogram</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('aspek_psikologis')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Aspek Psikologis</p>
                    </a>
                </li>
            </ul>
        </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>Master Soal<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/no_master_soal" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nomor Master Soal</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/tipe_test" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tipe Test</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/soal" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Soal</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/jawaban" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>jawaban</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="/select_test" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>Tentukan Test Sekolah</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/result_test" class="nav-link">
          <i class="nav-icon fas fa-clipboard-list"></i>
          <p>Hasil Test Peserta</p>
        </a>
    </li>
@elseif ((Auth::user()->role ==2))
  <li class="nav-item">
      <a href="/home" class="nav-link">
      <i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard</p></a>
  </li>
  <li class="nav-item">
      <a href="#" class="nav-link">
      <i class="nav-icon fas fa-th"></i>
      <p>Psikolog<i class="right fas fa-angle-left"></i></p>
      </a>
      <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="/peserta_test_psi" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Peserta Test</p>
              </a>
          </li>
      </ul>
  </li>
@elseif ((Auth::user()->role ==3))
  <li class="nav-item">
      <a href="/home" class="nav-link">
      <i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard</p></a>
  </li>
  <li class="nav-item">
      <a href="{{url('ambil_tes')}}" class="nav-link">
      <i class="nav-icon fas fa-tasks"></i><p> Ambil tes</p></a>
  </li>
@endif
