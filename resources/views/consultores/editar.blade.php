<form hx-post="/consultores/update" tx-target="#container" autocomplete="off">
    <div class="container" id="cadastro-consultor">
        <div class="row">
            @if(!empty($mensagem))
                <div class="col-12">
                    <div class="alert alert-{{$type}}" role="alert">
                        {{ $mensagem }}
                    </div>
                </div>
            @endif
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                @csrf
                <input type="text" name="id" value="{{ $id }}" hidden readonly>
                <div class="form-group mb-2">
                    <label for="nome" class="form-label">Nome do Consultor</label>
                    <input type="text" class="form-control" name="nome" value="{{ $consultor->nome }}">
                </div>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <a href="/consultores" class="btn btn-secondary me-1 float-end">
                            Cancelar
                        </a>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary float-end ms-1">
                            Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>