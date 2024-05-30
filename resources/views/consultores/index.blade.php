<div class="container-fluid">
    <div class="card mt-2 border-1 rounded shadow-sm">
        <div class="card-header h5">
            Consultores
        </div>
        <div class="card-body">
            <div id="void"></div>
            <div class="row">
                <div class="col">
                    <a href="/consultores/cadastrar" class="btn btn-primary float-end mt-2">
                        <i class="fa fa-plus me-1"></i>
                        Cadastrar
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive mt-2">
                        <table class="table">
                            <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($consultores as $consultor)
                                <tr>
                                    <td>{{ $consultor->id }}</td>
                                    <td>
                                        @if ($consultor->foto)
                                            @php
                                                $type = pathinfo(app()->storagePath('app/') . $consultor->foto, PATHINFO_EXTENSION);
                                                $content = base64_encode(file_get_contents(app()->storagePath('app/') . $consultor->foto));
                                            @endphp
                                            <img src="data:image/{{ $type }};base64,{{ $content }}" alt="" style="max-width: 300px; max-height: 400px">
                                        @endif
                                    </td>
                                    <td>{{ $consultor->nome }}</td>
                                    <td>{{ $consultor->email }}</td>
                                    <td>
                                        <a hx-get="/consultor/editar/{{ $consultor->id }}" hx-target="#container" class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil me-1"></i>
                                            Editar
                                        </a>
                                        <button data-id="{{ $consultor->id }}" class="btn btn-sm btn-danger" onclick="handleModalDeleteOpen(this)">
                                            <i class="fa fa-pencil me-1"></i>
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

<div class="modal fade" id="modalExclusao" tabindex="-1" aria-labelledby="modalExclusaoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalExclusaoLabel">
                    Confirmação de exclusão
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger mb-2" role="alert" id="alert_danger" hidden=""></div>
                Confirma a exclusão do consultor?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <form hx-post="/consultores/delete" hx-target="#void" hx-on::after-request="handleResponse(event)">
                    @csrf
                    <input type="text" value="" name="id" id="id_consultor" hidden readonly>
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const modalElement = document.getElementById('modalExclusao')
    let modalRef = null;

    if (modalElement) {
        modalRef = new bootstrap.Modal(modalElement)
        modalElement.addEventListener('hide.bs.modal', () => {
            document.getElementById('alert_danger').hidden = true;
        })
    }

    const handleModalDeleteOpen = element => {
        document.getElementById('id_consultor').value = element.getAttribute('data-id');

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