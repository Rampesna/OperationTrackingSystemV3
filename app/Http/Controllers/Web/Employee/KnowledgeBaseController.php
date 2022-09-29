<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KnowledgeBaseController extends Controller
{
    public function index()
    {
        return view('employee.modules.knowledgeBase.index.index');
    }

    public function question(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('employee.modules.knowledgeBase.question.index', [
                'id' => $request->id
            ]);
        }
    }
}
