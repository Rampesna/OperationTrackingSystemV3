<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class KnowledgeBaseController extends Controller
{
    public function index()
    {
        return view('user.modules.knowledgeBase.index.index');
    }

    public function question()
    {
        return view('user.modules.knowledgeBase.question.index');
    }

    public function category()
    {
        return view('user.modules.knowledgeBase.category.index');
    }
}
