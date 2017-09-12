@extends('layouts.afterlogin')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <div class="md-card">
                        <div class="md-card-content">
                            <form method="GET">
                            <h3 class="heading_a">Date range</h3>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-large-2-5 uk-width-medium-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_start">Start Date</label>
                                        <input class="md-input"  name="start" type="text" id="uk_dp_start" value={{(isset($_GET['start']))?$_GET['start']:""}}>
                                    </div>
                                </div>
                                <div class="uk-width-large-2-5 uk-width-medium-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_end">End Date</label>
                                        <input class="md-input" name="end" type="text" id="uk_dp_end" value={{(isset($_GET['end']))?$_GET['end']:""}}>
                                    </div>
                                </div>
                                <div class="uk-width-large-1-5 uk-width-medium-1-1  uk-text-center">
                                            <button type="submit" id="search" class="md-btn md-btn-primary uk-width-medium-1-1 uk-margin-small-top">Search</button>
                                </div>

                            </div>
                                </form>
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
            <script>
                var sentimenData = {
                    labels : [
                        @foreach($indekskebahagiaan as $nilai=>$ik)
                                '{{($nilai)}}',
                        @endforeach
                    ],
                    datasets : [
                        {
                            borderColor: ["#2196F3"],
                            data : [
                                @foreach($indekskebahagiaan as $ik)
                                        '{{$ik}}',
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
                            text: 'Indeks Kebahagiaan'
                        }
                    }
                });
            </script>
        </div>
    </div>
@endsection