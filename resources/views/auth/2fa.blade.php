<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação 2FA - FitPlan Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #2c3e50;
            --accent-color: #f39c12;
            --dark-color: #1a1a1a;
            --light-color: #f8f9fa;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }

        .auth-header {
            background: var(--secondary-color);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .auth-header h1 {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 700;
        }

        .auth-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.8;
            font-size: 0.9rem;
        }

        .auth-body {
            padding: 2rem;
            text-align: center;
        }

        .two-fa-icon {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            text-align: center;
            font-size: 1.5rem;
            letter-spacing: 0.5rem;
            font-weight: bold;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }

        .btn-verify {
            background: var(--primary-color);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 1rem;
        }

        .btn-verify:hover {
            background: #e55a2b;
            transform: translateY(-1px);
        }

        .btn-back {
            background: var(--secondary-color);
            border: none;
            color: white;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background: #243b4a;
            color: white;
            text-decoration: none;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .instructions {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .code-input {
            position: relative;
        }

        .countdown {
            position: absolute;
            top: -10px;
            right: 10px;
            background: var(--accent-color);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1><i class="fas fa-shield-alt"></i> Verificação 2FA</h1>
                <p>Digite o código do seu aplicativo autenticador</p>
            </div>
            
            <div class="auth-body">
                <div class="two-fa-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>

                <div class="instructions">
                    <i class="fas fa-info-circle"></i>
                    Abra seu aplicativo autenticador (Google Authenticator, Authy, etc.) 
                    e digite o código de 6 dígitos exibido para FitPlan Academy.
                </div>

                @if(session('message'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i> {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('2fa.verify') }}">
                    @csrf
                    
                    <div class="form-floating mb-3 code-input">
                        <div class="countdown" id="countdown">5:00</div>
                        <input type="text" 
                               class="form-control @error('code') is-invalid @enderror" 
                               id="code" 
                               name="code" 
                               placeholder="000000"
                               required
                               maxlength="6"
                               pattern="[0-9]{6}"
                               autocomplete="off"
                               autofocus>
                        <label for="code"><i class="fas fa-key"></i> Código 2FA</label>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-verify" id="verifyBtn">
                        <i class="fas fa-check"></i> Verificar
                    </button>
                </form>

                <a href="{{ route('login') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Voltar ao Login
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Countdown timer (5 minutos)
        let timeLeft = 300; // 5 minutos em segundos
        const countdownElement = document.getElementById('countdown');
        const verifyBtn = document.getElementById('verifyBtn');
        
        function updateCountdown() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                countdownElement.textContent = 'Expirado';
                countdownElement.style.backgroundColor = '#dc3545';
                verifyBtn.disabled = true;
                verifyBtn.innerHTML = '<i class="fas fa-clock"></i> Sessão Expirada';
                
                setTimeout(() => {
                    window.location.href = '{{ route("login") }}';
                }, 2000);
            } else {
                timeLeft--;
            }
        }
        
        // Iniciar countdown
        updateCountdown();
        const countdownInterval = setInterval(updateCountdown, 1000);

        // Formatação automática do código
        document.getElementById('code').addEventListener('input', function(e) {
            // Remove qualquer caractere que não seja número
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 6);
            
            // Se atingiu 6 dígitos, submete automaticamente
            if (this.value.length === 6) {
                setTimeout(() => {
                    document.querySelector('form').submit();
                }, 500);
            }
        });

        // Prevenir colar texto que não seja número
        document.getElementById('code').addEventListener('paste', function(e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text');
            const numbers = paste.replace(/[^0-9]/g, '').substring(0, 6);
            this.value = numbers;
            
            if (numbers.length === 6) {
                setTimeout(() => {
                    document.querySelector('form').submit();
                }, 500);
            }
        });

        // Auto-dismiss alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('show')) {
                    setTimeout(() => {
                        alert.classList.remove('show');
                    }, 5000);
                }
            });
        }, 100);

        // Focus no input ao carregar
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('code').focus();
        });
    </script>
</body>
</html>
