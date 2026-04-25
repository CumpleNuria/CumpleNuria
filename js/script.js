// ✨ SCROLL ANIMADO
const elements = document.querySelectorAll("section");

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("visible");
        }
    });
}, { threshold: 0.2 });

elements.forEach(el => {
    el.classList.add("fade-in");
    observer.observe(el);
});

// 📳 VIBRACIÓN
document.querySelector("button[type='submit']").addEventListener("click", () => {
    if (navigator.vibrate) navigator.vibrate(50);
});

// 🎉 MENSAJE DE CONFIRMACIÓN DESPUÉS DE ENVIAR
const urlParams = new URLSearchParams(window.location.search);

if (urlParams.get("ok") === "1") {

    const mensaje = document.createElement("div");
    mensaje.innerText = "Gracias por confirmar tu asistencia 🎉";

    mensaje.style.position = "fixed";
    mensaje.style.top = "20px";
    mensaje.style.left = "50%";
    mensaje.style.transform = "translateX(-50%)";
    mensaje.style.background = "rgba(0,0,0,0.8)";
    mensaje.style.color = "#fff";
    mensaje.style.padding = "15px 25px";
    mensaje.style.borderRadius = "10px";
    mensaje.style.zIndex = "9999";
    mensaje.style.fontSize = "16px";
    mensaje.style.boxShadow = "0 5px 15px rgba(0,0,0,0.3)";

    document.body.appendChild(mensaje);

    setTimeout(() => {
        mensaje.remove();
    }, 3000);
}

document.querySelectorAll(".playlist-section").forEach(el => {
    el.classList.add("fade-in");
});

// 🎉 Mostrar modal si viene del PHP
const params = new URLSearchParams(window.location.search);

if (params.get("ok") === "1") {
    document.getElementById("successModal").classList.remove("hidden");
}

// 🔙 cerrar modal
function closeModal() {
    document.getElementById("successModal").classList.add("hidden");

    // limpiar URL sin recargar
    window.history.replaceState({}, document.title, "index.html");
}
