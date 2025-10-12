@extends('layouts.app')

@section('title', 'Termos de Serviço - FitPlan Academy')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-zinc-900">
    <!-- Header -->
    <div class="bg-white dark:bg-zinc-800 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-4">
                    Termos de Serviço
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
                        1. Aceitação dos Termos
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">
                        Bem-vindo à FitPlan Academy! Estes Termos de Serviço ("Termos") regem o uso de nossos serviços 
                        de fitness e plataforma online. Ao acessar ou usar nossos serviços, você concorda em cumprir 
                        estes termos e todas as leis aplicáveis.
                    </p>
                </section>

                <!-- Definições -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        2. Definições
                    </h2>
                    <ul class="space-y-3 text-zinc-600 dark:text-zinc-300">
                        <li><strong>"FitPlan Academy"</strong> ou <strong>"Empresa"</strong>: Refere-se à nossa organização</li>
                        <li><strong>"Serviços"</strong>: Todos os serviços oferecidos pela FitPlan Academy</li>
                        <li><strong>"Usuário"</strong> ou <strong>"Você"</strong>: Pessoa que utiliza nossos serviços</li>
                        <li><strong>"Plataforma"</strong>: Nosso site, aplicativo e sistemas online</li>
                        <li><strong>"Conteúdo"</strong>: Materiais, exercícios, planos e informações fornecidos</li>
                    </ul>
                </section>

                <!-- Serviços Oferecidos -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        3. Serviços Oferecidos
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        A FitPlan Academy oferece os seguintes serviços:
                    </p>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Planos de treino personalizados</li>
                        <li>Aulas em grupo e individuais</li>
                        <li>Acesso às instalações das unidades</li>
                        <li>Orientação nutricional básica</li>
                        <li>Comunidade online de membros</li>
                        <li>Desafios e competições</li>
                        <li>Acompanhamento de progresso</li>
                    </ul>
                </section>

                <!-- Cadastro e Conta -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        4. Cadastro e Conta de Usuário
                    </h2>
                    
                    <h3 class="text-xl font-medium text-zinc-800 dark:text-zinc-200 mb-3">
                        4.1 Requisitos para Cadastro
                    </h3>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 mb-4 space-y-2">
                        <li>Ter pelo menos 18 anos de idade</li>
                        <li>Fornecer informações verdadeiras e completas</li>
                        <li>Manter informações atualizadas</li>
                        <li>Ser responsável pela segurança da conta</li>
                    </ul>

                    <h3 class="text-xl font-medium text-zinc-800 dark:text-zinc-200 mb-3">
                        4.2 Responsabilidades do Usuário
                    </h3>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Manter confidencialidade da senha</li>
                        <li>Notificar sobre uso não autorizado</li>
                        <li>Ser responsável por todas as atividades na conta</li>
                        <li>Respeitar outros usuários e funcionários</li>
                    </ul>
                </section>

                <!-- Pagamentos -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        5. Pagamentos e Cobrança
                    </h2>
                    
                    <h3 class="text-xl font-medium text-zinc-800 dark:text-zinc-200 mb-3">
                        5.1 Preços e Cobrança
                    </h3>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 mb-4 space-y-2">
                        <li>Preços estão sujeitos a alterações com aviso prévio</li>
                        <li>Cobrança mensal automática</li>
                        <li>Taxas adicionais podem aplicar-se a serviços especiais</li>
                        <li>Pagamentos são processados por terceiros seguros</li>
                    </ul>

                    <h3 class="text-xl font-medium text-zinc-800 dark:text-zinc-200 mb-3">
                        5.2 Cancelamento e Reembolso
                    </h3>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Cancelamento pode ser feito a qualquer momento</li>
                        <li>Reembolsos seguem nossa política específica</li>
                        <li>Serviços cessam no final do período pago</li>
                        <li>Taxas de cancelamento podem aplicar-se</li>
                    </ul>
                </section>

                <!-- Uso Aceitável -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        6. Uso Aceitável
                    </h2>
                    
                    <h3 class="text-xl font-medium text-zinc-800 dark:text-zinc-200 mb-3">
                        6.1 Condutas Permitidas
                    </h3>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 mb-4 space-y-2">
                        <li>Usar os serviços conforme destinado</li>
                        <li>Respeitar outros usuários e funcionários</li>
                        <li>Seguir instruções de segurança</li>
                        <li>Manter equipamentos em bom estado</li>
                    </ul>

                    <h3 class="text-xl font-medium text-zinc-800 dark:text-zinc-200 mb-3">
                        6.2 Condutas Proibidas
                    </h3>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Usar serviços para atividades ilegais</li>
                        <li>Interferir com outros usuários</li>
                        <li>Danificar equipamentos ou instalações</li>
                        <li>Compartilhar conta com terceiros</li>
                        <li>Fazer upload de conteúdo inadequado</li>
                        <li>Violar direitos de propriedade intelectual</li>
                    </ul>
                </section>

                <!-- Saúde e Segurança -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        7. Saúde e Segurança
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        <strong>IMPORTANTE:</strong> Consulte um médico antes de iniciar qualquer programa de exercícios.
                    </p>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Você é responsável por sua própria saúde</li>
                        <li>Informe sobre limitações físicas</li>
                        <li>Siga instruções de segurança</li>
                        <li>Use equipamentos adequadamente</li>
                        <li>Pare imediatamente se sentir dor ou desconforto</li>
                    </ul>
                </section>

                <!-- Propriedade Intelectual -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        8. Propriedade Intelectual
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        Todo o conteúdo da FitPlan Academy é protegido por direitos autorais:
                    </p>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Planos de treino e exercícios</li>
                        <li>Materiais educacionais</li>
                        <li>Logotipos e marcas</li>
                        <li>Software e aplicações</li>
                        <li>Conteúdo do site e aplicativo</li>
                    </ul>
                </section>

                <!-- Limitação de Responsabilidade -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        9. Limitação de Responsabilidade
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        A FitPlan Academy não se responsabiliza por:
                    </p>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Lesões decorrentes do uso dos serviços</li>
                        <li>Perda de dados ou informações</li>
                        <li>Interrupções temporárias dos serviços</li>
                        <li>Danos indiretos ou consequenciais</li>
                        <li>Ações de terceiros</li>
                    </ul>
                </section>

                <!-- Suspensão e Encerramento -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        10. Suspensão e Encerramento
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        Podemos suspender ou encerrar sua conta nas seguintes situações:
                    </p>
                    <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-300 space-y-2">
                        <li>Violação destes termos</li>
                        <li>Comportamento inadequado</li>
                        <li>Pagamentos em atraso</li>
                        <li>Atividades ilegais</li>
                        <li>Por solicitação sua</li>
                    </ul>
                </section>

                <!-- Alterações -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        11. Alterações nos Termos
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">
                        Podemos atualizar estes termos periodicamente. Alterações significativas serão comunicadas 
                        com antecedência. O uso continuado dos serviços após mudanças constitui aceitação dos novos termos.
                    </p>
                </section>

                <!-- Lei Aplicável -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        12. Lei Aplicável
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">
                        Estes termos são regidos pelas leis brasileiras. Qualquer disputa será resolvida nos tribunais 
                        competentes do Brasil.
                    </p>
                </section>

                <!-- Contato -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">
                        13. Contato
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed mb-4">
                        Para dúvidas sobre estes Termos de Serviço, entre em contato conosco:
                    </p>
                    <div class="bg-zinc-50 dark:bg-zinc-700 p-6 rounded-lg">
                        <p class="text-zinc-700 dark:text-zinc-300">
                            <strong>FitPlan Academy</strong><br>
                            E-mail: legal@fitplanacademy.com<br>
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
