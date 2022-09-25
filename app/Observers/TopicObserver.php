<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');
        $topic->excerpt = make_excerpt($topic->body);

        if (count($topic->arr_tags) > 0) {
            foreach ($topic->arr_tags as $tag) {
                \DB::table('tags')->where('tag_name', $tag)->increment('num');
            }
        }
    }
}
