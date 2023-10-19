@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-5 text-center header-green">投稿編集</h2>

        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
                {{-- バリデーションエラー部分テンプレート --}}
                @include('layouts.errors')

                <form action="{{ route('post.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="my-3">
                        <textarea name="comment" class="form-control" placeholder="面白い犬">{{ $post->comment }}</textarea>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-green px-4">更新する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
