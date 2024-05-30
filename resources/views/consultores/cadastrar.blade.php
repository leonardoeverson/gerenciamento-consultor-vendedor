<div class="container" id="cadastro-consultor">
    <form hx-post="/consultores/insert" hx-target="#container" autocomplete="off">
        @csrf
        <div class="card mt-2">
            <div class="card-header">
                <div class="card-title">
                    Cadastro de consultor
                </div>
            </div>
            <div class="card-body">
                {{ view('consultores.common') }}
            </div>
        </div>
    </form>
</div>

