<?php

declare(strict_types = 1);

namespace App\Concerns\Relations;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
trait QuestionHasRelationTrait
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers() : HasMany
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

}
