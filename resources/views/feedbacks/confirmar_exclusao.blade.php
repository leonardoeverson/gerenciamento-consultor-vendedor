<form hx-post="/feedbacks/delete" hx-target="#container">
    @csrf
    <input type="text" name="id" value="{{ $id }}" hidden readonly>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="alert alert-primary" role="alert">
                        Confirma a exclusão do item?
                    </div>
                </div>
            </div>
        </div>
        <a href="/feedbacks" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Confirmar</button>
    </div>
</form>
