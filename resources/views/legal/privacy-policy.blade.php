@extends('layouts.app')

@section('title', 'Política de Privacidade - FitPlan Academy')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-zinc-900">
    <!-- Header -->
    <div class="bg-white dark:bg-zinc-800 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-4">
                    Política de Privacidade
                </h1>
                <p class="text-zinc-600 dark:text-zinc-400">
                    Última atualização: {{ date('d/m/Y') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Conteúdo -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-8">
                
                <!-- Introdução -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        1. Introdução
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">
                        A FitPlan Academy ("nós", "nosso" ou "empresa") respeita sua privacidade e está comprometida 
                        em proteger suas informações pessoais. Esta Política de Privacidade explica como coletamos, 
                        usamos, armazenamos e protegemos suas informações quando você utiliza nossos serviços.
                    </p>
                </section>

                <!-- Informações Coletadas -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        2. Informações que Coletamos
                    </h2>
                    
                    <h3 class="text-xl font-medium text-zinc-800 dark:text-zinc-200 mb-3">
                        2.1 Informações Pessoais
                    </h3>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 mb-4 space-y-2">
                        <li>Nome completo</li>
                        <li>Data de nascimento</li>
                        <li>Gênero</li>
                        <li>Nome da mãe</li>
                        <li>CPF</li>
                        <li>Endereço completo</li>
                        <li>Números de telefone</li>
                        <li>Endereço de e-mail</li>
                    </ul>

                    <h3 class="text-xl font-medium text-zinc-800 dark:text-zinc-200 mb-3">
                        2.2 Informações de Uso
                    </h3>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 mb-4 space-y-2">
                        <li>Dados de navegação no site</li>
                        <li>Histórico de treinos</li>
                        <li>Preferências de exercícios</li>
                        <li>Dados de pagamento (processados por terceiros seguros)</li>
                    </ul>
                </section>

                <!-- Como Usamos -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        3. Como Usamos suas Informações
                    </h2>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Fornecer e melhorar nossos serviços de fitness</li>
                        <li>Criar planos de treino personalizados</li>
                        <li>Processar pagamentos e manter registros financeiros</li>
                        <li>Comunicar sobre serviços e atualizações</li>
                        <li>Cumprir obrigações legais e regulamentares</li>
                        <li>Melhorar a experiência do usuário</li>
                    </ul>
                </section>

                <!-- Compartilhamento -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        4. Compartilhamento de Informações
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        Não vendemos, alugamos ou compartilhamos suas informações pessoais com terceiros, exceto nas seguintes situações:
                    </p>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Com seu consentimento explícito</li>
                        <li>Para processar pagamentos (processadores de pagamento seguros)</li>
                        <li>Para cumprir obrigações legais</li>
                        <li>Para proteger nossos direitos e segurança</li>
                        <li>Com prestadores de serviços que nos auxiliam (sob acordos de confidencialidade)</li>
                    </ul>
                </section>

                <!-- Segurança -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        5. Segurança dos Dados
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        Implementamos medidas de segurança técnicas e organizacionais para proteger suas informações:
                    </p>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Criptografia de dados sensíveis</li>
                        <li>Acesso restrito a informações pessoais</li>
                        <li>Monitoramento regular de segurança</li>
                        <li>Backup seguro dos dados</li>
                        <li>Treinamento de funcionários sobre privacidade</li>
                    </ul>
                </section>

                <!-- Seus Direitos -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        6. Seus Direitos
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        Você tem os seguintes direitos em relação às suas informações pessoais:
                    </p>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Acesso às suas informações pessoais</li>
                        <li>Correção de informações incorretas</li>
                        <li>Exclusão de suas informações (direito ao esquecimento)</li>
                        <li>Portabilidade dos dados</li>
                        <li>Oposição ao processamento</li>
                        <li>Retirada do consentimento</li>
                    </ul>
                </section>

                <!-- Cookies -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        7. Cookies e Tecnologias Similares
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        Utilizamos cookies e tecnologias similares para melhorar sua experiência:
                    </p>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Cookies essenciais para funcionamento do site</li>
                        <li>Cookies de análise para entender o uso</li>
                        <li>Cookies de preferências para personalização</li>
                    </ul>
                </section>

                <!-- Retenção -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        8. Retenção de Dados
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">
                        Mantemos suas informações pessoais apenas pelo tempo necessário para cumprir os propósitos 
                        descritos nesta política ou conforme exigido por lei. Dados de contas inativas são excluídos 
                        após 3 anos de inatividade.
                    </p>
                </section>

                <!-- Menores -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        9. Menores de Idade
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">
                        Nossos serviços são destinados a pessoas com 18 anos ou mais. Não coletamos intencionalmente 
                        informações de menores de 18 anos. Se descobrirmos que coletamos informações de um menor, 
                        tomaremos medidas para excluir essas informações.
                    </p>
                </section>

                <!-- Alterações -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        10. Alterações nesta Política
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">
                        Podemos atualizar esta Política de Privacidade periodicamente. Notificaremos sobre mudanças 
                        significativas através do nosso site ou por e-mail. Recomendamos revisar esta política 
                        regularmente.
                    </p>
                </section>

                <!-- Contato -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        11. Contato
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        Se você tiver dúvidas sobre esta Política de Privacidade ou sobre como tratamos suas informações, 
                        entre em contato conosco:
                    </p>
                    <div class="bg-zinc-50 dark:bg-zinc-700 p-6 rounded-lg">
                        <p class="text-zinc-700 dark:text-zinc-300">
                            <strong>FitPlan Academy</strong><br>
                            E-mail: privacidade@fitplanacademy.com<br>
                            Telefone: (11) 9999-9999<br>
                            Endereço: Av. Paulista, 1000 - Bela Vista, São Paulo - SP
                        </p>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>
@endsection
