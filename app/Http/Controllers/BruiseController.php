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
//        dd($user);
         // テーブルを指定
        $bruises = DB::table('bruises');
//        logger($user->name);    
        $bruise = $bruises->where('userid', '=', $user->name)
        ->orderBy('id', 'desc')
        ->get();
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
//        logger('this is showDetail');    

        $bruise = Bruise::find($id);
//$bruises = DB::table('bruises');
//$bruise = bruises::find($id);
//        dd($bruise);

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
//        logger('this is exeInsert');    
        $inputs = $request->all();
//        dd($inputs);
        DB::beginTransaction();
        try {
            // データを登録
            Bruise::create($inputs);
//            logger('create after');    
            //            dd($inputs);
            DB::commit();
//            logger('commit after');    
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
//            logger('this is error');    
            \Session::flash('err_msg','ユーザが正しくありません。');
            return redirect(route('showList'));
        }
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
//        logger('this is exeUpdate');    
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
                'note'     =>$inputs['note'],
                'takeymd1'     =>$inputs['takeymd1'],
//                'takeymd2'     =>$inputs['takeymd2'],
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
//        logger('this is exeUpload');    

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
//        logger('this is insUpload'); 
        $bruise = new Bruise();   
        $user = \Auth::user();
        $username=$user->name;
        $inputs = $request->all();
//        dd($inputs);

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
//        dd($files);
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
//                    dd($bruise);

                date_default_timezone_set('Asia/Tokyo');
                $originalName = $files->getClientOriginalName();
                $filepath= pathinfo($originalName);
                $originalFilename =$filepath['filename'];
                $originalExtension =$filepath['extension'];
                $micro = explode(" ", microtime());
                $fileTail = date("Ymd_His", $micro[1]) . '_' . (explode('.', $micro[0])[1]);
//                dd($bruise);

                $dir = 'upFiles';
                $fileName = $fname . $originalFilename . '_' . $fileTail . '.' . $originalExtension;
                $files->storeAs($dir, $fileName, ['disk' => 'local']);
//                dd($bruise);

                $bruise->fill([
                    'file1'=>$originalName,
                    'oimagename1'=>$fileName,
                    'takeymd1'  =>$inputs['takeymd1'],
                    ]);
                // データを登録
//                dd($bruise);
                $bruise->save();
                DB::commit();
                //ユーザディレクトリの作成
                $path = public_path(). '/storage/images/'.$huserid;
//                dd($path);
                if(!\File::exists($path)) {
                    // path does not exist
                    $rtn = \File::makeDirectory($path);
//                    dd($rtn);
                }

//                dd($path);
                //サムネイルの作成
                $image = \Image::make(file_get_contents($files->getRealPath()));
//                dd($image);
                $image
//                    ->save($dir .$fileName)
                    ->resize(300, 300)
//                    ->save($dir.'/300-300-'.$fileName)
//                    ->resize(500, 500)
                    ->save($path.'/300-300-'.$hid.$originalName);
//        dd($files);
//$image::move(public_path().'/images/300-300-'.$hid.$originalName,
//                public_path().'/images/300x-300x-'.$hid.$originalName);
//                $dir.'/thumbnail/300-300-'.$hid.$originalName);
//$str = $dir.'/thumbnail/300-300-'.$hid.$originalName;
//$str = public_path().'/images/300-300-'.$hid.$originalName;
//$str = __DIR__;
//dd($str);
//rename(public_path().'/images/300-300-'.$hid.$originalName,
//            '../');
//'../../../storage/app/upFiles/thumbnail/300-300-'.$hid.$originalName);
//public_path().'/images/300x-300x-'.$hid.$originalName);
   

//        dd($files);



            } catch(\Throwable $e) {
                DB::rollback();
                abort(500);
            }
            \Session::flash('err_msg', '写真を投稿しました。');
        }
//        dd($files);

        // セッションへデータを保存する
        session()->put('id', $hid);

//return redirect(route('showUpload'));
//\Session::flash('err_msg', 'ファイルをアップロードしました。');
return redirect(route('showList'));

//return redirect(route('rtnUpload', ['id' => $hid]));
//return view('bruise.rtnUpload')->with('id',$hid);
    }

/**
     * いきなり登録して画像uploadする画面を表示する
     * 
     * @return view
     * */
    public function showUpload(){
        //        dd($bruises);
//                logger('this is showUpload');    
        
        //        return view('bruise.showUpload');
                $user = \Auth::user();
                //dd($user);
                $username=$user->name;
                //セッションからidを取得する
                $id = session()->pull('id', 'default');    
                $bruise = Bruise::find($id);
//                return view('bruise.showUpload')->with('username',$username,);
                return view('bruise.showUpload')->with('username',$username,'bruise',$bruise,);
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
