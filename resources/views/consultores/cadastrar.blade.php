<form hx-post="/consultores/insert" hx-target="#container" autocomplete="off">
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
                <div class="form-group mb-2">
                    <label for="nome" class="form-label">Nome do Consultor</label>
                    <input type="text" class="form-control" name="nome">
                </div>
                <button type="submit" class="btn btn-primary float-end">
                    Salvar
                </button>
            </div>
        </div>
    </div>
</form>
