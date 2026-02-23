<?php

namespace App\Http\Controllers\Api;

use App\Enums\QuizStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\StoreQuizRequest;
use App\Http\Requests\Quiz\UpdateQuizRequest;
use App\Http\Resources\QuizCollection;
use App\Http\Resources\QuizResource;
use App\Repositories\Quiz\QuizRepositoryInterface;
use App\Traits\ApiResponse;
use App\UseCases\Quiz\CreateQuizUseCase;
use App\UseCases\Quiz\UpdateQuizUseCase;
use App\UseCases\Quiz\DeleteQuizUseCase;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    use ApiResponse;
    

    //en önemlisi use case kullanırken her fonkisyon içerisinde use case'i parametre olarak alırız ve o fonksiyon içinde kullanırız unutma can alıcı 
//store upd delete bak
    public function index(Request $request, QuizRepositoryInterface $repo)
    {
        //paginat yap int
        $perPage = (int) $request->query('per_page', 15);
        return $this->success(new QuizCollection($repo->paginate($perPage)), 'Quizler listelendi');
    }

    public function show(int $id, QuizRepositoryInterface $repo)
    {
        //id al ve o idli quizi döndür yoksa hata döndürür
        return $this->success(new QuizResource($repo->findOrFail($id)), 'Quiz getirildi');
    }

    public function store(StoreQuizRequest $request, CreateQuizUseCase $uc)
    {
        $v = $request->validated();

        $quiz = $uc->execute(
            title: $v['title'],
            isActive: (bool)($v['is_active'] ?? true),
            status: QuizStatus::from($v['status'])
        );

        return $this->success(new QuizResource($quiz), 'Quiz oluşturuldu', 201);
    }

    public function update(UpdateQuizRequest $request, int $id, UpdateQuizUseCase $uc)
    {
        $v = $request->validated();

        $quiz = $uc->execute($id, $v);

        return $this->success(new QuizResource($quiz), 'Quiz güncellendi');
    }

    public function destroy(int $id, DeleteQuizUseCase $uc)
    {
        $uc->execute($id);
        return $this->success(null, 'Silindi');
        
    }
}
