<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        return User::whereIn('id', $this->ids)->select('id', 'name', 'created_at', 'status', 'email', 'phone')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên',
            'Ngày tạo',
            'Trạng thái',
            'Email',
            'Số điện thoại'
        ];
    }
}
