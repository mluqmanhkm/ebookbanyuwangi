@extends('index')
@section('content')
<style>
    .card .foto {
        width: 100%;
        padding: 30px;
        height: 300px;
    }

    .btn-primary {
        border-radius: 50px;
        width: 80px;
    }

    .btn-primary:hover {
        background-color: black;
    }

    .btn-success {
        border-radius: 50px;
        width: 130px;
    }

    .btn-success:hover {
        background-color: black;
    }

    .card-body .card-text {
        margin-left: 10px;
        margin-right: 10px;
    }

    h5 {
        text-align: center;
    }
</style>
<div class="container py-5" style="margin-top: 100px; margin-left: 20px;">
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="Cari..." aria-label="Cari...">
        </div>
        <div class="col">
            <select id="kategori" name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('kategori')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-auto">
            <button class="btn btn-success">Cari</button>
        </div>
    </div>
</div>

<div class="container py-1">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($ebook as $e)
        <div class="col col-sm-3">
            <div class="card">
                <img src="{{ asset('uploads/covers/'.$e->cover) }}" class="card-img foto" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $e->judul }}</h5>
                    <p class="card-text">{{ Str::limit($e->deskripsi,100) }}</p>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <button class="btn btn-primary">Baca</button>
                    <a href="{{ route('detailebook', Crypt::encrypt($e->id)) }}"><button class="btn btn-success">Detail
                            E-Book</button>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection