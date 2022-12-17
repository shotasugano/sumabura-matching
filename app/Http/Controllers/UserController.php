<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    /**
        * ログイン
        *
        * @param Request $request
        * @return Response
        */
    public function login(Request $request)
    { 
        //もしAuthを保持しているようであれば強制的にhome画面へ遷移する
        if(Auth::check()){
            ///home画面へ遷移
            return redirect('/statuses');
        }
        return view('user.login');
    }
    /**
        * 登録画面へ遷移
        *
        * @param Request $request
        * @return Response
        */
        public function registmove(Request $request)
        { 
            return view('user.regist');
            
        }
    /**
        * usersDBへ情報を登録後ログイン画面へ遷移
        *
        * @param Request $request
        * @return Response
        */
        public function regist(Request $request)
        {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => ' required|email|unique:users',    
                'password' => 'required|max:32 |confirmed',
                'password_confirmation'=> 'required|max:32',
            ]);
 
            // usersDBへ登録
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

        return redirect('/');
    }
    /**
        * ログインの判定を行う
        *
        * @param Request $request
        * @return Response
        */
        public function find(Request $request)
        {
            //もしAuthを保持しているようであれば強制的にログアウトするTODO
          //  if(Auth::check()){
          //  return redirect('/home');
          //  }

             $credentials = $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);
     
            // 入力された値がuserDBにあるか、Authで確認し、trueの場合、
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
                return redirect('/statuses');
            }else{
            //異なる場合
           // session()->flash('erorr','メールアドレス、もしくはパスワードに誤りがあります');
         // return redirect()->back();
            return back()->with([
            'error'=>'メールアドレス、もしくはパスワードに誤りがあります',
            'email' => $request->email,
            ]);}
    
        }
        /**
 * ユーザーをアプリケーションからログアウトさせる
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
        public function logout(Request $request)
        {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
        }

              /**
        * タスク一覧
        *
        * @param Request $request
        * @return Response
        */
        public function index(Request $request)
        {
        
            //検索をした場合名前からあいまい検索をしてくれる
            $namekeyword = $request->input('keyword');
            $charakeyword = $request->input('charaname');
            $ratekeyword = $request->input('rate');
            $query = User::query();
            //userのdenychara1001,1002,等の列を[1001,1002]の配列にする（whereinを使うため）
            $denycharas =User::where('id',Auth::id())
            ->value('denychara');
            $denycharas =explode(",",$denycharas);
            $denyrates =User::where('id',Auth::id())
            ->value('denyrate');
            $denyrates =explode(",",$denyrates);
// dd($denycharas);
            if(!empty($namekeyword)){
            $query->where('name','LIKE',"%{$namekeyword}%");
            }elseif(!empty($charakeyword)  || !empty($ratekeyword)){
                $query->where('charaname','=',"{$charakeyword}")
                      ->orwhere('rate','=',"{$ratekeyword}");
            }

             //userが拒否するもの以外のユーザー一覧を取得する
             $users = $query->whereNOTIn('charaname', $denycharas)
                     ->whereNOTIN('rate',$denyrates)
                     ->get();

                     $characters =[
                        '1001'=> 'マリオ',
                        '1002'=>'ドンキーコング',
                        '1003'=>'リンク',
                        '1004'=>'サムス・ダークサムス',
                        '1005'=>'ヨッシー',
                        '1006'=>'カービィ',
                        '1007'=>'フォックス',
                        '1008'=>'ピカチュウ',
                        '1009'=>'ルイージ',
                        '1010'=>'ネス',
                        '1011'=>'キャプテン・ファルコン',
                        '1012'=>'プリン',
                        '1013'=>'ピーチ・デイジー',
                        '1014'=>'クッパ',
                        '1015'=>'アイスクライマー', 
                        '1016'=>'シーク',
                        '1017'=>'ゼルダ',
                        '1018'=>'ドクターマリオ',
                        '1019'=>'ピチュー',
                        '1020'=>'ファルコ',
                        '1021'=>'マルス',
                        '1022'=>'ルキナ',
                        '1023'=>'こどもリンク',
                        '1024'=>'ガノンドロフ',
                        '1025'=>'ミュウツー',
                        '1026'=>'ロイ',
                        '1027'=>'クロム',
                        '1028'=>'Mr.ゲーム&amp;ウォッチ',
                        '1029'=>'メタナイト',
                        '1030'=>'ピット・ブラックピット',
                        '1031'=>'ゼロスーツサムス',
                        '1032'=>'ワリオ',
                        '1033'=>'スネーク',
                        '1034'=>'アイク',
                        '1035'=>'ポケモントレーナー',
                        '1036'=>'ディディーコング',
                        '1037'=>'リュカ',
                        '1038'=>'ソニック',
                        '1039'=>'デデデ',
                        '1040'=>'ピクミン&amp;オリマー' ,
                        '1041'=>'ルカリオ',
                        '1042'=>'ロボット',
                        '1043'=>'トゥーンリンク',
                        '1044'=>'ウルフ',
                        '1045'=>'むらびと',
                        '1046'=>'ロックマン',
                        '1047'=>'Wii Fit トレーナー',
                        '1048'=>'ロゼッタ&amp;チコ' ,
                        '1049'=>'リトル・マック',
                        '1050'=>'ゲッコウガ',
                        '1051'=>'格闘Mii',
                        '1052'=>'剣術Mii',
                        '1053'=>'射撃Mii',
                        '1054'=>'パルテナ',
                        '1055'=>'パックマン',
                        '1056'=>'ルフレ' ,
                        '1057'=>'シュルク',
                        '1058'=>'クッパ Jr.',
                        '1059'=>'ダックハント',
                        '1060'=>'リュウ',
                        '1061'=>'ケン',
                        '1062'=>'クラウド',
                        '1063'=>'カムイ',
                        '1064'=>'ベヨネッタ',
                        '1065'=>'インクリング',
                        '1066'=>'リドリー',
                        '1067'=>'シモン・リヒター',
                        '1068'=>'キングクルール',
                        '1069'=>'しずえ',
                        '1070'=>'ガオガエン',
                        '1071'=>'パックンフラワー',
                        '1072'=>'ジョーカー',
                        '1073'=>'勇者',
                        '1074'=>'バンジョー&amp;カズーイ',
                        '1075'=>'テリー',
                        '1076'=>'ベレト／ベレス',
                        '1077'=>'ミェンミェン',
                        '1078'=>'スティーブ',
                        '1079'=>'セフィロス',
                        '1080'=>'ホムラ・ヒカリ',
                        '1081'=>'三島一八',
                        '1082'=>'ソラ',
                        
    ];
    $rates =[
        '2001'=>'未VIP発射台～VIPに向けた発射台',
        '2002'=>'未VIP修行ゾーン（下）～VIPまであと2-3勝',
        '2003'=>'VIP到達～魔境まであと2-3勝',
        '2004'=>'魔境Lv.1～魔境Lv.3',
        '2005'=>'魔境Lv.4',
        '2006'=>'魔境Lv.5',
        '2007'=>'魔境卒業',
        '2008'=>'地元最強',
        '2009'=>'宇宙最強',
        '2010'=>'神',
    ];


        return view('user.index', [
            'users' => $users,'characters'=>$characters,'rates'=>$rates
        ]);
        }
        /**
     * プロフィール登録画面へ遷移
        * @return Response
     */
    public function edit(Request $request)
    { if ($request->isMethod('post')) {
        // バリデーション
    //     $this->validate($request, [
    //         'charaname'=> 'required',
    //         'rate'=> 'required',
    //         'playdate'=> 'required',
    //     ],

    // [
    //     'charaname.required' => '使用キャラを選択してください',
    //     'rate.required' => '戦闘力を入力してください',
    //     'playdate.required' => 'プレイ時間を入力してください',
    // ]);
        // 申請DBへ商品登録
        if(!empty($request->denychara)){
        $requestdenychara = implode(',', $request->denychara);
        }else{
        $requestdenychara =NULL;
        };
        if(!empty($request->denyrate)){
        $requestdenyrate =implode(',', $request->denyrate);
         }else{
        $requestdenyrate =NULL;
         };
 User::where('id',Auth::id())
            ->update([
                'charaname'=> $request->charaname,
                'denychara'=> $requestdenychara,
                'rate'=> $request->rate,
                'denyrate'=> $requestdenyrate,
                'path'=> $request->path,
                'address'=> $request->address,
                'playdate'=> $request->playdate,
            ]);
        return redirect('/statuses');
    }
    $user =User::where('id',Auth::id())->first();
    $characters =[
                        '1001'=> 'マリオ',
                        '1002'=>'ドンキーコング',
                        '1003'=>'リンク',
                        '1004'=>'サムス・ダークサムス',
                        '1005'=>'ヨッシー',
                        '1006'=>'カービィ',
                        '1007'=>'フォックス',
                        '1008'=>'ピカチュウ',
                        '1009'=>'ルイージ',
                        '1010'=>'ネス',
                        '1011'=>'キャプテン・ファルコン',
                        '1012'=>'プリン',
                        '1013'=>'ピーチ・デイジー',
                        '1014'=>'クッパ',
                        '1015'=>'アイスクライマー', 
                        '1016'=>'シーク',
                        '1017'=>'ゼルダ',
                        '1018'=>'ドクターマリオ',
                        '1019'=>'ピチュー',
                        '1020'=>'ファルコ',
                        '1021'=>'マルス',
                        '1022'=>'ルキナ',
                        '1023'=>'こどもリンク',
                        '1024'=>'ガノンドロフ',
                        '1025'=>'ミュウツー',
                        '1026'=>'ロイ',
                        '1027'=>'クロム',
                        '1028'=>'Mr.ゲーム&amp;ウォッチ',
                        '1029'=>'メタナイト',
                        '1030'=>'ピット・ブラックピット',
                        '1031'=>'ゼロスーツサムス',
                        '1032'=>'ワリオ',
                        '1033'=>'スネーク',
                        '1034'=>'アイク',
                        '1035'=>'ポケモントレーナー',
                        '1036'=>'ディディーコング',
                        '1037'=>'リュカ',
                        '1038'=>'ソニック',
                        '1039'=>'デデデ',
                        '1040'=>'ピクミン&amp;オリマー' ,
                        '1041'=>'ルカリオ',
                        '1042'=>'ロボット',
                        '1043'=>'トゥーンリンク',
                        '1044'=>'ウルフ',
                        '1045'=>'むらびと',
                        '1046'=>'ロックマン',
                        '1047'=>'Wii Fit トレーナー',
                        '1048'=>'ロゼッタ&amp;チコ' ,
                        '1049'=>'リトル・マック',
                        '1050'=>'ゲッコウガ',
                        '1051'=>'格闘Mii',
                        '1052'=>'剣術Mii',
                        '1053'=>'射撃Mii',
                        '1054'=>'パルテナ',
                        '1055'=>'パックマン',
                        '1056'=>'ルフレ' ,
                        '1057'=>'シュルク',
                        '1058'=>'クッパ Jr.',
                        '1059'=>'ダックハント',
                        '1060'=>'リュウ',
                        '1061'=>'ケン',
                        '1062'=>'クラウド',
                        '1063'=>'カムイ',
                        '1064'=>'ベヨネッタ',
                        '1065'=>'インクリング',
                        '1066'=>'リドリー',
                        '1067'=>'シモン・リヒター',
                        '1068'=>'キングクルール',
                        '1069'=>'しずえ',
                        '1070'=>'ガオガエン',
                        '1071'=>'パックンフラワー',
                        '1072'=>'ジョーカー',
                        '1073'=>'勇者',
                        '1074'=>'バンジョー&amp;カズーイ',
                        '1075'=>'テリー',
                        '1076'=>'ベレト／ベレス',
                        '1077'=>'ミェンミェン',
                        '1078'=>'スティーブ',
                        '1079'=>'セフィロス',
                        '1080'=>'ホムラ・ヒカリ',
                        '1081'=>'三島一八',
                        '1082'=>'ソラ',
                        
    ];
    $rates =[
        '2001'=>'未VIP発射台～VIPに向けた発射台',
        '2002'=>'未VIP修行ゾーン（下）～VIPまであと2-3勝',
        '2003'=>'VIP到達～魔境まであと2-3勝',
        '2004'=>'魔境Lv.1～魔境Lv.3',
        '2005'=>'魔境Lv.4',
        '2006'=>'魔境Lv.5',
        '2007'=>'魔境卒業',
        '2008'=>'地元最強',
        '2009'=>'宇宙最強',
        '2010'=>'神',
    ];

    return view('user.edit',
    ['characters'=>$characters,'user'=>$user,'rates'=>$rates]
    );
    }

}