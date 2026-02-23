<?php

namespace App\UseCases\Quiz;

use App\Repositories\Quiz\QuizRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DeleteQuizUseCase
{
    public function __construct(private readonly QuizRepositoryInterface $repo) {}

    //id alır quiz siler
    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            //kontrol et bakaılım id li quiz var mı yok mu varsa sil yoksa hata döndürür
            $quiz = $this->repo->findOrFail($id);
            $this->repo->delete($quiz);
        });
    }
}