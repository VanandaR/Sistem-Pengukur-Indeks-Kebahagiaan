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
            <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_visitors peity_data">5,3,9,6,5,9,7</span></div>
                            <span class="uk-text-muted uk-text-small">Data Tweet</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">150</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-1-1  ">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Distribusi</h4>
                            <canvas id="distribusi_sentimen"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var sentimenData = {
                    labels : [
                            '15.00-16.00','16.00-17.00','17.00-18.00'
                    ],
                    datasets : [
                        {
                            data : [
                                    0.5,0.6,0.551
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