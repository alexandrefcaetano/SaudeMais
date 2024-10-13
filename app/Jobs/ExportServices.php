<?php
namespace App\Jobs;

use App\Exports\ServicosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\ExportCompleted;
use Illuminate\Bus\Queueable; // Adicione esta linha
use Illuminate\Contracts\Queue\ShouldQueue; // Adicione esta linha
use Illuminate\Foundation\Bus\Dispatchable; // Adicione esta linha
use Illuminate\Queue\InteractsWithQueue; // Adicione esta linha
use Illuminate\Queue\SerializesModels; // Adicione esta linha

class ExportServices implements ShouldQueue // Certifique-se de implementar a interface ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels; // Adicione as traits necessárias

    protected $fileName;
    public $timeout = 5600; // 1 hora (3600 segundos)

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function handle()
    {
        // Lógica para exportar os serviços
        Excel::store(new ServicosExport, $this->fileName);

    }

}
