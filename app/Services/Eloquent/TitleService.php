<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITitleService;
use App\Models\Eloquent\Title;

class TitleService implements ITitleService
{
    public function getAll()
    {
        return Title::all();
    }

    public function getById(
        int $id
    )
    {
        return Title::find($id);
    }

    public function getByDepartmentId(
        int $departmentId
    )
    {
        return Title::where('department_id', $departmentId)->get();
    }

    public function create(
        int    $departmentId,
        string $name
    )
    {
        $title = new Title;
        $title->department_id = $departmentId;
        $title->name = $name;
        $title->save();

        return $title;
    }

    public function update(
        int    $id,
        string $name
    )
    {
        $title = $this->getById($id);
        $title->name = $name;
        $title->save();

        return $title;
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

}
