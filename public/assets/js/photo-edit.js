document
.getElementById("fileInput")
    .addEventListener("change", function (event) {
        const file = event.target.files[0];
        const fileName = document.getElementById("fileName");

        if (file) {
            fileName.textContent = file.name;
        }
    });

function removeImage(element) {
    const inputFile = document.getElementById("fileInput");
    element.closest("li").remove(); // Hapus gambar dari daftar
    inputFile.value = ""; // Reset input file
}
