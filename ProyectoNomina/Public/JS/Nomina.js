$(document).ready(function () {
    // Buscar y filtrar empleados
    $("#searchInput").on("keyup", function () {
        const value = $(this).val().toLowerCase();
        $("#nominaTable tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Activar edición del tipo de nómina
    $(".editar-tipo-nomina").on("click", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        const $cell = $('.tipo-nomina-cell[data-id="' + id + '"]');
        $cell.find('.tipo-nomina-text').hide();
        $cell.find('.tipo-nomina-select').removeClass('d-none').focus();
    });

    // Guardar automáticamente al cambiar
    $(".tipo-nomina-select").on("change", function () {
        const $select = $(this);
        const nuevoTipo = $select.val();
        const idNomina = $select.closest('.tipo-nomina-cell').data("id");

        $.post("index.php?controller=nomina&action=actualizarTipoNomina", {
            ID_Nomina: idNomina,
            Tipo_Nomina: nuevoTipo
        }, function (response) {
            const res = JSON.parse(response);
            if (res.success) {
                alert("Tipo de nómina actualizado correctamente.");
                location.reload(); // o actualizar dinámicamente solo la fila si prefieres
            } else {
                alert("Error al actualizar.");
            }
        });
    });
});