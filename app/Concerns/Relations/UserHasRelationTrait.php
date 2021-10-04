<?php

declare(strict_types = 1);

namespace App\Concerns\Relations;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserHasRelationTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions() : HasMany
    {
        return $this->hasMany(Question::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers() : HasMany
    {
        return $this->hasMany(Answer::class, 'user_id', 'id');
    }

}
