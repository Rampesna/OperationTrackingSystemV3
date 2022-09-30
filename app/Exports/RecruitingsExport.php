<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecruitingsExport implements FromCollection, WithHeadings
{
    private $recruitings;

    public function __construct($recruitings)
    {
        $this->recruitings = $recruitings;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $recruitings = collect();
        foreach ($this->recruitings as $recruiting) {
            $recruitings->push([
                'name' => $recruiting->name,
                'email' => $recruiting->email,
                'phone_number' => $recruiting->phone_number,
                'identity' => $recruiting->identity,
                'birth_date' => $recruiting->birth_date,
                'obstacle' => $recruiting->obstacle == 1 ? 'Var' : 'Yok',
                'department' => $recruiting->department ? $recruiting->department->name : '',
                'step' => $recruiting->cancel == 1 ? 'İptal' : $recruiting->step->name,
            ]);
        }

        return $recruitings;
    }

    public function headings(): array
    {
        return [
            'Ad Soyad',
            'E-Posta',
            'Telefon Numarası',
            'Kimlik Numarası',
            'Doğum Tarihi',
            'Engel Durumu',
            'Departman',
            'Aşama',
        ];
    }
}
