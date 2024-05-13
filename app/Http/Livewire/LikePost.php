<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLicked;
    public $likes;

    public function mount($post)
    {
        $this->isLicked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if ($this->post->checkLike(auth()->user())) 
        {
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLicked = false;
            $this->likes--;
        } else 
        {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLicked = true;
            $this->likes++;
        }
    }


    public function render()
    {
        return view('livewire.like-post');
    }
}

