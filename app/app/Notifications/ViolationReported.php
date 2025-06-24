<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ViolationReported extends Notification
{
    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->error()
            ->content('🚨 違反報告が届きました')
            ->attachment(function ($attachment) {
                $attachment->title('投稿タイトル: ' . $this->post->title)
                    ->content('投稿ID: ' . $this->post->id . "\n" .
                        'ユーザーID: ' . $this->post->user_id . "\n" .
                        '詳細ページ: ' . url('/posts/' . $this->post->id));
            });
    }
}
