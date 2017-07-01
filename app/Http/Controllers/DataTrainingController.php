<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classification;
use App\Tweet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Phpml\Metric\ClassificationReport;

use Phpml\Classification\NaiveBayes;
class DataTrainingController extends TextMiningController
{
    public function index()
    {
        $datatraining=Tweet::where('status',1)->get();
        $distribusisentimen=DB::table('classifications')->join('tweets', 'id_tweet', '=', 'tweets.id')
            ->select('manual_sentimen_label',DB::raw('count(*) as total'))
            ->where('status',1)
            ->groupBy('manual_sentimen_label')->get();
        $distribusicategory=DB::table('classifications')->join('tweets', 'id_tweet', '=', 'tweets.id')
            ->select('manual_category_label',DB::raw('count(*) as total'))
            ->where('status',1)
            ->groupBy('manual_category_label')->get();
        return view('datatraining.index',['datatraining'=>$datatraining,'distribusisentimen'=>$distribusisentimen,'distribusicategory'=>$distribusicategory]);
    }
    public function textmining()
    {
        $datatraining=Tweet::where('status',1)->get();
        $hasilpreprocessing=$this->preprocessing($datatraining);
        $hasilstemming=$this->stemming($datatraining);
        $hasilstopwordremoval=$this->stopwordremoval($hasilstemming);
        $hasilngram=$this->ngram($hasilstopwordremoval);

        $b=array();
        foreach ($hasilngram as $hn){
            $b=$b+$hn;
        }
        $hasilfrequencyngram=$this->frequencyngram($b);

        return view('datatraining.textpreprocessing',['datatraining'=>$datatraining,'hasilpreprocessing'=>$hasilpreprocessing,
            'hasilstemming'=>$hasilstemming,'hasilstopwordremoval'=>$hasilstopwordremoval,'hasilngram'=>$hasilngram,
            'hasilfrequencyngram'=>$hasilfrequencyngram]);
    }
    public function update(Request $request){
        Classification::where('id_tweet', $request->id)->update([
            'manual_sentimen_label'=>$request->manual_sentimen_label,
            'manual_category_label'=>$request->manual_category_label
        ]);
        return Redirect::to('/datatraining/tabel');
    }
    public function edit($id){
        $datatraining=Tweet::find($id);
        return view('datatraining.edit',['datatraining'=>$datatraining]);
    }
    function delete($id){
        Tweet::destroy($id);
        return Redirect::to('/datatraining/tabel');
    }
    public function manual(){
        $datatraining=Tweet::where('status',1)->get();
        return view('datatraining.manual',['datatraining'=>$datatraining]);
    }
    public function labelling(Request $request){

        Classification::find($request->id)->update([
            'manual_sentimen_label'=>$request->sentimen,
            'manual_category_label'=>$request->kategori
        ]);
        return Redirect::to('/datatraining/manual');
    }
}
