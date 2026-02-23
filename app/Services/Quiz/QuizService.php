<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use Illuminate\Support\Str;

class QuizService
{

//normalize et derken gelen veriyi temizle ve düzenle farksiz bir şekilde kullanıma hazır hale getiriyoruz slug 
//ben arrray alırım
    public function normalize(array $data): array
    {
        if (isset($data['title'])) {
            $data['title'] = trim($data['title']);
        }

        return $data;
    }


//slug oluştururken aynı slug varsa sonuna -2, -3 gibi ekler yaparak benzersiz hale getirir
//ben saddece başlık isterim
    public function makeUniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $slug = $base ?: Str::random(8);
        $i = 2;

        while (Quiz::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}