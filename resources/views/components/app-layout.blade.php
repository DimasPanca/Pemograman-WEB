<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Mahasiswa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa; /* Latar belakang abu-abu muda */
        }
    </style>
</head>

<body>
    <main class="container py-5">
        
        <div class="text-center mb-5">
            <h1 class="display-4 text-dark">Input Biodata Mahasiswa</h1>
            <p class="lead text-muted">Contoh aplikasi CRUD sederhana dengan Laravel & Bootstrap</p>
        </div>

        {{ $slot }}

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const bioForm = document.getElementById('bio-form');
            const tableBody = document.getElementById('data-table-body');
            
            if (bioForm && tableBody) {
                bioForm.addEventListener('submit', function (event) {
                    event.preventDefault(); 

                    const nama = document.getElementById('inputNama').value;
                    const nim = document.getElementById('inputNIM').value;
                    const email = document.getElementById('inputEmail').value;

                    const newRowNumber = tableBody.getElementsByTagName('tr').length + 1;

                    const newRow = tableBody.insertRow();
                    newRow.className = "align-middle";

                    const cellNomor = newRow.insertCell(0);
                    const cellNama = newRow.insertCell(1);
                    const cellNIM = newRow.insertCell(2);
                    const cellEmail = newRow.insertCell(3);

                    cellNomor.innerHTML = `<th scope="row">${newRowNumber}</th>`; 
                    cellNama.textContent = nama;
                    cellNIM.textContent = nim;
                    cellEmail.textContent = email;

                    bioForm.reset();
                });
            } else {
                console.error('Form atau Table Body tidak ditemukan. Cek ID Anda.');
            }

        });
    </script>

</body>
</html>