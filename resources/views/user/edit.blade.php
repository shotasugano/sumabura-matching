@extends('layouts.app')
 

@section('content')
<!--バリデーションの結果表示-->
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif
<!--登録-->

            <div class="card card-primary">
                <form method="POST" >
                    @csrf
                        <div class="form-group">
                        <div class="card-body">
                        <label for="charaname">使用キャラ
                        <select required name="charaname"class="uk-select" id="charaname" style="padding-left: 30px;" onchange="changeChara('my')">
                        @if(empty($user->charaname)) 
                        <option value="" selected   hidden>選択してください</option>
                        @endif
                        @foreach ($characters as $character_key => $character_val)
                        @if ($user->charaname == $character_key)
                        <option value="{{ $character_key}}" selected>{{ $character_val}}</option>
                        @else
                        <option value="{{ $character_key}}" >{{ $character_val}}</option>
                        @endif
                        @endforeach
                        </label>
                        <!-- <option value="1001">マリオ</option>
                        <option value="1002">ドンキーコング</option>
                        <option value="1003">リンク</option>
                        <option value="1004">サムス・ダークサムス</option>
                        <option value="1005">ヨッシー</option>
                        <option value="1006">カービィ</option>
                        <option value="1007">フォックス</option>
                        <option value="1008">ピカチュウ</option>
                        <option value="1009">ルイージ</option>
                        <option value="1010">ネス</option>
                        <option value="1011">キャプテン・ファルコン</option>
                        <option value="1012">プリン</option>
                        <option value="1013">ピーチ・デイジー</option>
                        <option value="1014">クッパ</option>
                        <option value="1015">アイスクライマー </option>
                        <option value="1016">シーク</option>
                        <option value="1017">ゼルダ</option>
                        <option value="1018">ドクターマリオ</option>
                        <option value="1019">ピチュー</option>
                        <option value="1020">ファルコ</option>
                        <option value="1021">マルス</option>
                        <option value="1022">ルキナ</option>
                        <option value="1023">こどもリンク</option>
                        <option value="1024">ガノンドロフ</option>
                        <option value="1025">ミュウツー</option>
                        <option value="1026">ロイ</option>
                        <option value="1027">クロム</option>
                        <option value="1028">Mr.ゲーム&amp;ウォッチ</option>
                        <option value="1029">メタナイト</option>
                        <option value="1030">ピット・ブラックピット</option>
                        <option value="1031">ゼロスーツサムス</option>
                        <option value="1032">ワリオ</option>
                        <option value="1033">スネーク</option>
                        <option value="1034">アイク</option>
                        <option value="1035">ポケモントレーナー</option>
                        <option value="1036">ディディーコング</option>
                        <option value="1037">リュカ</option>
                        <option value="1038">ソニック</option>
                        <option value="1039">デデデ</option>
                        <option value="1040">ピクミン&amp;オリマー </option>
                        <option value="1041">ルカリオ </option>
                        <option value="1042">ロボット</option>
                        <option value="1043">トゥーンリンク</option>
                        <option value="1044">ウルフ</option>
                        <option value="1045">むらびと</option>
                        <option value="1046">ロックマン</option>
                        <option value="1047">Wii Fit トレーナー </option>
                        <option value="1048">ロゼッタ&amp;チコ </option>
                        <option value="1049">リトル・マック</option>
                        <option value="1050">ゲッコウガ</option>
                        <option value="1051">格闘Mii</option>
                        <option value="1052">剣術Mii</option>
                        <option value="1053">射撃Mii</option>
                        <option value="1054">パルテナ</option>
                        <option value="1055">パックマン</option>
                        <option value="1056">ルフレ </option>
                        <option value="1057">シュルク </option>
                        <option value="1058">クッパ Jr.</option>
                        <option value="1059">ダックハント</option>
                        <option value="1060">リュウ</option>
                        <option value="1061">ケン</option>
                        <option value="1062">クラウド</option>
                        <option value="1063">カムイ</option>
                        <option value="1064">ベヨネッタ</option>
                        <option value="1065">インクリング</option>
                        <option value="1066">リドリー</option>
                        <option value="1067">シモン・リヒター</option>
                        <option value="1068">キングクルール</option>
                        <option value="1069">しずえ</option>
                        <option value="1070">ガオガエン</option>
                        <option value="1071">パックンフラワー</option>
                        <option value="1072">ジョーカー</option>
                        <option value="1073">勇者</option>
                        <option value="1074">バンジョー&amp;カズーイ</option>
                        <option value="1075">テリー</option>
                        <option value="1076">ベレト／ベレス</option>
                        <option value="1077">ミェンミェン</option>
                        <option value="1078">スティーブ</option>
                        <option value="1079">セフィロス</option>
                        <option value="1080">ホムラ・ヒカリ</option>
                        <option value="1081">三島一八</option>
                        <option value="1082">ソラ</option> -->
                        </select>
                        </div>

                        <div class="form-group">
                        <div class="card-body">
                        <label for="denychara[]">拒否キャラ</label>

                        @foreach ($characters as $character_key => $character_val)
                        <div class="form-check">
                        @if (mb_strpos( $user->denychara ,$character_key) === false )
                        <label class="form-check-label" for="{{ $character_key }}">
                        <input name="denychara[]" type="checkbox" value="{{ $character_key }}" id="{{ $character_key }}">
                        @else
                        <label class="form-check-label" for="{{ $character_key }}">
                        <input name="denychara[]" type="checkbox" value="{{ $character_key }}"  id="{{ $character_key }}" checked >
                        @endif
                        {{$character_val}}</label>
                        </div>
                        @endforeach
                        <!-- <input type="checkbox" name="denychara[]" value="1001"> マリオ
                        <input type="checkbox" name="denychara[]" value="1002">ドンキーコング
                        <input type="checkbox" name="denychara[]" value="1003">リンク
                        <input type="checkbox" name="denychara[]" value="1004">サムス・ダークサムス
                        <input type="checkbox" name="denychara[]" value="1005">ヨッシー
                        <input type="checkbox" name="denychara[]" value="1006">カービィ
                        <input type="checkbox" name="denychara[]" value="1007">フォックス
                        <input type="checkbox" name="denychara[]" value="1008">ピカチュウ
                        <input type="checkbox" name="denychara[]" value="1009">ルイージ
                        <input type="checkbox" name="denychara[]" value="1010">ネス
                        <input type="checkbox" name="denychara[]" value="1011">キャプテン・ファルコン
                        <input type="checkbox" name="denychara[]" value="1012">プリン
                        <input type="checkbox" name="denychara[]" value="1013">ピーチ・デイジー
                        <input type="checkbox" name="denychara[]" value="1014">クッパ
                        <input type="checkbox" name="denychara[]" value="1015">アイスクライマー 
                        <input type="checkbox" name="denychara[]" value="1016">シーク
                        <input type="checkbox" name="denychara[]" value="1017">ゼルダ
                        <input type="checkbox" name="denychara[]" value="1018">ドクターマリオ
                        <input type="checkbox" name="denychara[]" value="1019">ピチュー
                        <input type="checkbox" name="denychara[]" value="1020">ファルコ
                        <input type="checkbox" name="denychara[]" value="1021">マルス
                        <input type="checkbox" name="denychara[]" value="1022">ルキナ
                        <input type="checkbox" name="denychara[]" value="1023">こどもリンク
                        <input type="checkbox" name="denychara[]" value="1024">ガノンドロフ
                        <input type="checkbox" name="denychara[]" value="1025">ミュウツー
                        <input type="checkbox" name="denychara[]" value="1026">ロイ
                        <input type="checkbox" name="denychara[]" value="1027">クロム
                        <input type="checkbox" name="denychara[]" value="1028">Mr.ゲーム&amp;ウォッチ
                        <input type="checkbox" name="denychara[]" value="1029">メタナイト
                        <input type="checkbox" name="denychara[]" value="1030">ピット・ブラックピット
                        <input type="checkbox" name="denychara[]" value="1031">ゼロスーツサムス
                        <input type="checkbox" name="denychara[]" value="1032">ワリオ
                        <input type="checkbox" name="denychara[]" value="1033">スネーク
                        <input type="checkbox" name="denychara[]" value="1034">アイク
                        <input type="checkbox" name="denychara[]" value="1035">ポケモントレーナー
                        <input type="checkbox" name="denychara[]" value="1036">ディディーコング
                        <input type="checkbox" name="denychara[]" value="1037">リュカ
                        <input type="checkbox" name="denychara[]" value="1038">ソニック
                        <input type="checkbox" name="denychara[]" value="1039">デデデ
                        <input type="checkbox" name="denychara[]" value="1040">ピクミン&amp;オリマー 
                        <input type="checkbox" name="denychara[]" value="1041">ルカリオ
                        <input type="checkbox" name="denychara[]" value="1042">ロボット
                        <input type="checkbox" name="denychara[]" value="1043">トゥーンリンク
                        <input type="checkbox" name="denychara[]" value="1044">ウルフ
                        <input type="checkbox" name="denychara[]" value="1045">むらびと
                        <input type="checkbox" name="denychara[]" value="1046">ロックマン
                        <input type="checkbox" name="denychara[]" value="1047">Wii Fit トレーナー
                        <input type="checkbox" name="denychara[]" value="1048">ロゼッタ&amp;チコ 
                        <input type="checkbox" name="denychara[]" value="1049">リトル・マック
                        <input type="checkbox" name="denychara[]" value="1050">ゲッコウガ
                        <input type="checkbox" name="denychara[]" value="1051">格闘Mii
                        <input type="checkbox" name="denychara[]" value="1052">剣術Mii
                        <input type="checkbox" name="denychara[]" value="1053">射撃Mii
                        <input type="checkbox" name="denychara[]" value="1054">パルテナ
                        <input type="checkbox" name="denychara[]" value="1055">パックマン
                        <input type="checkbox" name="denychara[]" value="1056">ルフレ 
                        <input type="checkbox" name="denychara[]" value="1057">シュルク
                         <input type="checkbox" name="denychara[]" value="1058">クッパ Jr.
                         <input type="checkbox" name="denychara[]" value="1059">ダックハント
                         <input type="checkbox" name="denychara[]" value="1060">リュウ
                         <input type="checkbox" name="denychara[]" value="1061">ケン
                         <input type="checkbox" name="denychara[]" value="1062">クラウド
                         <input type="checkbox" name="denychara[]" value="1063">カムイ
                         <input type="checkbox" name="denychara[]" value="1064">ベヨネッタ
                         <input type="checkbox" name="denychara[]" value="1065">インクリング
                         <input type="checkbox" name="denychara[]" value="1066">リドリー
                         <input type="checkbox" name="denychara[]" value="1067">シモン・リヒター
                         <input type="checkbox" name="denychara[]" value="1068">キングクルール
                         <input type="checkbox" name="denychara[]" value="1069">しずえ
                         <input type="checkbox" name="denychara[]" value="1070">ガオガエン
                         <input type="checkbox" name="denychara[]" value="1071">パックンフラワー
                         <input type="checkbox" name="denychara[]" value="1072">ジョーカー
                         <input type="checkbox" name="denychara[]" value="1073">勇者
                         <input type="checkbox" name="denychara[]" value="1074">バンジョー&amp;カズーイ
                         <input type="checkbox" name="denychara[]" value="1075">テリー
                         <input type="checkbox" name="denychara[]" value="1076">ベレト／ベレス
                         <input type="checkbox" name="denychara[]" value="1077">ミェンミェン
                         <input type="checkbox" name="denychara[]" value="1078">スティーブ
                         <input type="checkbox" name="denychara[]" value="1079">セフィロス
                         <input type="checkbox" name="denychara[]" value="1080">ホムラ・ヒカリ
                         <input type="checkbox" name="denychara[]" value="1081">三島一八
                         <input type="checkbox" name="denychara[]" value="1082">ソラ</option>
                         -->
                         </div>
                        
                        <div class="form-group">
                            <label for="rate">戦闘力</label>
                            <select required name="rate" class="uk-select" id="rate" style="padding-left: 30px;" onchange="changeChara('my')">
                            @if(empty($user->rate)) 
                             <option value="" selected   hidden>選択してください</option>
                            @endif
                             @foreach ($rates as $rate_key => $rate_val)
                              @if ($user->rate == $rate_key)
                           <option value="{{ $rate_key}}" selected>{{ $rate_val}}</option>
                              @else
                              <option value="{{ $rate_key}}" >{{ $rate_val}}</option>
                              @endif
                              @endforeach
                              </label>
                            <!-- <option value="2001">未VIP発射台～VIPに向けた発射台</option>
                            <option value="2002">未VIP修行ゾーン（下）～VIPまであと2-3勝</option>
                            <option value="2003">VIP到達～魔境まであと2-3勝</option>
                            <option value="2004">魔境Lv.1～魔境Lv.3</option>
                            <option value="2005">魔境Lv.4</option>
                            <option value="2006">魔境Lv.5</option>
                            <option value="2007">魔境卒業</option>
                            <option value="2008">地元最強</option>
                            <option value="2009">宇宙最強</option>
                            <option value="2010">神</option> -->
                        </select>
                        </div>

                        <div class="form-group">
                           <div class="card-body">
                           <label for="denyrate[]">対戦拒否闘力帯</label>
                           @foreach ($rates as $rate_key => $rate_val)
                            <div class="form-check">
                                <!-- もしもuserdenyrateの数字が含まれていたら -->
                            @if (mb_strpos( $user->denyrate ,$rate_key) === false )
                            <label class="form-check-label" for="{{ $rate_key}}">
                            <input name="denyrate[]" type="checkbox" value="{{ $rate_key }}" id ="{{ $rate_key}}">
                            @else
                            <label class="form-check-label" for="{{ $rate_key}}">
                            <input name="denyrate[]" type="checkbox" value="{{ $rate_key }}" checked id ="{{ $rate_key}}">
                            @endif
                            {{$rate_val}}</label>
                            </div>
                            @endforeach
                            <!-- <input type="checkbox" name="denyrate[]" value="1001">未VIP発射台～VIPに向けた発射台
                            <input type="checkbox" name="denyrate[]" value="1002">未VIP修行ゾーン（下）～VIPまであと2-3勝
                            <input type="checkbox" name="denyrate[]" value="1003">VIP到達～魔境まであと2-3勝
                            <input type="checkbox" name="denyrate[]" value="1004">魔境Lv.1～魔境Lv.3
                            <input type="checkbox" name="denyrate[]" value="1005">魔境Lv.4
                            <input type="checkbox" name="denyrate[]" value="1006">魔境Lv.5
                            <input type="checkbox" name="denyrate[]" value="1007">魔境卒業
                            <input type="checkbox" name="denyrate[]" value="1008">地元最強
                            <input type="checkbox" name="denyrate[]" value="1009">宇宙最強
                            <input type="checkbox" name="denyrate[]" value="1010">神 -->
                            </div>
                        </div>

                        <!--TODO証拠画像-->
                        <div class="form-group">
                            <label for="name">プレイする時間帯</label>
                            <input type="text" class="form-control" id="playdate" name="playdate" placeholder="土日の21:30～等" 
                            @if(!empty($user->playdate)) value="{{$user->playdate}}" 
                            @endif
                             required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop