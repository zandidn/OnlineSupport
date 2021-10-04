<?php

namespace App\Models;

use App\Concerns\Relations\AnswerHasRelationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property integer $question_id
 * @property integer $user_id
 * @property string $answer
 * @property string $created_at
 * @property string $updated_at
 * @property Question $question
 * @property User $user
 */
class Answer extends Model
{
    use HasFactory;
    use AnswerHasRelationTrait;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['question_id', 'user_id', 'answer', 'created_at', 'updated_at'];

}
