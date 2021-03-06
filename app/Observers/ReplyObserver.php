<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\ArticleReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function created(Reply $reply)
    {
        // 命令行运行迁移时不做这些操作！
        if ( ! app()->runningInConsole()) {
            $reply->article->updateReplyCount();

            // 通知话题作者有新的评论
            $reply->article->user->notify(new ArticleReplied($reply));
        }
    }

    public function updating(Reply $reply)
    {
        //
    }

    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function deleted(Reply $reply)
    {
        $reply->article->updateReplyCount();
    }

}
