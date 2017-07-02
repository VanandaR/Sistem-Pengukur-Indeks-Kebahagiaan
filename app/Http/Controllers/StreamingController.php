<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TwitterStreamingApi;

class StreamingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
//        TwitterStreamingApi::publicStream()
//            ->whenHears('dosis', function(array $tweet) {
//                echo "{$tweet['user']['screen_name']} tweeted {$tweet['text']}";
//            })
//            ->startListening();
//        die;
        return view('streaming.index');
    }
    public function visualisasi(){
        return view('streaming.visualisasi');
    }
}
