<?php 
namespace App\Exports;

use App\Models\FeePayment;
use Maatwebsite\Excel\Concerns\FromCollection;

class FeeCollectionExport implements FromCollection
{
    public function collection()
    {
        return FeePayment::with('student')->get();
    }
}