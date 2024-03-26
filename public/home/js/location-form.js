
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
    // event.preventDefault(); // Empêche la soumission normale du formulaire
    const formData = $(this).serialize(); // Sérialiser les données du formulaire
    $.ajax({
    type: 'POST',
    url: $(this).attr('action'), // URL de l'endpoint Laravel
    data: formData,
    success: function(response) {
    // Manipuler la réponse de succès, par exemple, afficher un message de succès
    let res;
    const modalLocationContent = $('#modal-body-content');
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
    $('#modal-location').modal('show');

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
