@php/* @var App\Models\Contrat $contrat */@endphp
    <!-- Vertically centered Modal -->
<button type="button" class="btn btn-sm btn-outline-primary @disabled($disabled)"
        data-bs-toggle="modal" data-bs-target="#modal-contrat-{{ $id }}">
    {{ $title }} <i class="bi bi-file-earmark-text"></i>
</button>
<div class="modal fade" id="modal-contrat-{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $contrat ? 'Consulter le contrat' : 'Ajouter un contrat' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($contrat)
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $chauffeur->getAvatar() }}"
                                 class="img-fluid w-100 rounded" alt="Photo du Contrat">
                        </div><!-- End Img col -->
                        <div class="col-md-8">
                            <p class="card-text">
                                <span class="fw-bold">Contrat N: </span>{{ $contrat->code }}
                            </p>

                            <p class="card-text">
                                <span class="fw-bold">Nom: </span>{{ $chauffeur->getFullName() }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Durée: </span>{{ $contrat->duree }} ans
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Type de contrat: </span>{{ $contrat->type }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Date d'embauche: </span>{{ $contrat->date_embauche }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Modifier le: </span>{{ $contrat->updated_at->format("d/m/Y") }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Ajouter le: </span>{{ $contrat->created_at->format("d/m/Y") }}
                            </p>
                        </div><!-- End Col -->
                    </div> <!-- End Row -->
                @else
                    <!-- If contrat don't exist -->
                    @include('admin.chauffeurs.contrats.__form__', [
                        'action' => route('admin.contrats.store'),
                        'method' => 'POST',
                        'chauffeur' => $chauffeur
                    ])
                @endif <!-- End If -->
            </div>
            <div class="modal-footer">
                {{-- Supprimer le contrat --}}
                @if($contrat)
                    <form class="d-inline delete-form"
                          action="{{ route('admin.contrats.destroy', $contrat) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Supprimer <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('admin.contrats.edit', $chauffeur) }}"
                       type="button" class="btn btn-sm btn-primary">
                        Modifier <i class="bi bi-pencil-square"></i>
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

