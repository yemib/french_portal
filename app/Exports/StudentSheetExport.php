<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentSheetExport implements FromCollection, WithHeadings
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
		
		//get all the of result mark 
		
		
        return [
            'Registration Number',
            'Full Name',
            'Score',
            'great'
        ];
    }
}
