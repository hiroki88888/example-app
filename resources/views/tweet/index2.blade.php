<!doctype html>
<html lang= "ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,
        maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"></script>
    <title>つぶやきアプリ</title>
</head>
<body>
    <h1>つぶやきアプリ</h1>
    @auth
        <div>
            <p>投稿フォーム</p>
            @if (session('feedback.success'))
                <p style="color: green">{{ session('feedback.success') }}</p>
            @endif
            <form action="{{ route('tweet.create') }}" method="post">
                @csrf
                <label for="tweet-content">つぶやき</label>
                <span>140字まで</span>
                <textarea id="tweet-content" type="text" name="tweet" placeholder="つぶやきを入力"></textarea>
                @error('tweet')
                <p style="color: red;">{{ $message }}</p>
                @enderror
                <button type="submit">投稿</button>
            </form>
        </div>
        {{-- ツイート一覧は一旦コメントアウト　--}}
        <div>
            @foreach($tweets as $tweet)
                <details>
                    <summary>{{ $tweet->content }} by {{ $tweet->user->name }}</summary>
                    @if(\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
                        <div>
                            <a href="{{ route('tweet.update.index', ['tweetId' => $tweet->id]) }}">編集</a>
                            <form action="{{ route('tweet.delete', ['tweetId' => $tweet->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit">削除</button>
                            </form>
                        </div>
                    @else
                        編集できません
                    @endif
                </details>
            @endforeach
        </div>
    @endauth
</body>
</html>