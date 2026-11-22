// Library Management System small UI helpers
document.addEventListener('DOMContentLoaded', function () {
    // Confirm before dangerous deletes (forms already have inline handlers too)
    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!confirm(form.getAttribute('data-confirm'))) {
                e.preventDefault();
            }
        });
    });
});
