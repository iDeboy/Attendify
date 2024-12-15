(async () => {
  const API_INSCRIBIRSE = `api/alumno/inscribirse`;
  const btnInscribirse = document.getElementById("btnInscribirse");
  const grupoId = btnInscribirse.getAttribute("data-id");

  btnInscribirse.addEventListener("click", async (e) => {
    const result = await fetch(API_INSCRIBIRSE, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        grupoId: grupoId,
      }),
    }).then((r) => r.json());

    if (!result.valido) return alert(result.error);

    location.href = location.href;
  });
})();
