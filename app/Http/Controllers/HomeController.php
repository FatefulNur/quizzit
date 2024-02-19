<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $quizzes = Quiz::with('user:id,name')
            ->select([
                'title',
                'description',
                'type',
                'user_id',
                'expired_at',
                'created_at',
            ])
            ->where('started_at', '<=', now())
            ->latest()->paginate(12);

        return view('index', compact('quizzes'));
    }
}
