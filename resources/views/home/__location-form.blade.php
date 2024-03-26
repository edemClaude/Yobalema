<meta name="csrf-token" content="{{ csrf_token() }}">
<form id="location-form" class="trip-form needs-validation" novalidate
      action="{{ route('location') }}"
      method="POST">
    @csrf

    @include('components.alert')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="row align-items-center">

        @include('components.select', [
            'name' => 'type_vehicule',
            'label' => 'Véhicule',
            'options' => $categories,
            'value' => old('type_voiture'),
            'class' => 'col-md-4'
        ])

        @include('components.input', [
            'name' => 'lieu_depart',
            'label' => 'Départ de',
            'value' => old('lieu_depart', ''),
            'class' => 'col-md-4'
        ])

        @include('components.input', [
            'name' => 'lieu_destination',
            'label' => 'Arrivée à',
            'value' => old('lieu_destination', ''),
            'class' => 'col-md-4'
        ])
    </div>
    <div class="row align-items-center">
        @include('components.input', [
            'name' => 'date_location',
            'label' => 'Départ le',
            'type' => 'date',
            'value' => old('date_location', ''),
            'class' => 'col-md-4'
        ])
        <script>
            // Date < a la date courante
            document.getElementById('date_location').min = new Date().toISOString().split("T")[0];
        </script>

        @include('components.input', [
            'name' => 'heure_depart',
            'label' => 'A',
            'type' => 'time',
            'value' => old('heure_depart', ''),
            'class' => 'col-md-4'
        ])

        @include('components.submit', [
            'label' => 'Rechercher',
        ])
    </div>

</form>

<!-- Modal -->
<div class="modal fade" id="modal-location" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="save-location">Valider</button>
                <button type="button" id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                    Annuler <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<div id="loader">
    <div class="loader-icon" style="width: 200px; height: 200px;"></div>
</div>

<style>
    #loader {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .loader-icon {
        width: 200px; /* ajustez la taille de l'indicateur de chargement selon vos besoins */
        height: 200px;
        background: url('{{ asset('/home/images/loader.gif') }}') no-repeat center center;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('/home/js/location-form.js') }}"></script>

