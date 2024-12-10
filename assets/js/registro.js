(async () => {
  const radioUsuario = document.getElementById("radioUsuario");
  const textoId = document.getElementById("textoId");

  radioUsuario.addEventListener("change", (e) => {
    const target = e.target;
    
    if (target.type !== "radio") return;
    
    if (!target.checked) return;

    if (target.value === "Alumno") {
      textoId.textContent = "No. Control";
    } else {
      textoId.textContent = "RFC";
    }
  });
})();
