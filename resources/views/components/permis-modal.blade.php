@php/* @var App\Models\PermisConduite $permis */@endphp
<!-- Vertically centered Modal -->
<button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-{{ $id }}">
    {{ $title }} <i class="bi bi-person-badge-fill"></i>
</button>
<div class="modal fade" id="modal-{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $permis ? 'Consulter le permis' : 'Ajouter un permis' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($permis)
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $chauffeur->getAvatar() }}"
                                 class="img-fluid w-100 rounded" alt="Photo du permis">
                        </div><!-- End Img col -->
                        <div class="col-md-8">
                            <p class="card-text">
                                <span class="fw-bold">Numéro du permis: </span>{{ $permis->num_permis }}
                            </p>

                            <p class="card-text">
                                <span class="fw-bold">Nom: </span>{{ $chauffeur->getFullName() }}
                            </p>

                            <p class="card-text">
                                <span class="fw-bold">Type de permis: </span>{{ $permis->category->type_permis }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Date d'obtention: </span>{{ $permis->delivrance }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Date d'expiration: </span>{{ $permis->expiration }}
                            </p>
                        </div><!-- End Col -->
                    </div> <!-- End Row -->
                @else <!-- If permis don't exist -->
                    @include('admin.chauffeurs.permis.__form__', [
                        'action' => route('admin.permis.store', $chauffeur),
                        'method' => 'POST',
                        'chauffeur' => $chauffeur
                    ])
                @endif <!-- End If -->
            </div>
            <div class="modal-footer">
                {{-- Supprimer le permis --}}
                @if($permis)
                    <form class="d-inline delete-form"
                          action="{{ route('admin.permis.destroy', $permis) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Supprimer <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('admin.permis.edit', $chauffeur) }}" type="button" class="btn btn-sm btn-primary">
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
<script>
    document.querySelector('input[name="delivrance"]')
        .max = new Date().toISOString().split("T")[0];

    document.querySelector('input[name="delivrance"]')
        .addEventListener('change', (event) => {
            document.querySelector('input[name="expiration"]')
                .min = event.target.value
        })
</script>
