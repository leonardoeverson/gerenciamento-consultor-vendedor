<form hx-post="/feedbacks/insert" hx-target="#container" autocomplete="off">
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
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="firstName" class="form-label">Consultor</label>
            <select name="id_consultor" id="id_consultor" class="form-select" required>
                <option value="">--Selecione um consultor--</option>
                @foreach($consultores as $consultor)
                    <option value="{{ $consultor->id }}">{{ $consultor->nome }}</option>
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
                <textarea class="form-control" name="descricao" id="descricao" placeholder="Descrição do feedback"
                          required=""></textarea>
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
                <textarea class="form-control" name="estrategia" id="estrategia" placeholder="Estratégia"
                          required=""></textarea>
                <div class="invalid-feedback">
                    Insira um estratégia válida
                </div>
            </div>
        </div>
        <div class="col-12">
            <label for="observacoes" class="form-label">Observações<span
                        class="text-body-secondary">(Opcional)</span></label>
            <textarea class="form-control" name="observacoes" id="observacoes" placeholder="Observações"></textarea>
        </div>
    </div>
    <button type="submit" class="mt-2 w-100 btn btn-primary btn-lg">Salvar</button>
</form>