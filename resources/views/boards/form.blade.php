@if (Auth::id() == $user->id)
    <div class="mt-4">
        <p class="mb-0">投稿者名</p>
        <p class="mb-0">{!! nl2br(e($user->user_name)) !!}</p>
        <p class="mb-0">一言メッセージ</p>
        <form method="POST" action="{{ route('boards.store') }}">
            @csrf
        
            <div class="form-control mt-4">
                <textarea rows="2" name="message" class="input input-bordered w-full"></textarea>
            </div>
        
            <button type="submit" class="btn btn-primary btn-block normal-case">Post</button>
        </form>
    </div>
@endif