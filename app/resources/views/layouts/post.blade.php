<div class="col-10 mx-auto">
    <div class="mb-3">
        <div class="d-flex justify-content-between mb-3 mt-5 border-top">
            <img src="{{ Storage::url($post_user->picture) }}" width="50" height="40">
            <a href="{{ route('profile.index', $post->user_id) }}" class="mt-3 fw-bold">
                {{ $post_user->name }}
            </a>
            <small>
                {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Tokyo')->format('Y/m/d H:i:s') }}
            </small>
        </div>
        <div class="text-center">
            <img src="{{ Storage::url($post->path) }}" width="800" height="400">
            {{ $post->comment }}
        </div>
        <div>
            <div class="text-left">
            @if (Auth::user()->is_like($post->id))
                <form action="{{ route('likes.unlike', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button btn btn-none"><i class="fa fa-heart" style="font-size:36px;color:red"></i></button>
                </form>
            @else
                <form action="{{ route('likes.like', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="button btn btn-none"><i class="fa-regular fa-heart" style="font-size:36px;color:red"></i></button>
                </form>
            @endif
            </div>
            @if($post->user_id == Auth::user()->user_id)
                <div class="d-flex justify-content-end">
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-orange mt-3">
                        <i class="fa-solid fa-pen pe-2"></i>
                        編集
                    </a>
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-blue px-4">削除</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
