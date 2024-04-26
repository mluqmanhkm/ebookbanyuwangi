{{-- @if ($user->role == '1') --}}
@if (auth()->user()->role == '1')

<li class="nav-small-cap">
  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
  <span class="hide-menu">Home</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-layout-dashboard"></i>
    </span>
    <span class="hide-menu">Dashboard</span>
  </a>
</li>
<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Data Master</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('ebook.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-article"></i>
    </span>
    <span class="hide-menu">E-Book</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('kategori.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-alert-circle"></i>
      </span>
      <span class="hide-menu">Kategori</span>
    </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="#" aria-expanded="false">
    <span>
      <i class="ti ti-cards"></i>
    </span>
    <span class="hide-menu">Laporan Jumlah Pembaca</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="#" aria-expanded="false">
    <span>
      <i class="ti ti-file-description"></i>
    </span>
    <span class="hide-menu">Laporan Ulasan</span>
    </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="#" aria-expanded="false">
    <span>
      <i class="ti ti-typography"></i>
    </span>
    <span class="hide-menu">Banner</span>
  </a>
</li>
<li class="nav-small-cap">
  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
  <span class="hide-menu">AUTH</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="#" aria-expanded="false">
    <span>
      <i class="ti ti-login"></i>
    </span>
    <span class="hide-menu">Data Pembaca</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="#" aria-expanded="false">
    <span>
      <i class="ti ti-user-plus"></i>
    </span>
    <span class="hide-menu">Data Admin</span>
  </a>
</li>
<li class="nav-small-cap">
  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
  <span class="hide-menu">EXTRA</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="#" aria-expanded="false">
    <span>
      <i class="ti ti-mood-happy"></i>
    </span>
    <span class="hide-menu">Log Aktivitas</span>
  </a>
</li>

{{-- @elseif ($user->role == '2') --}}
@elseif (auth()->user()->role == '2')

<li class="nav-small-cap">
  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
  <span class="hide-menu">Home</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-layout-dashboard"></i>
    </span>
    <span class="hide-menu">Dashboard</span>
  </a>
</li>
<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Data Master</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('ebook.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-article"></i>
    </span>
    <span class="hide-menu">E-Book</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('kategori.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-alert-circle"></i>
      </span>
      <span class="hide-menu">Kategori</span>
    </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="#" aria-expanded="false">
    <span>
      <i class="ti ti-cards"></i>
    </span>
    <span class="hide-menu">Laporan Jumlah Pembaca</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="#" aria-expanded="false">
    <span>
      <i class="ti ti-file-description"></i>
    </span>
    <span class="hide-menu">Laporan Ulasan</span>
    </a>
</li>

@endif