<?php

namespace App\Http\Controllers;

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
        if(Auth::user()->role_id==2){
            return view('crawling.tweet2');
        }else{
            return view('crawling.tweet');
        }

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
    }

}
