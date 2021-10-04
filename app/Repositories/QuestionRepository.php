<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AnswerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class QuestionRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }

    public function getUserQuestion()
    {
        $user = Auth::user();
        $query = $this->query();
        $query = $query->where('user_id', $user->id)->whereIn('status', ['Not Answered', 'Answered', 'In Progress']);

        return $query->get();
    }

    public function createQuestion(Request $request)
    {
        $user = Auth::user();
        $data = [
            'question' => $request['question'],
            'status'   => 'Not Answered',
            'user_id'  => $user->id,
        ];

        return $this->create($data);
    }

    public function searchUserQuestion(Request $request)
    {
        $customerName=$request['customer_name'];
        $query = $this->query();
        $query = $query->whereHas('user', function ($query) use ($customerName) {
            $query->where([
                'name', like, '%'.$customerName.'%'
            ]);
        });

        return $query->get();
    }

    public function searchQuestionStatus(Request $request)
    {
        $status=$request['status'];
        $query = $this->query();
        $query = $query->where('status', $status);

        return $query->get();
    }

    public function markSpam(Request $request)
    {
        $id=$request['question_id'];
        $data = [
            'status'   => 'SPAM'
        ];

        return $this->update($data, $id);
    }

    public function markAnswered($id)
    {
        $data = [
            'status'   => 'Answered'
        ];

        return $this->update($data, $id);
    }
}
