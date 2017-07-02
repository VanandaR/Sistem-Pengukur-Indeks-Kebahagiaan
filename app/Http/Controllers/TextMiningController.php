<?php

namespace App\Http\Controllers;

use App\Classification;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Phpml\Metric\ClassificationReport;
use Sastrawi\Dictionary\ArrayDictionary;
use Phpml\Classification\NaiveBayes;

class TextMiningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
//        $normalizedText = new \Sastrawi\Filter\TextNormalizer::normalizeText($);
        $normalizer=new \Sastrawi\Stemmer\Filter\TextNormalizer();
        $output=array();
        $i=0;
        foreach ($datatraining as $dt){
            $kw[$i]=$dt->tweet;
            $i++;
        }
        $i=0;
        foreach ($kw as $k){
            $output[$i]=$normalizer->normalizeText($k);
            $i++;
        }
        return $output;
//        $kw=array();
//        $i=0;
//        foreach ($datatraining as $dt){
//            $kw[$i]=$dt->tweet;
//            $i++;
//        }
//        if(!empty($kw)) {
//            $ret = array();
//            $i=0;
//            foreach($kw as $k) {
//                $k = strtolower($k); //tolowercase
//                $k = preg_replace('/[^a-z -]/im', ' ', $k);//penghapusan delimiter
//                $k = preg_replace('/#([\w-]+)/i', '', $k);//penghapusan tag
//                $k = preg_replace('/@([\w-]+)/i', '', $k);//penghapusan mention
//                $k = preg_replace('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '', $k);//penghapusan tag
//                $k = preg_replace('/( +)/im', ' ', $k);
//                if(!empty($k) && strlen($k) > 2) {
//                    $k = strtolower($k);
//                    if(!empty($k))
//                        $token = strtok($k," "); //tokenizing
//                    while ($token !== false)
//                    {
//                        $ret[$i][]=$token; //memasukkan ke array
//                        $token = strtok(" ");
//                    }
//                }
//                $i++;
//            }
//            return $ret;
//        }
    }
    public function getKataDasar()
    {
        $dictionaryFile=public_path().'\kata-dasar.txt';
        return explode("\n", file_get_contents($dictionaryFile));
    }
    public function removeBukanKataDasar($text)
    {

        $kataDasar = $this->getKataDasar();

        $dictionary = new ArrayDictionary($kataDasar);

        $words = explode(' ', $text);

        foreach ($words as $i => $word) {
            if (!$dictionary->contains($word)) {
                unset($words[$i]);
            }
        }

        return implode(' ', $words);
    }
    public function cekCorpus($datatraining){
        $output=array();
        $i=0;
        foreach ($datatraining as $dt){
            $output[$i]=$this->removeBukanKataDasar($dt);
            $i++;
        }
        return $output;
    }




}
