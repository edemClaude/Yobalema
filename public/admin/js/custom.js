'use strict';

// Delete confirmation forms
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', () => {
        if (!confirm('êtes vous sur de vouloir supprimer cet élément ?')) {
            event.preventDefault();
            event.stopPropagation();
        }
    });
});


