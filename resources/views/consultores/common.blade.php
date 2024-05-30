@csrf
@if (isset($id))
    <input type="text" name="id" value="{{ $id }}" hidden readonly>
@endif

@php
    $encoded = null;
    $type = null;
    $path = app()->storagePath('app/') . $consultor->foto;
    if ($consultor && $consultor->foto && is_file($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $encoded = base64_encode(file_get_contents($path));
    }
@endphp
@if(!empty($mensagem))
    <div class="col-12">
        <div class="alert alert-{{$type}}" role="alert">
            {{ $mensagem }}
        </div>
    </div>
@endif
<div class="my-2">
    @if ($consultor && $consultor->foto)
        <img class="img-fluid" style="max-height: 400px; max-width: 300px" id="preview"
             alt="foto de perfil" src="data:image/{{ $type }};base64,{{ $encoded }}">
    @else
        <img class="avatar avatar-128 bg-light rounded-circle text-white p-2" style="height: 128px" id="preview"
             alt="foto de perfil" src="https://raw.githubusercontent.com/twbs/icons/main/icons/person-fill.svg">
    @endif
</div>
<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
    <div class="form-group mb-2">
        <label for="foto" class="form-label">Nova foto de perfil</label>
        <input type="file" accept="image/png, image/jpeg" id="foto" name="foto">
    </div>
</div>
<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
    <div class="form-group mb-2">
        <label for="nome" class="form-label">Nome do Consultor</label>
        <input type="text" class="form-control" name="nome" value="{{ isset($consultor) ? $consultor->nome : '' }}"
               required>
    </div>
</div>
<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
    <div class="form-group mb-2">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" value="{{ isset($consultor) ? $consultor->email : '' }}"
               required>
    </div>
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
