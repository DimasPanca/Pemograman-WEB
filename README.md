<?php

session_start();

$errors = [];
$form_data = [];

// 3. Logika saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan bersihkan data dari form
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Simpan data untuk ditampilkan kembali jika ada error
    $form_data['username'] = $username;
    $form_data['email'] = $email;

    // 4. Validasi Sederhana
    if (empty($username)) {
        $errors[] = "Username tidak boleh kosong.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password harus memiliki minimal 8 karakter.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Konfirmasi password tidak cocok.";
    }

    // 5. Jika tidak ada error, proses pendaftaran
    if (empty($errors)) {
        // Karena tidak ada database, kita hanya simulasi
        // Simpan pesan sukses di session
        $_SESSION['registration_success'] = "Akun untuk <strong>" . htmlspecialchars($username) . "</strong> berhasil didaftarkan!";
        
        // Redirect ke halaman yang sama untuk menampilkan pesan sukses
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// === AKHIR LOGIKA PHP ===
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            max-width: 450px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card h2 {
            margin: 0 0 30px 0;
            color: #2c3a47;
            font-weight: 600;
        }

        /* Tampilan untuk pesan error */
        .error-container {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            text-align: left;
            font-size: 14px;
        }
        .error-container ul {
            margin: 0;
            padding-left: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
            position: relative;
        }
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-size: 14px;
        }
        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        .input-group input:focus {
            outline: none;
            border-color: #4a69bd;
            box-shadow: 0 0 10px rgba(74, 105, 189, 0.15);
        }

        /* Password Strength Meter */
        .password-strength {
            height: 5px;
            width: 0%;
            background-color: #e74c3c; /* Merah (lemah) */
            border-radius: 5px;
            margin-top: 8px;
            transition: width 0.3s ease, background-color 0.3s ease;
        }
        #strength-text {
            margin-top: 5px;
            font-size: 12px;
            color: #777;
        }
        
        /* Pesan konfirmasi password */
        #confirm-message {
            margin-top: 5px;
            font-size: 12px;
        }
        .match { color: #27ae60; }
        .no-match { color: #c0392b; }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #4a69bd 0%, #6a89cc 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover {
            box-shadow: 0 5px 15px rgba(74, 105, 189, 0.4);
            transform: translateY(-3px);
        }

        /* Tampilan untuk halaman sukses */
        .success-card {
            text-align: center;
        }
        .success-icon {
            font-size: 60px;
            color: #2ecc71;
            margin-bottom: 20px;
        }
        .success-card p {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .success-card a {
            text-decoration: none;
            color: #4a69bd;
            font-weight: 600;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <?php 
            // Cek apakah ada pesan sukses di session
            if (isset($_SESSION['registration_success'])): 
            ?>
                <div class="success-card">
                    <div class="success-icon">&#10004;</div>
                    <h2>Pendaftaran Berhasil!</h2>
                    <p><?= $_SESSION['registration_success']; ?></p>
                    <a href="#">Kembali ke Halaman Login</a>
                </div>
            <?php 
                // Hapus pesan dari session agar tidak muncul lagi
                unset($_SESSION['registration_success']);
            else: 
            ?>
                <h2>Buat Akun Baru</h2>

                <?php if (!empty($errors)): ?>
                    <div class="error-container">
                        <strong>Terjadi Kesalahan:</strong>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?= htmlspecialchars($form_data['username'] ?? ''); ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($form_data['email'] ?? ''); ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        <div class="password-strength" id="strength-bar"></div>
                        <p id="strength-text"></p>
                    </div>
                    <div class="input-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <p id="confirm-message"></p>
                    </div>
                    <button type="submit">Daftar Sekarang</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const strengthBar = document.getElementById('strength-bar');
        const strengthText = document.getElementById('strength-text');
        const confirmMessage = document.getElementById('confirm-message');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let text = 'Lemah';
            let color = '#e74c3c'; // Merah

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            switch (strength) {
                case 1:
                case 2:
                    break; // Tetap lemah
                case 3:
                    text = 'Sedang';
                    color = '#f1c40f'; // Kuning
                    break;
                case 4:
                    text = 'Kuat';
                    color = '#27ae60'; // Hijau
                    break;
                case 5:
                    text = 'Sangat Kuat';
                    color = '#2980b9'; // Biru
                    break;
            }

            strengthBar.style.width = (strength * 20) + '%';
            strengthBar.style.backgroundColor = color;
            strengthText.textContent = 'Kekuatan: ' + text;
        });

        function validatePasswordConfirmation() {
            if (confirmPasswordInput.value === '') {
                confirmMessage.textContent = '';
            } else if (passwordInput.value === confirmPasswordInput.value) {
                confirmMessage.textContent = '✔ Password cocok!';
                confirmMessage.className = 'match';
            } else {
                confirmMessage.textContent = '✖ Password tidak cocok!';
                confirmMessage.className = 'no-match';
            }
        }
        
        passwordInput.addEventListener('input', validatePasswordConfirmation);
        confirmPasswordInput.addEventListener('input', validatePasswordConfirmation);
    </script>
</body>
</html>
