<!--@if (Auth::id() == $user->id)-->
<div class="w-full max-w-2/3 mx-auto mt-10">
  <form method="POST" action="{{ route('boards.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mx-auto">
   @csrf
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
        投稿者名
      </label>
      <p class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="名前">{!! nl2br(e($user->user_name)) !!}</p>
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
        一言メッセージ
      </label>
      <textarea name="message" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" type="text" placeholder="一言メッセージ"></textarea>
    </div>
    <div class="flex items-center justify-between">
      <button type="submit" class="btn btn-primary normal-case">投稿</button>
    </div>
  </form>
</div>
<!--@endif-->

