(async () => {
  const API_CLASE = "api/profesor/crear-clase";
  const temaClase = document.getElementById("temaClase");
  const fechaClase = document.getElementById("fechaClase");
  const horaClase = document.getElementById("horaClase");
  const btnGuardar = document.getElementById("btnGuardar");
  const grupoId = btnGuardar.getAttribute("data-id");

  btnGuardar.addEventListener("click", async (e) => {
    const result = await fetch(API_CLASE, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        grupoId: grupoId,
        temaClase: temaClase.value,
        fechaClase: fechaClase.value,
        horaClase: horaClase.value,
      }),
    }).then((r) => r.json());

    if (!result.valido) return alert(result.error);

    location.href = `profesor/grupos/${grupoId}`;
  });
})();
