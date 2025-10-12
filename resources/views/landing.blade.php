<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FitPlan Academy - Eleve Seu Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">FitPlan Academy</h1>
        <p class="text-gray-600 mb-8">Landing page completa funcionando</p>
        
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($plans as $plan)
            <div class="bg-white rounded-lg shadow-sm p-6 {{ $plan->name === 'Smart' ? 'ring-2 ring-orange-500' : '' }}">
                @if($plan->name === 'Smart')
                    <div class="text-center mb-4">
                        <span class="inline-block px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded-full">MAIS POPULAR</span>
                    </div>
                @endif
                
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $plan->name }}</h3>
                <p class="text-gray-600 mb-4">R$ {{ number_format($plan->price, 2, ',', '.') }}/mês</p>
                <p class="text-gray-500 text-sm mb-4">{{ $plan->description }}</p>
                
                <ul class="space-y-2 mb-4">
                    @foreach($plan->features as $feature)
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-600">{{ $feature }}</span>
                    </li>
                    @endforeach
                </ul>
                
                <a href="{{ route('plan.' . strtolower($plan->name)) }}" class="block w-full text-center px-4 py-2 bg-orange-500 text-white rounded-lg">Escolher {{ $plan->name }}</a>
            </div>
            @endforeach
        </div>
        
        <div class="mt-8 text-center">
            <a href="{{ route('cadastro') }}" class="inline-block px-6 py-3 bg-orange-500 text-white rounded-lg">Cadastre-se</a>
        </div>
    </div>
</body>
</html>