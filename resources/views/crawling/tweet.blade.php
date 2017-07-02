@extends('layouts.afterlogin')
@section('konten')
    <?php
    require_once 'twitteroauth/twitteroauth.php';
    define('CONSUMER_KEY', '2m6gNr9B6XY9btj8JyWw9n85Y'); //isikan dengan CONSUMER_KEY anda
    define('CONSUMER_SECRET', 'zH3oKZ1SyidyY5jyJKTBOWry1J7W2zZEABOXQwrqsHh5od5nVa'); //isikan dengan CONSUMER_KEY anda
    define('ACCESS_TOKEN', '3014251646-MakM1YrlHcQWab2arBvmB3lYoQfkZU7l4pnscX0'); //isikan dengan CONSUMER_KEY anda
    define('ACCESS_TOKEN_SECRET', 'sYT1x5fRXfhs6ZUJECQ8ctkgsrHBkqXd1ae4jfwZYsmNi'); //isikan dengan CONSUMER_KEY anda

    function search()
    {
        $limit = (isset($_GET['jumlahtweet']))?$_GET['jumlahtweet']:100;
        $max_id = null;
        $count=100;
        $contents = array();
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
        for ($i = 0; $i < $limit; $i += $count) {

            $content = $connection->get('search/tweets', array(
                    "q" => (isset($_GET['query']))?$_GET['query']:"jember",
                    "count"=>$limit,
                    'max_id'=>$max_id,
                    'lang'=>'id'
                    ));
            $contents[] = $content;
            // this indicates the last index of $content array
            if(count($content->statuses)>0)
            $max_id=($content->statuses[count($content->statuses)-1]->id_str);
//            if (count($content)) {
//                $last_tweet = end($content);
//
//                $max_id = $content[count($content) - 1]->id_str;
//            } else $max_id = null;
        }
        return $contents;
    }

    $results = search();
//            $res=array();
//            for($i=0;$i<count($results);$i++){
//                $res[]=$results[$i];
//            }
//            dd($res);
//    function search($query)
//    {
//        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
//        return $connection->get('search/tweets', $query);
//    }
//
//
//    $query = array(
//            "q" => (isset($_GET['query']))?$_GET['query']:"",
//            "count"=>(isset($_GET['jumlahtweet']))?$_GET['jumlahtweet']:"0",
//            "geocode"=>"-8.1845,113.6681,20km"
//    );
//
//    $results = search($query);
//            dd($results);
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
                                                <div class="uk-width-medium-1-1">
                                                    <label>Query</label>
                                                    <input type="text" id="query" name="query" class="md-input" value="{{(isset($_GET['query']))?$_GET['query']:""}}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-1">
                                                    <label>Jumlah Tweet</label>
                                                    <input type="text" id="jumlahtweet" name="jumlahtweet" class="md-input" value="{{(isset($_GET['jumlahtweet']))?$_GET['jumlahtweet']:"0"}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-1 uk-text-center">
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
                                        <th>No</th>
                                        <th><input type="checkbox" name="mailbox_select_all" id="mailbox_select_all" data-md-icheck />
                                            </th>
                                        <th>User</th>
                                        <th>Tweet</th>
                                        <th width="15%">Waktu Post</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @for($j=0;$j<count($results);$j++)
                                    @foreach($results[$j]->statuses as $result)

                                        <?php
//                                        dd($result->created_at);
                                        $date = new DateTime($result->created_at);?>
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><div class="md-card-list-item-select">
                                                    <input type="checkbox" name="tweet[]" value="{{$result->text}};{{$result->user->screen_name}};{{$date->format("Y-m-d h:m:s")}}" id="ceklist" data-md-icheck />
                                                </div></td>
                                            <td>{{$result->user->screen_name}}</td>
                                            <td>{{$result->text}}</td>
                                            <td>{{$date->format("d M Y h:i:s")}}</td>
                                            @php $i++;@endphp
                                        </tr>
                                    @endforeach
                                        @endfor
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