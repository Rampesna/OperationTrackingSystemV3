<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('user.modules.project.index.index');
    }

    public function overview(Request $request)
    {
        return view('user.modules.project.overview.index', [
            'id' => $request->id
        ]);
    }

    public function task(Request $request)
    {
        return view('user.modules.project.task.index', [
            'id' => $request->id
        ]);
    }

    public function managementTask(Request $request)
    {
        return view('user.modules.project.managementTask.index', [
            'id' => $request->id
        ]);
    }

    public function note(Request $request)
    {
        return view('user.modules.project.note.index', [
            'id' => $request->id
        ]);
    }

    public function file(Request $request)
    {
        return view('user.modules.project.file.index', [
            'id' => $request->id
        ]);
    }

    public function supportRequest(Request $request)
    {
        return view('user.modules.project.supportRequest.index', [
            'id' => $request->id
        ]);
    }
}
