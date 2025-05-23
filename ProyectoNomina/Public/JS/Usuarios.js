document.addEventListener("DOMContentLoaded", function () {
    const respuestas = [
        document.getElementById("Respuesta1"),
        document.getElementById("Respuesta2"),
        document.getElementById("Respuesta3"),
        document.getElementById("Respuesta4")
    ];

    document.querySelector("form").addEventListener("submit", function (e) {
        const valores = respuestas.map(r => r.value.trim().toLowerCase());
        const duplicados = valores.filter((v, i, a) => a.indexOf(v) !== i);

        if (duplicados.length > 0) {
            e.preventDefault();
            alert("No puedes ingresar la misma respuesta más de una vez.");
        }
    });
});

