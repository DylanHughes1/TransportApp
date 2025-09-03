import $ from "jquery";
window.$ = window.jQuery = $;

(function ($) {
    $('#btnAgregarLinea').on('click', function () {
        $('#modalAgregarLinea').removeClass('hidden');
    });

    $('#formAgregarLinea').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let data = form.serialize();

        $.post(url, data)
            .done(function (resp) {
                showToast(resp.message || "Línea agregada correctamente", "success");
                setTimeout(() => location.reload(), 1500); 
            })
            .fail(function (xhr) {
                console.error(xhr.responseText);
                showToast("Error al guardar la línea extra", "error");
            });
    });

    function showToast(message, type = "success") {
        const container = document.getElementById("toast-container");

        const colors = {
            success: "bg-green-500 text-white",
            error: "bg-red-500 text-white",
            info: "bg-blue-500 text-white",
        };

        const toast = document.createElement("div");
        toast.className = `px-4 py-2 rounded-lg shadow-lg ${colors[type]} animate-slide-in`;
        toast.innerText = message;

        container.appendChild(toast);

        // se borra solo después de 3 segundos
        setTimeout(() => {
            toast.classList.add("opacity-0", "transition", "duration-500");
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }
});
