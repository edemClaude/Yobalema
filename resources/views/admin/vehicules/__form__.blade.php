@php/* @var App\Models\Vehicule $vehicule */@endphp
<form class="needs-validation" novalidate enctype="multipart/form-data"
      action="{{ $action }}" method="POST">
    @csrf
    @method($method)
    @include('components.input', [
        'label' => 'Image', 'name' => 'image', 'type' => 'file', 'required' => false
    ])<!-- End Image Input -->

    @include('components.input', [
        'label' => __('Immatriculation'), 'name' => 'matricule',
         'value' => $vehicule->matricule
    ]) <!-- End immatriculation Input -->

    @include('components.select', [
        'label' => __('Catégorie'), 'name' => 'category_id', 'value' => $vehicule->category_id,
        'options' => $categories
    ])<!-- End Catégorie Select -->

    @include('components.input', [
        'label' => __('Kilométrage par défaut'), 'name' => 'km_defaut',
        'value' => $vehicule->km_defaut
    ]) <!-- End Kilométrage par défaut Input -->

    @include('components.input', [
        'label' => __('Date d\'achat'), 'name' => 'date_achat',
        'value' => $vehicule->date_achat, 'type' => 'date'
    ])<!-- End Date d'achat Input -->

    <script>
        // Date < à la date d'aujourd'hui
        document.querySelector('#date_achat').max = new Date().toISOString().split("T")[0];
    </script>

    <div class="text-center form-group mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i>
            {{ $vehicule->exists ? 'Modifier Véhicule' : 'Créer un véhicule' }}
        </button> <!-- End Submit Button -->
    </div><!-- End Submit Button div -->
</form>
