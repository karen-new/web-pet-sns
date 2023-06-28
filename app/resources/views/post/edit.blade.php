@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-5 text-center header-green">投稿編集</h2>

        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
                {{-- バリデーションエラー部分テンプレート --}}
                @include('layouts.errors')

                {{ Form::open(['url' => route('post.update', $post->id), 'method' => 'put']) }}

                <div class="my-3">
                    {{ Form::textarea('comment', $post->comment, ['class' => 'form-control', 'placeholder' => '面白い犬']) }}
                </div>

                <div>
                    {{ Form::submit('更新する', ['class' => 'btn btn-green px-4']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection