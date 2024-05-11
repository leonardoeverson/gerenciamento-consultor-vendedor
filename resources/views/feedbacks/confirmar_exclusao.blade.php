<form hx-post="/feedbacks/delete" hx-target="#container">
    @csrf
    <div class="container mt-2">
        <div class="card bg-body rounded shadow-sm">
            <div class="card-body">
                <input type="text" name="id" value="{{ $id }}" hidden readonly>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-primary" role="alert">
                                Confirma a exclusão do item?
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="/feedbacks" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
