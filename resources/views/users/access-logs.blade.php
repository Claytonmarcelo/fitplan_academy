<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs de Acesso - FitPlan Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #2c3e50;
        }

        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: var(--secondary-color) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .table {
            margin: 0;
        }

        .table th {
            background: #f8f9fa;
            color: var(--secondary-color);
            font-weight: 600;
            border: none;
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background: #e55a2b;
            border-color: #e55a2b;
        }

        .log-entry {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Barra de Acessibilidade -->
    @include('components.accessibility-bar')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-dumbbell"></i> FitPlan Academy
            </a>
            
            <div class="d-flex align-items-center">
                <span class="text-white me-3">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </span>
                <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="content-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="fas fa-history"></i> Logs de Acesso</h3>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>

            <!-- Filtros -->
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-3">
                    <input type="text" 
                           class="form-control" 
                           name="user_name" 
                           placeholder="Nome do usuário"
                           value="{{ request('user_name') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" 
                           class="form-control" 
                           name="user_cpf" 
                           placeholder="CPF"
                           value="{{ request('user_cpf') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" 
                           class="form-control" 
                           name="date_from" 
                           value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" 
                           class="form-control" 
                           name="date_to" 
                           value="{{ request('date_to') }}">
                </div>
                <div class="col-md-1">
                    <select class="form-select" name="successful">
                        <option value="">Status</option>
                        <option value="1" {{ request('successful') === '1' ? 'selected' : '' }}>Sucesso</option>
                        <option value="0" {{ request('successful') === '0' ? 'selected' : '' }}>Falha</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <select class="form-select" name="two_factor">
                        <option value="">2FA</option>
                        <option value="1" {{ request('two_factor') === '1' ? 'selected' : '' }}>Com 2FA</option>
                        <option value="0" {{ request('two_factor') === '0' ? 'selected' : '' }}>Sem 2FA</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Tabela -->
            <div class="table-responsive">
                <table class="table table-hover">
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
                        <tr class="log-entry">
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $log->user_name }}</td>
                            <td>{{ $log->user_cpf }}</td>
                            <td><code>{{ $log->user_login }}</code></td>
                            <td>{{ $log->ip_address }}</td>
                            <td>
                                @if($log->two_factor_used)
                                    <span class="badge bg-success">
                                        <i class="fas fa-shield-alt"></i> Sim
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Não</span>
                                @endif
                            </td>
                            <td>
                                @if($log->login_successful)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check"></i> Sucesso
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times"></i> Falha
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-history fa-2x text-muted"></i>
                                <p class="mt-2 text-muted">Nenhum log de acesso encontrado.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            @if($logs->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $logs->appends(request()->query())->links() }}
            </div>
            @endif

            <!-- Resumo -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $logs->total() }}</h5>
                            <p class="card-text">Total de Logs</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-success">
                                {{ $logs->where('login_successful', true)->count() }}
                            </h5>
                            <p class="card-text">Sucessos</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-danger">
                                {{ $logs->where('login_successful', false)->count() }}
                            </h5>
                            <p class="card-text">Falhas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-warning">
                                {{ $logs->where('two_factor_used', true)->count() }}
                            </h5>
                            <p class="card-text">Com 2FA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
