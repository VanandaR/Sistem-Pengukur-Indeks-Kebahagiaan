@extends('.layouts.afterlogin')
@section('judul','Tabel Data Testing')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Data Testing</h4>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-1-1  ">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Distribusi</h4>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-large-1-4">
                                    <canvas id="distribusi_sentimen"></canvas>
                                </div>
                                <div class="uk-width-large-1-4">
                                    <canvas id="distribusi_category"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Username</th>
                            <th>Tweet</th>
                            <th>Post Time</th>
                            <th>Manual Sentimen</th>
                            <th>Manual Kategori</th>
                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @php $i=0; @endphp

                        @foreach($datatesting as $dt)
                            <tr>
                                @php $i++;@endphp
                                <td>{{$i}}</td>
                                <td>{{$dt->user}}</td>
                                <td>{{$dt->tweet}}</td>
                                <td>{{$dt->post_time}}</td>
                                <td>{{$dt->classification->manual_sentimen_label}}</td>
                                <td>{{$dt->classification->manual_category_label}}</td>
                                <td class="uk-text-center">
                                    <a href="/datatesting/edit/{{$dt->id}}"><i class="md-icon material-icons">edit</i></a>
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/datatesting/delete/{{$dt->id}}' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var sentimenData = {
            labels : [
                @foreach($distribusisentimen as $ds)
                        '{{$ds->manual_sentimen_label}}',
                @endforeach

            ],
            datasets : [
                {
                    backgroundColor: ["#2196F3", "#4CAF50","#f44336","#009688"],
                    data : [
                        @foreach($distribusisentimen as $ds)
                        {{$ds->total}},
                        @endforeach
                    ]
                }
            ]

        }
        var categoryData = {
            labels : [
                @foreach($distribusicategory as $dc)
                        '{{$dc->manual_category_label}}',
                @endforeach

            ],
            datasets : [
                {
                    backgroundColor: ["#f44336", "#E91E63",
                        "#9C27B0", "#673AB7", "#3F51B5", "#2196F3", "#03A9F4", "#00BCD4", "#009688", "#4CAF50",'#8BC34A'],
                    data : [
                        @foreach($distribusicategory as $dc)
                        {{$dc->total}},
                        @endforeach
                    ]
                }
            ]

        }
        var s=new Chart(document.getElementById("distribusi_sentimen"), {
            type: 'pie',
            data: sentimenData,
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Sentimen Data'
                }
            }
        });
        var s=new Chart(document.getElementById("distribusi_category"), {
            type: 'pie',
            data: categoryData,
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Kategori Data'
                }
            }
        });
        //        var myPieChart = new Chart(document.getElementById("distribusi_sentimen"), {
        //            type: 'pie',
        //            data: {
        //                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        //                datasets: [{
        //                    label: "Population (millions)",
        //                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
        //                    data: [2478,5267,734,784,433]
        //                }]
        //            },
        //            options: {
        //                title: {
        //                    display: true,
        //                    text: 'Predicted world population (millions) in 2050'
        //                }
        //            }
        //        });
        //        var distribisisentimen = new Chart(document.getElementById("distribusi_sentimen").getContext("2d")).Bar(sentimenData);
        //        var distribisikategori = new Chart(document.getElementById("distribusi_category").getContext("2d")).Bar(categoryData);
    </script>
@endsection

