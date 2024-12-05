<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        @keyframes moveBackground {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 100%;
            }
            100% {
                background-position: 0% 0%;
            }
        }

        body {
            background-image: url('/img/p.jpg'); /* Ganti URL gambar sesuai kebutuhan */
            background-size: 150% 100%;
            background-position: 0% 0%;
            animation: moveBackground 30s ease infinite;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            margin: 0;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.85);
            color: #333;
            max-width: 380px;
            width: 100%;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-header {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            background: linear-gradient(90deg, #ff758c, #ff7eb3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-control {
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ff7eb3, #ff758c);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #ff758c, #ff6a75);
            transform: scale(1.05);
        }

        .login-footer a {
            color: #ff758c;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-footer a:hover {
            color: #ff6a75;
        }

        .alert {
            border-radius: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">Welcome Back!</div>
        <!-- Display error message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="/login" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <!-- Register Link -->
        <div class="login-footer mt-3">
            <p>Don't have an account? <a href="/register">Sign up now</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
