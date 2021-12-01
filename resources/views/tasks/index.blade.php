@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tarefas
                    <a href="{{ route('tasks.create') }}" class="float-right">Nova Tarefa</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data Limite</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <th scope="row">{{ $task->id }}</th>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($task->deadline)) }}</td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm m-1">Editar</a>
                                        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="post" class="d-inline-block m-1">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($tasks->total() > $tasks->perPage())
                        <nav>
                            <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ $tasks->previousPageUrl() }}">Anterior</a></li>
                            @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                                <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item"><a class="page-link" href="{{ $tasks->nextPageUrl() }}">Proxímo</a></li>
                            </ul>
                        </nav>
                    @endif
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
</div>
@endsection
