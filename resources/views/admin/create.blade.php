@extends('layouts.app')

@section('content')
    @if(Auth::check())
        @if(Auth::user()->status_user == 'ADMIN')
            <div class="container">
                <div class="row justify-content-center">
                    <form action="/api/input_films" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                
                        <div class="col-md-12">
                            <label for="Nama_Films">Nama Films</label>
                            <input type="text" name="nama_films" id="nama_films" class="form-control">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="Gambar_films">Gambar Films</label>
                            <input type="file" name="gambar_films" id="gambar_films" class="form-control">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="status_films">Status Films</label>
                            <select name="status_films" id="status_films" class="form-control">
                                <option value="sedang_tayang">Sedang tayang</option>
                                <option value="coming_soon">Coming Soon</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-3">
                            <input type="submit" value="Simpan" class="btn btn-info form-control">
                        </div>
                    </form>
                </div>
            </div>
        @else
            <script>
                alert('Kamu Tidak Memiliki Hak Akses');
                window.location.href='/';
            </script>
        @endif
    @else
        <script>
            alert('Login dulu Yaa!');
            window.location.href='/login'
        </script>
    @endif
 
@endsection