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
        <div class="d-flex justify-content-between align-items-center mt-3">
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
        <div class="card-body line-height">
            <div class="card-body line-height">
                <div>
                    @if (!empty($post->comments))
                        <span class="font-weight-bold">
                            コメント
                        </span>
                    @endif
                    @foreach ($post->comments as $comment)
                        <div class="mb-2 p-1">
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
                <hr>
                <div class="row actions" id="comment-form-post-{{ $post->id }}">
                    <form class="w-100" id="new_comment" action="{{ route('comment.create', $post->id) }}" accept-charset="UTF-8" data-remote="true" method="post">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                        <input class="form-control comment-input border-0" placeholder="コメントする" autocomplete="off" type="text" name="comment" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
