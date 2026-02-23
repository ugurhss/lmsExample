<?php

namespace App\UseCases\Quiz;

use App\Enums\QuizStatus;
use App\Models\Quiz;
use App\Repositories\Quiz\QuizRepositoryInterface;
use App\Services\Quiz\QuizService;
use Illuminate\Support\Facades\DB;

class UpdateQuizUseCase
{
    public function __construct(
        private readonly QuizRepositoryInterface $repo,
        private readonly QuizService $service
    ) {}

    //id al ve güncellemek istediğimiz verileri alır quiz günceller
    public function execute(int $id, array $payload): Quiz
    {
        return DB::transaction(function () use ($id, $payload) {

            $quiz = $this->repo->findOrFail($id);

            $data = $this->service->normalize($payload);

            // title değiştiyse slug yenile
            if (array_key_exists('title', $data)) {
                $data['slug'] = $this->service->makeUniqueSlug($data['title']);
            }

            //enum validasyonu controller/requestte yapacagım burada da istersk kontrol edb

            return $this->repo->update($quiz, $data);
        });
    }
}