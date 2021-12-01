@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $task->name }}</div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">
                            <label>Data Limite de Conclusão:</label>
                            <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($task->deadline)) }}">
                        </div><!-- mb-3 -->
                    </fieldset>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
</div>
@endsection
