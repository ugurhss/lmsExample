<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentQuizRepository implements QuizRepositoryInterface
{
    public function create(array $data): Quiz
    {
        return Quiz::create($data);
    }

    public function findOrFail(int $id): Quiz
    {
        return Quiz::query()->findOrFail($id);
    }

    public function update(Quiz $quiz, array $data): Quiz
    {
        $quiz->fill($data);
        $quiz->save();

        return $quiz->fresh();
    }

    public function delete(Quiz $quiz): void
    {
        $quiz->delete();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Quiz::query()->latest()->paginate($perPage);
    }
}