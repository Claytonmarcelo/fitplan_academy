<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Usuários - FitPlan Academy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
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
            color: #666;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #ff6a00;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-active {
            background-color: #28a745;
            color: white;
        }
        .badge-inactive {
            background-color: #dc3545;
            color: white;
        }
        .badge-master {
            background-color: #6f42c1;
            color: white;
        }
        .badge-common {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FitPlan Academy</h1>
        <p>Relatório de Usuários</p>
        <p>Gerado em: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Login</th>
                <th>CPF</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Cadastrado em</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->login }}</td>
                <td>{{ $user->cpf ?? 'N/A' }}</td>
                <td>
                    @if($user->role === 'master')
                        <span class="badge badge-master">Administrador</span>
                    @else
                        <span class="badge badge-common">Comum</span>
                    @endif
                </td>
                <td>
                    @if($user->is_active)
                        <span class="badge badge-active">Ativo</span>
                    @else
                        <span class="badge badge-inactive">Inativo</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 20px;">
                    Nenhum usuário encontrado.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total de usuários: {{ $users->count() }}</p>
        <p>FitPlan Academy - Sistema de Gestão de Academia</p>
    </div>
</body>
</html>

