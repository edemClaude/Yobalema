<form class="needs-validation" novalidate enctype="multipart/form-data"
      action="{{ $action }}"
      method="POST">
    @csrf
    @method($method ?? 'POST')
    @include('components.input', [
        'name' => 'image',
        'type' => 'file',
        'class' => 'col-md-12',
        'required' => false,
    ]) <!-- Fin Image Input -->

    <div class="row">
        @include('components.input', [
           'label' => 'Prénom',
           'name' => 'prenom',
           'value' => $user->prenom,
           'class' => 'col-md-6',
        ]) <!-- Fin Prénom Input -->

        @include('components.input', [
            'name' => 'nom',
            'value' => $user->nom,
            'class' => 'col-md-6',
        ]) <!-- Fin nom Input -->

    </div> <!-- Fin nom et prénom Row -->

    @include('components.input', [
        'name' => 'email',
        'type' => 'email',
        'value' => $user->email
    ]) <!-- Fin Email Input -->

    <div class="row">
        @includeUnless($user->exists, 'components.input', [
            'label' => 'Mot de passe',
            'type' => 'password',
            'name' => 'password',
            'class' => 'col-md-6'
        ]) <!-- Fin Mot de passe Input -->

        @includeUnless($user->exists, 'components.input', [
            'label' => 'Confirmer mot de passe',
            'type' => 'password',
            'name' => 'confirm_password',
            'value' => null,
            'class' => 'col-md-6'
        ]) <!-- Fin Confirmer mot de passe Input -->
    </div> <!-- Fin mot de passe Row -->

    <div class="row">

        @include('components.input', [
            'label' => 'Téléphone',
            'name' => 'telephone',
            'value' => $user->telephone,
            'class' => 'col-md-6'
        ]) <!-- Fin Telephone Input -->

        @include('components.input', [
            'name' => 'adresse',
            'value' => $user->adresse,
            'class' => 'col-md-6'
        ]) <!-- Fin Adresse Input -->

    </div> <!-- Fin Telephone et Adresse Row -->

    @if(Route::current()->getName() == 'admin.users.create')
        @include('components.select', [
            'label' => 'Role',
            'name' => 'role_id',
            'value' => $user->role_id,
            'options' => $roles
        ]) <!-- Fin Role Select -->
    @endif <!-- include only when creating user -->

    @include('components.submit', [
        'label' => $user->exists ? 'Modifier' : 'Créer',
    ])

</form>
