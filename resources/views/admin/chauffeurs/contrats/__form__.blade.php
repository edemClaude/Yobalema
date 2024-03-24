@php
    /* @var App\Models\User $chauffeur */
    $contrat = $chauffeur->contrat;
@endphp
<form action="{{ $action }} " method="POST" class="needs-validation" novalidate>

    @csrf
    @method($method)

    @include('components.input', [
       'name' => 'user_id',
       'value' => $chauffeur->id,
       'type' => 'hidden',
       'class' => 'd-none',
   ])

    @include('components.select', [
        'label' => 'Choisir le type de contrat',
        'name' => 'type',
        'value' => $contrat?->type,
        'options' => App\Models\Contrat::TYPE,
    ])

    @include('components.input', [
        'label' => 'Durée du contrat',
        'name' => 'duree',
        'type' => 'number',
        'value' => $contrat?->duree,
    ])

    @include('components.input', [
        'label' => 'Salaire',
        'name' => 'salaire',
        'type' => 'number',
        'value' => $contrat?->salaire,
    ])

    @include('components.input', [
        'label' => 'Date d\'embauche',
        'name' => 'date_embauche',
        'value' => $contrat?->date_embauche,
        'type' => 'date',
    ])
    <script>
        document.querySelector('input[name="date_embauche"]').valueAsDate = new Date();
        document.querySelector('input[name="date_embauche"]').min = new Date().toISOString().split("T")[0];
    </script>

    @include('components.submit', [
        'label' => $contrat?->exists ? 'Modifier le contrat' : 'Ajouter un contrat',
    ])

</form>
