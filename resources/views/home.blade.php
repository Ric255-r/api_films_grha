@extends('layouts.app')

@section('content')
    @if(Auth::user()->status_user == 'ADMIN')
        <script>window.location.href='/admin'</script>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3>Film Yang Tersedia</h3>
                </div>
                @foreach($sedang_tayang as $value)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('gambar_films/'.$value->gambar_films) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $value->nama_films }}</h5>

                                @if($value->isFavourite())
                                    {{-- Hapus Dari Favorite --}}
                                    <form action="/api/favourite_user/{{ $value->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Hapus Dari Favorit" class="btn btn-danger">
                                    </form>
                                @else
                                    <form action="/api/favourite_user" method="post" class="d-inline-block">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="films_id" value="{{ $value->id }}">
                                        <input type="submit" value="Tambah Sebagai Favorit" class="btn btn-primary">
                                    </form>
                                @endif
                                @php
                                    $coba = false;
                                @endphp

                                @foreach($auth_rating as $auth)
                                    @php
                                        if($value->id == $auth->films_id){
                                            if(Auth::user()->id == $auth->user_id) {
                                                $coba = true;
                                                break;
                                            }
                                        } else {
                                            $coba = false;
                                        }
                                    @endphp
                                @endforeach

                                @if($coba == false)
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#ModalRatingFilm-{{ $value->id }}">
                                            Rating Film Ini
                                        </button>
                                    </div>
                                @endif
                                
                                {{-- <div class="mt-2">
                                    <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#ModalRatingFilm-{{ $value->id }}">
                                        Rating Film Ini
                                    </button>
                                </div> --}}

                                @foreach($rating as $key1)
                                    @if($value->id == $key1->films_id)
                                        @php
                                            $hasil = $key1->rating / $key1->jumlah_user;

                                        @endphp
                                        <br>
                                        Rating : {{ $hasil }} ({{ $key1->jumlah_user }})
                                        {{-- {{ $key1->rating }}
                                        {{ $key1->jumlah_user }} --}}

                                    @endif

                                @endforeach

                                <div class="modal fade" id="ModalRatingFilm-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Rating Film {{ $value->nama_films }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/api/rating" method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="col-sm-12 text-center">
                                                        <label for="1">
                                                            <input type="radio" name="rating" id="" class="" value="1" required>
                                                            <br>
                                                            1
                                                        </label>
                                                        <label for="1">
                                                            <input type="radio" name="rating" id="" class="" value="2">
                                                            <br>
                                                            2
                                                        </label>
                                                        <label for="1">
                                                            <input type="radio" name="rating" id="" class="" value="3">
                                                            <br>
                                                            3
                                                        </label>
                                                        <label for="1">
                                                            <input type="radio" name="rating" id="" class="" value="4">
                                                            <br>
                                                            4
                                                        </label>
                                                        <label for="1">
                                                            <input type="radio" name="rating" id="" class="" value="5">
                                                            <br>
                                                            5
                                                        </label>
                                                        <br>
                                                    </div>
                                                    <div class="col-sm-12 mt-3">
                                                        <label for="pesan" style="text-align: left !important">Pesan</label>
                                                        <textarea name="pesan" id="pesan" cols="30" rows="10" class="form-control" required></textarea>
                                                    </div>
                                                    <div class="col-sm-12 mt-3">
                                                        <input type="hidden" name="films_id" id="films_id" value="{{ $value->id }}">
                                                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                                        <input type="submit" value="Kirim" class="btn btn-primary form-control">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>   
                @endforeach

            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                    <h3>Film Yang Akan Datang</h3>
                </div>
                @foreach($coming_soon as $value)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('gambar_films/'.$value->gambar_films) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $value->nama_films }}</h5>

                                    @if($value->isFavourite2())
                                        {{-- Hapus Dari Favorite --}}
                                        <form action="/api/favourite_user/{{ $value->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Hapus Dari Favorit" class="btn btn-danger">
                                        </form>
                                    @else
                                        <form action="/api/favourite_user" method="post" class="d-inline-block">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="films_id" value="{{ $value->id }}">
                                            <input type="submit" value="Tambah Sebagai Favorit" class="btn btn-primary">
                                        </form>
                                    @endif                            
                            </div>
                        </div>
                        
                    </div>   
                @endforeach

            </div>
        </div>
    @endif

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
