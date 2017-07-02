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

            $content = $connection->get('search/tweets', array("q" => (isset($_GET['query']))?$_GET['query']:"jember","count"=>$limit,'max_id'=>$max_id));
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid uk-grid-width-medium-1-4" data-uk-grid-margin>
                @for($j=0;$j<count($results);$j++)
                    @foreach($results[$j]->statuses as $result)
                        <div>
                            <div class="md-card md-card-hover md-card-overlay">
                                <div class="md-card-toolbar">
                                    <h3 class="md-card-toolbar-heading-text">
                                        @
                                        {{$result->user->screen_name}}
                                    </h3>
                                    <div class="md-card-toolbar-actions">
                                        <i class="md-icon material-icons md-color-blue-grey-500">&#xE0C8;</i>
                                    </div>
                                </div>
                                <div class="md-card-content truncate-text">
                                    {{$result->text}}
                                </div>
                                <div class="md-card-overlay-content">
                                    <div class="uk-clearfix md-card-overlay-header">
                                            <i class="md-icon md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                        <h3>
                                            Klasifikasi
                                        </h3>
                                    </div>

                                    <form method="POST" action="/ahlibahasaclassification">
                                        {{ csrf_field() }}
                                        @php $date = new DateTime($result->created_at); @endphp
                                        <input type="hidden" value="{{$result->user->screen_name}}" name="username">
                                        <input type="hidden" value="{{$result->text}}" name="tweet">
                                        <input type="hidden" value="{{$date->format("Y-m-d h:m:s")}}" name="post_time">
                                        <div class="klasifikasi">
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-1 uk-width-large-1-1">
                                                        <select id="select_demo_1" name="manual_sentimen_label" data-md-selectize>
                                                            <option value="">Sentimen</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Negatif">Negatif</option>
                                                            <option value="Netral">Netral</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="klasifikasi">
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-1 uk-width-large-1-1">
                                                        <select id="select_demo_1" name="manual_category_label" data-md-selectize>
                                                            <option value="">Kategori</option>
                                                            <option value="Pekerjaan">Pekerjaan</option>
                                                            <option value="Pendapatan Rumah Tangga">Pendapatan Rumah Tangga</option>
                                                            <option value="Kondisi Rumah dan Aset">Kondisi Rumah dan Aset</option>
                                                            <option value="Pendidikan">Pendidikan</option>
                                                            <option value="Kesehatan">Kesehatan</option>
                                                            <option value="Keharmonisan Keluarga">Keharmonisan Keluarga</option>
                                                            <option value="Hubungan Sosial">Hubungan Sosial</option>
                                                            <option value="Ketersediaan Waktu Laung">Ketersediaan Waktu Luang</option>
                                                            <option value="Kondisi Lingkungan">Kondisi Lingkungan</option>
                                                            <option value="Kondisi Keamanan">Kondisi Keamanan</option>
                                                            <option value="Tidak Terkategori">Tidak Terkategori</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="klasifikasi">
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-1 uk-width-large-1-1">
                                                        <select id="select_demo_1" name="jenis" data-md-selectize>
                                                            <option value="">Fungsi Data</option>
                                                            <option value="1">Data Training</option>
                                                            <option value="2">Data Testing</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="klasifikasi">
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-1 uk-width-large-1-1">
                                                        <button type="submit" class="md-btn md-btn-primary md-btn-block" href="#">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endfor

            </div>
        </div>
    </div>
    <style>
        .klasifikasi{
            margin-top:0px;
        }
    </style>


@endsection