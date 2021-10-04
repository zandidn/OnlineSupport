<?php

namespace App\Models;

use App\Concerns\Relations\QuestionHasRelationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $question
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Answer[] $answers
 */
class Question extends Model
{
    use HasFactory;
    use QuestionHasRelationTrait;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
    /**
     * @var string
     */
    protected $table = 'questions';
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'question', 'status', 'created_at', 'updated_at'];
 }
