document.addEventListener("DOMContentLoaded", function () {
    const estado = document.getElementById("estado");
    const fechaBaja = document.getElementById("fecha_baja");

    function toggleFechaBaja() {
        if (estado.value === "Baja" && !fechaBaja.value) {
            const hoy = new Date().toISOString().split('T')[0];
            fechaBaja.value = hoy;
        } else if (estado.value === "Activo") {
            fechaBaja.value = '';
        }
    }

    estado.addEventListener("change", toggleFechaBaja);
    toggleFechaBaja();
});

