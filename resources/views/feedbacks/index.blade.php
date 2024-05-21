<div class="card bg-body rounded shadow-sm mt-2">
    <div class="card-header">
        <form hx-get="/feedbacks/pesquisar" hx-target="#table-body" autocomplete="off">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-2">
                    <div class="form-group mb-2">
                        <label for="periodoinicial" class="form-label">Período Inicial</label>
                        <input type="date" class="form-control" name="periodoinicial" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-2">
                    <div class="form-group mb-2">
                        <label for="periodofinal" class="form-label">Período Final</label>
                        <input type="date" class="form-control" name="periodofinal" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-2">
                    <div class="form-group mb-2">
                        <label for="id_consultor" class="form-label">Consultor</label>
                        <select name="id_consultor" id="id_consultor" class="form-select">
                            <option value="">--Selecione--</option>
                            @if (isset($consultores))
                                @foreach($consultores as $consultor)
                                    <option value="{{ $consultor->id }}">
                                        {{ $consultor->nome }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary" type="submit">
                        Pesquisar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="row g-2">
            <div class="col-12">
                <a href="/feedbacks/cadastrar" type="button" class="btn btn-primary float-end">
                    <i class="fa fa-plus me-1"></i>
                    Novo Feedback
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-sm table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Data/Hora</th>
                        <th>Consultor</th>
                        <th>Feedback</th>
                        <th>Estratégia</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody id="table-body">
                    {{ view('feedbacks.list', ['feedbacks' => $feedbacks]) }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>