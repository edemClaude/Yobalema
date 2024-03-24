@php/* @var App\Models\User $client */ @endphp
<div class="row justify-content-center col-12">
@foreach($clients as $client)
        <div class="col-xxl-4 col-md-4">
            <div class="card">
                <img src="{{ $client->getAvatar() }}" class="img-fluid card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title">Client <span>: {{ $client->getFullName() }}</span></h5>
                    <div class="card-text fs-6">
                        <p><span>{{ $client->email }}</span></p>
                        <p><span>{{ $client->telephone }}</span></p>
                        <p>Ajouté le <span>{{ $client->created_at }}</span></p>
                    </div>
                    <a href="{{ route('admin.users.show', $client) }}" class="link link-info float-end mt-3">
                        Plus d'infos <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div><!-- End Revenue Card -->
@endforeach
</div>
{{ $clients->links() }}
