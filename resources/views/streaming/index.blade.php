@extends('layouts.afterlogin')
@section('konten')
    <?php
    require_once 'twitteroauth/twitteroauth.php';
    define('CONSUMER_KEY', '0Y9KZFaZaUI67BQ5RjBcPPhSN'); //isikan dengan CONSUMER_KEY anda
    define('CONSUMER_SECRET', 'ey1LZH8xYegJ0h9EIB0m2nsD18shVcJHZtxlNfcHKdzTR5tbyK'); //isikan dengan CONSUMER_KEY anda
    define('ACCESS_TOKEN', '3014251646-J0LadQ2pyEAs0xLwnhwxu5nv27gZL8of0NAPzGB'); //isikan dengan CONSUMER_KEY anda
    define('ACCESS_TOKEN_SECRET', 'R06seEsYZdaPy2LkpHz54JLhLxBx0snXg2AdpPuaBipdY'); //isikan dengan CONSUMER_KEY anda

    function search()
    {
        $limit = (isset($_GET['jumlahtweet']))?$_GET['jumlahtweet']:100;
        $max_id = null;
        $count=100;
        $contents = array();
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
        for ($i = 0; $i < $limit; $i += $count) {

            $content = $connection->get('search/tweets', array(
                    "q" => "ayah",
                    "count"=>$limit,
                    'max_id'=>$max_id,
                    "geocode"=>"-8.1845,113.6681,20km"));
            $limit=$limit-$count;
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

//    $results = search($query);
    //    dd($results);
    ?>


    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Streaming</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Tweet</th>
                            <th width="15%">Waktu Post</th>
                        </tr>
                        </thead>


                        <tbody>
                        @php $i=0; @endphp
                        @for($j=0;$j<count($results);$j++)
                            @foreach($results[$j]->statuses as $result)

                            <?php
                            //                                        dd($result->created_at);
                            $date = new DateTime($result->created_at);?>
                            <tr>
                                <td>{{$result->user->screen_name}}</td>
                                <td>{{$result->text}}</td>
                                <td>{{$date->format("d M Y")}}</td>
                            </tr>
                        @endforeach
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>


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