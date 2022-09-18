<?php

namespace App\View\Components\Tweet;

use Illuminate\View\Component;

class Options extends Component
{
    /**
     * Create a new component instance.
     *
     * private int $tweetId
     * private int $userId
     * 
     * @return void
     */
    public function __construct(int $tweetId, int $userId)
    {
        $this->tweetId = $tweetId;
        $this->userId = $userId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tweet.options')
        ->with('tweetId', $this->tweetId)
        ->with('myTweet', \Illuminate\Support\Facades\Auth::id() === $this->userId);
    }
}
