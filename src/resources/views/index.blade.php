@extends('layout.layout')

@section('pageCss')
    <link href="./css/app.css" rel="stylesheet">
@endsection

@section('PageJavaScript')
    <!--JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--自作のJS-->
    <script src="js/app.js"></script>
@endsection

@section('content')
    <!--画面遷移用-->
    @include('layout.splash')

    <div id="container">
        <header>
            <h1><a href="{{url('/LinuxForm')}}"><img src="image/image2.png" alt="Linux"></a></h1>
        </header>

        <div class="area1">
            <div>
                <h2>Laravelとは</h2>
                <div>Laravel は、MVCのWebアプリケーション開発用の無料・オープンソースのPHPで書かれたWebアプリケーションフレームワークである。様々なコミュニティのコンポーネントを使用しており、特にSymfonyは9つのコンポート利用するなど重要な基盤となっている。LaravelはMITライセンスの下でリリースされており、そのソースコードはGitHubにホスティングされている。マイクロソフトの.NETの開発に関わっていたTaylor Otwell が開発し、Taylorを中心としたコミュニティーが活発な開発を続けている。
                </div>
                <h2>お問い合わせ・質問</h2>
                <div>お問い合わせ、ご質問は<a href="{{url('/LinuxForm')}}">こちら</a>をクリック。</div>
                <h2>データ一覧</h2>
                <div>
                    データの一覧を表示したい方は<a href="{{url('/LinuxData')}}">こちら</a>をクリック。
                </div>
            </div>

        </div>
    </div>
@endsection

