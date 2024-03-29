<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Quiz;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $quizzes = Quiz::with('user:id,name')
            ->select([
                'id',
                'title',
                'description',
                'type',
                'marks_total',
                'user_id',
                'expired_at',
                'created_at',
            ])
            ->where('started_at', '<=', now())
            ->latest()->paginate(12);

        $products = Product::select([
            'name',
            'price_formatted'
        ])->get();

        return view('index', compact('quizzes', 'products'));
    }
}
