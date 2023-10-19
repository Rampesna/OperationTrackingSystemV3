<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class UserAgeAndGenderReportExport implements FromCollection
{
    private $ageAndGenders;

    public function __construct($ageAndGenders)
    {
        $this->ageAndGenders = $ageAndGenders;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $ageAndGenders = collect();
        foreach ($this->ageAndGenders as $ageAndGender) {
            $ageAndGenders->push([
                'Ad Soyad' => $ageAndGender['name'],
                'Yaş' => $ageAndGender['age'],
                'Cinsiyet' => $ageAndGender['gender'],
            ]);
        }

        return $ageAndGenders;
    }
}
