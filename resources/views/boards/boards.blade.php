<div class="mt-4">
    @if(isset($error))
        <p>現在、投稿内容を取得できません</p>
        <p>{{ $error }}</p>
    @endif
    @if (isset($boards))
        <ul class="list-none">
            @foreach ($boards as $board)
                <li class="flex items-start gap-x-2 mb-4">
                        <div>
                            <table>
                                <tr>
                                    <th>{!! nl2br(e($board->user_name)) !!}</th>
                                    <td>{!! nl2br(e($board->updated_at)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{!! nl2br(e($board->message)) !!}</td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            @include('board_favorite.favorite_button')
                        </div>
                         <div>
                            @if (Auth::id() == $board->user_number)
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('boards.destroy', $board->message_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                                        onclick="return confirm('Delete id = {{ $board->message_id }} ?')">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $boards->links() }}
    @endif
</div>