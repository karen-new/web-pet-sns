<header class="my-header">
    <div>
        <a href="{{ route('post.index') }}" style="color: white; font-size: 36px; font-weight: bold; margin-left: 20px;">
        PetSNS
    </a>
    </div>

    <div class="d-flex justify-content-end align-items-center header-green" style="height: 60px;">
        <a href="{{ route('profile.index', auth()->user()->id) }}" class="btn my-3 btn-green" style="font-size: 20px;">
            マイページ
        </a>
        <a href="{{ route('post.index') }}" class="btn my-3 btn-green" style="font-size: 20px;">
            ホーム
        </a>
        <a href="{{ route('post.create') }}" class="btn my-3 btn-green" style="font-size: 20px;">
            <i class="fa-solid fa-circle-plus pe-1" style="color: white;"></i>新規投稿
        </a>
        <a href="{{ route('search') }}" class="btn my-3 btn-green" style="font-size: 20px;">
            <i class="fa fa-search pe-1" aria-hidden="true" style="color: white;"></i>検索
        </a>
        <a href="{{ route('search') }}" class="btn my-3 btn-green" style="font-size: 20px;">
            <i class="fas fa-cog pe-1" style="color: white;"></i>設定
        </a>
        @if (Route::has('login'))
        <form action="{{ route('logout') }}" method="post" style="margin-left: 30px;">
            @csrf
            <input type="submit" value="ログアウト" class="p-1 border rounded" style="background: #e2f0e8; color: black; font-size: 20px; border: none;">
        </form>
        @endif
    </div>
</header>
