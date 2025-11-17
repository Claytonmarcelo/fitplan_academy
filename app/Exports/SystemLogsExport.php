<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SystemLogsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function collection()
    {
        return $this->logs;
    }

    public function headings(): array
    {
        return [
            'Data/Hora',
            'Usuário',
            'CPF',
            'Login',
            'IP',
            'User Agent',
            '2FA',
            'Status',
        ];
    }

    public function map($log): array
    {
        return [
            $log->created_at->format('d/m/Y H:i:s'),
            $log->user_name,
            $log->user_cpf,
            $log->user_login,
            $log->ip_address,
            $log->user_agent ?? 'N/A',
            $log->two_factor_used ? 'Sim' : 'Não',
            $log->login_successful ? 'Sucesso' : 'Falha',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

