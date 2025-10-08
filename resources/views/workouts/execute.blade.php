<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Executar Treino - {{ $workout['name'] }} - FitPlan Academy</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ff6a00",
                        "background-light": "#f8f7f5",
                        "background-dark": "#23170f",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-zinc-900 dark:text-zinc-200">
<div class="min-h-screen">
    <!-- Barra de Acessibilidade -->
    @include('components.accessibility-bar')
    
    <!-- Header -->
    @include('components.header')

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header do Treino -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $workout['name'] }}</h1>
                    <p class="text-zinc-600 dark:text-zinc-400 mt-2">{{ $workout['description'] }}</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-primary" id="workout-timer">00:00:00</div>
                    <div class="text-sm text-zinc-600 dark:text-zinc-400">Tempo Total</div>
                </div>
            </div>
            
            <!-- Progresso Geral -->
            <div class="mb-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-zinc-600 dark:text-zinc-400">Progresso do Treino</span>
                    <span class="text-sm font-medium text-zinc-900 dark:text-white" id="workout-progress">0/{{ $workout['total_exercises'] }}</span>
                </div>
                <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-3">
                    <div class="bg-primary h-3 rounded-full transition-all duration-500" id="workout-progress-bar" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- Exercício Atual -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 mb-8" id="current-exercise-card">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-white" id="current-exercise-name">Carregando...</h2>
                    <p class="text-zinc-600 dark:text-zinc-400" id="current-exercise-sets">Séries: 0x0</p>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary mb-2" id="exercise-timer">00:00</div>
                    <div class="text-sm text-zinc-600 dark:text-zinc-400">Tempo de Descanso</div>
                </div>
            </div>

            <!-- Controles do Exercício -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Peso -->
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Peso (kg)</label>
                    <input type="number" 
                           id="exercise-weight" 
                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white text-center text-xl font-bold focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" 
                           placeholder="0" 
                           min="0" 
                           step="0.5">
                </div>

                <!-- Repetições -->
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Repetições</label>
                    <input type="number" 
                           id="exercise-reps" 
                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white text-center text-xl font-bold focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" 
                           placeholder="0" 
                           min="0">
                </div>

                <!-- Tempo de Descanso -->
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Descanso (segundos)</label>
                    <input type="number" 
                           id="exercise-rest" 
                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white text-center text-xl font-bold focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" 
                           placeholder="60" 
                           min="0" 
                           value="60">
                </div>
            </div>

            <!-- Botões de Controle -->
            <div class="flex gap-4">
                <button id="start-exercise-btn" 
                        class="flex-1 bg-primary hover:bg-primary/90 text-white font-semibold py-4 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m-6-8h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2z"></path>
                    </svg>
                    Iniciar Exercício
                </button>
                
                <button id="complete-set-btn" 
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-6 rounded-lg transition-colors flex items-center justify-center gap-2 hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Concluir Série
                </button>
                
                <button id="next-exercise-btn" 
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition-colors flex items-center justify-center gap-2 hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    Próximo Exercício
                </button>
            </div>
        </div>

        <!-- Lista de Exercícios -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">Exercícios do Treino</h3>
            
            <div class="space-y-4" id="exercises-list">
                @foreach($workout['exercises'] as $index => $exercise)
                <div class="exercise-item p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg {{ $index === 0 ? 'bg-primary/10 border-primary' : '' }}" 
                     data-exercise-index="{{ $index }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full bg-zinc-200 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-400 flex items-center justify-center text-sm font-semibold">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 dark:text-white">{{ $exercise['name'] }}</h4>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $exercise['sets'] }} - Descanso: {{ $exercise['rest'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="exercise-status px-3 py-1 text-xs font-medium rounded-full {{ $index === 0 ? 'bg-primary text-white' : 'bg-zinc-100 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-400' }}">
                                {{ $index === 0 ? 'Atual' : 'Pendente' }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Botão Finalizar Treino -->
        <div class="mt-8 text-center">
            <button id="finish-workout-btn" 
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-lg transition-colors flex items-center justify-center gap-2 mx-auto hidden">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Finalizar Treino
            </button>
        </div>
    </main>
</div>

<!-- JavaScript para funcionalidades do cronômetro -->
<script>
class WorkoutTimer {
    constructor(workoutData) {
        this.workout = workoutData;
        this.currentExerciseIndex = 0;
        this.currentSet = 1;
        this.totalSets = 0;
        this.isResting = false;
        this.isExerciseActive = false;
        
        // Timers
        this.workoutTimer = null;
        this.exerciseTimer = null;
        this.restTimer = null;
        
        // Tempos
        this.workoutStartTime = null;
        this.exerciseStartTime = null;
        this.restStartTime = null;
        
        // Dados do exercício atual
        this.exerciseData = null;
        this.completedSets = [];
        
        this.init();
    }
    
    init() {
        this.loadCurrentExercise();
        this.bindEvents();
        this.startWorkoutTimer();
    }
    
    loadCurrentExercise() {
        if (this.currentExerciseIndex >= this.workout.exercises.length) {
            this.showFinishWorkout();
            return;
        }
        
        this.exerciseData = this.workout.exercises[this.currentExerciseIndex];
        this.parseSets();
        this.updateExerciseDisplay();
        this.updateExerciseList();
    }
    
    parseSets() {
        // Parse sets like "3x12" or "4x10"
        const setsMatch = this.exerciseData.sets.match(/(\d+)x(\d+)/);
        if (setsMatch) {
            this.totalSets = parseInt(setsMatch[1]);
            this.targetReps = parseInt(setsMatch[2]);
        } else {
            this.totalSets = 1;
            this.targetReps = 12;
        }
        
        this.currentSet = 1;
        this.completedSets = [];
    }
    
    updateExerciseDisplay() {
        document.getElementById('current-exercise-name').textContent = this.exerciseData.name;
        document.getElementById('current-exercise-sets').textContent = `Série ${this.currentSet}/${this.totalSets} - ${this.exerciseData.sets}`;
        
        // Reset inputs
        document.getElementById('exercise-weight').value = '';
        document.getElementById('exercise-reps').value = '';
        document.getElementById('exercise-rest').value = this.parseRestTime(this.exerciseData.rest);
        
        // Update buttons
        this.updateButtons();
    }
    
    parseRestTime(restString) {
        // Parse rest time like "60s" or "90s"
        const restMatch = restString.match(/(\d+)s/);
        return restMatch ? parseInt(restMatch[1]) : 60;
    }
    
    updateExerciseList() {
        const exerciseItems = document.querySelectorAll('.exercise-item');
        exerciseItems.forEach((item, index) => {
            const statusSpan = item.querySelector('.exercise-status');
            
            if (index === this.currentExerciseIndex) {
                item.classList.add('bg-primary/10', 'border-primary');
                item.classList.remove('bg-zinc-50', 'dark:bg-zinc-700');
                statusSpan.textContent = 'Atual';
                statusSpan.className = 'exercise-status px-3 py-1 text-xs font-medium rounded-full bg-primary text-white';
            } else if (index < this.currentExerciseIndex) {
                item.classList.add('bg-green-50', 'dark:bg-green-900/20', 'border-green-500');
                item.classList.remove('bg-zinc-50', 'dark:bg-zinc-700');
                statusSpan.textContent = 'Concluído';
                statusSpan.className = 'exercise-status px-3 py-1 text-xs font-medium rounded-full bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300';
            } else {
                item.classList.remove('bg-primary/10', 'border-primary', 'bg-green-50', 'dark:bg-green-900/20', 'border-green-500');
                item.classList.add('bg-zinc-50', 'dark:bg-zinc-700');
                statusSpan.textContent = 'Pendente';
                statusSpan.className = 'exercise-status px-3 py-1 text-xs font-medium rounded-full bg-zinc-100 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-400';
            }
        });
    }
    
    updateButtons() {
        const startBtn = document.getElementById('start-exercise-btn');
        const completeBtn = document.getElementById('complete-set-btn');
        const nextBtn = document.getElementById('next-exercise-btn');
        
        if (!this.isExerciseActive && !this.isResting) {
            startBtn.classList.remove('hidden');
            completeBtn.classList.add('hidden');
            nextBtn.classList.add('hidden');
        } else if (this.isExerciseActive) {
            startBtn.classList.add('hidden');
            completeBtn.classList.remove('hidden');
            nextBtn.classList.add('hidden');
        } else if (this.isResting) {
            startBtn.classList.add('hidden');
            completeBtn.classList.add('hidden');
            nextBtn.classList.remove('hidden');
        }
    }
    
    bindEvents() {
        document.getElementById('start-exercise-btn').addEventListener('click', () => {
            this.startExercise();
        });
        
        document.getElementById('complete-set-btn').addEventListener('click', () => {
            this.completeSet();
        });
        
        document.getElementById('next-exercise-btn').addEventListener('click', () => {
            this.nextExercise();
        });
        
        document.getElementById('finish-workout-btn').addEventListener('click', () => {
            this.finishWorkout();
        });
    }
    
    startExercise() {
        this.isExerciseActive = true;
        this.exerciseStartTime = Date.now();
        this.updateButtons();
        
        // Disable inputs during exercise
        document.getElementById('exercise-weight').disabled = true;
        document.getElementById('exercise-reps').disabled = true;
        document.getElementById('exercise-rest').disabled = true;
    }
    
    completeSet() {
        const weight = parseFloat(document.getElementById('exercise-weight').value) || 0;
        const reps = parseInt(document.getElementById('exercise-reps').value) || 0;
        
        if (reps === 0) {
            alert('Por favor, informe o número de repetições realizadas.');
            return;
        }
        
        // Save set data
        this.completedSets.push({
            set: this.currentSet,
            weight: weight,
            reps: reps,
            completedAt: new Date()
        });
        
        this.currentSet++;
        
        if (this.currentSet > this.totalSets) {
            // Exercise completed
            this.completeExercise();
        } else {
            // Start rest period
            this.startRest();
        }
    }
    
    startRest() {
        this.isExerciseActive = false;
        this.isResting = true;
        this.restStartTime = Date.now();
        
        const restSeconds = parseInt(document.getElementById('exercise-rest').value) || 60;
        this.startRestTimer(restSeconds);
        
        this.updateButtons();
        this.updateExerciseDisplay();
    }
    
    startRestTimer(seconds) {
        let remainingSeconds = seconds;
        
        this.restTimer = setInterval(() => {
            const minutes = Math.floor(remainingSeconds / 60);
            const secs = remainingSeconds % 60;
            document.getElementById('exercise-timer').textContent = 
                `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            
            remainingSeconds--;
            
            if (remainingSeconds < 0) {
                clearInterval(this.restTimer);
                this.endRest();
            }
        }, 1000);
    }
    
    endRest() {
        this.isResting = false;
        this.updateButtons();
        
        // Re-enable inputs
        document.getElementById('exercise-weight').disabled = false;
        document.getElementById('exercise-reps').disabled = false;
        document.getElementById('exercise-rest').disabled = false;
        
        document.getElementById('exercise-timer').textContent = '00:00';
    }
    
    completeExercise() {
        this.isExerciseActive = false;
        this.isResting = false;
        
        // Move to next exercise
        this.currentExerciseIndex++;
        this.updateWorkoutProgress();
        
        if (this.currentExerciseIndex < this.workout.exercises.length) {
            this.loadCurrentExercise();
        } else {
            this.showFinishWorkout();
        }
    }
    
    nextExercise() {
        if (this.restTimer) {
            clearInterval(this.restTimer);
        }
        this.endRest();
    }
    
    updateWorkoutProgress() {
        const progress = (this.currentExerciseIndex / this.workout.exercises.length) * 100;
        document.getElementById('workout-progress').textContent = 
            `${this.currentExerciseIndex}/${this.workout.exercises.length}`;
        document.getElementById('workout-progress-bar').style.width = `${progress}%`;
    }
    
    startWorkoutTimer() {
        this.workoutStartTime = Date.now();
        
        this.workoutTimer = setInterval(() => {
            const elapsed = Date.now() - this.workoutStartTime;
            const hours = Math.floor(elapsed / 3600000);
            const minutes = Math.floor((elapsed % 3600000) / 60000);
            const seconds = Math.floor((elapsed % 60000) / 1000);
            
            document.getElementById('workout-timer').textContent = 
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }, 1000);
    }
    
    showFinishWorkout() {
        document.getElementById('finish-workout-btn').classList.remove('hidden');
        document.getElementById('current-exercise-card').classList.add('hidden');
    }
    
    finishWorkout() {
        if (confirm('Tem certeza que deseja finalizar o treino?')) {
            // Calculate total duration
            const totalDuration = Math.floor((Date.now() - this.workoutStartTime) / 60000);
            
            // Send completion data
            fetch(`/workouts/${this.workout.id}/complete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    workout_id: this.workout.id,
                    duration_minutes: totalDuration,
                    notes: 'Treino concluído via cronômetro'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Treino concluído com sucesso!');
                    window.location.href = '/workouts';
                } else {
                    alert('Erro ao finalizar treino: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao finalizar treino');
            });
        }
    }
}

// Initialize workout timer when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Add CSRF token if not present
    if (!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = 'LLoID9mg8XdrnmX9W0um7LvBPY31Gldr9lcyQpPb';
        document.head.appendChild(meta);
    }
    
    // Initialize workout timer
    const workoutData = @json($workout);
    new WorkoutTimer(workoutData);
});
</script>
</body>
</html>
