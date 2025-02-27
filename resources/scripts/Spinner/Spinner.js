document.addEventListener("DOMContentLoaded", function () {
    const spinner = document.getElementById("loading-spinner");

    if (spinner) {
        spinner.classList.add("hidden");
    }

    document.querySelectorAll(".redirect-link").forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            if (spinner) {
                spinner.classList.remove("hidden");
            }
            setTimeout(() => {
                window.location.href = link.href;
            }, 100);
        });
    });

    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", function () {
            if (spinner) {
                spinner.classList.remove("hidden");
            }
            form.querySelectorAll("button, input[type='submit']").forEach(element => {
                element.disabled = true;
            });
        });
    });
});

window.addEventListener("pageshow", function (event) {
    const spinner = document.getElementById("loading-spinner");
    if (event.persisted && spinner) {
        spinner.classList.add("hidden");
    }
});