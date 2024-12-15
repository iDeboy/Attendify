(async () => {
  API_SOLICITUD = "api/profesor/solicitud";
  const notificationButton = document.getElementById("notificationButton");
  const notificationMenu = document.getElementById("notificationMenu");
  const closeNotificationMenu = document.getElementById(
    "closeNotificationMenu"
  );

  const btnsAceptarAlumno = document.getElementsByClassName("btnAceptarAlumno");
  const btnsRechazarAlumno =
    document.getElementsByClassName("btnRechazarAlumno");

  for (let btn of btnsAceptarAlumno) {
    const solicitudId = btn.getAttribute("data-id");
    btn.addEventListener("click", async (e) => {
      const result = await fetch(API_SOLICITUD, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          solicitudId: solicitudId,
          accion: 1,
        }),
      }).then((r) => r.json());

      if (!result.valido) return alert(result.error);

      location.href = location.href;
    });
  }

  for (let btn of btnsRechazarAlumno) {
    const solicitudId = btn.getAttribute("data-id");
    btn.addEventListener("click", async (e) => {
      const result = await fetch(API_SOLICITUD, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          solicitudId: solicitudId,
          accion: 0,
        }),
      }).then((r) => r.json());

      if (!result.valido) return alert(result.error);

      location.href = location.href;
    });
  }

  document.addEventListener("click", (e) => {
    notificationMenu.classList.add("hidden");
  });

  notificationMenu.addEventListener("click", (e) => {
    e.stopPropagation();
  });

  notificationButton.addEventListener("click", (e) => {
    e.stopPropagation();
    notificationMenu.classList.remove("hidden");
  });

  closeNotificationMenu.addEventListener("click", (e) => {
    e.stopPropagation();
    notificationMenu.classList.add("hidden");
  });
})();
