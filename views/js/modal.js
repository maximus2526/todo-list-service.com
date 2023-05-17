function openPopup(todoId) {
    document.getElementById("popup-overlay-" + todoId).style.display = "block";
}

function closePopup(todoId) {
    document.getElementById("popup-overlay-" + todoId).style.display = "none";
}