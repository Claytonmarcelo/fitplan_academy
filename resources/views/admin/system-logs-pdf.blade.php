<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs do Sistema - FitPlan Academy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ff6a00;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #ff6a00;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .stats {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stat-item {
            display: table-cell;
            text-align: center;
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        .stat-item strong {
            display: block;
            font-size: 18px;
            color: #ff6a00;
        }
        .stat-item span {
            font-size: 11px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #ff6a00;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #dee2e6;
            font-size: 10px;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .status-success {
            color: #28a745;
            font-weight: bold;
        }
        .status-failure {
            color: #dc3545;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FitPlan Academy</h1>
        <p>Relatório de Logs do Sistema</p>
        <p>Gerado em: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <strong>{{ $stats['total'] }}</strong>
            <span>Total de Logs</span>
        </div>
        <div class="stat-item">
            <strong>{{ $stats['successful'] }}</strong>
            <span>Logins Bem-sucedidos</span>
        </div>
        <div class="stat-item">
            <strong>{{ $stats['failed'] }}</strong>
            <span>Logins Falhados</span>
        </div>
        <div class="stat-item">
            <strong>{{ $stats['with_2fa'] }}</strong>
            <span>Com 2FA</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Data/Hora</th>
                <th>Usuário</th>
                <th>CPF</th>
                <th>Login</th>
                <th>IP</th>
                <th>2FA</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                <td>{{ $log->user_name }}</td>
                <td>{{ $log->user_cpf }}</td>
                <td>{{ $log->user_login }}</td>
                <td>{{ $log->ip_address }}</td>
                <td>{{ $log->two_factor_used ? 'Sim' : 'Não' }}</td>
                <td class="{{ $log->login_successful ? 'status-success' : 'status-failure' }}">
                    {{ $log->login_successful ? 'Sucesso' : 'Falha' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">
                    Nenhum log encontrado.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>FitPlan Academy - Sistema de Gestão de Academia</p>
        <p>Este relatório foi gerado automaticamente pelo sistema.</p>
    </div>
</body>
</html>

