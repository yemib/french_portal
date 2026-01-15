<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllStudentsSheetExport implements FromCollection, WithHeadings
{
    protected $studentsSheetArray;

    public function __construct($studentsSheetArray)
    {
        $this->studentsSheetArray = $studentsSheetArray;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return collect($this->studentsSheetArray);
    }

    public function headings(): array
    {
        return [
            'Registration Number',
            'Full Name',
            'Program',
            'Department'
        ];
    }
}
