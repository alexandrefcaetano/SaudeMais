<?php

namespace App\Exports;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class RelatorioCencusSeguroExport implements FromCollection, WithHeadings
{
    private ?int $empresa_id;
    private int $seguradora_id;
    private ?string $apolice;
    private ?string $beneficiarionecessitaautorizacao;

    /**
     * Construtor da classe RelatorioCencusSeguroExport.
     *
     * @param int $seguradora_id ID da seguradora (obrigatório).
     * @param int|null $empresa_id ID da empresa (opcional).
     * @param string|null $apolice ID da apólice (opcional).
     * @param string|null $beneficiarionecessitaautorizacao S ou N (opcional).
     */
    public function __construct(int $seguradora_id, ?int $empresa_id = null, ?string $apolice = null, ?string $beneficiarionecessitaautorizacao = null)
    {
        $this->empresa_id = $empresa_id;
        $this->seguradora_id = $seguradora_id;
        $this->apolice = $apolice;
        $this->beneficiarionecessitaautorizacao = $beneficiarionecessitaautorizacao;
    }

    /**
     * Obtém a coleção de dados a serem exportados.
     *
     * @return Collection A coleção com os dados dos clientes.
     */
    public function collection(): Collection
    {
        // Inicializa a consulta
        $query = DB::table('tb_cliente AS cli')
            ->select([
                'seg.seguradora',
                'emp.nomefantasia AS empresa',
                'apo.apolice',
                DB::raw("CASE
                    WHEN apo.resseguro = 'S' THEN 'Sim'
                    ELSE 'Não'
                END AS resseguro"),
                'apo.apoliceseguradora',
                DB::raw("CASE
                    WHEN apo.datafimcobertura < NOW() THEN 'BLOQUEADO'
                    ELSE cli.situacao
                END AS situacao"),
                DB::raw("CASE
                    WHEN substr(cli.numerocartao, 13, 2) <> '00' THEN concat(substr(cli.numerocartao, 1, 12), '-00')
                    ELSE cli.numerocartao
                END AS cartaotitular"),
                'cli.numeroempregado',
                DB::raw("CASE
                    WHEN apo.redeinternacional = 'S' THEN 'Sim'
                    ELSE 'Não'
                END AS redeinternacional"),
                'cli.bi',
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
                'cli.numeroseguradora',
                'cli.updated_at',
                'cli.datacancelamento',
                DB::raw("COALESCE(cli.iban, '') AS iban"),
                DB::raw("COALESCE(cli.contacorrente, '') AS contacorrente"),
                DB::raw("CASE
                    WHEN cli.beneficiarionecessitaautorizacao = 'S' THEN 'Sim'
                    ELSE 'Não'
                END AS beneficiarionecessitaautorizacao")

            ])
            ->leftJoin('tb_seguradora AS seg', 'cli.seguradora_id', '=', 'seg.id_seguradora')
            ->leftJoin('tb_empresa AS emp', 'cli.empresa_id', '=', 'emp.id_empresa')
            ->leftJoin('tb_apolice AS apo', 'cli.apolice_id', '=', 'apo.id_apolice')
            ->where('cli.seguradora_id', $this->seguradora_id);

        // Adiciona filtros opcionais
        if ($this->empresa_id) {
            $query->where('cli.empresa_id', $this->empresa_id);
        }

        if ($this->apolice) {
            $query->where('apo.apolice', $this->apolice);
        }
        if( $this->beneficiarionecessitaautorizacao){
            $query->where('cli.beneficiarionecessitaautorizacao', $this->beneficiarionecessitaautorizacao);
        }

        // Retorna a coleção de dados
        return collect($query->get());
    }

    /**
     * Define os cabeçalhos da planilha Excel.
     *
     * @return array Um array contendo os nomes das colunas.
     */
    public function headings(): array
    {
        return [
            'Seguradora',
            'Empresa',
            'Apólice',
            'Resseguro',
            'Apólice Seguradora',
            'Situação',
            'Cartão Titular',
            'Número Empregado',
            'Rede Internacional',
            'BI',
            'Número do Cartão',
            'Beneficiário',
            'Data de Nascimento',
            'Idade',
            'Parentesco',
            'Gênero',
            'Contato',
            'Data de Ativação',
            'Data Início Cobertura',
            'Data Fim Cobertura',
            'Número Seguradora',
            'Última Atualização',
            'Data de Cancelamento',
            'IBAN',
            'Conta Corrente',
            'Necessita Autorização'
        ];
    }
}
