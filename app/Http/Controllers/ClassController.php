<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller para gerenciar aulas da academia
 * 
 * Este controller é responsável por:
 * - Exibir aulas disponíveis
 * - Gerenciar agendamento de aulas
 * - Controlar presença nas aulas
 * - Exibir cronograma de aulas
 * 
 * Arquitetura: Clean Architecture
 * - Separação de responsabilidades
 * - Código limpo e comentado
 * - Performance otimizada
 */
class ClassController extends Controller
{
    /**
     * Create a new controller instance.
     * Aplica middleware de autenticação demo
     */
    public function __construct()
    {
        $this->middleware('demo.auth');
    }

    /**
     * Exibe a página principal de aulas
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Obter usuário da sessão demo
        $user = session()->get('demo_user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['login' => 'Sessão expirada.']);
        }
        
        $user = (object) $user;

        // Se for usuário Master, redireciona para o dashboard administrativo
        if ($user->profile === 'master') {
            return redirect()->route('dashboard');
        }

        // Obter dados das aulas
        $classes = $this->getAvailableClasses();
        $userSchedule = $this->getUserSchedule($user);
        $classStats = $this->getClassStats($user);

        return view('classes.index', compact('user', 'classes', 'userSchedule', 'classStats'));
    }

    /**
     * Exibe detalhes de uma aula específica
     * 
     * @param Request $request
     * @param string $classId
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $classId)
    {
        $user = session()->get('demo_user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['login' => 'Sessão expirada.']);
        }
        
        $user = (object) $user;

        // Obter detalhes da aula
        $class = $this->getClassDetails($classId);
        
        if (!$class) {
            return redirect()->route('classes.index')->withErrors(['class' => 'Aula não encontrada.']);
        }

        // Verificar se usuário está inscrito
        $isEnrolled = $this->isUserEnrolled($user, $classId);

        return view('classes.show', compact('user', 'class', 'isEnrolled'));
    }

    /**
     * Inscreve usuário em uma aula
     * 
     * @param Request $request
     * @param string $classId
     * @return \Illuminate\Http\JsonResponse
     */
    public function enroll(Request $request, $classId)
    {
        $request->validate([
            'class_id' => 'required|string',
        ]);

        $user = session()->get('demo_user');
        
        // Simular inscrição na aula
        $enrollment = [
            'id' => uniqid(),
            'class_id' => $classId,
            'user_id' => $user['id'],
            'enrolled_at' => now()->toISOString(),
            'status' => 'enrolled',
        ];

        // Salvar na sessão para demonstração
        $enrollments = session()->get('class_enrollments', []);
        $enrollments[] = $enrollment;
        session()->put('class_enrollments', $enrollments);

        return response()->json([
            'success' => true,
            'message' => 'Inscrição realizada com sucesso!',
            'enrollment' => $enrollment,
        ]);
    }

