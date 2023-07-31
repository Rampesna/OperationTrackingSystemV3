<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class UserPermitReportExport implements FromCollection
{
    private $permits;

    public function __construct($permits)
    {
        $this->permits = $permits;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $permits = collect();
        foreach ($this->permits as $permit) {
            $permits->push([
                'Ad Soyad' => $permit['name'],
                'İzin Süresi (Saat)' => $permit['duration'],
            ]);
        }

        return $permits;
    }
}
