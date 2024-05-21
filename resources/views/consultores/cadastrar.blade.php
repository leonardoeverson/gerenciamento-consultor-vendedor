<div class="container" id="cadastro-consultor">
    <form hx-post="/consultores/insert" hx-target="#container" autocomplete="off">
        @csrf
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    @if(!empty($mensagem))
                        <div class="col-12">
                            <div class="alert alert-{{$type}}" role="alert">
                                {{ $mensagem }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group mb-2">
                            <label for="nome" class="form-label">Nome do Consultor</label>
                            <input type="text" class="form-control" name="nome" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="form-group mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <button type="submit" class="btn btn-primary float-end">
                            Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

