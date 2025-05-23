$(document).ready(function () {

    $("#searchInput").on("keyup", function () {
        const value = $(this).val().toLowerCase();
        $("#productividadTable tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    if (typeof graficaLabels !== 'undefined' && typeof graficaDatos !== 'undefined') {
        const colores = graficaLabels.map(() => `hsl(${Math.random() * 360}, 70%, 60%)`);

        new Chart(document.getElementById('graficaBarras'), {
            type: 'bar',
            data: {
                labels: graficaLabels,
                datasets: [{
                    label: 'Productividad (%)',
                    data: graficaDatos,
                    backgroundColor: colores,
                    borderRadius: 8,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Productividad por Empleado',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.dataset.label}: ${ctx.formattedValue}%`
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45,
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 10,
                            callback: value => value + '%'
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('graficaPastel'), {
            type: 'pie',
            data: {
                labels: graficaLabels,
                datasets: [{
                    data: graficaDatos,
                    backgroundColor: colores
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribución de la Productividad',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.label}: ${ctx.formattedValue}%`
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 12 },
                            boxWidth: 12
                        }
                    }
                }
            }
        });
    }
});

console.log("Labels:", graficaLabels);
console.log("Datos:", graficaDatos);


document.querySelector('form').addEventListener('submit', function(e) {
    const empleadoSelect = document.querySelector('#ID_Emp');
    const selectedOption = empleadoSelect.options[empleadoSelect.selectedIndex];
    const fechaIngresoStr = selectedOption.getAttribute('data-ingreso');
    const mes = parseInt(document.querySelector('[name="Mes"]').value);
    const anio = parseInt(document.querySelector('[name="Anio"]').value);

    if (!fechaIngresoStr) return;

    const fechaIngreso = new Date(fechaIngresoStr);
    const fechaProductividad = new Date(anio, mes - 1, 1);
    const fechaActual = new Date();
    const inicioMesActual = new Date(fechaActual.getFullYear(), fechaActual.getMonth(), 1);

    if (fechaProductividad < fechaIngreso) {
        alert("La fecha de productividad no puede ser anterior a la fecha de ingreso del empleado.");
        e.preventDefault();
        return;
    }

    if (fechaProductividad > inicioMesActual) {
        alert("No se puede registrar productividad en meses futuros.");
        e.preventDefault();
        return;
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const selectEmp = document.getElementById('ID_Emp_select');
    const hiddenEmp = document.getElementById('ID_Emp_hidden');

    if (selectEmp && hiddenEmp) {
        hiddenEmp.value = selectEmp.value;

        if (!selectEmp.disabled) {
            selectEmp.addEventListener('change', function () {
                hiddenEmp.value = this.value;
            });
        }
    }
});



