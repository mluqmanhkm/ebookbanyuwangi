@extends('admin.layout.main')
@section('title', 'Dashboard')

@section('isi')
<h5>Dashboard</h5>
{{-- <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Sample Page</h5>
      <p class="mb-0">This is a sample page </p>
    </div>
  </div> --}}
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Ebook</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ebook }} Ebook</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Kategori</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kategori }} Kategori Ebook</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Baca Ebook</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalbaca }} Kali</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @if ($user->role == '1') --}}
    @if (auth()->user()->role == '1')
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                          Akun Admin</div>
                      {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahAdmin }}</div> --}}
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ auth()->user()::where('role', 2)->count() }}</div>
                  </div>
                  <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                  </div>
              </div>
          </div>
      </div>
    </div> 

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Akun Pembaca</div>
                        {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahPembaca }}</div> --}}
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ auth()->user()::where('role', 3)->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
      </div> 
    @endif

    
    
</div>
@endsection

