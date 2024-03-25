@php/* @var App\Models\Location $location */ @endphp
<div class="col-md-6 col-lg-4 mb-4">
    <div class="listing d-block  align-items-stretch">
        <div class="listing-img h-100 mr-4">
            <img src="{{ $location->vehicule?->getImage() }}" alt="Image" class="img-fluid">
        </div>
        <div class="listing-contents h-100">
            <h3>Heure de depart : {{ date('H:i', strtotime($location->heure_depart)) }}</h3>
            <div class="rent-price">
                <strong>Chauffeur : {{ $location->chauffeur?->getFullName() }}</strong>
            </div>
            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                <div class="listing-feature pr-4">
                    <span class="caption">Départ :</span>
                    <span class="number">{{ $location->lieu_depart }}</span>
                </div>
                <div class="listing-feature pr-4">
                    <span class="caption">Arrivé :</span>
                    <span class="number">{{ $location->lieu_destination }}</span>
                </div>
                <div class="listing-feature pr-4">
                    <span class="caption">Montant : </span>
                    <span class="number">{{ $location->prix_estime }} FCFA</span>
                </div>
            </div>
            <div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
                <p><a href="#" class="btn btn-primary btn-sm">Rent Now</a></p>
                <form class="d-inline" action="{{ route('location.destroy', $location) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Annuler la location</button>
                </form>
            </div>
        </div>

    </div>
</div>
