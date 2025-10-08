<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller para gerenciar comunidade da academia
 * 
 * Este controller é responsável por:
 * - Exibir posts da comunidade
 * - Gerenciar interações sociais
 * - Controlar sistema de likes/comentários
 * - Exibir perfis de usuários
 * 
 * Arquitetura: Clean Architecture
 * - Separação de responsabilidades
 * - Código limpo e comentado
 * - Performance otimizada
 */
class CommunityController extends Controller
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
     * Exibe a página principal da comunidade
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

        // Obter dados da comunidade
        $posts = $this->getCommunityPosts();
        $trendingTopics = $this->getTrendingTopics();
        $userStats = $this->getUserCommunityStats($user);
        $recentActivities = $this->getRecentActivities();

        return view('community.index', compact('user', 'posts', 'trendingTopics', 'userStats', 'recentActivities'));
    }

    /**
     * Exibe detalhes de um post específico
     * 
     * @param Request $request
     * @param string $postId
     * @return \Illuminate\View\View
     */
    public function showPost(Request $request, $postId)
    {
        $user = session()->get('demo_user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['login' => 'Sessão expirada.']);
        }
        
        $user = (object) $user;

        // Obter detalhes do post
        $post = $this->getPostDetails($postId);
        
        if (!$post) {
            return redirect()->route('community.index')->withErrors(['post' => 'Post não encontrado.']);
        }

        // Obter comentários do post
        $comments = $this->getPostComments($postId);

        return view('community.post', compact('user', 'post', 'comments'));
    }

    /**
     * Cria um novo post na comunidade
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPost(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:1000',
            'type' => 'required|in:text,image,video,achievement',
            'image' => 'nullable|image|max:2048',
        ]);

        $user = session()->get('demo_user');
        
        // Simular criação do post
        $post = [
            'id' => uniqid(),
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_avatar' => substr($user['name'], 0, 2),
            'content' => $request->content,
            'type' => $request->type,
            'created_at' => now()->toISOString(),
            'likes_count' => 0,
            'comments_count' => 0,
            'shares_count' => 0,
        ];

        // Salvar na sessão para demonstração
        $posts = session()->get('community_posts', []);
        array_unshift($posts, $post);
        session()->put('community_posts', $posts);

        return response()->json([
            'success' => true,
            'message' => 'Post criado com sucesso!',
            'post' => $post,
        ]);
    }

    /**
     * Adiciona like a um post
     * 
     * @param Request $request
     * @param string $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function likePost(Request $request, $postId)
    {
        $request->validate([
            'post_id' => 'required|string',
        ]);

        $user = session()->get('demo_user');
        
        // Simular like no post
        $likes = session()->get('post_likes', []);
        $likeKey = $postId . '_' . $user['id'];
        
        if (isset($likes[$likeKey])) {
            // Remover like
            unset($likes[$likeKey]);
            $action = 'unliked';
        } else {
            // Adicionar like
            $likes[$likeKey] = [
                'post_id' => $postId,
                'user_id' => $user['id'],
                'liked_at' => now()->toISOString(),
            ];
            $action = 'liked';
        }
        
        session()->put('post_likes', $likes);

        return response()->json([
            'success' => true,
            'message' => $action === 'liked' ? 'Post curtido!' : 'Like removido!',
            'action' => $action,
        ]);
    }

    /**
     * Adiciona comentário a um post
     * 
     * @param Request $request
     * @param string $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComment(Request $request, $postId)
    {
        $request->validate([
            'post_id' => 'required|string',
            'content' => 'required|string|min:1|max:500',
        ]);

        $user = session()->get('demo_user');
        
        // Simular comentário no post
        $comment = [
            'id' => uniqid(),
            'post_id' => $postId,
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_avatar' => substr($user['name'], 0, 2),
            'content' => $request->content,
            'created_at' => now()->toISOString(),
            'likes_count' => 0,
        ];

        // Salvar na sessão para demonstração
        $comments = session()->get('post_comments', []);
        $comments[] = $comment;
        session()->put('post_comments', $comments);

        return response()->json([
            'success' => true,
            'message' => 'Comentário adicionado!',
            'comment' => $comment,
        ]);
    }

    /**
     * Obtém posts da comunidade
     * 
     * @return array
     */
    private function getCommunityPosts()
    {
        return [
            [
                'id' => 'post_1',
                'user_name' => 'Carlos Silva',
                'user_avatar' => 'CS',
                'content' => 'Acabei de completar meu primeiro desafio de 30 dias! 🎉 A sensação de conquista é indescritível. Obrigado a todos que me apoiaram durante essa jornada!',
                'type' => 'achievement',
                'created_at' => now()->subHours(2)->format('d/m/Y H:i'),
                'likes_count' => 24,
                'comments_count' => 8,
                'shares_count' => 3,
                'is_liked' => false,
            ],
            [
                'id' => 'post_2',
                'user_name' => 'Ana Costa',
                'user_avatar' => 'AC',
                'content' => 'Dica do dia: Hidratação é fundamental! Bebam bastante água durante os treinos. Meu rendimento melhorou muito depois que comecei a me hidratar corretamente 💧',
                'type' => 'text',
                'created_at' => now()->subHours(5)->format('d/m/Y H:i'),
                'likes_count' => 18,
                'comments_count' => 12,
                'shares_count' => 7,
                'is_liked' => true,
            ],
            [
                'id' => 'post_3',
                'user_name' => 'João Santos',
                'user_avatar' => 'JS',
                'content' => 'Alguém mais está participando do desafio de queima de calorias? Estou com 7.500 calorias queimadas! Falta pouco para completar os 10.000 🔥',
                'type' => 'text',
                'created_at' => now()->subHours(8)->format('d/m/Y H:i'),
                'likes_count' => 15,
                'comments_count' => 6,
                'shares_count' => 2,
                'is_liked' => false,
            ],
            [
                'id' => 'post_4',
                'user_name' => 'Maria Lima',
                'user_avatar' => 'ML',
                'content' => 'Aula de pilates hoje foi incrível! A professora Maria é sensacional. Recomendo para quem quer trabalhar flexibilidade e fortalecimento 💪',
                'type' => 'text',
                'created_at' => now()->subHours(12)->format('d/m/Y H:i'),
                'likes_count' => 22,
                'comments_count' => 9,
                'shares_count' => 4,
                'is_liked' => true,
            ],
        ];
    }

    /**
     * Obtém tópicos em alta
     * 
     * @return array
     */
    private function getTrendingTopics()
    {
        return [
            ['name' => '#Desafio30Dias', 'posts_count' => 45],
            ['name' => '#Pilates', 'posts_count' => 32],
            ['name' => '#Hidratação', 'posts_count' => 28],
            ['name' => '#QueimaCalorias', 'posts_count' => 24],
            ['name' => '#Flexibilidade', 'posts_count' => 19],
        ];
    }

    /**
     * Obtém estatísticas da comunidade do usuário
     * 
     * @param object $user
     * @return array
     */
    private function getUserCommunityStats($user)
    {
        return [
            'posts_created' => 8,
            'total_likes_received' => 156,
            'comments_made' => 23,
            'followers_count' => 45,
            'following_count' => 38,
            'achievements_shared' => 3,
        ];
    }

    /**
     * Obtém atividades recentes
     * 
     * @return array
     */
    private function getRecentActivities()
    {
        return [
            [
                'type' => 'like',
                'user_name' => 'Pedro Lima',
                'action' => 'curtiu seu post',
                'time' => '2 min atrás',
            ],
            [
                'type' => 'comment',
                'user_name' => 'Carla Santos',
                'action' => 'comentou no seu post',
                'time' => '15 min atrás',
            ],
            [
                'type' => 'follow',
                'user_name' => 'Rafael Costa',
                'action' => 'começou a te seguir',
                'time' => '1 hora atrás',
            ],
        ];
    }

    /**
     * Obtém detalhes de um post específico
     * 
     * @param string $postId
     * @return array|null
     */
    private function getPostDetails($postId)
    {
        $posts = $this->getCommunityPosts();
        
        foreach ($posts as $post) {
            if ($post['id'] === $postId) {
                return $post;
            }
        }
        
        return null;
    }

    /**
     * Obtém comentários de um post
     * 
     * @param string $postId
     * @return array
     */
    private function getPostComments($postId)
    {
        return [
            [
                'id' => 'comment_1',
                'user_name' => 'Pedro Lima',
                'user_avatar' => 'PL',
                'content' => 'Parabéns! Inspirador ver sua dedicação! 👏',
                'created_at' => now()->subHours(1)->format('d/m/Y H:i'),
                'likes_count' => 3,
            ],
            [
                'id' => 'comment_2',
                'user_name' => 'Carla Santos',
                'user_avatar' => 'CS',
                'content' => 'Qual foi o maior desafio durante esses 30 dias?',
                'created_at' => now()->subHours(2)->format('d/m/Y H:i'),
                'likes_count' => 1,
            ],
        ];
    }
}
