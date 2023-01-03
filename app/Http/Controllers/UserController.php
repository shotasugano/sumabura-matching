<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{    /**
    * Twitterを使用したログイン画面への遷移
    *
    * @param Request $request
    * @return Response
    */
    public function redirectToProvider() {
        return Socialite::driver('twitter')->redirect();
    }
   /**
    * Twitterを使用したログインボタン後の処理（コールバック）
    *
    * @param Request $request
    * @return Response
    */
    public function handleProviderCallback() {
        try {
            $twitterUser=Socialite::with('twitter')->user();
        }catch (Exception $e) {
            return redirect('login/twitter');
        }
 
        $user=User::where('twitter_id', $twitterUser->id)->first();
 
        if($user) {
            $user->name = $twitterUser->name;
            $user->update();
        }else {
            $user=New User();
            $user->twitter_id = $twitterUser->id;
            $user->name = $twitterUser->name;
            $user->save();
        }
 
        Auth::login($user);
        return redirect()->to('/statuses');
    }
    /**
        * ログイン
        *
        * @param Request $request
        * @return Response
        */
    public function login(Request $request)
    { 
        //もしAuthを保持しているようであれば強制的にstatus画面へ遷移する
        if(Auth::check()){
            ///status画面へ遷移
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
    //     public function regist(Request $request)
    //     {
    //         $this->validate($request, [
    //             'name' => 'required|max:255',
    //             'email' => ' required|email|unique:users',    
    //             'password' => 'required|max:32 |confirmed',
    //             'password_confirmation'=> 'required|max:32',
    //         ]);
 
    //         // usersDBへ登録
    //         User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
            
    //         ]);

    //     return redirect('/');
    // }
    /**
        * ログインの判定を行う
        *
        * @param Request $request
        * @return Response
        */
        // public function find(Request $request)
        // {
            //もしAuthを保持しているようであれば強制的にログアウトするTODO
          //  if(Auth::check()){
          //  return redirect('/home');
          //  }

            //  $credentials = $request->validate([
            //     'email' => ['required'],
            //     'password' => ['required'],
            // ]);
     
            // 入力された値がuserDBにあるか、Authで確認し、trueの場合、
            // if (Auth::attempt($credentials)) {
            //     $request->session()->regenerate();
    
            //     return redirect('/statuses');
            // }else{
            //異なる場合
           // session()->flash('erorr','メールアドレス、もしくはパスワードに誤りがあります');
         // return redirect()->back();
        //     return back()->with([
        //     'error'=>'メールアドレス、もしくはパスワードに誤りがあります',
        //     'email' => $request->email,
        //     ]);}
    
        // }
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
            $check =User::where('id',Auth::id())->select('role')->first();
         
            if($check['role'] == 1){
                ///dummy画面へ遷移
                return view('user.dummy');
            }
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
                     ->where('id','!=',Auth::id())
                     ->where('role','=',NULL)
                     ->get();

                     $characters =[
                        '101'=> 'マリオ',
                        '102'=>'ドンキーコング',
                        '103'=>'リンク',
                        '104'=>'サムス・ダークサムス',
                        '105'=>'ヨッシー',
                        '106'=>'カービィ',
                        '107'=>'フォックス',
                        '108'=>'ピカチュウ',
                        '109'=>'ルイージ',
                        '110'=>'ネス',
                        '111'=>'キャプテン・ファルコン',
                        '112'=>'プリン',
                        '113'=>'ピーチ・デイジー',
                        '114'=>'クッパ',
                        '115'=>'アイスクライマー', 
                        '116'=>'シーク',
                        '117'=>'ゼルダ',
                        '118'=>'ドクターマリオ',
                        '119'=>'ピチュー',
                        '120'=>'ファルコ',
                        '121'=>'マルス',
                        '122'=>'ルキナ',
                        '123'=>'こどもリンク',
                        '124'=>'ガノンドロフ',
                        '125'=>'ミュウツー',
                        '126'=>'ロイ',
                        '127'=>'クロム',
                        '128'=>'Mr.ゲーム&ウォッチ',
                        '129'=>'メタナイト',
                        '130'=>'ピット・ブラックピット',
                        '131'=>'ゼロスーツサムス',
                        '132'=>'ワリオ',
                        '133'=>'スネーク',
                        '134'=>'アイク',
                        '135'=>'ポケモントレーナー',
                        '136'=>'ディディーコング',
                        '137'=>'リュカ',
                        '1038'=>'ソニック',
                        '139'=>'デデデ',
                        '140'=>'ピクミン&オリマー' ,
                        '141'=>'ルカリオ',
                        '142'=>'ロボット',
                        '143'=>'トゥーンリンク',
                        '144'=>'ウルフ',
                        '145'=>'むらびと',
                        '146'=>'ロックマン',
                        '147'=>'Wii Fit トレーナー',
                        '148'=>'ロゼッタ&チコ' ,
                        '149'=>'リトル・マック',
                        '150'=>'ゲッコウガ',
                        '151'=>'格闘Mii',
                        '152'=>'剣術Mii',
                        '153'=>'射撃Mii',
                        '154'=>'パルテナ',
                        '155'=>'パックマン',
                        '156'=>'ルフレ' ,
                        '157'=>'シュルク',
                        '158'=>'クッパ Jr.',
                        '159'=>'ダックハント',
                        '160'=>'リュウ',
                        '161'=>'ケン',
                        '162'=>'クラウド',
                        '163'=>'カムイ',
                        '164'=>'ベヨネッタ',
                        '165'=>'インクリング',
                        '166'=>'リドリー',
                        '167'=>'シモン・リヒター',
                        '168'=>'キングクルール',
                        '169'=>'しずえ',
                        '170'=>'ガオガエン',
                        '171'=>'パックンフラワー',
                        '172'=>'ジョーカー',
                        '173'=>'勇者',
                        '174'=>'バンジョー&カズーイ',
                        '175'=>'テリー',
                        '176'=>'ベレト／ベレス',
                        '177'=>'ミェンミェン',
                        '178'=>'スティーブ',
                        '179'=>'セフィロス',
                        '180'=>'ホムラ・ヒカリ',
                        '181'=>'三島一八',
                        '182'=>'ソラ',
                        
    ];
    $rates =[
        '201'=>'未VIP発射台～VIPに向けた発射台',
        '202'=>'未VIP修行ゾーン（下）～未VIP修行ゾーン（上）',
        '203'=>'VIPの階段登る～VIPまであと2-3勝',
        '204'=>'VIP到達～魔境まであと2-3勝',
        '205'=>'魔境Lv.1～魔境Lv.3',
        '206'=>'魔境Lv.4',
        '207'=>'魔境Lv.5',
        '208'=>'魔境卒業',
        '209'=>'地元最強',
        '210'=>'宇宙最強',
        '211'=>'神',
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
        $this->validate($request, [
            'denychara'=> 'array|max:50',
        ],

    [
        'denychara.max' => '最大の拒否キャラは５０キャラまでです',
    ]);
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
                        '101'=> 'マリオ',
                        '102'=>'ドンキーコング',
                        '103'=>'リンク',
                        '104'=>'サムス・ダークサムス',
                        '105'=>'ヨッシー',
                        '106'=>'カービィ',
                        '107'=>'フォックス',
                        '108'=>'ピカチュウ',
                        '109'=>'ルイージ',
                        '110'=>'ネス',
                        '111'=>'キャプテン・ファルコン',
                        '112'=>'プリン',
                        '113'=>'ピーチ・デイジー',
                        '114'=>'クッパ',
                        '115'=>'アイスクライマー', 
                        '116'=>'シーク',
                        '117'=>'ゼルダ',
                        '118'=>'ドクターマリオ',
                        '119'=>'ピチュー',
                        '120'=>'ファルコ',
                        '121'=>'マルス',
                        '122'=>'ルキナ',
                        '123'=>'こどもリンク',
                        '124'=>'ガノンドロフ',
                        '125'=>'ミュウツー',
                        '126'=>'ロイ',
                        '127'=>'クロム',
                        '128'=>'Mr.ゲーム&ウォッチ',
                        '129'=>'メタナイト',
                        '130'=>'ピット・ブラックピット',
                        '131'=>'ゼロスーツサムス',
                        '132'=>'ワリオ',
                        '133'=>'スネーク',
                        '134'=>'アイク',
                        '135'=>'ポケモントレーナー',
                        '136'=>'ディディーコング',
                        '137'=>'リュカ',
                        '138'=>'ソニック',
                        '139'=>'デデデ',
                        '140'=>'ピクミン&オリマー' ,
                        '141'=>'ルカリオ',
                        '142'=>'ロボット',
                        '143'=>'トゥーンリンク',
                        '144'=>'ウルフ',
                        '145'=>'むらびと',
                        '146'=>'ロックマン',
                        '147'=>'Wii Fit トレーナー',
                        '148'=>'ロゼッタ&チコ' ,
                        '149'=>'リトル・マック',
                        '150'=>'ゲッコウガ',
                        '151'=>'格闘Mii',
                        '152'=>'剣術Mii',
                        '153'=>'射撃Mii',
                        '154'=>'パルテナ',
                        '155'=>'パックマン',
                        '156'=>'ルフレ' ,
                        '157'=>'シュルク',
                        '158'=>'クッパ Jr.',
                        '159'=>'ダックハント',
                        '160'=>'リュウ',
                        '161'=>'ケン',
                        '162'=>'クラウド',
                        '163'=>'カムイ',
                        '164'=>'ベヨネッタ',
                        '165'=>'インクリング',
                        '166'=>'リドリー',
                        '167'=>'シモン・リヒター',
                        '168'=>'キングクルール',
                        '169'=>'しずえ',
                        '170'=>'ガオガエン',
                        '171'=>'パックンフラワー',
                        '172'=>'ジョーカー',
                        '173'=>'勇者',
                        '174'=>'バンジョー&カズーイ',
                        '175'=>'テリー',
                        '176'=>'ベレト／ベレス',
                        '177'=>'ミェンミェン',
                        '178'=>'スティーブ',
                        '179'=>'セフィロス',
                        '180'=>'ホムラ・ヒカリ',
                        '181'=>'三島一八',
                        '182'=>'ソラ',
                        
    ];
    $rates =[
        '201'=>'未VIP発射台～VIPに向けた発射台',
        '202'=>'未VIP修行ゾーン（下）～未VIP修行ゾーン（上）',
        '203'=>'VIPの階段登る～VIPまであと2-3勝',
        '204'=>'VIP到達～魔境まであと2-3勝',
        '205'=>'魔境Lv.1～魔境Lv.3',
        '206'=>'魔境Lv.4',
        '207'=>'魔境Lv.5',
        '208'=>'魔境卒業',
        '209'=>'地元最強',
        '210'=>'宇宙最強',
        '211'=>'神',
    ];

    return view('user.edit',
    ['characters'=>$characters,'user'=>$user,'rates'=>$rates]
    );
    }
    /**
        * 使い方説明画面へ遷移
        *
        * @param Request $request
        */
        public function instruction(Request $request)
        { 
            return view('user.instruction');
        }
    /**
        * 退会画面へ遷移
        *
        * @param Request $request
        */
        public function withdrawal(Request $request)
        { 
            if ($request->isMethod('post')) {
            User::where('id',Auth::id())
            ->update([
                'role'=> 1,
            ]);

            return view('user.dummy');
        }

            return view('user.withdrawal');
        }
}