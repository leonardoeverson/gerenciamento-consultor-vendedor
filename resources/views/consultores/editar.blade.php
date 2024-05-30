<div class="container" id="cadastro-consultor">
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header">
                    <div class="card-title">
                        Edição de cadastro de consultor
                    </div>
                </div>
                <div class="card-body">
                    <form hx-post="/consultores/update" enctype="multipart/form-data" hx-target="#container" autocomplete="off">
                        {{ view('consultores.common', ['id' => $id, 'consultor' => $consultor, 'mensagem' => $mensagem ?? null, 'type' => $type ?? null]) }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
