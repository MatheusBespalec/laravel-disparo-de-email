@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Tarefa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nome da Tarefa</label>
                            <input type="text" class="form-control" name="name" value="{{ $task->name }}">
                        </div>
                        <div class="form-group">
                            <label>Data Limite</label>
                            <input type="date" class="form-control" name="deadline" value="{{ $task->deadline }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
