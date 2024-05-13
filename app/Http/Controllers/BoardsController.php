<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Board;

class BoardsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            $user = \Auth::user();
            try{
                // 内部結合し、削除されていない投稿を投稿が古い順に取得
                $boards = DB::table('board')
                    ->join('users', 'board.user_number', '=', 'users.id')
                    ->where('board.delete_flag', 0)
                    ->select('board.*', 'users.user_name')
                    ->orderBy('board.created_at', 'asc')
                    ->paginate(5);
                $data = [
                    'user' => $user,
                    'boards' => $boards,
                ];
            } catch (\Exception $e) {
                // エラーメッセージを取得
                $errorMessage = $e->getMessage();
                // エラーメッセージをViewに渡す
                 return view('dashboard', ['error' => $errorMessage]);
            }
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }
    public function store(Request $request)
    {
        // バリデーション
        $val = $request->validate([
            'message' => 'required|max:140',
        ]);
        
        // 認証済みユーザー（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        try {
            // データの登録処理
            $board = $request->user()->boards()->create([
            'message' => $request->message,
        ]);

            // 登録成功時のメッセージをセッションに保存
            session()->flash('success', 'データの登録に成功しました。');
        } catch (\Exception $e) {
            // 登録失敗時のメッセージをセッションに保存
            session()->flash('error', 'データの登録に失敗しました。');
        }
        // 前のURLへリダイレクトさせる
        return back();
    }
    // public function update(Request $request, $id)
    // {
        
    //     // idの値でメッセージを検索して取得
    //     $board = Board::findOrFail($id);
    //     if (\Auth::id() === $board->user_id) {
    //         $board->delete_flag = 1;  // delete_flagを1に更新
    //         $board->save();  // データベースに保存
    //     }else{
    //         return view('dashboard');
    //     }
    
    //     // トップページへリダイレクトさせる
    //     return redirect('/');
    // }
    
    public function destroy(string $id)
    {
        
        // idの値で投稿を検索して取得
        $board = Board::findOrFail($id);
        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $board->user_number) {
            $board->delete_flag = 1;  // delete_flagを1に更新
            $board->save();  // データベースに保存
            return back()
                ->with('success','Delete Successful');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }
}
