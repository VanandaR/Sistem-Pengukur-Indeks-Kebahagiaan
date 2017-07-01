@extends('.layouts.afterlogin')
@section('judul','Edit Data Training')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Edit Data Training</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <form method="post" action="/datatesting/update">
                        {{ csrf_field() }}
                        <div class="uk-form-row">
                            <input type="hidden" value="<?php echo $datatesting->id;?>" name="id">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1">
                                    <label for="message">Tweet</label>
                                    <textarea disabled class="md-input" name="tweet" cols="10" rows="3" data-parsley-validation-threshold="10">{{$datatesting->tweet}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1 uk-width-large-1-1">
                                    <select id="select_demo_1" name="manual_sentimen_label" data-md-selectize>

                                        <option value="">Sentimen</option>

                                        <option value="Positif" {{($datatesting->classification->manual_sentimen_label=='positif')?"selected":""}}>Positif</option>
                                        <option value="Negatif" {{($datatesting->classification->manual_sentimen_label=='negatif')?"selected":""}}>Negatif</option>
                                        <option value="Netral" {{($datatesting->classification->manual_sentimen_label=='netral')?"selected":""}}>Netral</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="uk-form-row">
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1 uk-width-large-1-1">
                                    <select id="select_demo_1" name="manual_category_label" data-md-selectize>
                                        <option value="">Kategori</option>
                                        <option value="Pekerjaan" {{($datatesting->classification->manual_category_label=='pekerjaan')?"selected":""}}>Pekerjaan</option>
                                        <option value="Pendapatan Rumah Tangga" {{($datatesting->classification->manual_category_label=='pendapatan rumah tangga')?"selected":""}}>Pendapatan Rumah Tangga</option>
                                        <option value="Kondisi Rumah dan Aset" {{($datatesting->classification->manual_category_label=='kondisi rumah dan aset')?"selected":""}}>Kondisi Rumah dan Aset</option>
                                        <option value="Pendidikan" {{($datatesting->classification->manual_category_label=='pendidikan')?"selected":""}}>Pendidikan</option>
                                        <option value="Kesehatan" {{($datatesting->classification->manual_category_label=='kesehatan')?"selected":""}}>Kesehatan</option>
                                        <option value="Keharmonisan Keluarga" {{($datatesting->classification->manual_category_label=='keharmonisan keluarga')?"selected":""}}>Keharmonisan Keluarga</option>
                                        <option value="Hubungan Sosial" {{($datatesting->classification->manual_category_label=='hubungan sosial')?"selected":""}}>Hubungan Sosial</option>
                                        <option value="Ketersediaan Waktu Luang" {{($datatesting->classification->manual_category_label=='ketersediaan waktu luang')?"selected":""}}>Ketersediaan Waktu Luang</option>
                                        <option value="Kondisi Lingkungan" {{($datatesting->classification->manual_category_label=='kondisi lingkungan')?"selected":""}}>Kondisi Lingkungan</option>
                                        <option value="Kondisi Keamanan" {{($datatesting->classification->manual_category_label=='kondisi keamanan')?"selected":""}}>Kondisi Keamanan</option>
                                        <option value="Tidak Terkategori" {{($datatesting->classification->manual_category_label=='tidak terkategori')?"selected":""}}>Tidak Terkategori</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class=" uk-text-right" style="border-top:1px solid rgba(0,0,0,.12); margin-top: 20px; padding-top:20px">
                            <a href="/datatesting/tabel" class="md-btn md-btn-flat uk-modal-close">Close</a><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

