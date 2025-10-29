<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitPlan Academy - API</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            max-width: 800px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #667eea;
            font-size: 3em;
            margin-bottom: 20px;
            text-align: center;
        }

        .subtitle {
            color: #666;
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 40px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .feature {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .feature h3 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .feature p {
            color: #666;
            font-size: 0.9em;
        }

        .endpoints {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .endpoints h2 {
            color: #667eea;
            margin-bottom: 20px;
        }

        .endpoint {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            border-left: 4px solid #667eea;
        }

        .endpoint code {
            color: #764ba2;
            font-family: 'Courier New', monospace;
        }

        .method {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 0.8em;
            font-weight: bold;
            margin-right: 10px;
        }

        .method.post { background: #28a745; color: white; }
        .method.get { background: #007bff; color: white; }
        .method.put { background: #ffc107; color: black; }
        .method.delete { background: #dc3545; color: white; }

        .footer {
            text-align: center;
            color: #999;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <!-- Barra de Acessibilidade -->
    @include('components.accessibility-bar')
    <div class="container">
        <h1>🚀 FitPlan Academy</h1>
        <p class="subtitle">API REST com Clean Architecture + Laravel + PostgreSQL</p>

        <div class="features">
            <div class="feature">
                <h3>⚡ Performance</h3>
                <p>Otimizado com PostgreSQL e Redis</p>
            </div>
            <div class="feature">
                <h3>🏗️ Clean Code</h3>
                <p>Arquitetura limpa por features</p>
            </div>
            <div class="feature">
                <h3>🔐 Seguro</h3>
                <p>Laravel Sanctum Auth</p>
            </div>
            <div class="feature">
                <h3>📚 Documentado</h3>
                <p>Código comentado para equipe</p>
            </div>
        </div>

        <div class="endpoints">
            <h2>🔌 Endpoints da API</h2>
            
            <div class="endpoint">
                <span class="method post">POST</span>
                <code>/api/auth/register</code> - Registrar novo usuário
            </div>
            
            <div class="endpoint">
                <span class="method post">POST</span>
                <code>/api/auth/login</code> - Login (gera token)
            </div>
            
            <div class="endpoint">
                <span class="method get">GET</span>
                <code>/api/auth/me</code> - Dados do usuário autenticado
            </div>
            
            <div class="endpoint">
                <span class="method post">POST</span>
                <code>/api/auth/logout</code> - Logout (revoga token)
            </div>
            
            <div class="endpoint">
                <span class="method get">GET</span>
                <code>/api/users</code> - Listar usuários (paginado)
            </div>
            
            <div class="endpoint">
                <span class="method get">GET</span>
                <code>/api/users/{id}</code> - Buscar usuário por ID
            </div>
            
            <div class="endpoint">
                <span class="method post">POST</span>
                <code>/api/users</code> - Criar novo usuário
            </div>
            
            <div class="endpoint">
                <span class="method put">PUT</span>
                <code>/api/users/{id}</code> - Atualizar usuário
            </div>
            
            <div class="endpoint">
                <span class="method delete">DELETE</span>
                <code>/api/users/{id}</code> - Deletar usuário
            </div>
        </div>

        <div class="footer">
            <p>💻 Desenvolvido com Laravel 10.x + PostgreSQL</p>
            <p>📖 Veja o README.md para documentação completa</p>
        </div>
    </div>
</body>
</html>

