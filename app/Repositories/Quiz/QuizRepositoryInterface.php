<?php

namespace App\Repositories\Quiz;

use App\Models\Quiz;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface QuizRepositoryInterface
{
    public function create(array $data): Quiz;

    public function findOrFail(int $id): Quiz;

    public function update(Quiz $quiz, array $data): Quiz;

    public function delete(Quiz $quiz): void;

    public function paginate(int $perPage = 15): LengthAwarePaginator;
}