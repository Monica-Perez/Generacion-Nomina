document.addEventListener("DOMContentLoaded", function () {
    if (typeof labels !== 'undefined' && typeof data !== 'undefined') {
        const colores = labels.map(() => `hsl(${Math.random() * 360}, 70%, 60%)`);

        new Chart(document.getElementById('graficaBarra'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Productividad (%)',
                    data: data,
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
                        text: 'Productividad de empleados (Barras)',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: { display: false },
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
                            font: { size: 10 }
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

        // Gráfico de Pastel
        new Chart(document.getElementById('graficaPastel'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colores
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribución de Productividad por mes',
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

document.addEventListener('DOMContentLoaded', function () {
    const editarBtns = document.querySelectorAll('.btn-editar');

    editarBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const fila = document.querySelector(`#fila-${id}`);
            
            // Mostrar input, ocultar span
            fila.querySelectorAll('input[type="number"]').forEach(input => input.classList.remove('d-none'));
            fila.querySelectorAll('.texto').forEach(span => span.classList.add('d-none'));

            // Mostrar botón guardar, ocultar editar
            fila.querySelector(`#guardar-${id}`).classList.remove('d-none');
            this.classList.add('d-none');
        });
    });
});




