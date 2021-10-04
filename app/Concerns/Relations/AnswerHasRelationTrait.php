<?php

declare(strict_types = 1);

namespace App\Concerns\Relations;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait AnswerHasRelationTrait
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question() : BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

}
