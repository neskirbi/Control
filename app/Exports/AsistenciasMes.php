<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Support\Facades\DB;
use App\Models\Cita;

use App\Models\Obra;
class AsistenciasMes implements FromView
{
   
    public function view(): View
    {
        
    }
}
