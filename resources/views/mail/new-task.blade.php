@component('mail::message')
# {{ $task->name }}

Limite de Conclusão: {{ date('d/m/Y', strtotime($task->deadline)) }}.

@component('mail::button', ['url' => route('tasks.show', ['task' => $task->id])])
Ver Tarefa
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent
