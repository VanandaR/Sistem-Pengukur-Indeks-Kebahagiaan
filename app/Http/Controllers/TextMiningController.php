<?php

namespace App\Http\Controllers;

use App\Classification;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Phpml\Classification\NaiveBayes;

class TextMiningController extends Controller
{
    public $ngramtraining=array();
    public $ngramtesting=array();
    public $labelling=array();
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function datatraining()
    {
        $datatraining=Tweet::where('status',1)->get();
        return view('datatraining.index',['datatraining'=>$datatraining]);
    }
    public function datatesting()
    {
        $datatesting=Tweet::where('status',2)->get();
        return view('datatesting.index',['datatesting'=>$datatesting]);
    }
    public function updatedatatraining(Request $request){
        Tweet::find($request->id)->update([
            'tweet'=>$request->tweet
        ]);
        return Redirect::to('/datatraining/tabel');
    }
    function deletedatatraining($id){
        Tweet::destroy($id);
        return Redirect::to('/datatraining/tabel');
    }

    function naivebayestraining($training,$labels,$testing){
//        $samples = [['aku'], ['apa'], ['yos'], ['men'], ['tor'], ['ind'],['kk']];
//        $labels = ['positif', 'positif', 'positif', 'negatif', 'negatif', 'negatif', 'netral'];


        $classifier = new NaiveBayes();
        $classifier->train($training, $labels);

        return $classifier->predict(['ibu']);
    }
    public function textminingdatatraining()
    {
        $datatraining=Tweet::where('status',1)->get();
        $hasilpreprocessing=$this->preprocessing($datatraining);
        $hasilstemming=$this->stemming($datatraining);
        $hasilstopwordremoval=$this->stopwordremoval($hasilstemming);
        $hasilngram=$this->ngram($hasilstopwordremoval);
        $this->ngramtraining=$hasilngram;
        $b=array();
        foreach ($hasilngram as $hn){
            $b=$b+$hn;
        }
        $hasilfrequencyngram=$this->frequencyngram($b);

        return view('datatraining.textpreprocessing',['datatraining'=>$datatraining,'hasilpreprocessing'=>$hasilpreprocessing,
        'hasilstemming'=>$hasilstemming,'hasilstopwordremoval'=>$hasilstopwordremoval,'hasilngram'=>$hasilngram,
        'hasilfrequencyngram'=>$hasilfrequencyngram]);
    }
    public function textminingdatatesting()
    {
        $datatraining=Tweet::where('status',2)->get();
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
    public function frequencyngram($ngram){
        $y = new \Ngram\Tool\Ngram\Frequency();
        $z=$y->get($ngram);
        $output=array();
        $i=0;
        for ($i=0;$i<count($z);$i++){
            $output[$i][0]=key($z);
            $output[$i][1]=$z[key($z)];

            next($z);
        }
        return $output;
    }
    public function ngram($datatraining,$n=3){
        $output=array();
        $i=0;

        foreach ($datatraining as $dt){
            $w = new \Ngram\Frequency\Letter($dt);
            $j=0;
            foreach ($w->extract($n) as $ye){
                $output[$i][$j]=$ye;
                $j++;
            }
            $i++;
        }
        return $output;


//        foreach ($z as $ksks){
//            echo $ksks."<br>";
//        }
//        $i=0;
//        foreach ($w->extract(3) as $ye){
//            //echo $ye."<br>";
//            $i++;
//        }
//        die;
//        $len=strlen($word);
//        $ngram=array();
//        for($i=0;$i+$n<=$len;$i++){
//            $string="";
//            for($j=0;$j<$n;$j++){
//                $string.=$word[$j+$i];
//            }
//            $ngram[$i]=$string;
//        }
//        return $ngram;
    }
    public function stemming($datatraining){
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();
        $output=array();
        // stem
        $i=0;
        foreach ($datatraining as $dt){
            $kw[$i]=$dt->tweet;
            $i++;
        }
        $i=0;
        foreach ($kw as $k){
            $output[$i]=$stemmer->stem($k);
            $i++;
        }
        return($output);
    }
    public function lexiconing($datatraining){
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();
        $output=array();
        // stem
        $i=0;
        foreach ($datatraining as $dt){
            $kw[$i]=$dt->tweet;
            $i++;
        }
        $i=0;
        foreach ($kw as $k){
            $output[$i]=$stemmer->stem($k);
            $i++;
        }
        return($output);
    }
    public function stopwordremoval($datatraining){
        $stopwordFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $stopword=$stopwordFactory->createStopWordRemover();
        $output=array();
        $i=0;
        foreach ($datatraining as $dt){
            $output[$i]=$stopword->remove($dt);
            $i++;
        }
        return $output;
    }



    public function preprocessing($datatraining){
        //tolowercase dan penghapusan delimiter
        //$normalizedText = new \Sastrawi\Filter\TextNormalizer::normalizeText($);
//        $output=array();
//        $i=0;
//        foreach ($datatraining as $dt){
//            $output[$i]=new \Sastrawi\Stemmer\Filter\TextNormalizer::normalizeText($dt);
//            $i++;
//        }
//        return $output;
        $kw=array();
        $i=0;
        foreach ($datatraining as $dt){
            $kw[$i]=$dt->tweet;
            $i++;
        }
        if(!empty($kw)) {
            $ret = array();
            $i=0;
            foreach($kw as $k) {
                $k = strtolower($k); //tolowercase
                $k = preg_replace('/[^a-z0-9 -]/im', ' ', $k);//penghapusan delimiter
                $k = preg_replace('/( +)/im', ' ', $k);
                if(!empty($k) && strlen($k) > 2) {
                    $k = strtolower($k);
                    if(!empty($k))
                        $token = strtok($k," "); //tokenizing
                    while ($token !== false)
                    {
                        $ret[$i][]=$token; //memasukkan ke array
                        $token = strtok(" ");
                    }
                }
                $i++;
            }
            return $ret;
        }
    }
    public function datatraininglexicon(){
        $datatraining=Tweet::where('status',1)->get();
        return view('datatraining.lexicon',['datatraining'=>$datatraining]);
    }
    public function manuallabelling(Request $request){

        Classification::find($request->id)->update([
            'manual_sentimen_label'=>$request->sentimen,
            'manual_category_label'=>$request->kategori
        ]);
        return Redirect::to('/datatraining/lexicon');
    }
    public function klasifikasitesting(){
        $datatesting=Tweet::where('status',2)->get();
        return view('datatesting.klasifikasi',['datatesting'=>$datatesting]);
    }
}
