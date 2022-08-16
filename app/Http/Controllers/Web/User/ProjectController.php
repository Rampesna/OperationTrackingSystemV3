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

    public function ticket(Request $request)
    {
        return view('user.modules.project.ticket.index', [
            'id' => $request->id
        ]);
    }

    public function version(Request $request)
    {
        return view('user.modules.project.version.index', [
            'id' => $request->id
        ]);
    }

    public function projectJob(Request $request)
    {
        return view('user.modules.project.projectJob.index', [
            'id' => $request->id
        ]);
    }

    public function landingCustomer(Request $request)
    {
        return view('user.modules.project.landingCustomer.index', [
            'id' => $request->id
        ]);
    }
}
