<?php
namespace App\Concern;

use App\Topic;

trait HasTopics
{
    protected $topicForeignKey = 'user_id';
    protected $pivotTable = 'followers';
    protected $pivotKey = 'follower_id';

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function scopeLastTopicDate($query)
    {
        return $query->addSelect([
            'last_topic_date' => Topic::select('created_at')
            ->whereColumn($this->topicForeignKey, 'topics.id')
            ->orderBy('created_at', 'desc')
            ->limit(1)
        ]);
    }

    public function allTopics()
    {
        return Topic::where($this->topicForeignKey, $this->id)
            ->orWhereRaw("{$this->topicForeignKey} IN (SELECT {$this->topicForeignKey} FROM {$this->pivotTable} where {$this->pivotKey} = {$this->id})");
    }
}
