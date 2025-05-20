document.addEventListener("DOMContentLoaded", function () {
    if (typeof graficaLabels !== 'undefined' && typeof graficaDatos !== 'undefined') {
        const ctxBar = document.getElementById('graficaBarra').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: graficaLabels,
                datasets: [{
                    label: 'Productividad (%)',
                    data: graficaDatos,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Productividad Mensual (Barras)'
                    }
                }
            }
        });

        const ctxPie = document.getElementById('graficaPastel').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: graficaLabels,
                datasets: [{
                    label: 'Productividad (%)',
                    data: graficaDatos
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribución de Productividad (Pastel)'
                    }
                }
            }
        });
    }
});
