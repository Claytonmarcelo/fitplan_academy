<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - FitPlan Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
</head>
<body class="bg-gray-50 font-['Inter']">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Bem-vindo de volta!</h1>
                <p class="mt-2 text-gray-600">Entre com sua conta FitPlan Academy</p>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-8">
                <form action="{{ url('/api/auth/login') }}" method="POST" class="space-y-6" onsubmit="handleLogin(event)">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                               placeholder="seu@email.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                               placeholder="Sua senha">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                        </label>
                        <a href="#" class="text-sm text-orange-600 hover:text-orange-700">Esqueceu a senha?</a>
                    </div>

                    <button type="submit"
                            class="w-full bg-orange-600 text-white py-3 rounded-lg font-bold hover:bg-orange-700 transition-colors">
                        Entrar
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600">
                    Não tem uma conta?
                    <a href="{{ route('landing') }}#planos" class="text-orange-600 hover:text-orange-700 font-medium">Assine agora</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        async function handleLogin(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: formData.get('email'),
                        password: formData.get('password'),
                        remember: formData.get('remember') === 'on'
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    // Salva token no localStorage
                    localStorage.setItem('token', data.data.token);
                    // Redireciona para dashboard (você pode criar depois)
                    alert('Login realizado com sucesso!');
                    window.location.href = '/';
                } else {
                    alert(data.message || 'Erro ao fazer login');
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao fazer login. Tente novamente.');
            }
        }
    </script>
</body>
</html>

