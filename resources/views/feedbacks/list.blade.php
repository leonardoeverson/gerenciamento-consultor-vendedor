@foreach($feedbacks as $feedback)
    <tr>
        <td>{{ $feedback->id }}</td>
        <td>{{ date('d/m/Y H:i:s', strtotime($feedback->datahora)) }}</td>
        <td>{{ $feedback->nome }}</td>
        <td style="white-space: pre-line">{{ $feedback->descricao }}</td>
        <td style="white-space: pre-line">{{ $feedback->estrategia }}</td>
        <td style="white-space: pre-line">{{ $feedback->observacoes }}</td>
        <td>
            <div class="btn-toolbar float-end" style="display: block ruby">
                <div class="btn-group me-1">
                    <form>
                        @csrf
                        <input type="text" name="id" id="id" class="form-control"
                               value="{{ $feedback->id }}" hidden readonly>
                        <btn type="submit" class="btn btn-primary btn-sm"
                             hx-post="/feedbacks/editar" hx-target="#container">
                            <i class="fa fa-edit me-1"></i>
                            Editar
                        </btn>
                    </form>
                </div>
                <div class="btn-group">
                    <btn hx-get="/feedbacks/excluir/{{ $feedback->id }}" hx-target="#container"
                         class="btn btn-danger btn-sm">
                        <i class="fa fa-trash me-1"></i>
                        Excluir
                    </btn>
                </div>
            </div>
        </td>
    </tr>
@endforeach