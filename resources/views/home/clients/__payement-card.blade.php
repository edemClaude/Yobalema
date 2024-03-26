<div class="card">
    <div class="card-header">
        <h3 class="card-title">Paiement</h3>
    </div>
    <div class="card-body">
    <form action="{{ route('client.payement.store') }}" method="POST" class="needs-validation">
        @csrf
        @include('components.input', [
            'name' => 'mode',
            'label' => 'Mode de paiement',
            'type' => 'text',
        ])

        @include('components.input', [
            'location' => '',
            'name' => 'location_id',
            'label' => 'Location',
            'type' => 'hidden',
            'value' => $location->id,
        ])

        @include('components.submit', [
            'label' => 'Enregistrer le payement',
        ])

    </form>
    </div>
</div>
