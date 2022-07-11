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
    public function show(User $user, Tweet $tweet, Follower $follower)  //ユーザーの詳細画面表示
    {
        // dd($user);
        $login_user = \Auth::user(); //現在ログインしているユーザー情報を取得
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $tweet->getUserTimeLine($user->id);  
        $tweet_count = $tweet->getTweetCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);

        return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'tweet_count'    => $tweet_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'screen_name'   => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name'          => ['required', 'string', 'max:255'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);
        $validator->validate();
        $user->updateProfile($data);

        return redirect('users/'.$user->id);
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
    public function follow(User $user)   //引数の$userは「フォローする」ボタンを押されたユーザーの情報<-どのユーザーの「フォローする」ボタンが押されたか判別
    {
        $following_user = \Auth::user(); //現在ログインしているユーザーを取得(これからフォロー「する」側のユーザー)
        // フォローしているか
        $is_following = $following_user->isFollowing($user->id);    // $userは引数で渡ってきたuserのID($is_followingでtrueかfalseを返す)　<- フォローいていればTrue, フォローしていなければFalse
        // dd($is_following);
        if(!$is_following) {
            // フォローしていなければフォローする
            $following_user->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)   //引数の$userは「フォローする」ボタンを押されたユーザーの情報<-どのユーザーの「フォローする」ボタンが押されたか判別するため 
    {
        // dd($user);
        $following_user = \Auth::user(); //現在ログインしているユーザーを取得(今相手をフォロー「している」側のユーザー)
        // フォローしているか
        $is_following = $following_user->isFollowing($user->id);   // $userは引数で渡ってきたuserのID($is_followingでtrueかfalseを返す) <- フォローいていればTrue, フォローしていなければFalse
        // dd($is_following);
        if($is_following) {
            // フォローしていればフォローを解除する
            $following_user->unfollow($user->id);
            return back();
        }
    }
}