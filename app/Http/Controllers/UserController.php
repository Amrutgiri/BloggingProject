<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.user', compact('user'));
    }

    public function myPosts()
    {
        return view('user.posts.myPosts');
    }

    public function createPost()
    {
        return view('user.posts.createPost');
    }

    public function editPost($id){
        $postData=Post::find($id);
        return view('user.posts.editPost',compact('postData'));
    }
}
