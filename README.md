# 🏋️‍♂️ FitPlan Academy

Sistema completo de gestão de academia com funcionalidades avançadas de treinos, aulas, desafios e comunidade.

## 🚀 Funcionalidades

### 🔐 Sistema de Autenticação
- **Cadastro completo** com validações brasileiras (CPF, CEP, telefone)
- **Login seguro** com senhas criptografadas
- **Validação em tempo real** com feedback visual
- **Botão mostrar/ocultar senha**
- **Login automático** após cadastro
- **Redirecionamento inteligente** baseado no perfil do usuário

### 👥 Gestão de Usuários
- **Perfis diferenciados**: Master e Common
- **Dados pessoais completos**: nome, data nascimento, gênero, nome da mãe
- **Documentos**: CPF com validação de dígito verificador
- **Contato**: email, telefone celular e fixo
- **Endereço completo**: rua, número, complemento, bairro, cidade, estado, CEP
- **Credenciais**: login (6 caracteres alfabéticos) e senha (8+ caracteres alfabéticos)

### 🏋️‍♂️ Sistema de Treinos
- **Dashboard personalizado** para cada aluno
- **Execução de treinos** com cronômetro integrado
- **Controle de peso, repetições e tempo de descanso**
- **Estatísticas de progresso** e metas
- **Histórico de treinos** completados

### 🎯 Funcionalidades Avançadas
- **Aulas em grupo** com inscrições
- **Desafios fitness** com ranking
- **Comunidade** com posts e interações
- **Comparação de planos** detalhada
- **Gestão de unidades** da academia
- **Sistema de notificações**

### 🎨 Interface e UX
- **Design responsivo** com Tailwind CSS
- **Modo escuro/claro** automático
- **Barra de acessibilidade** (contraste, tamanho da fonte, Libras)
- **Validações em tempo real** com checkmarks visuais
- **Feedback visual** claro e intuitivo
- **Animações suaves** e transições

### 🛡️ Segurança
- **Senhas criptografadas** com Hash::make()
- **Validação de CPF** com algoritmo de dígito verificador
- **Validação de CEP** com API ViaCEP
- **Middleware de autenticação** robusto
- **Sanitização de dados** de entrada

## 🏗️ Arquitetura

### Backend
- **Laravel 10** com PHP 8.4
- **Arquitetura limpa** com separação de responsabilidades
- **Eloquent ORM** para interação com banco de dados
- **Validações robustas** com mensagens personalizadas
- **API REST** para funcionalidades AJAX

### Frontend
- **Tailwind CSS** para estilização
- **JavaScript vanilla** para interatividade
- **Componentes Blade** reutilizáveis
- **Design responsivo** mobile-first
- **Acessibilidade** seguindo padrões WCAG

### Banco de Dados
- **SQLite** para desenvolvimento
- **MySQL** para produção
- **Migrations** organizadas e versionadas
- **Modelos Eloquent** com relacionamentos
- **Índices otimizados** para performance

## 📱 Páginas Principais

### Públicas
- **Landing Page** com apresentação dos planos
- **Páginas de planos** individuais (Basic, Smart, Black)
- **Comparação de planos** (completa, preços, benefícios)
- **Unidades da academia** com detalhes e equipamentos
- **Página de contato** com formulário

### Autenticadas
- **Dashboard do aluno** com estatísticas pessoais
- **Execução de treinos** com cronômetro
- **Aulas disponíveis** com inscrições
- **Desafios ativos** com ranking
- **Comunidade** com posts e comentários
- **Gestão de usuários** (apenas Master)

## 🔧 Tecnologias Utilizadas

- **PHP 8.4** - Linguagem principal
- **Laravel 10** - Framework web
- **Tailwind CSS** - Framework CSS
- **JavaScript** - Interatividade frontend
- **SQLite/MySQL** - Banco de dados
- **Composer** - Gerenciador de dependências
- **Git** - Controle de versão

## 📊 Estrutura do Projeto

```
fitplan_acadamy/
├── app/
│   ├── Http/Controllers/     # Controllers da aplicação
│   ├── Features/           # Funcionalidades organizadas
│   └── Models/             # Modelos Eloquent
├── database/
│   ├── migrations/         # Migrations do banco
│   └── database.sqlite     # Banco SQLite local
├── resources/
│   ├── views/              # Templates Blade
│   └── css/               # Estilos CSS
├── routes/
│   └── web.php            # Rotas da aplicação
└── public/                # Arquivos públicos
```

## 🎯 Próximos Passos

- [ ] Implementar sistema de pagamentos
- [ ] Adicionar notificações push
- [ ] Integrar com wearables
- [ ] Sistema de avaliação física
- [ ] App mobile nativo
- [ ] Integração com redes sociais

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👨‍💻 Desenvolvido por

**Eduardo Cruz** - Desenvolvedor Full Stack

---

*Para instruções de instalação e execução, consulte o arquivo [INSTALLATION.md](INSTALLATION.md)*
