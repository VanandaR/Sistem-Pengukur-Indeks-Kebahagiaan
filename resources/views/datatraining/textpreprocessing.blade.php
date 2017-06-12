@extends('.layouts.afterlogin')
@section('judul','Text Preprocessing')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Text Preprocessing</h3>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                                <li class="uk-active"><a href="#">Text Preprocessing</a></li>
                                <li><a href="#">Text Tranformation</a></li>
                                <li><a href="#">N-Gram</a></li>
                                <li><a href="#">N-Gram Frequency Total</a></li>
                            </ul>
                            <ul id="tabs_1" class="uk-switcher uk-margin">
                                <li>
                                    <table  class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Data Awal</th>
                                            <th>Hasil Preprocessing</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @php $i=0; @endphp

                                        @foreach($datatraining as $dt)
                                            <tr>
                                                @php $i++;@endphp
                                                <td>{{$i}}</td>
                                                <td>{{$dt->tweet}}</td>
                                                <td>
                                                    @foreach($hasilpreprocessing[$i-1] as $token)
                                                        {{$token}}
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </li>
                                <li>
                                    <table class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Hasil Preprocessing</th>
                                            <th>Stemming</th>
                                            <th>Stopword Removal</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @php $i=0; @endphp

                                        @foreach($datatraining as $dt)
                                            <tr>
                                                @php $i++;@endphp
                                                <td>{{$i}}</td>
                                                <td>
                                                    @foreach($hasilpreprocessing[$i-1] as $token)
                                                        {{$token}}
                                                    @endforeach
                                                </td>
                                                <td>
                                                        {{$hasilstemming[$i-1]}}
                                                </td>
                                                <td>
                                                    {{$hasilstopwordremoval[$i-1]}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </li>
                                <li>
                                    <table class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Hasil Stopword Removal</th>
                                            <th>N-Gram</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @php $i=0; @endphp

                                        @foreach($datatraining as $dt)
                                            <tr>
                                                @php $i++;@endphp
                                                <td>{{$i}}</td>
                                                <td>
                                                    {{$hasilstopwordremoval[$i-1]}}
                                                </td>
                                                <td>
                                                    @foreach($hasilngram[$i-1] as $ngram)
                                                        [{{$ngram}}]
                                                    @endforeach
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </li>
                                <li>
                                    <table class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>N-Gram</th>
                                            <th>Frekuensi</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @php $i=0; @endphp

                                        @foreach($hasilfrequencyngram as $fngram)
                                            <tr>
                                                @php $i++;@endphp
                                                <td>{{$i}}</td>
                                                @foreach($fngram as $fngram2)
                                                <td>
                                                    {{$fngram2}}
                                                </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

