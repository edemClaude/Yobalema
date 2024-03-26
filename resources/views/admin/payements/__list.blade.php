@php/* @var App\Models\Payement $payement */ @endphp
<div class="row justify-content-center col-12">
    @foreach($payements as $payement)
        <div class="col-xxl-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payement <span>: {{ $payement?->location->id }}</span></h5>
                    <div class="card-text fs-6">
                        <p><span>Depart :{{ $payement->location?->lieu_depart }}</span></p>
                        <p><span>Arriver a: {{ $payement->location?->lieu_destination }}</span></p>
                        <p><span>Montant: {{ $payement->montant }} FCFA</span></p>
                        <p><span>Mode de payement: {{ $payement->mode }}</span></p>
                        <p>Client: <span>{{ $payement->location?->client?->getFullName() }}</span></p>
                    </div>
                    <a href="#" class="link link-info float-end mt-3">
                        Plus d'infos <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div><!-- End Revenue Card -->
    @endforeach
</div>
{{ $payements->links() }}
