<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class RelatorioCencusCronicoExport implements FromView, WithDrawings
{
    private ?int $empresa_id;
    private int $seguradora_id;
    private ?int $apolice_id;
    private ?int $cobertura_id;

    /**
     * Construtor da classe RelatorioCencusCronicoExport.
     *
     * @param int|null $empresa_id ID da empresa (opcional).
     * @param int $seguradora_id ID da seguradora (obrigatório).
     * @param int|null $apolice_id ID da apólice (opcional).
     * @param int|null $cobertura_id ID da cobertura (opcional).
     */
    public function __construct(int $seguradora_id, ?int $empresa_id = null, ?int $apolice_id = null, ?int $cobertura_id = null)
    {
        $this->empresa_id = $empresa_id;
        $this->seguradora_id = $seguradora_id;
        $this->apolice_id = $apolice_id;
        $this->cobertura_id = $cobertura_id;
    }

    /**
     * Retorna a view que será usada para gerar o arquivo Excel.
     *
     * @return View
     */
    public function view(): View
    {
        $query = DB::table('tb_cliente AS cli')
            ->select([
                'seg.seguradora',
                'emp.nomefantasia AS empresa',
                'apo.apolice',
                DB::raw("
                    CASE
                        WHEN apo.datafimcobertura < NOW() THEN 'BLOQUEADO'
                        ELSE cli.situacao
                    END AS situacao
                "),
                DB::raw("
                    CASE
                        WHEN SUBSTRING(cli.numerocartao FROM 13 FOR 2) <> '00' THEN
                            CONCAT(SUBSTRING(cli.numerocartao FROM 1 FOR 12), '-00')
                        ELSE cli.numerocartao
                    END AS cartaotitular
                "),
                'cli.numeroempregado',
                DB::raw("
                    CASE
                        WHEN apo.redeinternacional = 'S' THEN 'Sim'
                        ELSE 'Não'
                    END AS redeinternacional
                "),
                'cli.numerocartao',
                'cli.nome AS beneficiario',
                'cli.datanascimento',
                DB::raw("EXTRACT(YEAR FROM AGE(cli.datanascimento)) AS idade"),
                'cli.parentesco',
                'cli.genero',
                'cli.contato',
                'cli.dataativacao',
                'apo.datainiciocobertura',
                'apo.datafimcobertura',
//                'cc.dtinclusao',
//                'usu.nome AS usuario_inc',
                'cli.datacancelamento',
                'cid.cid'
            ])
            ->join('tb_seguradora AS seg', 'cli.seguradora_id', '=', 'seg.id_seguradora')
            ->join('tb_empresa AS emp', 'cli.empresa_id', '=', 'emp.id_empresa')
            ->join('tb_apolice AS apo', 'cli.apolice_id', '=', 'apo.id_apolice')
            ->leftJoin('tb_clientecronico AS cc', 'cli.id_cliente', '=', 'cc.cliente_id')
//            ->leftJoin('usuario AS usu', 'cc.id_usuario_inc', '=', 'usu.id_usuario')
            ->leftJoin('tb_cid as cid', 'cc.cid_id', '=', 'cid.id_cid')
            ->where('cli.seguradora_id', $this->seguradora_id);

        // Adiciona filtros opcionais
        if ($this->empresa_id) {
            $query->where('cli.id_empresa', $this->empresa_id);
        }

        if ($this->apolice_id) {
            $query->where('cli.id_apolice', $this->apolice_id);
        }

        if ($this->cobertura_id) {
            $query->where('cid.id_cobertura', $this->cobertura_id);
        }

        $clientes = $query->get();

        // Retorna a view com os dados
        return view('exports.relatorio_cencus_cronico', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Retorna a imagem que será usada no relatório.
     *
     * @return array
     */
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo do relatório');
        $drawing->setPath(public_path('assets/media/logos/imagem.png'));
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1'); // Define a célula onde a imagem será exibida

        return [$drawing];
    }
}
