<?php

namespace App\UseCases\Quiz;

use App\Enums\QuizStatus;
use App\Models\Quiz;
use App\Repositories\Quiz\QuizRepositoryInterface;
use App\Services\Quiz\QuizService;
use Illuminate\Support\Facades\DB;

class CreateQuizUseCase
{
    public function __construct(
        private readonly QuizRepositoryInterface $repo,
        private readonly QuizService $service
    ) {}


    // başlık, aktiflik durumu ve durum bilgisi alır quiz olşturur
    public function execute(string $title, bool $isActive, QuizStatus $status): Quiz
    {
        return DB::transaction(function () use ($title, $isActive, $status) {

            $data = $this->service->normalize([
                'title' => $title,
                'is_active' => $isActive,
                'status' => $status->value,
            ]);
            //ilk önce normalize datasını verdik sonra dedik ki slug oluştururken aynı slug varsa sonuna -2, -3 gibi ekler yaparak benzersiz hale getirir

            $data['slug'] = $this->service->makeUniqueSlug($data['title']);

            //en son olarak repository'e create işlemi yaptırırız
            return $this->repo->create($data);
        });
    }
}