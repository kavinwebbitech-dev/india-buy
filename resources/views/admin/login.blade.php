<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('{{ asset('asset/images/new-images/about-bg.webp') }}') no-repeat center center;
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        /* Soft overlay */
        body::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 60, 100, 0.35);
            backdrop-filter: blur(1px);
            z-index: 0;
        }

        /* Login Box */
        .login-box {     
            width: 400px;
            padding: 50px 40px;
            border-radius: 22px;

            background: linear-gradient(135deg,
                    rgba(255, 255, 255, 0.25),
                    rgba(180, 220, 255, 0.25));

            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);

            border: 1px solid rgba(255, 255, 255, 0.35);

            box-shadow: 0 20px 50px rgba(0, 80, 120, 0.25);

            animation: fadeUp 0.8s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h4 {
            color: #0f172a;
            font-weight: 700;
            letter-spacing: 1px;
        }

        label {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 120, 200, 0.2);
            color: #0f172a;
            padding: 12px;
            transition: 0.3s ease;
        }

        .form-control:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.25);
        }

        /* Password wrapper */
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #0ea5e9;
            font-size: 18px;
        }

        /* Button */
        .btn-primary {
            border-radius: 12px;
            font-weight: 600;
            padding: 12px;
            border: none;
            background: linear-gradient(45deg, #0ea5e9, #0284c7);
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.4);
        }

        .alert {
            border-radius: 12px;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('{{ asset('asset/images/new-images/about-bg.webp') }}') no-repeat center center;
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        /* Dark overlay */
        body::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 60, 100, 0.35);
            backdrop-filter: blur(1px);
            z-index: 0;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%;
            height: 180px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 45%;
            animation: waveMove 10s linear infinite;
            z-index: 0;
        }

        .wave2 {
            bottom: 0;
            animation: waveMoveReverse 14s linear infinite;
            opacity: 0.5;
        }

        @keyframes waveMove {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes waveMoveReverse {
            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <div class="wave"></div>
    <div class="wave wave2"></div>
    <div class="login-box">
        <h4 class="text-center mb-4">Admin Login</h4>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email address" required>
            </div>

            <div class="mb-3 password-wrapper">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control pe-5" placeholder="Password"
                    required>
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

</body>

</html>