    /**
     * Cancela inscrição em uma aula
     * 
     * @param Request $request
     * @param string $classId
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Request $request, $classId)
    {
        $request->validate([
            'class_id' => 'required|string',
        ]);

        $user = session()->get('demo_user');
        
        // Simular cancelamento da inscrição
        $enrollments = session()->get('class_enrollments', []);
        $enrollments = array_filter($enrollments, function($enrollment) use ($classId, $user) {
            return !($enrollment['class_id'] === $classId && $enrollment['user_id'] === $user['id']);
        });
        session()->put('class_enrollments', $enrollments);

        return response()->json([
            'success' => true,
            'message' => 'Inscrição cancelada com sucesso!',
        ]);
    }

    /**
     * Obtém aulas disponíveis
     * 
     * @return array
     */
    private function getAvailableClasses()
    {
        return [
            [
                'id' => 'class_1',
                'name' => 'Pilates Mat',
                'description' => 'Aula de pilates no solo para fortalecimento e flexibilidade',
                'instructor' => 'Maria Silva',
                'duration' => 60,
                'difficulty' => 'iniciante',
                'max_students' => 15,
                'enrolled_students' => 12,
                'schedule' => [
                    'monday' => '08:00',
                    'wednesday' => '08:00',
                    'friday' => '08:00',
                ],
                'room' => 'Sala 1',
                'equipment' => ['Mat', 'Bola', 'Faixa'],
                'price' => 'Incluído no plano',
            ],
            [
                'id' => 'class_2',
                'name' => 'Spinning',
                'description' => 'Aula de ciclismo indoor com alta intensidade',
                'instructor' => 'João Santos',
                'duration' => 45,
                'difficulty' => 'intermediário',
                'max_students' => 20,
                'enrolled_students' => 18,
                'schedule' => [
                    'tuesday' => '19:00',
                    'thursday' => '19:00',
                    'saturday' => '10:00',
                ],
                'room' => 'Sala Spinning',
                'equipment' => ['Bicicleta', 'Toalha', 'Garrafa'],
                'price' => 'Incluído no plano',
            ],
            [
                'id' => 'class_3',
                'name' => 'Yoga Flow',
                'description' => 'Sequência fluida de posturas de yoga',
                'instructor' => 'Ana Costa',
                'duration' => 75,
                'difficulty' => 'intermediário',
                'max_students' => 12,
                'enrolled_students' => 10,
                'schedule' => [
                    'monday' => '18:30',
                    'wednesday' => '18:30',
                    'sunday' => '09:00',
                ],
                'room' => 'Sala 2',
                'equipment' => ['Mat', 'Bloco', 'Faixa'],
                'price' => 'Incluído no plano',
            ],
            [
                'id' => 'class_4',
                'name' => 'CrossFit',
                'description' => 'Treino funcional de alta intensidade',
                'instructor' => 'Carlos Lima',
                'duration' => 60,
                'difficulty' => 'avançado',
                'max_students' => 10,
                'enrolled_students' => 8,
                'schedule' => [
                    'tuesday' => '07:00',
                    'thursday' => '07:00',
                    'saturday' => '08:00',
                ],
                'room' => 'Box CrossFit',
                'equipment' => ['Kettlebell', 'Corda', 'Barra'],
                'price' => 'Incluído no plano',
            ],
        ];
    }

    /**
     * Obtém cronograma do usuário
     * 
     * @param object $user
     * @return array
     */
    private function getUserSchedule($user)
    {
        return [
            'today' => [
                [
                    'class_name' => 'Pilates Mat',
                    'time' => '08:00',
                    'instructor' => 'Maria Silva',
                    'room' => 'Sala 1',
                    'status' => 'enrolled',
                ],
            ],
            'this_week' => [
                [
                    'day' => 'Segunda',
                    'classes' => [
                        ['name' => 'Pilates Mat', 'time' => '08:00'],
                        ['name' => 'Yoga Flow', 'time' => '18:30'],
                    ],
                ],
                [
                    'day' => 'Terça',
                    'classes' => [
                        ['name' => 'Spinning', 'time' => '19:00'],
                    ],
                ],
                [
                    'day' => 'Quarta',
                    'classes' => [
                        ['name' => 'Pilates Mat', 'time' => '08:00'],
                        ['name' => 'Yoga Flow', 'time' => '18:30'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Obtém estatísticas de aulas do usuário
     * 
     * @param object $user
     * @return array
     */
    private function getClassStats($user)
    {
        return [
            'total_classes_attended' => 24,
            'classes_this_month' => 8,
            'favorite_instructor' => 'Maria Silva',
            'favorite_class' => 'Pilates Mat',
            'attendance_rate' => 92,
            'streak_weeks' => 3,
        ];
    }

    /**
     * Obtém detalhes de uma aula específica
     * 
     * @param string $classId
     * @return array|null
     */
    private function getClassDetails($classId)
    {
        $classes = $this->getAvailableClasses();
        
        foreach ($classes as $class) {
            if ($class['id'] === $classId) {
                return $class;
            }
        }
        
        return null;
    }

    /**
     * Verifica se usuário está inscrito em uma aula
     * 
     * @param object $user
     * @param string $classId
     * @return bool
     */
    private function isUserEnrolled($user, $classId)
    {
        $enrollments = session()->get('class_enrollments', []);
        
        foreach ($enrollments as $enrollment) {
            if ($enrollment['class_id'] === $classId && $enrollment['user_id'] === $user['id']) {
                return true;
            }
        }
        
        return false;
    }
}
