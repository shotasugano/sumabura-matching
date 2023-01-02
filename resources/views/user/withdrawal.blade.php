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

<h1>退会画面</h1>
<div class="form-group">
<form method="POST" >
@csrf
    <div class="card-body">
    <p>退会するとサイト主にDMしない限りご利用できなくなります。よろしいでしょうか。</p>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-warning">退会する</button>
        <a class="btn btn-primary" href="/statuses">退会しない</a>
    </div>
    </form>
@stop

@section('css')
@stop

@section('js')
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>