<?php

namespace App\Model\Exports;

use App\Model\Core\Clousure;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClousureExports implements FromCollection,WithHeadings
{
    public function collection()
    {
        // Retorna todos las ordenes descritas
        dd(
            \Auth::user()->store()->clousures()
            ->select(
                'tables.name as table',
                'orders.id as order',
                'order_status.name as order_status',
                'orders.date as order_date',
                'order_product.price',
                'order_product.volume'
            )
            ->leftJoin('services','services.rel_clousure_id','clousures.id')
            ->leftJoin('tables','tables.id','services.table_id')
            ->leftJoin('orders','orders.service_id','services.id')
            ->leftJoin('order_status','order_status.id','orders.status_id')
            ->leftJoin('order_product','order_product.order_id','orders.id')
            
            ->get()
        );
        $orders = '';
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