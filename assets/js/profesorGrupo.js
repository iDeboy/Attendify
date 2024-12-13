(async () => {
  const notificationButton = document.getElementById("notificationButton");
  const notificationMenu = document.getElementById("notificationMenu");
  const closeNotificationMenu = document.getElementById(
    "closeNotificationMenu"
  );

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
