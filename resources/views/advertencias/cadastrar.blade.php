<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Nova Advertência
            </div>
        </div>
        <div class="card-body">
            <form hx-post="/advertencias/insert" hx-target="#container" autocomplete="off">
               {{ view('advertencias.common', ['message' => $message ?? null, 'consultores' => $consultores, 'type' => $type ?? null]) }}
            </form>
        </div>
    </div>
</div>
