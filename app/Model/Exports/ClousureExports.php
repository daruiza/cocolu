<?php

namespace App\Model\Exports;

use App\Model\Core\Clousure;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClousureExports implements FromCollection,WithHeadings
{
    public function collection()
    {
        return Clousure::all();
    }

    public function headings(): array
    {
        return [
            '#',
            __('messages.Name'),
            __('messages.Description'),
            'cosa',
            'cosa2',
            'FECHA',
            'FECHA',
            'Created at',
            'Updated at'
        ];
    }
}