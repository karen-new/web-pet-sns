<footer>
<div class="d-flex justify-content-evenly border-top" style="padding:20px;">
    <a href="{{ route('mypage.index', auth()->user()->id) }}" class="btn btn-primary my-3 btn-green">マイページ</a>
    <a href="{{ route('pet.index') }}"  class="btn btn-primary my-3 btn-green" >ホーム</a>
    <a href="{{ route('pet.create') }}" class="btn btn-primary my-3 btn-green">
        <i class="fa-solid fa-circle-plus pe-2"></i>
        新規投稿
    </a>
    <a href="{{ route('search') }}" class="btn btn-primary my-3 btn-green">
        <i class="fa fa-search" aria-hidden="true"></i>
        検索
    </a>
</div>
</footer>
