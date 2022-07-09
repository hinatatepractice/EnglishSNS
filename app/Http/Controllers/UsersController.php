<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Follower;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $login_user = \Auth::user(); // ログインしているユーザーの情報を取得
        $all_users = $user->getAllUsers($login_user->id);  // UserモデルのインスタンスからgetAllUsers()を呼び出す(引数にログインしているユーザーのID) <- ログインしているユーザー(本人)は一覧に載せないため

        return view('users.index', compact('all_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // フォローする機能
    public function follow(User $user)
    {
        $follower = auth()->user();
        // dd($login_user);
        // フォローしているか
        $is_following = $user->isFollowing($user->id);    // $is_followingでtrueかfalseを返す
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)   //引数の$userはURLのindex番号<-どのユーザーの「フォローする」ボタンが押されたか判別するため 
    {
        $follower = \Auth::user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);   // $is_followingでtrueかfalseを返す
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}