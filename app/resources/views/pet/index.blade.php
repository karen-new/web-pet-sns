@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="my-5 text-center header-green">投稿一覧</h2>

        <div class="row">
            @forelse($pets as $pet)
                @include('layouts.post',['pet' => $pet, 'pet_user' => $pet->user, 'user' => $user])
            @empty
                <td>No posts!!</td>
            @endforelse
        </div>
    </div>
@endsection