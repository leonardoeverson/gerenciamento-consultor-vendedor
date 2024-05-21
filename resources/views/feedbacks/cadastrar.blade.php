@php
    $path = "/feedbacks/insert";

    if (isset($mode) && $mode === 'update') {
        $path = '/feedbacks/update';
    }

@endphp
<div class="card mt-1">
    <div class="card-body">
        <form hx-post="{{ $path }}" hx-target="#container" autocomplete="off">
            @csrf
            @if (isset($mensagem))
                <div class="row">
                    <div class="col">
                        <div class="alert alert-{{$type}}" role="alert">
                            {{$mensagem}}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($id))
                <input type="text" name="id" id="id" value="{{ $id }}" hidden readonly>
                <div class="row">
                    <div class="col">
                        <h5 class="h5">Edição do Feedback #{{ $id }}</h5>
                    </div>
                </div>
            @endif
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="firstName" class="form-label">Consultor</label>
                    <select name="id_consultor" id="id_consultor" class="form-select" required>
                        <option value="">--Selecione um consultor--</option>
                        @foreach($consultores as $consultor)
                            <option value="{{ $consultor->id }}" {{ isset($feedback) && $feedback->id_consultor === $consultor->id ? 'selected' : '' }}>
                                {{ $consultor->nome }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Selecione um consultor
                    </div>
                </div>
                <div class="col-12">
                    <label for="descricao" class="form-label">Descrição</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">
                            <i class="fa-solid fa-comment"></i>
                        </span>
                        <textarea class="form-control" name="descricao" id="descricao" placeholder="Descrição do feedback" rows="5"
                                  required="">{{ isset($feedback) ? $feedback->descricao : '' }}</textarea>
                        <div class="invalid-feedback">
                            Insira um feedback válido
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="estrategia" class="form-label">Estratégia<span class="text-body-secondary"></span></label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">
                            <i class="fa-solid fa-chess-board"></i>
                        </span>
                        <textarea class="form-control" name="estrategia" id="estrategia" placeholder="Estratégia" rows="5"
                                  required="">{{ isset($feedback) ? $feedback->estrategia : '' }}</textarea>
                        <div class="invalid-feedback">
                            Insira um estratégia válida
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="observacoes" class="form-label">Observações<span
                                class="text-body-secondary">(Opcional)</span></label>
                    <textarea class="form-control" name="observacoes" id="observacoes" placeholder="Observações" rows="5">{{ isset($feedback) ? $feedback->observacoes : '' }}</textarea>
                </div>
            </div>
            <button type="submit" class="mt-2 w-100 btn btn-primary btn-lg">Salvar</button>
        </form>
    </div>
</div>
