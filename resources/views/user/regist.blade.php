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
  <form action="{{url('account/regist')}}" method="POST" name="login_form">
  @csrf
      <div class="login_form_top">
          <h1>スマブラマッチングシステム</h1>
      </div>
      <div class="form-group space">
          <p>名前</p>
          @if($errors->has('name'))
			@foreach($errors->get('name') as $message)
      <div class="text-danger">{{ $message }}</div>
			@endforeach
		@endif 
        <input type="text" name="name" placeholder="名前を入力してください" class="form-control" value="{{ old('name') }}" />
      </div>

      <div class="form-group">
         <p>メールアドレス</p>
         @if($errors->has('email'))
			@foreach($errors->get('email') as $message)
      <div class="text-danger">{{ $message }}</div>
			@endforeach
		@endif 
        <input type="text" name="email" placeholder="メールアドレスを入力してください" class="form-control" value="{{ old('email') }}" />
      </div>
      <div class="form-group">
        <p>パスワード</p>
        @if($errors->has('password'))
			@foreach($errors->get('password') as $message)
      <div class="text-danger">{{ $message }}</div>
			@endforeach
		@endif 
         <input type="password" name="password" placeholder="パスワードを入力してください" class="form-control" value="{{ old('password') }}" />
      </div>
      <div class="form-group">
         <p>パスワード(確認）</p>
         @if($errors->has('password_confirmation'))
         @foreach($errors->get('password_confirmation') as $message)
      <div class="text-danger">{{ $message }}</div>
			@endforeach
		@endif 
        <input type="password" name="password_confirmation" placeholder="パスワードを入力してください" class="form-control" value="{{ old('password_confirmation') }}" />
      </div>
  <button type="submit" class="btn btn-primary">アカウント登録</button>
  </form>
</div>
</body>