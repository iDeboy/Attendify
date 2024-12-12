(async () => {
  const API_GRUPO = "api/profesor/crear-grupo";
  const API_MATERIA = "api/profesor/crear-materia";

  const btnAgregarMateria = document.getElementById("btnAgregarMateria");
  const btnGuardarMateria = document.getElementById("btnGuardarMateria");
  const btnCancelarMateria = document.getElementById("btnCancelarMateria");
  const agregarMateria = document.getElementById("agregarMateria");

  const codigoMateria = document.getElementById("codigoMateria");
  const nombreMateria = document.getElementById("nombreMateria");  

  const btnGuardarGrupo = document.getElementById("btnGuardarGrupo");
  const nombreGrupo = document.getElementById('nombreGrupo');
  const materiaId = document.getElementById("materiaId");
  const horasSemanales = document.getElementById('horasSemanales');

  btnAgregarMateria.addEventListener("click", (e) => {
    limpiar();
    agregarMateria.classList.remove("hidden");
    agregarMateria.classList.add("flex");
  });

  btnCancelarMateria.addEventListener("click", (e) => {
    agregarMateria.classList.remove("flex");
    agregarMateria.classList.add("hidden");
  });

  btnGuardarGrupo.addEventListener("click", async (e) => {
    const result = await fetch(API_GRUPO, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        materiaId: materiaId.value,
        nombreGrupo: nombreGrupo.value,
        horasSemanales: horasSemanales.value
      }),
    }).then((r) => r.json());

    console.log(result);

    if (!result.valido) return alert("No se pudo agregar el grupo!");

    location.href = 'profesor/grupos';
  });

  btnGuardarMateria.addEventListener("click", async (e) => {
    const result = await fetch(API_MATERIA, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        codigoMateria: codigoMateria.value,
        nombreMateria: nombreMateria.value,
      }),
    }).then((r) => r.json());

    if (!result.valido) return alert("No se pudo agregar la materia!");

    location.href = location.href;
  });

  function limpiar() {
    codigoMateria.value = null;
    nombreMateria.value = null;
  }
})();
