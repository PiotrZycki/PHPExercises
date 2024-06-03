<?php

namespace Controller;

use Controller\Controller;
use Model\Post;
use Model\PostIds;
use Model\User;

class FeedController extends Controller
{
    private ?User $userA;
    public function index(): Result
    {
        return view('feed.index')->withTitle('Feed')->with('userA', $this->getCurrentUser());
    }
    public function store(): Result
    {
        $pIds = $this->postIds();

        $post = new Post($pIds->nextPostId++);

        $post->title = $_POST["postTitle"];
        $post->text = $_POST["postText"];
        $post->num = ($pIds->nextPostId - 1);

        $this->storage()->store($post);
        $this->storage()->store($pIds);

        return redirect("/feed");
    }

    public function load(): Result
    {
        return view('feed.show')->withTitle('Posts')->with('userA', $this->getCurrentUser())->with('posts', $this->storage()->load('model_post_*'));
    }

    public function publish(): Result
    {
        if (empty($this->userA)) {
            $this->userA = $this->getUser();
        }
        return view('feed.publish')->withTitle('Add')->with('userA', $this->getCurrentUser());
    }

    public function show(int $id): Result
    {
        return view('feed.showPost')->withTitle('Posts')->with('userA', $this->getCurrentUser())->with('posts', $this->storage()->load('model_post_'.$id));
    }

    private function getCurrentUser(): ?User
    {
        if (empty($this->userA)) {
            $this->userA = $this->getUser();
        }
        return $this->userA;
    }

    private function postIds(): PostIds
    {
        $pIds = new PostIds();
        $distinguishableArray = $this->storage()->load($pIds->key());
        if (count($distinguishableArray) && $distinguishableArray[0] instanceof PostIds) {
            return $distinguishableArray[0];
        }
        $this->storage()->store($pIds);
        return $pIds;
    }
}
