<?php

namespace App\Exports;

use App\Models\Cliente;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatorioMaioresUtilizadoresExport implements FromCollection, WithHeadings
{
    private ?int $empresa_id;
    private string $dataInicio;
    private string $dataFim;

    /**
     * Construtor da classe RelatorioMaioresUtilizadoresExport.
     *
     * @param int|null $empresa_id ID da empresa (opcional).
     * @param string $dataInicio Data de início no formato Y-m-d (obrigatório).
     * @param string $dataFim Data de fim no formato Y-m-d (obrigatório).
     */
    public function __construct(?int $empresa_id, string $dataInicio, string $dataFim)
    {
        $this->empresa_id = $empresa_id;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
    }

    /**
     * Obtém a coleção de dados a serem exportados.
     *
     * @return Collection A coleção com os dados dos clientes.
     */
    public function collection(): Collection
    {
        // Monta a query base com os parâmetros de data
        $query = DB::table('tb_guiaseguro as g')
            ->join('tb_tipoatendimento as t', 't.id_tipoatendimento', '=', 'g.tipoatendimento_id')
            ->join('tb_cliente as c', 'g.cliente_id', '=', 'c.id_cliente')
            ->join('tb_empresa as e', 'c.empresa_id', '=', 'e.id_empresa')
            ->join('tb_apolice as a', 'c.apolice_id', '=', 'a.id_apolice')
            ->selectRaw('c.numerocartao, c.nome AS beneficiario, c.parentesco, a.apolice, e.nomefantasia AS empresa, t.tipoatendimento, COUNT(g.id_guiaSeguro) AS quantidade')
            ->where('g.ativo', 'S')
            ->whereBetween(DB::raw('DATE(g.dataatendimento)'), [$this->dataInicio, $this->dataFim])
            ->groupBy('c.numerocartao', 'c.nome', 'c.parentesco', 'a.apolice', 'e.nomefantasia', 't.tipoatendimento')
            ->orderByDesc('quantidade')
            ->orderBy('c.nome')
            ->orderBy('t.tipoatendimento');

        // Aplica o filtro de empresa se estiver definido
        if ($this->empresa_id) {
            $query->where('c.empresa_id', $this->empresa_id);
        }

        // Retorna a coleção de dados
        return $query->get();
    }

    /**
     * Define os cabeçalhos da planilha Excel.
     *
     * @return array Um array contendo os nomes das colunas.
     */
    public function headings(): array
    {
        return [
            'Número do Cartão',
            'Beneficiário',
            'Parentesco',
            'Apólice',
            'Empresa',
            'Tipo de Atendimento',
            'Quantidade'
        ];
    }
}
