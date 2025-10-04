<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FitPlan Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #2c3e50;
            --accent-color: #f39c12;
            --dark-color: #1a1a1a;
            --light-color: #f8f9fa;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --info-color: #3498db;
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

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            margin: 0 0.2rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
        }

        .navbar-nav .nav-link.active {
            background: var(--primary-color);
            color: white !important;
        }

        .user-info {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            color: white;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--primary-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stats-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .stats-card.users .icon { background: var(--info-color); }
        .stats-card.active .icon { background: var(--success-color); }
        .stats-card.logins .icon { background: var(--primary-color); }
        .stats-card.failed .icon { background: var(--danger-color); }

        .stats-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            color: var(--secondary-color);
        }

        .stats-card p {
            margin: 0;
            color: #666;
            font-weight: 500;
        }

        .plan-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .plan-card.popular {
            border: 2px solid var(--primary-color);
            transform: scale(1.05);
        }

        .plan-card.popular::before {
            content: 'MAIS POPULAR';
            position: absolute;
            top: 20px;
            right: -30px;
            background: var(--primary-color);
            color: white;
            padding: 5px 40px;
            font-size: 0.8rem;
            font-weight: 700;
            transform: rotate(45deg);
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .plan-card.popular:hover {
            transform: scale(1.05) translateY(-5px);
        }

        .plan-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .plan-price {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .plan-price span {
            font-size: 1rem;
            color: #666;
        }

        .plan-description {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .plan-features {
            list-style: none;
            padding: 0;
        }

        .plan-features li {
            padding: 0.5rem 0;
            color: #555;
        }

        .plan-features li i {
            color: var(--success-color);
            margin-right: 0.5rem;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .content-card h5 {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 0.5rem;
        }

        .table {
            margin: 0;
        }

        .table th {
            background: var(--light-color);
            color: var(--secondary-color);
            font-weight: 600;
            border: none;
        }

        .badge {
            font-size: 0.8rem;
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background: #e55a2b;
            border-color: #e55a2b;
        }

        .btn-danger {
            background: var(--danger-color);
            border-color: var(--danger-color);
        }

        .accessibility-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--dark-color);
            color: white;
            padding: 10px;
            text-align: center;
            z-index: 1050;
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .accessibility-bar.active {
            transform: translateY(0);
        }

        .accessibility-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .accessibility-btn {
            background: none;
            border: 1px solid white;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .accessibility-btn:hover {
            background: white;
            color: var(--dark-color);
        }

        .accessibility-toggle {
            position: fixed;
            top: 80px;
            right: 20px;
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1051;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        /* Ajustes para alto contraste */
        body.high-contrast {
            filter: contrast(200%);
        }

        /* Ajustes de fonte */
        body.font-large {
            font-size: 1.2rem;
        }

        body.font-small {
            font-size: 0.9rem;
        }

        .welcome-message {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .welcome-message h2 {
            margin: 0;
            font-weight: 700;
        }

        .welcome-message p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <!-- Barra de Acessibilidade -->
    <div class="accessibility-bar" id="accessibilityBar">
        <div class="accessibility-controls">
            <button class="accessibility-btn" onclick="toggleContrast()">
                <i class="fas fa-adjust"></i> Contraste
            </button>
            <button class="accessibility-btn" onclick="increaseFontSize()">
                <i class="fas fa-plus"></i> A+
            </button>
            <button class="accessibility-btn" onclick="decreaseFontSize()">
                <i class="fas fa-minus"></i> A-
            </button>
            <button class="accessibility-btn" onclick="resetAccessibility()">
                <i class="fas fa-undo"></i> Reset
            </button>
        </div>
    </div>

    <!-- Botão de Toggle da Acessibilidade -->
    <button class="accessibility-toggle" onclick="toggleAccessibilityBar()">
        <i class="fas fa-universal-access"></i>
    </button>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-dumbbell"></i> FitPlan Academy
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}">
                            <i class="fas fa-home"></i> Início
                        </a>
                    </li>
                    @if($user->isMaster())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="fas fa-users"></i> Usuários
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.dashboard') }}">
                                <i class="fas fa-dumbbell"></i> Dashboard Aluno
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('access-logs') }}">
                                <i class="fas fa-history"></i> Logs
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.edit', $user->id) }}">
                            <i class="fas fa-user-edit"></i> Meu Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('change-password') }}">
                            <i class="fas fa-key"></i> Alterar Senha
                        </a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <div class="user-info me-3">
                        <i class="fas fa-user"></i>
                        <strong>{{ $user->name }}</strong>
                        @if($user->isMaster())
                            <span class="badge bg-warning ms-1">Master</span>
                        @else
                            <span class="badge bg-info ms-1">Comum</span>
                        @endif
                    </div>
                    <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <!-- Mensagem de Boas-vindas -->
        <div class="welcome-message">
            <h2>Bem-vindo, {{ $user->name }}!</h2>
            <p>
                @if($user->isMaster())
                    Você está logado como <strong>Master</strong> - Acesso total ao sistema
                @else
                    Você está logado como <strong>Usuário Comum</strong> - Acesso às suas informações
                @endif
            </p>
        </div>

        <!-- Estatísticas -->
        @if($user->isMaster())
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stats-card users">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>{{ $stats['total_users'] }}</h3>
                    <p>Total de Usuários</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stats-card active">
                    <div class="icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3>{{ $stats['active_users'] }}</h3>
                    <p>Usuários Ativos</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stats-card logins">
                    <div class="icon">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <h3>{{ $stats['total_logins_today'] }}</h3>
                    <p>Logins Hoje</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stats-card failed">
                    <div class="icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3>{{ $stats['failed_logins_today'] }}</h3>
                    <p>Tentativas Falhas</p>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="content-card">
                    <h5><i class="fas fa-crown"></i> Nossos Planos de Academia</h5>
                    
                    <div class="row">
                        @foreach($plans as $plan)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="plan-card {{ $plan['popular'] ? 'popular' : '' }}">
                                <div class="plan-name">{{ $plan['name'] }}</div>
                                <div class="plan-price">
                                    R$ {{ number_format($plan['price'], 2, ',', '.') }}
                                    <span>/mês</span>
                                </div>
                                <div class="plan-description">{{ $plan['description'] }}</div>
                                
                                <ul class="plan-features">
                                    @foreach($plan['features'] as $feature)
                                    <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if($user->isMaster())
        <div class="row">
            <!-- Logs Recentes -->
            <div class="col-lg-8">
                <div class="content-card">
                    <h5><i class="fas fa-history"></i> Acessos Recentes</h5>
                    
                    @if($recentLogs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Data/Hora</th>
                                    <th>Usuário</th>
                                    <th>CPF</th>
                                    <th>2FA</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentLogs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $log->user_name }}</td>
                                    <td>{{ $log->user_cpf }}</td>
                                    <td>
                                        @if($log->two_factor_used)
                                            <span class="badge bg-success">Sim</span>
                                        @else
                                            <span class="badge bg-secondary">Não</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($log->login_successful)
                                            <span class="badge bg-success">Sucesso</span>
                                        @else
                                            <span class="badge bg-danger">Falha</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('access-logs') }}" class="btn btn-primary">
                            <i class="fas fa-eye"></i> Ver Todos os Logs
                        </a>
                    </div>
                    @else
                    <p class="text-muted text-center">Nenhum log de acesso registrado ainda.</p>
                    @endif
                </div>
            </div>

            <!-- Usuários Recentes -->
            <div class="col-lg-4">
                <div class="content-card">
                    <h5><i class="fas fa-user-plus"></i> Usuários Recentes</h5>
                    
                    @if($recentUsers->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentUsers as $recentUser)
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $recentUser->name }}</strong><br>
                                    <small class="text-muted">{{ $recentUser->email }}</small>
                                </div>
                                <div class="text-end">
                                    @if($recentUser->isMaster())
                                        <span class="badge bg-warning">Master</span>
                                    @else
                                        <span class="badge bg-info">Comum</span>
                                    @endif
                                    <br>
                                    <small class="text-muted">{{ $recentUser->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('users.index') }}" class="btn btn-primary">
                            <i class="fas fa-users"></i> Ver Todos os Usuários
                        </a>
                    </div>
                    @else
                    <p class="text-muted text-center">Nenhum usuário cadastrado ainda.</p>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Funções de Acessibilidade
        function toggleAccessibilityBar() {
            const bar = document.getElementById('accessibilityBar');
            bar.classList.toggle('active');
        }

        function toggleContrast() {
            document.body.classList.toggle('high-contrast');
            localStorage.setItem('highContrast', document.body.classList.contains('high-contrast'));
        }

        function increaseFontSize() {
            document.body.classList.remove('font-small');
            document.body.classList.add('font-large');
            localStorage.setItem('fontSize', 'large');
        }

        function decreaseFontSize() {
            document.body.classList.remove('font-large');
            document.body.classList.add('font-small');
            localStorage.setItem('fontSize', 'small');
        }

        function resetAccessibility() {
            document.body.classList.remove('high-contrast', 'font-large', 'font-small');
            localStorage.removeItem('highContrast');
            localStorage.removeItem('fontSize');
        }

        // Carregar preferências salvas
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('highContrast') === 'true') {
                document.body.classList.add('high-contrast');
            }
            
            const fontSize = localStorage.getItem('fontSize');
            if (fontSize === 'large') {
                document.body.classList.add('font-large');
            } else if (fontSize === 'small') {
                document.body.classList.add('font-small');
            }
        });
    </script>
</body>
</html>
