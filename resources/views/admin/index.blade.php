@extends('layouts.app')

@section('content')
@if(Auth::check())
    @if(Auth::user()->status_user == 'ADMIN')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 text-right">
                    <a href="/tambah_films" class="text-right">Tambah Data</a>

                </div>
                <div class="col-md-12">
                    <h3>Daftar FIlm</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gambar Films</th>
                            <th scope="col">Nama Films</th>
                            <th scope="col">Status Films</th>
                            <th scope="col">Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($film as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->gambar_films }}</td>
                                    <td>{{ $item->nama_films }} </td>
                                    <td>{{ $item->status_films }}</td>
                                    <td><a href="/edit_films/{{ $item->id }}" class="btn btn-info">Edit</a></td>
                                    <td><form action="api/delete_films/{{ $item->id }}" method="post" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @else
        <script>
            alert('Kamu Tidak Memiliki Hak Akses');
            window.location.href='/home';
        </script>
    @endif

@else
    <script>
        alert('Login dulu Yaa!');
        window.location.href='/login'
    </script>
@endif

@endsection
