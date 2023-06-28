<div class="mx-auto">
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <a href="{{ route('mypage.index', $pet->user_id) }}" class="mt-3">
                {{ $pet_user->name }}
            </a>
            <small>
                {{ \Carbon\Carbon::parse($pet->created_at)->timezone('Asia/Tokyo')->format('Y/m/d H:i:s') }}
            </small>
        </div>
        <div class="card-body">
            <img src="{{ Storage::url($pet->path) }}" width="800" height="400">
            {{ $pet->comment }}
        </div>
        <div class="card-footer ">
            <div class="text-left">
            @if (Auth::user()->is_like($pet->id))
                {{ Form::open(['route' => ['likes.unlike', $pet->id], 'method' => 'delete']) }}
                    {{ Form::button('<i class="fa fa-heart" style="font-size:36px;color:red"></i>', ['class' => "button btn btn-none", 'type' => 'submit']) }}
                    
                {{ Form::close() }}
            @else
                {{ Form::open(['route' => ['likes.like', $pet->id]]) }}
                    {{ Form::button('<i class="fa-regular fa-heart" style="font-size:36px;color:red"></i>', ['class' => "button btn btn-none", 'type' => 'submit']) }}
                    
                {{ Form::close() }}
            @endif
            </div>
            @if($pet->user_id == $user->id)
                <div class="d-flex justify-content-end">
                    {{-- Edit Button --}}
                    <a href="{{ route('pet.edit', $pet->id) }}" class="btn btn-orange mt-3">
                        <i class="fa-solid fa-pen pe-2"></i>
                        編集
                    </a>
                    {{-- destroy Button --}}
                    {{ Form::open(['url' => route('pet.destroy', $pet->id), 'class' => 'mt-3', 'method' => 'delete']) }}
                        {{ Form::submit('削除', ['class' => 'btn btn-blue px-4']) }}
                    {{ Form::close() }}
                </div>
            @endif
        </div>                        
    </div>
</div>