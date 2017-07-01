<?php

namespace App\Http\Controllers;

use App\Classification;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Phpml\Metric\ClassificationReport;

use Phpml\Classification\NaiveBayes;

class DataTestingController extends TextMiningController
{
    public function index()
    {
        $datatesting=Tweet::where('status',2)->get();
        return view('datatesting.index',['datatesting'=>$datatesting]);
    }
    function delete($id){
        Tweet::destroy($id);
        return Redirect::to('/datatraining/tabel');
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
    public function textmining()
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

        return view('datatesting.textpreprocessing',['datatraining'=>$datatraining,'hasilpreprocessing'=>$hasilpreprocessing,
            'hasilstemming'=>$hasilstemming,'hasilstopwordremoval'=>$hasilstopwordremoval,'hasilngram'=>$hasilngram,
            'hasilfrequencyngram'=>$hasilfrequencyngram]);
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
        $datatesting=Tweet::where('status',2)->get();
        $manual=array();
        $j=0;
        foreach($datatraining as $dt){
            $manualsentimen[$j]=$dt->classification->manual_sentimen_label;
            $manualkategori[$j]=$dt->classification->manual_category_label;
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
        $hasilstopwordremovaltraining=$this->stopwordremoval($hasilstemmingtraining);
        $hasilngramtraining=$this->ngram($hasilstopwordremovaltraining);
        $b=array();
        $i=0;
        $k=0;
        $trainlabels="";
        $classifiersentimen=new NaiveBayes();
        $classifierkategori=new NaiveBayes();
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
        $hasilstopwordremovaltesting=$this->stopwordremoval($hasilstemmingtesting);
        $hasilngramtesting=$this->ngram($hasilstopwordremovaltesting);
        $i=0;
//        $positif=0;
//        $negatif=0;
        foreach ($hasilngramtesting as $hnt){

            $klasifikasisentimen[$i]['positif']=0;
            $klasifikasisentimen[$i]['negatif']=0;
            $klasifikasisentimen[$i]['netral']=0;
            $klasifikasisentimen['hasil'][$i]="";
            $klasifikasikategori[$i]['pekerjaan']=0;
            $klasifikasikategori[$i]['pendapatan rumah tangga']=0;
            $klasifikasikategori[$i]['kondisi rumah dan aset']=0;
            $klasifikasikategori[$i]['pendidikan']=0;
            $klasifikasikategori[$i]['kesehatan']=0;
            $klasifikasikategori[$i]['keharmonisan keluarga']=0;
            $klasifikasikategori[$i]['hubungan sosial']=0;
            $klasifikasikategori[$i]['ketersediaan waktu luang']=0;
            $klasifikasikategori[$i]['kondisi lingkungan']=0;
            $klasifikasikategori[$i]['kondisi keamanan']=0;
            $klasifikasikategori[$i]['tidak terkategori']=0;
            foreach ($hnt as $ngram){
                $predictedsentimen = $classifiersentimen->predict([$ngram]);
                $predictedkategori = $classifierkategori->predict([$ngram]);

                (isset($predictedsentimen['positif']))?$klasifikasisentimen[$i]['positif']+=$predictedsentimen['positif']:$klasifikasisentimen[$i]['positif']=0;
                (isset($predictedsentimen['negatif']))?$klasifikasisentimen[$i]['negatif']+=$predictedsentimen['negatif']:$klasifikasisentimen[$i]['negatif']=0;
                (isset($predictedsentimen['netral']))?$klasifikasisentimen[$i]['netral']+=$predictedsentimen['netral']:$klasifikasisentimen[$i]['netral']=0;
//                'pekerjaan','pendapatan rumah tangga','kondisi rumah dan aset','pendidikan','kesehatan','keharmonisan keluarga','hubungan sosial','ketersediaan waktu luang','kondisi lingkungan','kondisi keamanan','tidak terkategori'
                (isset($predictedkategori['pekerjaan']))?$klasifikasikategori[$i]['pekerjaan']+=$predictedkategori['pekerjaan']:$klasifikasikategori[$i]['pekerjaan']=0;
                (isset($predictedkategori['pendapatan rumah tangga']))?$klasifikasikategori[$i]['pendapatan rumah tangga']+=$predictedkategori['pendapatan rumah tangga']:$klasifikasikategori[$i]['pendapatan rumah tangga']=0;
                (isset($predictedkategori['kondisi rumah dan aset']))?$klasifikasikategori[$i]['kondisi rumah dan aset']+=$predictedkategori['kondisi rumah dan aset']:$klasifikasikategori[$i]['kondisi rumah dan aset']=0;
                (isset($predictedkategori['pendidikan']))?$klasifikasikategori[$i]['pendidikan']+=$predictedkategori['pendidikan']:$klasifikasikategori[$i]['pendidikan']=0;
                (isset($predictedkategori['kesehatan']))?$klasifikasikategori[$i]['kesehatan']+=$predictedkategori['kesehatan']:$klasifikasikategori[$i]['kesehatan']=0;
                (isset($predictedkategori['keharmonisan keluarga']))?$klasifikasikategori[$i]['keharmonisan keluarga']+=$predictedkategori['keharmonisan keluarga']:$klasifikasikategori[$i]['keharmonisan keluarga']=0;
                (isset($predictedkategori['hubungan sosial']))?$klasifikasikategori[$i]['hubungan sosial']+=$predictedkategori['hubungan sosial']:$klasifikasikategori[$i]['hubungan sosial']=0;
                (isset($predictedkategori['ketersediaan waktu luang']))?$klasifikasikategori[$i]['ketersediaan waktu luang']+=$predictedkategori['ketersediaan waktu luang']:$klasifikasikategori[$i]['ketersediaan waktu luang']=0;
                (isset($predictedkategori['kondisi lingkungan']))?$klasifikasikategori[$i]['kondisi lingkungan']+=$predictedkategori['kondisi lingkungan']:$klasifikasikategori[$i]['kondisi lingkungan']=0;
                (isset($predictedkategori['kondisi keamanan']))?$klasifikasikategori[$i]['kondisi keamanan']+=$predictedkategori['kondisi keamanan']:$klasifikasikategori[$i]['kondisi keamanan']=0;
                (isset($predictedkategori['tidak terkategori']))?$klasifikasikategori[$i]['tidak terkategori']+=$predictedkategori['tidak terkategori']:$klasifikasikategori[$i]['tidak terkategori']=0;
            }

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
        $datapositif=DB::table('classifications')->join('tweets','tweets.id','=','classifications.id_tweet')
            ->select(DB::raw('count(*) as total, DATE(post_time) as tanggal'))
            ->where('status',2)->where('predict_sentimen_label','positif')->groupBy(DB::raw('DATE(post_time)'))->get();
        $dataprediksi=DB::table('classifications')->join('tweets','tweets.id','=','classifications.id_tweet')
            ->select(DB::raw('count(*) as total, DATE(post_time) as tanggal'))
            ->where('status',2)->groupBy(DB::raw('DATE(post_time)'))->get();
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
            $indekskebahagiaan[$dp->tanggal]=$positif[$dp->tanggal]/$totalprediksi[$dp->tanggal];
        }
        return view('datatesting.indekskebahagiaan',['indekskebahagiaan'=>$indekskebahagiaan]);
    }
    public function manual(){
        $datatesting=Tweet::where('status',2)->get();
        return view('datatesting.manual',['datatesting'=>$datatesting]);
    }
}
