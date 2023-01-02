<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style_ss.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
 
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<div class="container">
  <form action="{{url('account/find')}}" method="POST" name="login_form">
@csrf
@if (session()->has('error')) 
    <div class="alert alert-danger">{{ session('error')}}</div>
@endif
          <div class="login_form_top">
            <h1>スマブラマッチングシステム</h1>
          </div>
<h3>スマブラでキャラ対策がしたい方のためのマッチングアプリです</h3>
<p class="mt-2">
 <a href="#" class="btn btn-primary">利用規約</a>
 ご利用前に閲覧ください(youtubeへ遷移します)
</p>
<p class="mt-2">
 <a href="{{route('twitter.login')}}" class="btn btn-primary">Twitterで登録orログインする</a>
</p>
</div>
</body>