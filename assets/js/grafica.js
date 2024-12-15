(async () => {
  API_GRAFICA = "api/profesor/grafica";

  const filtroGrafica = document.getElementById("filtroGrafica");
  const canvas = document.getElementById("barChart");
  const grupoId = canvas.getAttribute("data-id");

  let chart = null;

  const updateGrafica = async () => {
    const result = await fetch(API_GRAFICA, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        grupoId: grupoId,
        filtro: filtroGrafica.value,
      }),
    }).then((r) => r.json());

    if (!result.valido) return alert(result.error);

    const data = result.Data;

    if (chart !== null) {
        chart.destroy();
    }

    chart = new Chart(canvas, {
      type: "bar",
      data: {
        labels: Object.keys(data),
        datasets: [
          {
            label: "Asistencias",
            data: Object.values(data),
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            ticks: { precision: 0 },
            beginAtZero: true,
          },
        },
      },
    });
  };

  filtroGrafica.addEventListener('change', updateGrafica);

  updateGrafica();
})();
