<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePost extends Component
{
    public $post_title="";
    public $content="";

    public function save()
    {

        $this->validate([
            'post_title' => 'required',
            'content' => 'required',
        ]);


        Post::create([
            'post_title' => $this->post_title,
            'content' => $this->content,
            'user_id' => Auth::user()->id,
        ]);

        $this->post_title = '';
        $this->content = '';

        $this->redirect('/my/posts',navigate:true);

    }
    public function render()
    {
        return view('livewire.create-post');
    }
}
