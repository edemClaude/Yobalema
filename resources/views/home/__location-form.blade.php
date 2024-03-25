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
<script>
    let locationContent;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){


        $('#modal-close').click(function() {
            $('#modal-location').modal('hide');
        });

        $('#location-form').submit(function(event) {
            $('#loader').show();
            event.preventDefault(); // Empêche la soumission normale du formulaire
            const formData = $(this).serialize(); // Sérialiser les données du formulaire
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // URL de l'endpoint Laravel
                data: formData,
                success: function(response) {
                    // Manipuler la réponse de succès, par exemple, afficher un message de succès
                    let res;
                    const modalLocationContent = $('#modal-body-content');
                    const modalLocation = $('#modal-location');
                    if (response.success) {
                        res = response.success;

                        const html = "<div class='row'> <div class='col-md-4'>"
                            + "<img src='" + res.vehicule_image + "' class='img-fluid w-100 rounded' alt='...'>"
                            + "<img src='" + res.chauffeur_image + "' class='img-fluid w-100 rounded' alt='...'>"
                            + "</div> <div class='col-md-8'> <p class='card-text'>"
                            + "<span class='fw-bold'>Véhicule : " + res.vehicule_type + " </span> </p>"
                            + "<p><span class='fw-bold'>Chauffeur : " + res.chauffeur_name + " </span> </p>"
                            + "<p><span class='fw-bold'>Départ de : </span>"+ res.lieu_depart +"</p>"
                            + "<p> <span class='fw-bold'>Arrivée à : </span>"+ res.lieu_destination + "</p>"
                            + "<p><span class='fw-bold'>Heure Départ : </span>" + res.heure_depart + "</p>"
                            + "<p><span class='fw-bold'>Distance : </span>" + res.distance + "</p>"
                            + "<p><span class='fw-bold'>Montant extimé : </span>" + res.prix_estime + "</p>"
                            + "</div></div>";

                        locationContent = res.location;
                        modalLocationContent.html(html);
                        $('#loader').hide();
                        modalLocation.modal('show');

                    } else {
                        const html = "<div class='alert alert-danger' role='alert'>" + response.error +"</div>";
                        modalLocationContent.html(html);
                    }
                    // reset le formulaire
                    $('#location-form')[0].reset();
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    // Manipuler les erreurs, par exemple, afficher un message d'erreur
                    const html = "<div class='alert alert-danger' role='alert'>Erreur: "
                        + "Assurer vous que tous les cahmps ont été remplis</div>";
                    $('#modal-body-content').html(html);
                    $('#modal-location').modal('show');
                }
            });
        });
    });


    $('#save-location').click(function() {
        // Envoyer une requête AJAX pour sauvegarder la location
        //const jsonData = JSON.stringify(locationContent)
        // Récupérer le token CSRF
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Ajouter le token CSRF aux données de la location
        const jsonData = Object.assign({}, locationContent, {
            '_token': csrfToken
        })
        const modalLocation = $('#modal-location');

        $.ajax({
            type: 'POST',
            url: '/location/store', // URL de l'endpoint Laravel pour sauvegarder la location
            data: jsonData,
            success: function(response) {
                if ( response.success ) {
                    const html = "<div class='alert alert-success' role='alert'>"+ response.success +"</div>";
                    $('#modal-body-content').html(html);
                    modalLocation.modal('show');
                } else {
                    const html = "<div class='alert alert-danger' role='alert'>"+ response.error +"</div>";
                    $('#modal-body-content').html(html);
                    modalLocation.modal('show');
                }
            },
            error: function(xhr, status, error) {
                // Manipuler les erreurs, par exemple, afficher un message d'erreur
                const html = "<div class='alert alert-danger' role='alert'>"+ response.error +"</div>";
                $('#modal-body-content').html(html);
                modalLocation.modal('show');
            }
        });

    });

</script>

