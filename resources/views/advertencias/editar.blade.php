<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Editar Advertência
            </div>
        </div>
        <div class="card-body">
            <form hx-post="/advertencias/update" hx-target="#container" autocomplete="off">
                {{ view('advertencias.common', [
                        'message' => $message ?? null,
                        'consultores' => $consultores,
                        'advertencia' => $advertencia ?? null,
                        'type' => $type ?? null,
                        'id' => $id
                    ])
                }}
            </form>
        </div>
    </div>
</div>
