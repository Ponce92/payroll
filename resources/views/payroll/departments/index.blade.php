@extends('layout.layout')

@section('title') Departamentos @endsection

@section('body')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Departamentos</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    @if(Auth::user()->hasPermission('puede_crear_departamentos'))
                    <button class="btn btn-green" type="button" onclick="showCreateForm('{{ route('departments.create') }}')">
                        <i class="icon-plus" style="color: white;"></i>    Agregar
                    </button>
                    @endif
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <table class="table table-bordered table-striped dataTable"
                           id="laravel_datatable"
                           aria-describedby="DataTables_Table_0_info"
                           role="grid"
                           style="width: 100%">
                        <thead>
                            <tr class="odd">
                                <th width="30">Id</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Comentario</th>
                                <th style="width: 150px;">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal animated fadeIn text-left"
         id="modalCreate"
         tabindex="-1"
         role="dialog"
         aria-labelledby="create"
         style="display: none; padding-right: 15px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="icon-cog2"></i>
                        Crear departamento
                    </h4>
                </div>
                <div class="modal-body" id="targetCreate">
                    {{--   ++++++++++++++++++++++    --}}
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-secondary btn-cancel"
                            data-dismiss="modal">Cancelar</button>
                    <button type="button"
                            onclick="store('#modalCreate','#formCreate')"
                            class="btn btn-outline-info">Agregar</button>
                </div>
            </div>
        </div>
    </div>
{{--
    Edicion del objeto, modal . . .
    --}}
    <div class="modal animated fadeIn text-left"
         id="modalEdit"
         tabindex="-1"
         role="dialog"
         aria-labelledby="edit"
         style="display: none; padding-right: 15px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="icon-cog2"></i>
                        Edicion de departamento
                    </h4>
                </div>
                <div class="modal-body" id="targetEdit">

                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-dismiss="modal"><i class="icon-close"></i>  Cancelar</button>
                    <button type="button"
                            onclick="editObject('#modalCreate','#formCreate')"
                            class="btn btn-outline-info"> <i class="icon-save"> </i>  Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    {{--
    Edicion del objeto, modal
    --}}
    <div class="modal animated text-left"
         id="modalTrash"
         tabindex="-1"
         role="dialog"
         aria-labelledby="edit">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="icon icon-trash3" style="color: #aa0000;"></i>
                        Eliminar rol
                    </h4>
                </div>
                <div class="modal-body" id="targetDelete">
                    <div class="col col-8">
                        <p> Se eliminara el recurso del sistema, una vez eliminado no prodra recuperarse</p>
                    </div>
                    <input hidden type="text" disabled name="delete_input" id="delete_input" data-id="" value="" >
                    <div class="col col-12">
                        <strong>¿ Esta seguro de la accionz ?</strong>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-dismiss="modal"><i class="icon-times"></i> Cancelar </button>
                    <button type="button"
                            onclick="deleteObject()"
                            class="btn btn-outline-danger"> <i class="icon-trash3"></i>  Eliminar</button>
                </div>
            </div>
        </div>
    </div>


    <input type="text" hidden name="token" id="token" value="{{csrf_token()}}">


@endsection

@section('scripts')

    <link  href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>


    <script src="{{ asset('js/util/datatable.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#laravel_datatable').DataTable({
                processing: true,

                serverSide: true,
                ajax: "{{ route('departments.index') }}",
                columns: [
                    { data: 'id'},
                    { data: 'cs_name',orderable:false},
                    { data: 'cs_code'},
                    { data: 'cs_desc'},
                    { data: 'acctions'},
                ]
            });
        });
    </script>

@endsection
