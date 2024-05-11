<div class="card bg-body rounded shadow-sm">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-12">
                <a href="/feedbacks/cadastrar" type="button" class="btn btn-primary float-end mt-2">
                    <i class="fa fa-plus me-1"></i>
                    Novo Feedback
                </a>
            </div>
            @foreach($feedbacks as $feedback)
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    #{{ $feedback->id }} - {{ date('d/m/Y H:i:s', strtotime($feedback->datahora)) }}
                                </div>
                                <div class="col">
                                    <btn type="submit" hx-get="/feedbacks/excluir/{{ $feedback->id }}" hx-target="#container" class="btn btn-danger btn-sm float-end">
                                        Excluir
                                    </btn>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span>Consultor: {{ $feedback->nome }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col card-text">
                                    Feedback: {{ $feedback->descricao }}
                                </div>
                                <div class="col card-text">
                                    Estratégia: {{ $feedback->estrategia }}
                                </div>
                                <div class="col card-text">
                                    @if (!empty($feedback->observacoes))
                                        Observações: {{ $feedback->observacoes }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
