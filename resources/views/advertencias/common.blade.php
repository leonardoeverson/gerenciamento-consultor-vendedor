@csrf

@if (!empty($id))
    <input type="text" value="{{ $id }}" name="id" hidden readonly required>
@endif

@if (!empty($message))
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="alert alert-{{ $type }}" role="alert">
                {{ $message }}
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <div class="form-group mb-2">
            <label for="consultor" class="form-label">Consultor</label>
            <select name="consultor" id="consultor" class="form-select" required>
                <option>--Selecione--</option>
                @foreach($consultores as $consultor)
                    <option value="{{ $consultor->id }}" {{ !empty($advertencia) && $advertencia->id_consultor === $consultor->id ? 'selected' : '' }}>
                        {{ $consultor->nome }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <div class="form-group mb-2">
            <label for="observacoes" class="form-label">Observações</label>
            <textarea class="form-control" name="observacoes" id="observacoes" cols="30"
                      rows="5">{{ $advertencia->observacoes ?? '' }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <div class="form-group mb-2">
            <label for="id_tipoadvertencia" class="form-label">Tipo de Advertência</label>
            <select name="id_tipoadvertencia" id="id_tipoadvertencia" class="form-select" required>
                <option>--Selecione--</option>
                <option value="1" {{ !empty($advertencia) && $advertencia->id_tipoadvertencia === 1 ? 'selected' : ''}}>
                    Verbal
                </option>
                <option value="2" {{ !empty($advertencia) && $advertencia->id_tipoadvertencia === 2 ? 'selected' : ''}}>
                    Escrita
                </option>
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