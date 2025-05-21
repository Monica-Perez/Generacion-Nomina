$(document).ready(function () {
    console.log("🔧 Nomina.js cargado correctamente");

    // Buscador
    $("#searchInput").on("keyup", function () {
        const value = $(this).val().toLowerCase();
        $("#nominaTable tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Editar tipo de nómina
    $(".editar-tipo-nomina").on("click", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        const $cell = $('.tipo-nomina-cell[data-id="' + id + '"]');
        $cell.find('.tipo-nomina-text').hide();
        $cell.find('.tipo-nomina-select').removeClass('d-none').focus();
    });

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
                location.reload();
            } else {
                alert("Error al actualizar.");
            }
        });
    });

    // Toggle seleccionar todos
    let allSelected = false;

    $(".toggleSelectAll").on("click", function () {
        console.log("✅ Botón de seleccionar todos presionado");

        allSelected = !allSelected;

        $('input[name="ids[]"]').prop("checked", allSelected);

        $(this).text(allSelected
            ? "❌"
            : "✅");
    });
});