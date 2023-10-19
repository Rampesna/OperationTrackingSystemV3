<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class UserOvertimeReportExport implements FromCollection
{
    private $overtimes;

    public function __construct($overtimes)
    {
        $this->overtimes = $overtimes;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $overtimes = collect();
        foreach ($this->overtimes as $overtime) {
            $overtimes->push([
                'Ad Soyad' => $overtime['name'],
                'Mesai Süresi (Saat)' => $overtime['duration'],
            ]);
        }

        return $overtimes;
    }
}
