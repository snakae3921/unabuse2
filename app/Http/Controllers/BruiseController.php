<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bruise;
use App\Http\Requests\BruiseRequest;
use Illuminate\Support\Facades\DB; // DB ファサードを use する

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
        logger('this is showList');    
        $user = \Auth::user();
//        dd($user->name);
//        dd($user);
         // テーブルを指定
        $bruises = DB::table('bruises');
        logger($user->name);    
	    $bruise = $bruises->where('userid', '=', $user->name)->get();
//        $bruises = Bruise::all();
//        dd($bruises);
        return view('bruise.list', ['bruises'=>$bruise]);
    }
    /**
     * データ詳細を表示する
     * @param int $id
     * @return view
     * */
    public function showDetail($id){
        logger('this is showDetail');    

        $bruise = Bruise::find($id);
//$bruises = DB::table('bruises');
//$bruise = bruises::find($id);
//        dd($bruise);

        // セッションへデータを保存する
        if (!session()->has('id')) {
        // 存在しないnullだ
           session()->put('id', $id);
        }
//        logger('id' );    

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
        logger('this is showCreate');    

//        return view('bruise.create');
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
        logger('this is exeInsert');    
        $inputs = $request->all();
//        dd($inputs);
        DB::beginTransaction();
        try {
            // データを登録
            Bruise::create($inputs);
            logger('create after');    
            //            dd($inputs);
            DB::commit();
            logger('commit after');    
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
        logger('this is showEdit');    

        // セッションへデータを保存する
        if (!session()->has('id')) {
            // 存在しないnullだ
               session()->put('id', $id);
        }
        $bruise = Bruise::find($id);
//$bruise = $bruises::find($id);
//dd($bruise);
        if (is_null($bruise)){
            \Session::flash('err_msg','データがありません。。');
            return redirect(route('showList'));
        }
        return view('bruise.edit', ['bruise'=>$bruise]);
    }
    /**
     * データ更新する
     * 
     * @return view
     * */
    public function exeUpdate(BruiseRequest $request){
        logger('this is exeUpdate');    
        $inputs = $request->all();
//dd($inputs);
        DB::beginTransaction();
        try {
            // データを更新
            $bruise = Bruise::find($inputs['id']);
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
                'targetfile' =>$inputs['targetfile'],
                'note'     =>$inputs['note'],
            ]);
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
        logger('this is exeUpload');    

        $inputs = $request->all();
//        dd($inputs);
        //セッションからidを取得する
        $id = session()->pull('id', 'default');    
//        dd($id);

        $bruise = Bruise::find($id);
        if (is_null($bruise)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('showList'));
        }

        $files = $request->file('file');
//        dd($file);
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
                            'image1'=>$fname,
                            'oimagename1'=>$originalName,
                            'takeymd1'  =>$inputs['takeymd1'],
                            ]);
                    }elseif ($lcnt == 2){
                        $bruise->fill([
                            'targetfile'=>$fileName,
                            'image2'=>$fname,
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
        logger('this is insUpload'); 
        $bruise = new Bruise();   
        $user = \Auth::user();
        $username=$user->name;
        $inputs = $request->all();
//        dd($inputs);

        $files = $request->file('file');
//        dd($file);
        if (!is_null($files)) {
            DB::beginTransaction();
            try {
                // データを登録
                $bruise->fill([
                    'userid'=>$username,
                    'target'=>$inputs['target'],
                ]);
                $lcnt = 1;
                foreach($files as $file){
                    $maxBruiseId = Bruise::max('id');
                    $hid =$maxBruiseId + 1;
                    $huserid =$username;
                    $htarget =$inputs['target'];
                    $helement ='00';
                    $fname = $hid . '_' . $huserid . '_' . $htarget . '_' . $helement  . '_'; 
//                    dd($bruise);

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
                            'image1'=>$fname,
                            'oimagename1'=>$originalName,
                            'takeymd1'  =>$inputs['takeymd1'],
                            ]);
                    }elseif ($lcnt == 2){
                        $bruise->fill([
                            'targetfile'=>$fileName,
                            'image2'=>$fname,
                            'oimagename2'=>$originalName,
                            'takeymd2'  =>$inputs['takeymd2'],
                        ]);
                    } 
                    $lcnt = $lcnt + 1;
                }
                // データを登録
//                dd($bruise);
                $bruise->save();
                DB::commit();
            } catch(\Throwable $e) {
                DB::rollback();
                abort(500);
            }
        }
        \Session::flash('err_msg', 'ファイルをアップロードしました。');
        return redirect(route('showUpload'));
    }

/**
     * いきなり登録して画像uploadする画面を表示する
     * 
     * @return view
     * */
    public function showUpload(){
        //        dd($bruises);
                logger('this is showUpload');    
        
        //        return view('bruise.showUpload');
                $user = \Auth::user();
                //dd($user);
                $username=$user->name;
                return view('bruise.showUpload')->with('username',$user->name);
        
            }
            
        
}
