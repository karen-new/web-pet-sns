<header>
@if (Route::has('login'))
    <div class="d-flex flex-row-reverse">
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" value="logout">
    </form>
    </div>
@endif
</header>