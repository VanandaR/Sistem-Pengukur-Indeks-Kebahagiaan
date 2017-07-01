@extends('layouts.afterlogin')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="">
                            <h3>Selamat Datang {{Auth::user()->role->nama}}, {{Auth::user()->name}}</h3>
                            </div>
                            @if(Auth::user()->role_id==2)
                            <p>Sudah tahu tugas ahli bahasa? Jika belum silahkan klik <a href="/FAQ">FAQ</a>.</p>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-1">
                                        <a class="md-btn md-btn-danger md-btn-block" href="/tweet">Mulai Klasifikasi</a>
                                    </div>
                                </div>
                                <style>

                                </style>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection