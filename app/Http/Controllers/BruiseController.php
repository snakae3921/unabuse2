<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bruise;
use App\Http\Requests\BruiseRequest;
use Illuminate\Support\Facades\DB; // DB ファサードを use する
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class BruiseController extends Controller
{
    //
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * データ一覧を表示する
     * 
     * @return view
     * */
    public function showList(Request $request){
//        logger('this is showList');    
        $user = \Auth::user();
//        dd($user->name);
         // テーブルを指定
        $bruises = DB::table('bruises');

        // セッションへデータを保存する
        session()->put('kbn', $user->kbn);

        if ($user->kbn == 0){
            $bruise = $bruises->where('userid', '=', $user->name)
            ->orderBy('id', 'desc')
            ->simplePaginate(10);

        } else {
            $bruise = $bruises
            ->orderBy('id', 'desc')
            ->simplePaginate(10);
        }
//        $bruises = Bruise::all();
        return view('bruise.list', ['bruises'=>$bruise]);
    }
    /**
     * データ詳細を表示する
     * @param int $id
     * @return view
     * */
    public function showDetail($id){
//        logger('this is showDetail');    

        $bruise = Bruise::find($id);

        // セッションへデータを保存する
        if (!session()->has('id')) {
        // 存在しないnullだ
           session()->put('id', $id);
        }

        $user = \Auth::user();
        // url直節入力しての他のユーザの参照はできない
        if (!($user->name == $bruise->userid)) {
            if (!session()->pull('kbn') == 1){
                \Session::flash('err_msg','ユーザが正しくありません。');
                return redirect(route('showList'));
            }
        }

        if (is_null($bruise)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('showList'));
        }
        return view('bruise.detail', ['bruise'=>$bruise]);
    }
/**
     * データ登録画面を表示する
     * 
     * @return view
     * */
    public function showCreate(){
//        dd($bruises);
//        logger('this is showCreate');    

        $user = \Auth::user();
        //dd($user);
        $username=$user->name;
        return view('bruise.create')->with('username',$user->name);

    }
    
    /**
     * データ登録する
     * 
     * @return view
     * */
    public function exeInsert(BruiseRequest $request){
//        logger('this is exeInsert');    
        $inputs = $request->all();
//        dd($inputs);
        DB::beginTransaction();
        try {
            // データを登録
            Bruise::create($inputs);
            DB::commit();
        } catch(\Throwable $e) {
            DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg', 'データを登録しました。');
        return redirect(route('showList'));
    }
    /**
     * データ編集フォームを表示する
     * @param int $id
     * @return view
     * */
    public function showEdit($id){
//        logger('this is showEdit');    

        // セッションへデータを保存する
        if (!session()->has('id')) {
            // 存在しないnullだ
               session()->put('id', $id);
        }
        $bruise = Bruise::find($id);
        $user = \Auth::user();
        // url直節入力しての他のユーザの参照はできない
        if (!($user->name == $bruise->userid)) {
            if (!session()->pull('kbn') == 1){
                \Session::flash('err_msg','ユーザが正しくありません。');
                return redirect(route('showList'));
            }
        }

        $userkbn=$user->kbn;
        session()->put('kbn', $userkbn);

        if (is_null($bruise)){
            \Session::flash('err_msg','データがありません。。');
            return redirect(route('showList'));
        }
        return view('bruise.edit', ['bruise'=>$bruise, 'kbn'=>$userkbn]);
    }
    /**
     * データ更新する
     * 
     * @return view
     * */
    public function exeUpdate(BruiseRequest $request){

        //セッションからkbnを取得する
        $kbn = session()->pull('kbn', 'default');    

        //        logger('this is exeUpdate');    
        $inputs = $request->all();
        DB::beginTransaction();
        try {
            // データを更新
            $bruise = Bruise::find($inputs['id']);
            if  ($kbn == 1){   
                $bruise->fill([
//                    'userid'=>$inputs['userid'],
//                    'target'=>$inputs['target'],
                    'age'   =>$inputs['age'],
                    'sex'   =>$inputs['sex'],
                    'hasseiyy' =>$inputs['hasseiyy'],
                    'hasseimm' =>$inputs['hasseimm'],
                    'hasseidd' =>$inputs['hasseidd'],
                    'hasseihh' =>$inputs['hasseihh'],
                    'hasseimi' =>$inputs['hasseimi'],
                    'factor'   =>$inputs['factor'],
//                    'element'  =>$inputs['element'],
                    'note'     =>$inputs['note'],
                    'takeymd1'     =>$inputs['takeymd1'],
                ]);
            } else {
                $bruise->fill([
                    'userid'=>$inputs['userid'],
                    'target'=>$inputs['target'],
                    'age'   =>$inputs['age'],
                    'sex'   =>$inputs['sex'],
                    'hasseiyy' =>$inputs['hasseiyy'],
                    'hasseimm' =>$inputs['hasseimm'],
                    'hasseidd' =>$inputs['hasseidd'],
                    'hasseihh' =>$inputs['hasseihh'],
                    'hasseimi' =>$inputs['hasseimi'],
                    'factor'   =>$inputs['factor'],
                    'element'  =>$inputs['element'],
                    'note'     =>$inputs['note'],
                    'takeymd1'     =>$inputs['takeymd1'],
                ]);
            }    
            if ($kbn == 1) {
                $files = $inputs['file2'];
                if (!is_null($files) && !$bruise->file2) {

                    $hid =$inputs['id'];
                    $huserid =$inputs['userid'];
                    $htarget =$inputs['target'];
                    $helement =$inputs['element'];
                    $fname = 'rtn_'. $hid . '_' . $huserid . '_' . $htarget . '_' . $helement  . '_'; 

                    $originalName = $files->getClientOriginalName();
                    $filepath= pathinfo($originalName);
                    $originalFilename =$filepath['filename'];
                    $originalExtension =$filepath['extension'];

                    $dir = 'public/images/'. $huserid;
                    $fileName = $fname . $originalFilename . '.' . $originalExtension;
                    $files->storeAs($dir, $fileName, ['disk' => 'local']);
                    $bruise->fill([
                        'file2'=>$originalName,
                        'oimagename2'=>$fileName,
                        'takeymd2'  =>$inputs['takeymd2'],
                    ]);
                }            
            }            
            $bruise->save();
            DB::commit();
        } catch(\Throwable $e) {
            DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg', 'データを更新しました。');
        return redirect(route('showList'));
    }
    /**
     * テーブル更新してファイルアップロードする
     * 
     * @return view
     * */
    public function exeUpload(BruiseRequest $request)
    {

        $inputs = $request->all();
        //セッションからidを取得する
        $id = session()->pull('id', 'default');    
        $bruise = Bruise::find($id);
        if (is_null($bruise)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('showList'));
        }

        $files = $request->file('file');
        if (!is_null($files)) {
            DB::beginTransaction();
            try {
                // データを更新
                $lcnt = 1;
                foreach($files as $file){
                    $hid =$id;
                    $huserid =$bruise->userid;
                    $htarget =$bruise->target;
                    $helement =$bruise->element;
                    $fname = $hid . '_' . $huserid . '_' . $htarget . '_' . $helement  . '_'; 

                    date_default_timezone_set('Asia/Tokyo');
                    $originalName = $file->getClientOriginalName();
                    $filepath= pathinfo($originalName);
                    $originalFilename =$filepath['filename'];
                    $originalExtension =$filepath['extension'];
                    $micro = explode(" ", microtime());
                    $fileTail = date("Ymd_His", $micro[1]) . '_' . (explode('.', $micro[0])[1]);

                    $dir = 'upFiles';
                    $fileName = $fname . $originalFilename . '_' . $fileTail . '.' . $originalExtension;
                    $file->storeAs($dir, $fileName, ['disk' => 'local']);
                    if ($lcnt == 1){
                        $bruise->fill([
                            'targetfile'=>$fileName,
                            'file1'=>$fname,
                            'oimagename1'=>$originalName,
                            'takeymd1'  =>$inputs['takeymd1'],
                            ]);
                    }elseif ($lcnt == 2){
                        $bruise->fill([
                            'targetfile'=>$fileName,
                            'file2'=>$fname,
                            'oimagename2'=>$originalName,
                            'takeymd2'  =>$inputs['takeymd2'],
                        ]);
                    } 
                    $lcnt = $lcnt + 1;
                }
                $bruise->save();
                DB::commit();
            } catch(\Throwable $e) {
                DB::rollback();
                abort(500);
            }
        }
        \Session::flash('err_msg', 'ファイルをアップロードしました。');
        return redirect(route('showList'));
    }
    /**
     * テーブルに登録してファイルアップロードする
     * 
     * @return view
     * */
    public function insUpload(Request $request)
    {
        $bruise = new Bruise();   
        $user = \Auth::user();
        $username=$user->name;
        $inputs = $request->all();

        $validatedData = $request->validate([
            'target'        => 'nullable | string | max:100',
            'file1'         => 'required | image | max:8192',
            'oimagename1'   => 'nullable | string',
            'takeymd1'      => 'nullable | string | max:125',
//            'file2'         => 'nullable | image | max:512',
//            'oimagename2'   => 'nullable | string',
//            'takeymd2'      => 'nullable | string | max:125',
        ]);
        $files = $inputs['file1'];
        if (is_null($files)) {
            \Session::flash('err_msg', 'ファイルを選択して下さい。');
        } else {
            DB::beginTransaction();
            try {
                // データを登録
                $bruise->fill([
                    'userid'=>$username,
                    'target'=>$inputs['target'],
                ]);
                $maxBruiseId = Bruise::max('id');
                $hid =$maxBruiseId + 1;
                $huserid =$username;
                $htarget =$inputs['target'];
                $helement ='00';
                $fname = $hid . '_' . $huserid . '_' . $htarget . '_' . $helement  . '_'; 

                date_default_timezone_set('Asia/Tokyo');
                $originalName = $files->getClientOriginalName();
                $filepath= pathinfo($originalName);
                $originalFilename =$filepath['filename'];
                $originalExtension =$filepath['extension'];
                $micro = explode(" ", microtime());
                $fileTail = date("Ymd_His", $micro[1]) . '_' . (explode('.', $micro[0])[1]);

//$dir = 'upFiles';
                $dir = 'public/images';
//        dd($dir);
                $fileName = $fname . $originalFilename . '_' . $fileTail . '.' . $originalExtension;
                $files->storeAs($dir, $fileName, ['disk' => 'local']);

                $bruise->fill([
                    'file1'=>$originalName,
                    'oimagename1'=>$fileName,
                    'takeymd1'  =>$inputs['takeymd1'],
                    ]);
                // データを登録
                $bruise->save();
                DB::commit();
                //ユーザディレクトリの作成
                $path = public_path(). '/storage/images/'.$huserid;
                if(!\File::exists($path)) {
                    // path does not exist
                    $rtn = \File::makeDirectory($path);
                }
                //サムネイルの作成
                // 画像を横幅300px・縦幅アスペクト比維持の自動サイズへリサイズ
                $image = \Image::make(file_get_contents($files->getRealPath()))
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio(); })
                ->save($path.'/300-300-'.$hid.$originalName);
            } catch(\Throwable $e) {
                DB::rollback();
                abort(500);
            }
            \Session::flash('err_msg', '写真を投稿しました。');
        }
        // セッションへデータを保存する
        session()->put('id', $hid);

        return redirect(route('showList'));
    }

/**
     * いきなり登録して画像uploadする画面を表示する
     * 
     * @return view
     * */
    public function showUpload(){
                $user = \Auth::user();
                $username=$user->name;
                $userkbn=$user->kbn;
                // セッションへデータを保存する
                session()->put('kbn', $userkbn);

                //セッションにidを取得する
                return view('bruise.showUpload')->with('username',$username,);
            }
     /**
     * PDFを作成する
     * 
     * @return view
     * */
    public function mkPdf($id){

//        $pdf = PDF::loadHTML('<h1>Hello World</h1>');
//        return $pdf->stream();

        
        $bruise = Bruise::find($id);
        //$bruises = DB::table('bruises');
        //$bruise = bruises::find($id);
            
        // セッションへデータを保存する
        if (!session()->has('id')) {
        // 存在しないnullだ
            session()->put('id', $id);
        }
            
        $user = \Auth::user();
        // url直節入力しての他のユーザの参照はできない
        if (!($user->name == $bruise->userid)) {
//            logger('this is error');    
            \Session::flash('err_msg','ユーザが正しくありません。');
            return redirect(route('showList'));
        }
//        dd($bruise);
            
        if (is_null($bruise)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('showList'));
        }
//        return view('bruise.detail', ['bruise'=>$bruise]);

//        $pdf = \PDF::loadView('bruise.mkPdf',['bruise'=>$bruise]);
//        $pdf = \PDF::loadHTML('<h1>Hello World</h1>');
//dd($pdf);
//dd($bruise);

$url = asset('/storage/images/'. $bruise->userid. '/300-300-'. $bruise->id. $bruise->file1);
//////
include "../../../php/pear/TCPDF/tcpdf.php"; // include_path配下に設置したtcpdf.phpを読み込む
 
$tcpdf = new \TCPDF();
$tcpdf->AddPage(); // 新しいpdfページを追加
 
$tcpdf->SetFont("kozgopromedium", "", 10); // デフォルトで用意されている日本語フォント
 
$html = <<< EOF
<style>
h1 {
    font-size: 24px; // 文字の大きさ
    color: #ff00ff; // 文字の色
    text-align: center; // テキストを真ん中に寄せる
}
p {
    font-size: 12px; // 文字の大きさ
    color: #000000; // 文字の色
    text-align: left; // テキストを左に寄せる
}
</style>
<h1>侍エンジニア塾</h1>
<p>
今日は侍エンジニア塾についてお話させていただきます。
</p>
<br>
<img src="<?php$url?>">


<br>
EOF;
 
$tcpdf->writeHTML($html); // 表示htmlを設定
//$tcpdf->Output('samurai.pdf', 'I'); // pdf表示設定
$tcpdf->Output('samurai.pdf', 'D'); // pdfダウンロード
/////


$pdf = \PDF::loadView('bruise.mkPdf', ['bruise'=>$bruise]);
return $pdf->stream('bruise_aiueo.pdf');


//    	return $pdf->stream();
        
//        return $pdf->stream('test01.pdf');


//        return $pdf->download('test01.pdf');

    }
        


            /**
     * 投稿正常終了結果を表示する
     * 
     * @return view
     * */
    public function rtnUpload($id){
        dd($id);
        $bruise = Bruise::find($id);

        return view('bruise.rtnUpload', [
        'userid'=>$bruise->userid,
        'target'=>$bruise->target,
        'file1'=>$bruise->file1,
        'oimagename1'=>$bruise->oimagename1,
        'takeymd1'=>$bruise->takeymd1,
                                        ]);

            
    }
}
