<?php

namespace App\Http\Controllers;

use App\Classification;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Phpml\Metric\ClassificationReport;

use Phpml\Classification\NaiveBayes;
use Sastrawi\Dictionary\ArrayDictionary;

class DataTestingController extends TextMiningController
{
    public function index()
    {
        $datatesting=Tweet::where('status',2)->get();
        $distribusisentimen=DB::table('classifications')->join('tweets', 'id_tweet', '=', 'tweets.id')
            ->select('manual_sentimen_label',DB::raw('count(*) as total'))
            ->where('status',2)
            ->groupBy('manual_sentimen_label')->get();
        $distribusicategory=DB::table('classifications')->join('tweets', 'id_tweet', '=', 'tweets.id')
            ->select('manual_category_label',DB::raw('count(*) as total'))
            ->where('status',2)
            ->groupBy('manual_category_label')->get();
        return view('datatesting.index',['datatesting'=>$datatesting,'distribusisentimen'=>$distribusisentimen,'distribusicategory'=>$distribusicategory]);
    }
    function delete($id){
        Tweet::destroy($id);
        return Redirect::to('/datatesting/tabel');
    }
    public function update(Request $request){
        Classification::where('id_tweet', $request->id)->update([
            'manual_sentimen_label'=>$request->manual_sentimen_label,
            'manual_category_label'=>$request->manual_category_label
        ]);

        return Redirect::to('/datatesting/tabel');
    }
    public function edit($id){
        $datatesting=Tweet::find($id);
        return view('datatesting.edit',['datatesting'=>$datatesting]);
    }
    public function textmining()
    {
        $datatraining=Tweet::where('status',2)->get();
        $hasilpreprocessing=$this->preprocessing($datatraining);
        $hasilstemming=$this->stemming($datatraining);
        $hasilbukancorpus=$this->cekCorpus($hasilstemming);
        $hasilstopwordremoval=$this->stopwordremoval($hasilbukancorpus);
        $hasilngram=$this->ngram($hasilstopwordremoval);
        $b=array();
        foreach ($hasilngram as $hn){
            foreach ($hn as $ngram){
                $b[]=$ngram;
            }
        }
        $hasilfrequencyngram=$this->frequencyngram($b);

        return view('datatesting.textpreprocessing',['datatraining'=>$datatraining,'hasilpreprocessing'=>$hasilpreprocessing,
            'hasilstemming'=>$hasilstemming,'hasilstopwordremoval'=>$hasilstopwordremoval,'hasilngram'=>$hasilngram,
            'hasilbukancorpus'=>$hasilbukancorpus,'hasilfrequencyngram'=>$hasilfrequencyngram]);
    }
    public function labelling(Request $request){

        Classification::find($request->id)->update([
            'manual_sentimen_label'=>$request->sentimen,
            'manual_category_label'=>$request->kategori
        ]);
        return Redirect::to('/datatesting/manual');
    }
    public function klasifikasi(Request $request){

        $datatraining=Tweet::where('status',1)->get();
        $jumlahtraining=count($datatraining);
        $datatesting=Tweet::where('status',2)->get();
        $j=0;
        $jumlahsentimen=array();
        $jumlahsentimen['positif']=0;
        $jumlahsentimen['negatif']=0;
        $jumlahsentimen['netral']=0;
        $jumlahsentimen['pekerjaan']=0;$jumlahsentimen['pendapatan rumah tangga']=0;
        $jumlahsentimen['kondisi rumah dan aset']=0;$jumlahsentimen['pendidikan']=0;
        $jumlahsentimen['kesehatan']=0;$jumlahsentimen['keharmonisan keluarga']=0;
        $jumlahsentimen['hubungan sosial']=0;$jumlahsentimen['ketersediaan waktu luang']=0;
        $jumlahsentimen['kondisi lingkungan']=0;$jumlahsentimen['kondisi keamanan']=0;
        foreach($datatraining as $dt){
            $manualsentimen[$j]=$dt->classification->manual_sentimen_label;
            $manualkategori[$j]=$dt->classification->manual_category_label;
            switch ($dt->classification->manual_sentimen_label){
                case 'positif':

                    $jumlahsentimen['positif']++;
                    break;
                case 'negatif':
                    $jumlahsentimen['negatif']++;
                    break;
                case 'netral':
                    $jumlahsentimen['netral']++;
                    break;
            }
            switch ($dt->classification->manual_category_label){
                case 'pekerjaan':
                    $jumlahsentimen['pekerjaan']++;
                    break;
                case 'pendapatan rumah tangga':
                    $jumlahsentimen['pendapatan rumah tangga']++;
                    break;
                case 'kondisi rumah dan aset':
                    $jumlahsentimen['kondisi rumah dan aset']++;
                    break;
                case 'pendidikan':
                    $jumlahsentimen['pendidikan']++;
                    break;
                case 'kesehatan':
                    $jumlahsentimen['kesehatan']++;
                    break;
                case 'keharmonisan keluarga':
                    $jumlahsentimen['keharmonisan keluarga']++;
                    break;
                case 'hubungan sosial':
                    $jumlahsentimen['hubungan sosial']++;
                    break;
                case 'ketersediaan waktu luang':
                    $jumlahsentimen['ketersediaan waktu luang']++;
                    break;
                case 'kondisi lingkungan':
                    $jumlahsentimen['kondisi lingkungan']++;
                    break;
                case 'kondisi keamanan':
                    $jumlahsentimen['kondisi keamanan']++;
                    break;
            }

            $j++;
        }
        $l=0;
        foreach ($datatesting as $dtesting){
            $tweetidtesting[$l]=$dtesting->id;
            $manualsentimentesting[$l]=$dtesting->classification->manual_sentimen_label;
            $manualkategoritesting[$l]=$dtesting->classification->manual_category_label;
            $l++;
        }

        $hasilstemmingtraining=$this->stemming($datatraining);
        $hasilbukancorpustraining=$this->cekCorpus($hasilstemmingtraining);
        $hasilstopwordremovaltraining=$this->stopwordremoval($hasilbukancorpustraining);
        $hasilngramtraining=$this->ngram($hasilstopwordremovaltraining);
        $b=array();
        $i=0;
        $k=0;

//        dd($hasilngramtraining);
        $trainlabels="";
        $classifiersentimen=new NaiveBayes();
        $classifierkategori=new NaiveBayes();
//        $samples = [[5, 1, 1]];
//        $labels = ['a'];
//
//        $classifier = new NaiveBayes();
//        $classifier->train($samples, $labels);
//        $s= $classifier->predict([3, 1, 1]);
//        dd($s);
//        die;
        foreach ($hasilngramtraining as $hnt){

            foreach ($hnt as $ss){
//                $train[$i]=$ss;

                $classifiersentimen->train([[$ss]],[$manualsentimen[$k]]);//menambah training
                $classifierkategori->train([[$ss]],[$manualkategori[$k]]);//menambah training
//                $trainlabels=$trainlabels.$manual[$k].", ";
                $i++;
            }
            $k++;
        }

        $datatesting=Tweet::where('status',2)->get();
        $hasilstemmingtesting=$this->stemming($datatesting);
        $hasilbukancorpustesting=$this->cekCorpus($hasilstemmingtesting);
        $hasilstopwordremovaltesting=$this->stopwordremoval($hasilbukancorpustesting);

        $hasilngramtesting=$this->ngram($hasilstopwordremovaltesting);

        $i=0;

//        $pagi=$classifiersentimen->predict(["pakde"]);
//        $kategoripagi=$classifierkategori->predict(["sakit"]);
//        dd($pagi);
//        echo $pagi['positif']."<br>";
//        echo $pagi['negatif']."<br>";
//        echo $pagi['netral']."<br>";
//        die;
//
        foreach ($hasilngramtesting as $hnt){

            $klasifikasisentimen[$i]['positif']=1;
            $klasifikasisentimen[$i]['negatif']=1;
            $klasifikasisentimen[$i]['netral']=1;
            $klasifikasisentimen['hasil'][$i]="";
            $klasifikasikategori[$i]['pekerjaan']=1;
            $klasifikasikategori[$i]['pendapatan rumah tangga']=1;
            $klasifikasikategori[$i]['kondisi rumah dan aset']=1;
            $klasifikasikategori[$i]['pendidikan']=1;
            $klasifikasikategori[$i]['kesehatan']=1;
            $klasifikasikategori[$i]['keharmonisan keluarga']=1;
            $klasifikasikategori[$i]['hubungan sosial']=1;
            $klasifikasikategori[$i]['ketersediaan waktu luang']=1;
            $klasifikasikategori[$i]['kondisi lingkungan']=1;
            $klasifikasikategori[$i]['kondisi keamanan']=1;
            $klasifikasikategori[$i]['tidak terkategori']=0;
            foreach ($hnt as $ngram){
                $predictedsentimen = $classifiersentimen->predict([$ngram]);
                $predictedkategori = $classifierkategori->predict([$ngram]);

                (isset($predictedsentimen['positif']))?$klasifikasisentimen[$i]['positif']*=$predictedsentimen['positif']:null;
                (isset($predictedsentimen['negatif']))?$klasifikasisentimen[$i]['negatif']*=$predictedsentimen['negatif']:null;
                (isset($predictedsentimen['netral']))?$klasifikasisentimen[$i]['netral']*=$predictedsentimen['netral']:null;
//                'pekerjaan','pendapatan rumah tangga','kondisi rumah dan aset','pendidikan','kesehatan','keharmonisan keluarga','hubungan sosial','ketersediaan waktu luang','kondisi lingkungan','kondisi keamanan','tidak terkategori'
                (isset($predictedkategori['pekerjaan']))?$klasifikasikategori[$i]['pekerjaan']*=$predictedkategori['pekerjaan']:null;
                (isset($predictedkategori['pendapatan rumah tangga']))?$klasifikasikategori[$i]['pendapatan rumah tangga']*=$predictedkategori['pendapatan rumah tangga']:null;
                (isset($predictedkategori['kondisi rumah dan aset']))?$klasifikasikategori[$i]['kondisi rumah dan aset']*=$predictedkategori['kondisi rumah dan aset']:null;
                (isset($predictedkategori['pendidikan']))?$klasifikasikategori[$i]['pendidikan']*=$predictedkategori['pendidikan']:null;
                (isset($predictedkategori['kesehatan']))?$klasifikasikategori[$i]['kesehatan']*=$predictedkategori['kesehatan']:null;
                (isset($predictedkategori['keharmonisan keluarga']))?$klasifikasikategori[$i]['keharmonisan keluarga']*=$predictedkategori['keharmonisan keluarga']:null;
                (isset($predictedkategori['hubungan sosial']))?$klasifikasikategori[$i]['hubungan sosial']*=$predictedkategori['hubungan sosial']:null;
                (isset($predictedkategori['ketersediaan waktu luang']))?$klasifikasikategori[$i]['ketersediaan waktu luang']*=$predictedkategori['ketersediaan waktu luang']:null;
                (isset($predictedkategori['kondisi lingkungan']))?$klasifikasikategori[$i]['kondisi lingkungan']*=$predictedkategori['kondisi lingkungan']:null;
                (isset($predictedkategori['kondisi keamanan']))?$klasifikasikategori[$i]['kondisi keamanan']*=$predictedkategori['kondisi keamanan']:null;
                (isset($predictedkategori['tidak terkategori']))?$klasifikasikategori[$i]['tidak terkategori']*=$predictedkategori['tidak terkategori']:null;
            }
            $klasifikasisentimen[$i]['positif']=$klasifikasisentimen[$i]['positif']*($jumlahsentimen['positif']/$jumlahtraining);
            $klasifikasisentimen[$i]['negatif']=$klasifikasisentimen[$i]['negatif']*($jumlahsentimen['negatif']/$jumlahtraining);
            $klasifikasisentimen[$i]['netral']=$klasifikasisentimen[$i]['netral']*($jumlahsentimen['netral']/$jumlahtraining);
            $klasifikasikategori[$i]['pekerjaan']=$klasifikasikategori[$i]['pekerjaan']*($jumlahsentimen['pekerjaan']/$jumlahtraining);
            $klasifikasikategori[$i]['pendapatan rumah tangga']=$klasifikasikategori[$i]['pendapatan rumah tangga']*($jumlahsentimen['pendapatan rumah tangga']/$jumlahtraining);
            $klasifikasikategori[$i]['kondisi rumah dan aset']=$klasifikasikategori[$i]['kondisi rumah dan aset']*($jumlahsentimen['kondisi rumah dan aset']/$jumlahtraining);
            $klasifikasikategori[$i]['pendidikan']=$klasifikasikategori[$i]['pendidikan']*($jumlahsentimen['pendidikan']/$jumlahtraining);
            $klasifikasikategori[$i]['kesehatan']=$klasifikasikategori[$i]['kesehatan']*($jumlahsentimen['kesehatan']/$jumlahtraining);
            $klasifikasikategori[$i]['keharmonisan keluarga']=$klasifikasikategori[$i]['keharmonisan keluarga']*($jumlahsentimen['keharmonisan keluarga']/$jumlahtraining);
            $klasifikasikategori[$i]['hubungan sosial']=$klasifikasikategori[$i]['hubungan sosial']*($jumlahsentimen['hubungan sosial']/$jumlahtraining);
            $klasifikasikategori[$i]['ketersediaan waktu luang']=$klasifikasikategori[$i]['ketersediaan waktu luang']*($jumlahsentimen['ketersediaan waktu luang']/$jumlahtraining);
            $klasifikasikategori[$i]['kondisi lingkungan']=$klasifikasikategori[$i]['kondisi lingkungan']*($jumlahsentimen['kondisi lingkungan']/$jumlahtraining);
            $klasifikasikategori[$i]['kondisi keamanan']=$klasifikasikategori[$i]['kondisi keamanan']*($jumlahsentimen['kondisi keamanan']/$jumlahtraining);
            arsort($klasifikasisentimen[$i], SORT_NUMERIC);
            $klasifikasisentimen['hasil'][$i]=key($klasifikasisentimen[$i]);

            arsort($klasifikasikategori[$i], SORT_NUMERIC);
            $klasifikasikategori['hasil'][$i]=key($klasifikasikategori[$i]);
            Classification::where('id_tweet', $tweetidtesting[$i])->update([
                'predict_sentimen_label'=>$klasifikasisentimen['hasil'][$i],
                'predict_category_label'=>$klasifikasikategori['hasil'][$i]
            ]);
//            if ($klasifikasisentimen['hasil'][$i]=='positif'){
//                $positif+=1;
//            } else if($klasifikasisentimen['hasil'][$i]=='negatif'){
//                $negatif+=1;
//            }
            $i++;
        }

        $reportsentimen = new ClassificationReport($manualsentimentesting, $klasifikasisentimen['hasil']);

        $reportresultsentimen['precision']=$reportsentimen->getPrecision();
        $reportresultsentimen['recall']=$reportsentimen->getRecall();
        $reportresultsentimen['f1score']=$reportsentimen->getF1score();
        $reportresultsentimen['support']=$reportsentimen->getSupport();
        $reportresultsentimen['average']=$reportsentimen->getAverage();

        $reportkategori = new ClassificationReport($manualkategoritesting, $klasifikasikategori['hasil']);

        $reportresultkategori['precision']=$reportkategori->getPrecision();
        $reportresultkategori['recall']=$reportkategori->getRecall();
        $reportresultkategori['f1score']=$reportkategori->getF1score();
        $reportresultkategori['support']=$reportkategori->getSupport();
        $reportresultkategori['average']=$reportkategori->getAverage();

//        $indekskebahagiaan=$positif/($positif+$negatif);
        return view('datatesting.klasifikasi',['datatesting'=>$datatesting,'klasifikasisentimen'=>$klasifikasisentimen,'reportresultsentimen'=>$reportresultsentimen,'klasifikasikategori'=>$klasifikasikategori,'reportresultkategori'=>$reportresultkategori]);
    }
    public function indekskebahagiaan(){
        $start=(isset($_GET['start']))?$_GET['start']:"2017-01-01";
        $end=(isset($_GET['end']))?$_GET['end']:"2100-12-31";
        $datapositif=DB::table('classifications')->join('tweets','tweets.id','=','classifications.id_tweet')
            ->select(DB::raw('count(*) as total, DATE(post_time) as tanggal'))->whereBetween('post_time',array($start,$end))
            ->where('status',2)->where('predict_sentimen_label','positif')->groupBy(DB::raw('DATE(post_time)'))->get();
        $dataprediksi=DB::table('classifications')->join('tweets','tweets.id','=','classifications.id_tweet')
            ->select(DB::raw('count(*) as total, DATE(post_time) as tanggal'))->whereBetween('post_time',array($start,$end))
            ->where('status',2)->where('predict_sentimen_label','negatif')->groupBy(DB::raw('DATE(post_time)'))->get();
        $positif=array();
        $totalprediksi=array();
        $indekskebahagiaan=array();
        foreach ($datapositif as $dp){
            $positif[$dp->tanggal]=$dp->total;
        }
        foreach ($dataprediksi as $dp){
            if (!isset($positif[$dp->tanggal])){
                $positif[$dp->tanggal]=0;
            }
            $totalprediksi[$dp->tanggal]=$dp->total;
            $indekskebahagiaan[$dp->tanggal]=$positif[$dp->tanggal]/($positif[$dp->tanggal]+$totalprediksi[$dp->tanggal]);
        }
        return view('datatesting.indekskebahagiaan',['indekskebahagiaan'=>$indekskebahagiaan]);
    }
    public function manual(){
        $datatesting=Tweet::where('status',2)->get();
        return view('datatesting.manual',['datatesting'=>$datatesting]);
    }

}
