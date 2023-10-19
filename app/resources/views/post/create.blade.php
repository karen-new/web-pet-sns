@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-5 text-center header-green">新規作成</h2>

        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
                {{-- バリデーションエラー部分テンプレート --}}
                @include('layouts.errors')

                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="my-3">
                        <input type="file" name="picture">
                        <textarea name="comment" class="form-control form-control-lg" placeholder="例）かわいい猫ちゃん"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-green px-4">投稿する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
