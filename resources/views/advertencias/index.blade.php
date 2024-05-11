<div class="container">
    <div class="card mt-2 bg-body rounded shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a class="btn btn-primary float-end my-2" href="/advertencias/cadastrar">
                        <i class="fa fa-plus me-1"></i>
                        Cadastrar
                    </a>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mt-2">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Consultor</th>
                                    <th>Observações</th>
                                    <th>Tipo de Advertência</th>
                                    <th>Data/Hora</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($advertencias as $advertencia)
                                    <tr>
                                        <td>{{ $advertencia->id }}</td>
                                        <td>{{ $advertencia->consultor }}</td>
                                        <td>{{ $advertencia->observacoes }}</td>
                                        <td>{{ $advertencia->tipo_advertencia }}</td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($advertencia->datahora)) }}</td>
                                        <td>
                                            <button data-id="{{ $advertencia->id }}" type="button" class="btn btn-danger btn-sm" onclick="handleModalDeleteAdvOpen(this)">
                                                Excluir
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="void"></div>
</div>
<div class="modal fade" id="modalExcluirAdvertencia" tabindex="-1" aria-labelledby="modalExcluirAdvertenciaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalExcluirAdvertenciaLabel">Exclusão de advertência</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger mb-2" role="alert" id="alert_danger" hidden=""></div>
                Confirma a exclusão da advertência?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form hx-post="/advertencias/delete" hx-target="#void" hx-on::after-request="handleResponse(event)">
                    @csrf
                    <input type="text" name="id" id="id" hidden readonly>
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const modalElement = document.getElementById('modalExcluirAdvertencia')
    let modalRef = null;

    if (modalElement) {
        modalRef = new bootstrap.Modal(modalElement)
        modalElement.addEventListener('hide.bs.modal', () => {
            document.getElementById('alert_danger').hidden = true;
        })
    }

    const handleModalDeleteAdvOpen = element => {
        document.getElementById('id').value = element.getAttribute('data-id');

        if (modalRef) {
            modalRef.show();
        }
    }

    const handleResponse = (event) => {
        const {failed, xhr: {response}} = event.detail;
        const parsedResponse = JSON.parse(response)
        if (failed) {
            document.getElementById('alert_danger').innerText = parsedResponse.message;
            document.getElementById('alert_danger').hidden = false;
        } else {
            window.location.reload();
        }
    }
</script>