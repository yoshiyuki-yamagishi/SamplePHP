@extends('layout.layout')

@section('cssArea')
    @parent
    <link rel="stylesheet" href="./css/app2.css">
@endsection

@section('pageCss')
    <link rel="stylesheet" href="./css/app2.css">
@endsection


@section('content')
<div class="area1">
    <h1>こちらの内容で送信しました。<br>ありがとうございました。</h1>
    名前：{{ $name }}<br />
    Email：{{ $email }}<br />
    性別 : {{$gender}}<br />
    その他、ご意見、ご要望<br />
    {{ $content }}<br />
    男性の数: {{ $maleCount }}
    <p></p>
    <a href="{{url('/Linux1')}}">{{ Form::button('終了して戻る', ['type' => 'submit']) }}</a><br />
    <a href="{{url('/LinuxData')}}">データ一覧</a>  <!--formDataに行くための-->
</div>
@endsection
