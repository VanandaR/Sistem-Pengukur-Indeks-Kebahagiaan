<?php

namespace App\Http\Controllers;
define('CONSUMER_KEY', '0Y9KZFaZaUI67BQ5RjBcPPhSN'); //isikan dengan CONSUMER_KEY anda
define('CONSUMER_SECRET', 'ey1LZH8xYegJ0h9EIB0m2nsD18shVcJHZtxlNfcHKdzTR5tbyK'); //isikan dengan CONSUMER_KEY anda
define('ACCESS_TOKEN', '3014251646-J0LadQ2pyEAs0xLwnhwxu5nv27gZL8of0NAPzGB'); //isikan dengan CONSUMER_KEY anda
define('ACCESS_TOKEN_SECRET', 'R06seEsYZdaPy2LkpHz54JLhLxBx0snXg2AdpPuaBipdY'); //isikan dengan CONSUMER_KEY anda
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Happiness;
use App\Ontology;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Phpml\Classification\NaiveBayes;
use Spatie\TwitterStreamingApi\PublicStream;


class StreamingController extends TextMiningController
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $happiness=Happiness::all();
        return view('streaming.visualisasi',['happiness'=>$happiness]);
    }

    public function search($query)
    {
        $limit = (isset($_GET['jumlahtweet']))?$_GET['jumlahtweet']:100;
        $max_id = null;
        $count=100;
        $contents = array();
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
        for ($i = 0; $i < $limit; $i += $count) {

            $content = $connection->get('search/tweets', array(
                "q" =>$query,
                "count"=>$limit,
                'max_id'=>$max_id,
                'lang'=>'id'));
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
    public function klasifikasihariini()
    {
        $datatraining=Tweet::where('status',1)->get();
        $hasilstemmingtraining=$this->stemming($datatraining);
        $hasilbukancorpustraining=$this->cekCorpus($hasilstemmingtraining);
        $hasilstopwordremovaltraining=$this->stopwordremoval($hasilbukancorpustraining);
        $hasilngramtraining=$this->ngram($hasilstopwordremovaltraining);
        $j=0;
        foreach($datatraining as $dt){
            $manualsentimen[$j]=$dt->classification->manual_sentimen_label;
            $j++;
        }
        $classifiersentimen=new NaiveBayes();
        $k=0;
        $i=0;
        foreach ($hasilngramtraining as $hnt){
            foreach ($hnt as $ss){
                $classifiersentimen->train([[$ss]],[$manualsentimen[$k]]);//menambah training
                $i++;
            }
            $k++;
        }

        $tweethariini=$this->datatweethariini();
        $hasilstemmingtesting=$this->stemmingstreaming($tweethariini);
        $hasilbukancorpustesting=$this->cekCorpus($hasilstemmingtesting);
        $hasilstopwordremovaltesting=$this->stopwordremoval($hasilbukancorpustesting);
        $hasilngramtesting=$this->ngram($hasilstopwordremovaltesting);

        $positif=0;
        $negatif=0;
        $i=0;
        foreach ($hasilngramtesting as $hnt){

            $klasifikasisentimen[$i]['positif']=0;
            $klasifikasisentimen[$i]['negatif']=0;
            $klasifikasisentimen[$i]['netral']=0;
            $klasifikasisentimen['hasil'][$i]="";
            foreach ($hnt as $ngram){

                $predictedsentimen = $classifiersentimen->predict([$ngram]);

                (isset($predictedsentimen['positif']))?$klasifikasisentimen[$i]['positif']+=$predictedsentimen['positif']:$klasifikasisentimen[$i]['positif']=0;
                (isset($predictedsentimen['negatif']))?$klasifikasisentimen[$i]['negatif']+=$predictedsentimen['negatif']:$klasifikasisentimen[$i]['negatif']=0;
                (isset($predictedsentimen['netral']))?$klasifikasisentimen[$i]['netral']+=$predictedsentimen['netral']:$klasifikasisentimen[$i]['netral']=0;
            }

            arsort($klasifikasisentimen[$i], SORT_NUMERIC);
            $klasifikasisentimen['hasil'][$i]=key($klasifikasisentimen[$i]);


            if ($klasifikasisentimen['hasil'][$i]=='positif'){
                $positif+=1;
            } else if($klasifikasisentimen['hasil'][$i]=='negatif'){
                $negatif+=1;
            }
            $i++;
        }
//        dd($tweethariini);
        $indekskebahagiaan['positif']=$positif;
        $indekskebahagiaan['negatif']=$negatif;
        $indekskebahagiaan['hasil']=$positif/($positif+$negatif);
        return view('streaming.index',['tweethariini'=>$tweethariini,'klasifikasisentimen'=>$klasifikasisentimen,'indekskebahagiaan'=>$indekskebahagiaan]);
    }

    public function stemmingstreaming($data){
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();
        $output=array();
        // stem
        $i=0;
        foreach ($data as $dt){
            $kw[$i]=$dt->text;
            $i++;
        }
        $i=0;
        foreach ($kw as $k){
            $output[$i]=$stemmer->stem($k);
            $i++;
        }
        return($output);
    }

    public function datatweethariini(){
        $ontologi['kesehatan']=Ontology::where('parameter','kesehatan')->get();
        $ontologi['pendidikan']=Ontology::where('parameter','pendidikan')->get();
        $ontologi['kondisi keamanan']=Ontology::where('parameter','kondisi keamanan')->get();
        $ontologi['kondisi lingkungan']=Ontology::where('parameter','kondisi lingkungan')->get();
        $ontologi['keharmonisan keluarga']=Ontology::where('parameter','keharmonisan keluarga')->get();
//
        $ontologi['hubungan sosial']=Ontology::where('parameter','hubungan sosial')->get();
//
        $ontologi['kondisi rumah dan aset']=Ontology::where('parameter','kondisi rumah dan aset')->get();
        $ontologi['pekerjaan']=Ontology::where('parameter','pekerjaan')->get();
        $ontologi['ketersediaan waktu luang']=Ontology::where('parameter','ketersediaan waktu luang')->get();
        $ontologi['pendapatan rumah tangga']=Ontology::where('parameter','pendapatan rumah tangga')->get();
        $j=0;
//        dd($ontologi);
        foreach ($ontologi as $onto){
            $queryontologi[$j]=$onto[0]->text;
            for ($i=1;$i<count($onto);$i++){
                $queryontologi[$j] =$queryontologi[$j].' OR '.$onto[$i]->text;
            }
            $j++;
        }
//        $querykesehatan=$kesehatan[0]->text;
//        for ($i=1;$i<count($kesehatan);$i++){
//            $querykesehatan =$querykesehatan.' OR '.$kesehatan[$i]->text;
//        }

        $tweethariini=array();
        $results=array();
        foreach ($queryontologi as $query){
            $results[] = $this->search($query);
        }

//        $results[] = $this->search($querykesehatan);
        foreach($results as $result1){
            foreach($result1  as $result2){
                foreach($result2->statuses  as $result3) {
                    $tweethariini[]=$result3;
                }
            }
        }
        return $tweethariini;
    }
    public function saveindex(){
        $tweet=Happiness::create([
            'index'=>Input::get('indekskebahagiaan'),
            'date'=>Input::get('tanggal'),
        ]);
        return Redirect::to('/streaming');
    }
    function delete($id){
        Happiness::destroy($id);
        return Redirect::to('/streaming');
    }
}
