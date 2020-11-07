<?php

namespace App\Observers;

use App\Models\Article;
use App\Handlers\SlugTranslateHandler;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ArticleObserver
{
    public function saving(Article $article)
    {
        //XSS过滤
        $article->body = clean($article->body, 'user_article_body');
        //生成文章摘录
        $article->excerpt = make_excerpt($article->body);
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $article->slug) {
            $article->slug = app(SlugTranslateHandler::class)->translate($article->title);
        }
    }

}
