@extends('layouts.afterlogin')
@section('konten')
    <?php
    require_once 'twitteroauth/twitteroauth.php';
    define('CONSUMER_KEY', '0Y9KZFaZaUI67BQ5RjBcPPhSN'); //isikan dengan CONSUMER_KEY anda
    define('CONSUMER_SECRET', 'ey1LZH8xYegJ0h9EIB0m2nsD18shVcJHZtxlNfcHKdzTR5tbyK'); //isikan dengan CONSUMER_KEY anda
    define('ACCESS_TOKEN', '3014251646-J0LadQ2pyEAs0xLwnhwxu5nv27gZL8of0NAPzGB'); //isikan dengan CONSUMER_KEY anda
    define('ACCESS_TOKEN_SECRET', 'R06seEsYZdaPy2LkpHz54JLhLxBx0snXg2AdpPuaBipdY'); //isikan dengan CONSUMER_KEY anda

    function search($query)
    {
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
        return $connection->get('search/tweets', $query);
    }


    $query = array(
            "q" => (isset($_GET['query']))?$_GET['query']:"",
            "count"=>(isset($_GET['jumlahtweet']))?$_GET['jumlahtweet']:"0",
            "geocode"=>"-8.1845,113.6681,20km"
    );

    $results = search($query);
//    dd($results);
    ?>


    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid">
                <div class="uk-width-1-10">
                    </div>
                <div class="uk-width-8-10">
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="md-card">
                                <div class="md-card-content">
                                    <form method="GET">
                                        {{ csrf_field() }}
                                        <div class="uk-form-row">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-4-6">
                                                    <label>Query</label>
                                                    <input type="text" id="query" name="query" class="md-input" value="{{(isset($_GET['query']))?$_GET['query']:""}}" />
                                                </div>
                                                <div class="uk-width-medium-1-6">
                                                    <label>Jumlah Tweet</label>
                                                    <input type="text" id="jumlahtweet" name="jumlahtweet" class="md-input" value="{{(isset($_GET['jumlahtweet']))?$_GET['jumlahtweet']:"0"}}"/>
                                                </div>
                                                <div class="uk-width-medium-1-6 uk-text-center">

                                                    <button type="submit" id="search" class="md-btn md-btn-primary uk-width-medium-1-1 uk-margin-small-top">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                        {{--<div class="uk-width-medium-10-10">--}}
                                        {{--<form class="uk-form-stacked">--}}
                                        {{--<div class="uk-form-row">--}}
                                        {{--<label for="kUI_datetimepicker_range_start" class="uk-form-label">Start date:</label>--}}
                                        {{--<input id="kUI_datetimepicker_range_start" />--}}
                                        {{--</div>--}}
                                        {{--<div class="uk-form-row">--}}
                                        {{--<label for="kUI_datetimepicker_range_end" class="uk-form-label">End date:</label>--}}
                                        {{--<input id="kUI_datetimepicker_range_end" />--}}
                                        {{--</div>--}}
                                        {{--</form>--}}
                                        {{--</div>--}}


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md-card uk-margin-medium-bottom">
                        <form id="adddata" method="POST" action="/adddata">
                            {{ csrf_field() }}
                            <input type="hidden" value="0" name="jenis">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-hover">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" name="mailbox_select_all" id="mailbox_select_all" data-md-icheck />
                                            </th>
                                        <th>User</th>
                                        <th>Tweet</th>
                                        <th width="15%">Waktu Post</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results->statuses as $result)

                                        <?php
//                                        dd($result->created_at);
                                        $date = new DateTime($result->created_at);?>
                                        <tr>
                                            <td><div class="md-card-list-item-select">
                                                    <input type="checkbox" name="tweet[]" value="{{$result->text}};{{$result->user->screen_name}};{{$date->format("Y-m-d h:m:s")}}" id="ceklist" data-md-icheck />
                                                </div></td>
                                            <td>{{$result->user->screen_name}}</td>
                                            <td>{{$result->text}}</td>
                                            <td>{{$date->format("d M Y")}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
    <div class="md-fab-wrapper md-fab-speed-dial">
        <a class="md-fab md-fab-primary" href="#"><i class="material-icons">add</i></a>
        <div class="md-fab-wrapper-small">
            <button onclick="datatrainingsubmit()" data-uk-tooltip="{pos:'left'}" title="Jadikan Data Training" id="data_training_submit" class="md-fab md-fab-small md-fab-success" href="#"><i class="material-icons">add</i></button>
            <button onclick="datatestingsubmit()" data-uk-tooltip="{pos:'left'}" title="Jadikan Data Test" class="md-fab md-fab-small md-fab-danger" href="#"><i class="material-icons">add</i></button>
        </div>
    </div>

    <script>

        function datatrainingsubmit() {
            $("input[name='jenis']").val("1");
            $('#adddata').submit();
        }
        function datatestingsubmit() {
            $("input[name='jenis']").val("2");
            $('#adddata').submit();
        }
//        var valuetwo = $('#ceklist').getAttribute("name-value");
//        alert(valuetwo);

        //    $('#search').click(function() {
        //        var query = document.getElementById("query").value;
        //        var jumlahtweet = document.getElementById("jumlahtweet").value;
        //        var xmlhttp = new XMLHttpRequest();
        //        xmlhttp.onreadystatechange = function() {
        //            if (this.readyState == 4 && this.status == 200) {
        //                document.getElementById("txtHint").innerHTML = this.responseText;
        //            }
        //        }
        //        xmlhttp.open("GET", "gethint.php?q="+str, true);
        //        xmlhttp.send();
        //    });
    </script>
@endsection