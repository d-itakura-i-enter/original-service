<div class="w-full mt-6 mx-auto max-w-3/4 px-8">
    @if(isset($error))-->
        <p>現在、投稿内容を取得できません</p>
        <p>{{ $error }}</p>
    @endif
    @if (isset($boards))
        <div class="bg-white shadow-md rounded my-6 px-4">
            <table class="text-left w-full border-collapse">
                <tbody>
                    <?php foreach ($boards as $board): ?>
                        <tr>
                            <th>{{　$board->user_name }}</th>
                            <td>{{ $board->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>{{ $board->message }}</td>
                            <td>@include('board_favorite.favorite_button')</td>
                            <td>@if (Auth::id() == $board->user_number)
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('boards.destroy', $board->message_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                                        onclick="return confirm('本当に削除してよろしいですか？')">
                                        削除
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        </button>
                                </form>
                            @endif</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="flex justify-center">
                {{ $boards->links() }}
            </div>
        </div>
     @endif
</div>