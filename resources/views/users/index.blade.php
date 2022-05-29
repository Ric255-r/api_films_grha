@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Film Favourite Anda</h3>
        </div>
        <div class="col-md-12">

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gambar Films</th>
                    <th scope="col">Nama Films</th>
                    <th scope="col">Status Film</th>
                    <th scope="col">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($fav as $value)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img src="{{ asset('gambar_films/'.$value->gambar_films) }}" alt="" srcset="" style="height: 100px; width: 100px;"></td>
                            <td>{{ $value->nama_films }}</td>
                            <td>{{ $value->status_films }}</td>
                            <td>
                                <form action="/api/favourite_user/{{ $value->films_id }}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Hapus Dari Favorit" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>                        
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-5">
            <h3>Rating Anda</h3>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gambar Films</th>
                    <th scope="col">Nama Films</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Pesan</th>
                    <th scope="col">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($rating as $value)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img src="{{ asset('gambar_films/'.$value->gambar_films) }}" alt="" srcset="" style="height: 100px; width: 100px;"></td>
                            <td>{{ $value->nama_films }}</td>
                            <td>{{ $value->rating }}</td>
                            <td>{{ $value->pesan }}</td>
                            <td>
                                <form action="/api/rating/{{ $value->films_id }}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Hapus Rating" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>                        
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection