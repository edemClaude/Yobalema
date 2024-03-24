@php
    /* @var App\Models\User $chauffeur */
    $permis = $chauffeur->permisConduite
@endphp
<form action="{{ $action }} " method="POST" class="needs-validation" novalidate>

    @csrf
    @method($method)

    @include('components.input', [
       'label' => $chauffeur->prenom,
       'name' => 'user_id',
       'value' => $chauffeur->id,
       'type' => 'hidden',
       'class' => 'd-none',
   ])

    @include('components.select', [
        'label' => 'Catégorie du permis',
        'name' => 'category_id',
        'value' => $permis?->category->id,
        'options' => $categories,
    ])

    @include('components.input', [
        'label' => 'Numéro du permis',
        'name' => 'num_permis',
        'type' => 'number',
        'value' => $permis?->num_permis,
    ])

    @include('components.input', [
        'label' => 'Date d\'obtention',
        'name' => 'delivrance',
        'value' => $permis?->delivrance,
        'type' => 'date',
    ])

    @include('components.input', [
        'label' => 'Date d\'expiration',
        'name' => 'expiration',
        'value' => $permis?->expiration,
        'type' => 'date',
    ])

    @include('components.input', [
        'label' => 'Année experience',
        'name' => 'annee_experience',
        'value' => $permis?->annee_experience,
        'type' => 'number',
    ])

    @include('components.submit', [
        'label' => $permis?->exists ? 'Modifier le permis' : 'Ajouter le permis'
    ])

</form>
