@php/* @var App\Models\Vehicule $vehicule*/ @endphp
@foreach($vehicules as $vehicule)
<div class="col-md-6 col-lg-4 mb-4">

    <div class="listing d-block  align-items-stretch">
        <div class="listing-img h-100 mr-4">
            <img src="{{ $vehicule->getImage() }}" alt="Image" class="img-fluid">
        </div>
        <div class="listing-contents h-100">
            <h3>{{ $vehicule->matricule }}</h3>
            <div class="rent-price">
                <strong>Chauffeur: {{ $vehicule->user?->getFullName() }}</strong>
            </div>
            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                <div class="listing-feature pr-4">
                    <span class="caption">Type de Véhicule:</span>
                    <span class="number">{{ $vehicule->category->name }}</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach
