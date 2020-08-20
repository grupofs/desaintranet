<div class="modal fade" id="estadoEvaluacionModal" tabindex="-1"
     style="display: none"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                    Evaluación
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        id="evaluar-status-progreso" >
                        En Progreso
                        <span class="badge badge-secondary badge-pill">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        id="evaluar-status-aprobado" >
                        Aprobado
                        <span class="badge evaluar-estado-aprobado-background badge-pill">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        id="evaluar-status-rechazado" >
                        Rechazado
                        <span class="badge evaluar-estado-rechazado-background badge-pill">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        id="evaluar-status-observado" >
                        Observado
                        <span class="badge evaluar-estado-observado-background badge-pill">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        id="evaluar-status-pendiente" >
                        Pendiente Vida Util
                        <span class="badge evaluar-estado-pendiente-background badge-pill">0</span>
                    </li>
                </ul>
                <p id="evaluar-status-vacio" style="display: none"
                   class="form-text font-weight-bold " >
                    Existen <span>0</span> evaluaciones pendientes.
                </p>
            </div>
        </div>
    </div>
</div>