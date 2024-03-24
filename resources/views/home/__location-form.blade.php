<form class="trip-form needs-validation" novalidate action="{{ route('location') }}">

    <div class="row align-items-center">

        @include('components.select', [
            'name' => 'type_voiture',
            'label' => 'Véhicule',
            'options' => $categories,
            'value' => old('type_voiture'),
            'class' => 'col'
        ])

        @include('components.input', [
            'name' => 'lieu_depart',
            'label' => 'Départ de',
            'value' => old('lieu_depart', ''),
            'class' => 'col'
        ])

        @include('components.input', [
            'name' => 'lieu_destination',
            'label' => 'Arrivée à',
            'value' => old('lieu_destination', ''),
            'class' => 'col'
        ])

        @include('components.input', [
            'name' => 'date_location',
            'label' => 'Départ le',
            'type' => 'date',
            'value' => old('date_location', ''),
            'class' => 'col'
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
            'class' => 'col'
        ])

        @include('components.submit', [
            'label' => 'Valider',
        ])

    </div>

</form>
