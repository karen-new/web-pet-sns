@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center" style="font-size: 36px; font-weight: bold;">会員情報編集</div>

                    <div class="card-body">
                        <!-- エラーメッセージと成功メッセージ -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <!-- 会員情報 -->
                        <div class="border rounded section">
                            <h5 class="mb-3">会員情報</h5>
                            <p>ユーザー名: {{ Auth::user()->name }}</p>
                            <p>メールアドレス: {{ Auth::user()->email }}</p>
                        </div>

                        <!-- パスワード変更フォーム -->
                        <div class="border rounded section">
                            <h5 class="mb-3">パスワード変更</h5>
                            <form method="POST" action="{{ route('profile.passwordUpdate') }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group mt-1">
                                    <label for="current_password">現在のパスワード</label>
                                    <input type="password" name="current_password" class="form-control" id="current_password">
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label for="new_password">新しいパスワード</label>
                                    <input type="password" name="new_password" class="form-control" id="new_password">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label for="new_password_confirmation">パスワードの確認</label>
                                    <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation">
                                    @error('new_password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="mt-3 btn btn-success rounded-pill">更新する</button>
                            </form>
                        </div>

                        <!-- メールアドレス変更フォーム -->
                        <div class="border rounded section">
                            <h5 class="mb-3">メールアドレス変更</h5>
                            <form method="POST" action="{{ route('profile.emailUpdate') }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="email">新しいメールアドレス</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="mt-3 btn btn-primary rounded-pill">メールアドレス変更</button>
                            </form>
                        </div>

                        <!-- ユーザー削除ボタン -->
                        <div class="border rounded section">
                            <h5 class="mb-3">アカウントの削除</h5>
                            <form method="POST" action="{{ route('profile.delete') }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger rounded-pill">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .section {
        background-color: #e7eeea; /* 薄いモスグリーンのカラーコード */
        padding: 20px;
        margin: 20px
    }
</style>
