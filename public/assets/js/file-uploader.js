document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const menuListContainer = document.getElementById('menuListContainer');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const menuList = document.getElementById('menuList');

            // Membuat elemen daftar baru untuk menampilkan gambar
            const listItem = document.createElement('li');
            listItem.style.display = 'flex';
            listItem.style.alignItems = 'center';
            listItem.style.marginBottom = '10px';

            listItem.innerHTML = `
                <div style="margin-right: 10px;">
                    <img src="${e.target.result}" alt="Menu Image" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;" />
                </div>
                <div style="flex-grow: 1; overflow: hidden;">
                    <h2 style="font-size: 14px; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${file.name}</h2>
                    <h3 style="font-size: 12px; color: #888; margin: 0;">${(file.size / 1024).toFixed(2)} KB</h3>
                </div>
                <a href="javascript:void(0);" onclick="removeImage(this)" style="color: #ff6b6b; font-weight: bold; margin-left: 10px; cursor: pointer;">x</a>
            `;

            menuList.appendChild(listItem);

            // Setelah file di-upload, tambahkan border ke container
            menuListContainer.classList.add('has-image');

            // Mengubah padding dan border untuk container sesuai dengan kelas 'has-image'
            menuListContainer.style.padding = '15px 12.5px 0px 12.5px';
            menuListContainer.style.marginBottom = '2.25rem';
            menuListContainer.style.border = '1px solid rgba(145, 158, 171, .32)';
            menuListContainer.style.borderRadius = '5px';
        };
        reader.readAsDataURL(file);
    }
});

function removeImage(element) {
    const menuListContainer = document.getElementById('menuListContainer');
    const inputFile = document.getElementById('fileInput');

    const listItem = element.closest('li');
    listItem.remove(); // Menghapus gambar dan tombol X

    // Jika tidak ada gambar dalam daftar, sembunyikan container
    if (document.querySelectorAll('#menuList li').length === 0) {
        menuListContainer.classList.remove('has-image');
        menuListContainer.style.display = 'none';  // Sembunyikan container

        // Reset input file ke kosong
        inputFile.value = '';
        document.getElementById('fileName').innerText = 'Drag and drop a file to upload';

        // Menghapus gaya dari container jika tidak ada gambar
        menuListContainer.style.padding = '0';
        menuListContainer.style.marginBottom = '0';
        menuListContainer.style.border = 'none';
    }
}
