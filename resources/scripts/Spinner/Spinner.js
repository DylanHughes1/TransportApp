document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".redirect-link");
    const spinner = document.getElementById("loading-spinner");

    spinner.classList.add("hidden");

    links.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            spinner.classList.remove("hidden");
            setTimeout(() => {
                window.location.href = link.href;
            }, 100);
        });
    });

    $('form').on('submit', function () {
        spinner.classList.remove("hidden"); 
        $('button, input[type="submit"]').prop('disabled', true);
    });
});

// Detectar si la página se carga desde la caché
window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
        document.getElementById("loading-spinner").classList.add("hidden"); // Ocultar el spinner
    }
});
