@extends('layouts.afterlogin')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">

            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h3 class="heading_a">Date range</h3>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-large-1-2 uk-width-medium-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_start">Start Date</label>
                                        <input class="md-input" type="text" id="uk_dp_start">
                                    </div>
                                </div>
                                <div class="uk-width-large-1-2 uk-width-medium-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_end">End Date</label>
                                        <input class="md-input" type="text" id="uk_dp_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-1-1  ">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Indeks Kebahagiaan</h4>
                            <canvas id="distribusi_sentimen"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Indeks</th>
                            <th>Tanggal</th>
                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @php $i=0; @endphp
                        @foreach($happiness as $happy)

                            <tr>
                                <td>{{$happy->index}}</td>
                                <td>{{$happy->date}}</td>
                                <td class="uk-text-center">
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/streaming/delete/{{$happy->id}}' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                                @php $i++;@endphp
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-1">
                            <a class="md-btn md-btn-danger md-btn-block" href="/streaming/klasifikasi">Klasifikasi Hari Ini</a>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var sentimenData = {
                    labels : [
                        @foreach($happiness as $ik)
                                '{{$ik->date}}',
                        @endforeach
                    ],
                    datasets : [
                        {
                            data : [
                                @foreach($happiness as $ik)
                                        '{{$ik->index}}',
                                @endforeach
                            ]
                        }
                    ]

                }
                var s=new Chart(document.getElementById("distribusi_sentimen"), {
                    type: 'line',
                    data: sentimenData,
                    options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Sentimen Data'
                        }
                    }
                });
            </script>
        </div>
    </div>
@endsection