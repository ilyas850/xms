@if ((Auth::user()->role ==1))
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/change_pass_adm/{{ Auth::user()->id }}" class="nav-link">Ubah Password</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"
          class="nav-link">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
    </li>
@elseif ((Auth::user()->role ==2))
  <li class="nav-item d-none d-sm-inline-block">
    <a href="/change_pass_psi/{{ Auth::user()->id }}" class="nav-link">Ubah Password</a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
        class="nav-link">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
  </li>
@elseif ((Auth::user()->role ==3))
  <li class="nav-item d-none d-sm-inline-block">
    <a href="/change_pass_psrt/{{ Auth::user()->id }}" class="nav-link">Ubah Password</a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
        class="nav-link">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
  </li>
@endif
