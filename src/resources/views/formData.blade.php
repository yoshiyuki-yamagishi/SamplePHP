@extends('layout.layout')

@section('pageCss')
    <link rel="stylesheet" href="./css/data.css">
@endsection

@section('content')
<div class="area">
    <h1>データ一覧</h1>
    <table>
            <th class="th-1">名前</th>
            <th class="th-2">メールアドレス</th>
            <th class="th-3" >性別</th>
            <th class="th-4">内容</th>
        </tr>
        @foreach($dataList as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->gender }}</td>
                <td>{{ $data->content }}</td>
                <td>
                    {{Form::open(['route'=>'getDataEdit'])}}
                    {{Form::hidden('id',$data->id)}}
                    {{Form::button('編集', ['type' => 'submit'])}}
                    {{Form::close()}}
                </td>
            </tr>
        @endforeach
    </table>
    <div class="linkBack">
        <a href="{{url('/Linux1')}}">戻る</a><br />
    </div>
</div>
@endsection

