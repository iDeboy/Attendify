(async () => {
  API_ASISTENCIA = "api/alumno/asistencia";
  const btnPresente = document.getElementById("btnPresente");
  const claseId = btnPresente.getAttribute("data-id");
  btnPresente.addEventListener("click", async (e) => {
    const result = await fetch(API_ASISTENCIA, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        claseId: claseId,
      }),
    }).then((r) => r.json());

    if (!result.valido) alert(result.error);

    location.href = location.href;
  });
})();
