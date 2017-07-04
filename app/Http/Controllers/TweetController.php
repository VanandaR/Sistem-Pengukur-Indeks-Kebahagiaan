<?php

namespace App\Http\Controllers;
define('CONSUMER_KEY', '0Y9KZFaZaUI67BQ5RjBcPPhSN'); //isikan dengan CONSUMER_KEY anda
define('CONSUMER_SECRET', 'ey1LZH8xYegJ0h9EIB0m2nsD18shVcJHZtxlNfcHKdzTR5tbyK'); //isikan dengan CONSUMER_KEY anda
define('ACCESS_TOKEN', '3014251646-J0LadQ2pyEAs0xLwnhwxu5nv27gZL8of0NAPzGB'); //isikan dengan CONSUMER_KEY anda
define('ACCESS_TOKEN_SECRET', 'R06seEsYZdaPy2LkpHz54JLhLxBx0snXg2AdpPuaBipdY'); //isikan dengan CONSUMER_KEY anda
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Classification;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tweet=$this->search();
//        if(Auth::user()->role_id==2){
//            return view('crawling.tweet2',['tweet'=>$tweet]);
//        }else{
            return view('crawling.tweet',['tweet'=>$tweet]);
//        }

    }
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

    public function adddata(){
        $tweet = Input::get('tweet');
        $jenis=Input::get('jenis');
        if (is_array($tweet)){
            foreach ($tweet as $tw){
                $tweetarray=explode(";",$tw);
                $datatraining=Tweet::create([
                    'user'=>$tweetarray[1],
                    'tweet'=>$tweetarray[0],
                    'post_time'=>"$tweetarray[2]",
                    'status'=>$jenis
                ]);

                $lexicon=Classification::create([
                    'id_tweet'=>$datatraining->id,
                    'lexicon_pos_score'=>0,
                    'lexicon_neg_score'=>0,
                    'manual_sentimen_label'=>null,
                    'manual_category_label'=>null,
                    'nb_pos_probability'=>0,
                    'nb_neg_probability'=>0
                ]);
            }
        }
        return Redirect::to('/tweet');
    }
    public function ahlibahasaclassification(){

        $tweet=Tweet::create([
            'user'=>Input::get('username'),
            'tweet'=>Input::get('tweet'),
            'post_time'=>Input::get('post_time'),
            'status'=>Input::get('jenis')
        ]);

        $lexicon=Classification::create([
            'id_tweet'=>$tweet->id,
            'lexicon_pos_score'=>0,
            'lexicon_neg_score'=>0,
            'manual_sentimen_label'=>Input::get('manual_sentimen_label'),
            'manual_category_label'=>Input::get('manual_category_label'),
            'nb_pos_probability'=>0,
            'nb_neg_probability'=>0
        ]);
        return Redirect::to('/tweet?query='.$_GET['query']."&jumlahtweet=".$_GET['jumlahtweet']);
    }

}
