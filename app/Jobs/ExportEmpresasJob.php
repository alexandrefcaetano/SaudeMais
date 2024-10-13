<?php
namespace App\Jobs;

use App\Exports\EmpresaExport; // Certifique-se que está "EmpresaExport" e não "EmpresasExport"
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportEmpresasJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileType;

    public function __construct($fileType)
    {
        $this->fileType = $fileType;
    }

    public function handle()
    {
        // Exportar o arquivo no formato desejado
        Excel::store(new EmpresaExport, 'empresas.' . $this->fileType);
    }
}
