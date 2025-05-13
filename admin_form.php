<?php
$error = "";
$success = "";

// DB connection
$conn = mysqli_connect("localhost", "root", "", "testing");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id'] ?? '');

    // Allow only 1 admin
    $check = mysqli_query($conn, "SELECT * FROM admin LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        header('location:admin_login.php');
    } else {
        $insert = mysqli_query($conn, "INSERT INTO admin (username, admin_id) VALUES ('$username', '$admin_id')");
        if ($insert) {
            header("Location: admin_login.php");
            exit;
        } else {
            $error = "Insert failed: " . mysqli_error($conn);
        }
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background 0.4s ease-in-out;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 255, 255, 0.2);
            width: 100%;
            max-width: 420px;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #00ffe7;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        label {
            color: #dce3ea;
            margin-bottom: 5px;
            display: block;
            font-weight: 500;
        }

        .form-control {
            background-color: rgba(44, 62, 80, 0.9);
            border: none;
            color: #ecf0f1;
            width: 100%;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #2c3e50;
            color: #fff;
            box-shadow: 0 0 10px #00ffe7;
            outline: none;
        }

        .btn-custom {
            background: linear-gradient(90deg, #00ffe7, #00bfa5);
            color: #101820;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
        }

        .btn-custom:hover {
            background: linear-gradient(90deg, #00bfa5, #00796b);
            color: #fff;
            transform: scale(1.03);
        }

        .alert {
            font-size: 14px;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .btn-primary {
            background-color: transparent;
            border: 1px solid #00ffe7;
            color: #00ffe7;
            font-weight: 500;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #00ffe7;
            color: #101820;
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 30px 20px;
                border-radius: 12px;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
<div class="login-box">
    <a href="sticky.php" class="btn btn-primary">← Go Back</a>
    <h2>Insert Admin</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form action="admin_form.php" method="POST">
        <div class="mb-3">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Admin ID:</label>
            <input type="text" name="admin_id" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-custom">Insert Admin</button>
    </form>
</div>
</body>
</html>
