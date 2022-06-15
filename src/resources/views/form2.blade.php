@extends('layout.layout')

@section('pageCss')
    <link rel="stylesheet" href="./css/app2.css" >
@endsection

@section('PageJavaScript')
    <!--JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--自作のJS-->
    <script src="js/app.js"></script>
@endsection

@section('content')
    @include('layout.splash')
    <div id="container">
            <h1><a href="{{url('/Linux1')}}"><img id="ImagePenguin" src="image/image2.png" /></a></h1>
        {{ Form::open(['route' => 'form']) }}
        <div class="area1">
            <div class="area1-1"> 名前：{{ Form::text('name', '') }}</div></br>
            <div>性別： 男性{{Form::radio('gender' , 1 , ['class' => 'radio-button_input']) }}     女性{{Form::radio('gender' , 2, ['class' => 'radio-button_input']) }}     表示しない{{Form::radio('gender' , 3, ['class' => 'radio-button_input']) }}</div>　　　　<!--<input class="radio-button__input" name="gender" type="radio" value="male">-->　　　　　　　　　　
            <div class="area1-2">Email：{{ Form::email('email', '', ['class' => 'field']) }}</div></br>
            その他、ご意見、ご要望<br />
            <div class="area1-3">{{ Form:: textarea('content', null, ['placeholder' => '入力してください', 'rows' => '10']) }}</div>
            <div class="area1-4">{{ Form::button('登録', ['type' => 'submit']) }}</div>
        </div>
    </div>
@endsection
