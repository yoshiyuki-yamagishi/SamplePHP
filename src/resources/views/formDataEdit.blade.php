@extends('layout.layout')

@section('pageCss')
    <link rel="stylesheet" href="./css/dataEdit.css">
@endsection

@section('content')
    <a href="{{url('/Linux1')}}"><img id="ImagePenguin" src="image/image2.png" /></a>
    <div class="area1">
        <h1>データ編集</h1>
        {{ Form::open(['route' => 'updateData']) }}
        {{ Form::hidden('id', $id) }}
        <div class="area1-1"> 名前：{{ Form::text('name', $name) }}</div></br>
        <div>性別： 男性{{Form::radio('gender' , 1, ($gender == 1), ['class' => 'radio-button_input']) }}     女性{{Form::radio('gender' , 2, ($gender == 2), ['class' => 'radio-button_input']) }}     表示しない{{Form::radio('gender' , 3, ($gender == 3), ['class' => 'radio-button_input']) }}</div>
        <div class="area1-2">Email：{{ Form::email('email', $email, ['class' => 'field']) }}</div></br>
        その他、ご意見、ご要望<br />
        <div class="area1-3">{{ Form:: textarea('content', $content, ['placeholder' => '入力してください', 'rows' => '10']) }}</div>
        <div class="area1-4">{{ Form::button('更新', ['type' => 'submit']) }}</div>
    </div>
@endsection

