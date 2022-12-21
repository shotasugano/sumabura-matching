@extends('layouts.app')
 
@section('content')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
@if (!empty($users))
<div class="panel panel-default">
    <div class="panel-body">
        <!--検索機能の登録-->
        <form class="form-inline my-2 my-lg-0 ml-2" action="{{url('/statuses')}}" method="GET">
        <div class="form-group">
            <input type="search" class="form-control mr-sm-2" name="keyword" placeholder="名前から検索" aria-label="検索...">
        </div>
        <input type="submit" value="検索" class="btn btn-info">
        </form>
        <!--検索機能の登録（使用キャラクター、戦闘力帯で検索）-->
        <form class="form-inline my-2 my-lg-0 ml-2" action="{{url('/statuses')}}" method="GET">
        <div class="form-group">
                        <select  name="charaname"class="uk-select" id="charaname" style="padding-left: 30px;" onchange="changeChara('my')">
                        <option value="" selected hidden>使用キャラクターから検索</option>
                        <option value=""  >指定なし</option>
                        @foreach ($characters as $character_key => $character_val)
                        <option value="{{ $character_key}}" >{{ $character_val}}</option>
                        @endforeach
                        </select>
        </div>
        <div class="form-group">
                        <select  name="rate"class="uk-select" id="rate" style="padding-left: 30px;" onchange="changeChara('my')">
                        <option value="" selected  hidden >戦闘力帯から検索</option>
                        <option value="" >指定なし</option>
                        @foreach ($rates as $rate_key => $rate_val)
                        <option value="{{ $rate_key}}" >{{ $rate_val}}</option>
                        @endforeach
                        </select>
        
        <input type="submit" value="検索" class="btn btn-info">
        </form>
        </div>
        <form class="form-inline my-2 my-lg-0 ml-2" action="{{url('/statuses')}}" method="GET">
        <input type="submit" value="検索のリセット" class="btn btn-info">
        </form>
        <!-- 登録画面への遷移-->
        <table border="" class="table table-striped task-table" >
            <!-- テーブルヘッダ -->
            <thead>
                <th>名前</th>
                <th>使用キャラクター</th>
                <th>戦闘力帯</th>
                <th>プレイする時間帯<th>
            </thead>
 
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <!-- 登録者名 -->
                    <td class="table-text">
                        <div>{{ $user->name }}</div>
                    </td>
                    <!-- 使用キャラ-->
                    <td class="table-text">
                        <div>{{ $characters[$user->charaname] }}</div>
                    </td>
                    <!-- レート-->
                    <td class="table-text">
                    <div>{{ $rates[$user->rate] }}</div>
                    </td>
                    <td class="table-text">
                    <div>{{ $user->playdate }}</div>
                    </td>
                    <!-- 証拠画像
                    <td class="table-text">
                    <div><img src="{{ asset($user->path) }}"></div>
                    </td> -->
                    <td>
                        <!-- TODO: 編集ボタン -->
                        <a href="/edit/{{$user->id}}">>>申し込み</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>