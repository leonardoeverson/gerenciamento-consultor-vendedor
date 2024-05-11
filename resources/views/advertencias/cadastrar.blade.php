<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Nova Advertência
            </div>
        </div>
        <div class="card-body">
            <form hx-post="/advertencias/insert" hx-target="#container" autocomplete="off">
                @if (!empty($message))
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="alert alert-{{ $type }}" role="alert">
                                {{ $message }}
                            </div>
                        </div>
                    </div>
                @endif
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group mb-2">
                            <label for="consultor" class="form-label">Consultor</label>
                            <select name="consultor" id="consultor" class="form-select" required>
                                <option>--Selecione--</option>
                                @foreach($consultores as $consultor)
                                    <option value="{{ $consultor->id }}">{{ $consultor->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group mb-2">
                            <label for="observacoes" class="form-label">Observações</label>
                            <textarea class="form-control" name="observacoes" id="observacoes" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group mb-2">
                            <label for="id_tipoadvertencia" class="form-label">Tipo de Advertência</label>
                            <select name="id_tipoadvertencia" id="id_tipoadvertencia" class="form-select" required>
                                <option>--Selecione--</option>
                                <option value="1">Verbal</option>
                                <option value="2">Escrita</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <button type="submit" class="btn btn-primary float-end">
                            <i class="fa fa-save me-1"></i>
                            Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
