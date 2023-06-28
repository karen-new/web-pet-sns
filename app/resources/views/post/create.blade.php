@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-5 text-center header-green">新規作成</h2>

        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
                {{-- バリデーションエラー部分テンプレート --}}
                @include('layouts.errors')
                
                {{ Form::open(['url' => route('post.store'),'enctype'=>'multipart/form-data']) }}

                <div class="my-3">
                    {{ Form::file('picture')}}
                    {{ Form::textarea('comment', '', ['class' => 'form-control form-control-lg', 'placeholder' => '例）かわいい猫ちゃん']) }}
                </div>

                <div class="text-center">
                    {{ Form::submit('投稿する', ['class' => 'btn btn-green px-4']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection