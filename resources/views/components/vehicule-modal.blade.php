@php/* @var App\Models\Vehicule $vehicule */@endphp
    <!-- Vertically centered Modal -->
<button type="button" class="btn btn-sm btn-warning @disabled($disabled)"
        data-bs-toggle="modal" data-bs-target="#modal-vehicule-{{ $id }}">
    {{ $title }} <i class="bi bi-car-front-fill"></i>
</button>
<div class="modal fade" id="modal-vehicule-{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $vehicule ? 'Voire le vehicule' : 'Assigner un véhicule' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($vehicule)
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $vehicule->getImage() }}"
                                 class="img-fluid w-100 rounded" alt="Photo du Contrat">
                        </div><!-- End Img col -->
                        <div class="col-md-8">
                            <p class="card-text">
                                <span class="fw-bold">Matricule: </span>{{ $vehicule->matricule }}
                            </p>

                            <p class="card-text">
                                <span class="fw-bold">Date achat: </span>{{ $vehicule->date_achat }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">
                                    <i class="bi bi-speedometer"></i>KM defaut: </span>{{ $vehicule->km_defaut }} km
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">
                                    <i class="bi bi-speedometer"></i>KM actuel: </span>{{ $vehicule->km_actuel }} km
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Status: </span>{{ $vehicule->status }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Catégorie </span>{{ $chauffeur->permisConduite->category->name }}
                            </p>
                        </div><!-- End Col -->
                    </div> <!-- End Row -->
                @else
                    <!-- If vehicule don't exist -->
                    <a href="{{ route('admin.vehicules.assign', $chauffeur) }}" class="btn btn-primary btn-sm">
                        Assigner un véhicule <i class="bi bi-car-front"></i>
                    </a>
                @endif <!-- End If -->
            </div>
            <div class="modal-footer">
                {{-- Supprimer le vehicule --}}
                @if($vehicule)
                    <a href="{{ route('admin.vehicules.unassign', $chauffeur) }}"
                       type="button" class="btn btn-sm btn-danger">
                        Retirer le véhicule <i class="bi bi-pencil-square"></i>
                    </a>
                @else
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                        Fermer <i class="bi bi-x"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->


