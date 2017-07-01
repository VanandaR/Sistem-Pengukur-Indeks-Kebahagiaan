@extends('.layouts.afterlogin')
@section('judul','Tabel Data Testing')

@section('konten')
    <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Klasifikasi</h3>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                                <li class="uk-active"><a href="#">Klasifikasi Sentimen</a></li>
                                <li><a href="#">Klasifikasi Kategori</a></li>
                                <li><a href="#">Uji Performansi Sentimen</a></li>
                                <li><a href="#">Uji Performansi Kategori</a></li>
                            </ul>
                            <ul id="tabs_1" class="uk-switcher uk-margin">
                                <li>
                                    <table class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Tweet</th>
                                            <th>Probabilitas Positif</th>
                                            <th>Probabilitas Negatif</th>
                                            <th>Probabilitas Netral</th>
                                            <th>Klasifikasi Sentimen</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @php $i=0; @endphp

                                        @foreach($datatesting as $dt)
                                            <tr>
                                                @php $i++;@endphp
                                                <td>{{$i}}</td>
                                                <td>{{$dt->tweet}}</td>
                                                <td>{{$klasifikasisentimen[$i-1]['positif']}}</td>
                                                <td>{{$klasifikasisentimen[$i-1]['negatif']}}</td>
                                                <td>{{$klasifikasisentimen[$i-1]['netral']}}</td>
                                                <td>{{$klasifikasisentimen['hasil'][$i-1]}}</td>
                                            </tr>
                                            <div class="uk-modal" id="modal_edit_stopword{{$dt->id}}">
                                                <div class="uk-modal-dialog">
                                                    <div class="uk-modal-header">
                                                        <h3 class="uk-modal-title">Edit Stopword</h3>
                                                    </div>
                                                    <form method="post" action="/stopword/update">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="<?php echo $dt->id;?>" name="id">
                                                        <div class="uk-form-row">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>Stopword</label>
                                                                <input type="text" value="<?php echo $dt->text;?>" name="stopword" class="md-input">
                                                            </div>
                                                        </div>
                                                        <div class="uk-modal-footer uk-text-right">
                                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </li>
                                <li>
                                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Tweet</th>

                                            <th>Prob. Pekerjaan</th>
                                            <th>Prob. PRT</th>
                                            <th>Prob. KRDA</th>
                                            <th>Prob. Pendidikan</th>
                                            <th>Prob. Kesehatan</th>
                                            <th>Prob. Keluarga</th>
                                            <th>Prob. Sosial</th>
                                            <th>Prob. Waktu Luang</th>
                                            <th>Prob. Lingkungan</th>
                                            <th>Prob. Keamanan</th>
                                            <th>Prob. Tidak Terkategori</th>
                                            <th>Klasifikasi Kategori</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @php $i=0; @endphp

                                        @foreach($datatesting as $dt)
                                            <tr>
                                                {{--'pekerjaan','pendapatan rumah tangga','kondisi rumah dan aset',
                                                'pendidikan','kesehatan','keharmonisan keluarga','hubungan sosial',
                                                'ketersediaan waktu luang','kondisi lingkungan','kondisi keamanan',
                                                'tidak terkategori'--}}
                                                @php $i++;@endphp
                                                <td>{{$i}}</td>
                                                <td>{{$dt->tweet}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['pekerjaan']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['pendapatan rumah tangga']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['kondisi rumah dan aset']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['pendidikan']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['kesehatan']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['keharmonisan keluarga']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['hubungan sosial']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['ketersediaan waktu luang']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['kondisi lingkungan']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['kondisi keamanan']}}</td>
                                                <td>{{$klasifikasikategori[$i-1]['tidak terkategori']}}</td>
                                                <td>{{$klasifikasikategori['hasil'][$i-1]}}</td>
                                            </tr>
                                            <div class="uk-modal" id="modal_edit_stopword{{$dt->id}}">
                                                <div class="uk-modal-dialog">
                                                    <div class="uk-modal-header">
                                                        <h3 class="uk-modal-title">Edit Stopword</h3>
                                                    </div>
                                                    <form method="post" action="/stopword/update">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="<?php echo $dt->id;?>" name="id">
                                                        <div class="uk-form-row">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>Stopword</label>
                                                                <input type="text" value="<?php echo $dt->text;?>" name="stopword" class="md-input">
                                                            </div>
                                                        </div>
                                                        <div class="uk-modal-footer uk-text-right">
                                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </li>
                                <li>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <h3>Average</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Rata-rata</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultsentimen['average'] as $key=>$average)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$average}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Recall</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Recall</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultsentimen['recall'] as $key=>$recall)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$recall}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Precision</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Precision</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultsentimen['precision'] as $key=>$precision)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$precision}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>F1 Score</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai F1 Score</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultsentimen['f1score'] as $key=>$f1score)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$f1score}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Support</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Support</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultsentimen['support'] as $key=>$support)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$support}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <h3>Average</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Rata-rata</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultkategori['average'] as $key=>$average)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$average}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Recall</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Recall</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultkategori['recall'] as $key=>$recall)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$recall}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Precision</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Precision</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultkategori['precision'] as $key=>$precision)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$precision}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>F1 Score</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai F1 Score</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultkategori['f1score'] as $key=>$f1score)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$f1score}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Support</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Support</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($reportresultkategori['support'] as $key=>$support)
                                                    <tr>
                                                        @php $i++;@endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$support}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

