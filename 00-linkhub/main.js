// modal inicio
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("maintenance-modal");
    modal.classList.add("show");
    setTimeout(() => {
        modal.classList.remove("show");
    }, 4000);
});
// notificacion toastify
function showMessage(message, type = "success") {
    Toastify({
        text: message,
        duration: 3000,
        destination: "./favoritos",
        newWindow: false,
        gravity: "bottom", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: type === "success" ? "linear-gradient(to right,rgb(0, 106, 147),rgb(0, 14, 118))" : "linear-gradient(to right, #b00600,rgb(201, 157, 61))"
        },
        onClick: function () { } // Callback after click
    }).showToast();
}