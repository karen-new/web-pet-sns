<div class="col-8 mx-auto">
    <div class="my-card">
        <div class="my-card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="{{ $post_user->image }}" class="mx-2 rounded-image-mini" style="object-fit: cover;">
                <a href="{{ route('profile.index', $post->user_id) }}" class="fw-bold" style="flex-shrink-0;">
                    {{ $post_user->name }}
                </a>
            </div>
            <small class="mx-2">
                {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Tokyo')->format('Y/m/d H:i:s') }}
            </small>
        </div>
        <div class="my-card-body">
                <div class="text-center mt-3">
                    <img src="{{ $post->path }}" width="80%" height="auto" class="mx-auto d-block">
                </div>
                <div class="mt-3">
                    {{ $post->comment }}
                </div>
        </div>
        <div class="my-card-footer d-flex justify-content-between align-items-center mt-3">
            <div>
                @if (Auth::user()->is_like($post->id))
                    <form action="{{ route('likes.unlike', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button btn btn-none">
                            <i class="fa fa-heart" style="font-size:36px;color:red"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route('likes.like', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="button btn btn-none">
                            <i class="fa-regular fa-heart" style="font-size:36px;color:red"></i>
                        </button>
                    </form>
                @endif
            </div>
            @if($post->user_id == Auth::user()->id)
                <div class="d-flex">
                    {{-- 編集ボタン --}}
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-orange me-2">
                        <i class="fa-solid fa-pen pe-2"></i>
                        編集
                    </a>
                    {{-- 削除ボタン --}}
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-blue">削除</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    <div class="line-height mx-3">
        <div>
            @foreach ($post->comments as $comment)
                <div class="mb-1 p-1">
                    <span class="mx-1">
                        {{$comment->user->name}} ：
                    </span>
                    <span class="mx-1">
                        {{ $comment->comment }}
                    </span>
                    <span class="mx-4" style="font-size:10px;">
                        {{ \Carbon\Carbon::parse($comment->created_at)->timezone('Asia/Tokyo')->format('Y/m/d H:i:s') }}
                    </span>
                    @if ($comment->user->id == Auth::id())
                        <a data-remote="true" rel="nofollow" data-method="delete" href="{{ route('comment.delete', $comment->id) }}">
                            <button class="btn btn-blue px-2"> 削除 </button>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="row actions" id="comment-form-post-{{ $post->id }}">
            <form class="w-100" id="new_comment" action="{{ route('comment.create', $post->id) }}" accept-charset="UTF-8" data-remote="true" method="post">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                <input class="form-control comment-input border-0" placeholder="コメントする" autocomplete="off" type="text" name="comment" />
            </form>
        </div>
        <hr>
    </div>
</div>
