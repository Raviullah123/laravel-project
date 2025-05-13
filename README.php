<?php
session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Bank Management</title>
  <style>
    * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Courier New', Courier, monospace;
}

body {
  background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
  color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  overflow-x: hidden;
  animation: fadeIn 1s ease-in;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

header {
  width: 100%;
  background: rgba(0, 0, 0, 0.85);
  padding: 30px 0;
  text-align: center;
  position: relative;
  box-shadow: 0 4px 20px rgba(0,0,0,0.4);
  backdrop-filter: blur(10px);
  z-index: 1;
  animation: slideDown 0.8s ease-in-out;
}

@keyframes slideDown {
  from { transform: translateY(-50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

header h2 {
  font-size: 2.8rem;
  font-weight: 700;
  letter-spacing: 2px;
  margin-top: 10px;
  color: #00ffff;
  text-shadow: 1px 1px 3px #000;
}

header img {
  width: 65px;
  height: 65px;
  border-radius: 50%;
  object-fit: cover;
  box-shadow: 0 0 15px #00ffff;
  border: 2px solid #00ffff;
  transition: transform 0.3s ease;
}

header img:hover {
  transform: scale(1.1);
}

.sign-in-up {
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  gap: 12px;
}

.sign-in-up button {
  background-color: #00b4d8;
  border: none;
  color: #fff;
  font-weight: bold;
  padding: 10px 22px;
  border-radius: 14px;
  cursor: pointer;
  transition: background 0.3s ease, transform 0.3s ease;
  box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}

.sign-in-up button:hover {
  background: #90e0ef;
  color: #000;
  transform: scale(1.08);
}

.popup-container {
  display: none;
  position: fixed;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.7);
  justify-content: center;
  align-items: center;
  z-index: 10;
  animation: fadeIn 0.4s ease;
}

.popup {
  backdrop-filter: blur(20px);
  background: rgba(255, 255, 255, 0.12);
  padding: 40px 30px;
  border-radius: 16px;
  width: 90%;
  max-width: 400px;
  box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37);
  border: 1px solid rgba(255,255,255,0.2);
  position: relative;
  color: #fff;
  animation: popupIn 0.5s ease-out;
}

@keyframes popupIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}

.popup h2 {
  margin-bottom: 20px;
  text-align: center;
  color: #00ffff;
  font-size: 1.8em;
}

.popup input {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border: none;
  border-radius: 8px;
  font-size: 1em;
  background: rgba(255,255,255,0.2);
  color: #fff;
  transition: background 0.3s;
}

.popup input:focus {
  outline: none;
  background: rgba(255,255,255,0.3);
}

.popup input::placeholder {
  color: #ccc;
}

.popup button[type="submit"] {
  width: 100%;
  padding: 12px;
  background-color: #00b4d8;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1.1em;
  transition: background-color 0.3s, transform 0.3s;
}

.popup button[type="submit"]:hover {
  background-color: #90e0ef;
  color: #000;
  transform: scale(1.03);
}

.popup button.close-btn {
  position: absolute;
  top: 10px;
  right: 15px;
  background: none;
  border: none;
  font-size: 1.5em;
  color: #eee;
  cursor: pointer;
  transition: color 0.2s;
}

.popup button.close-btn:hover {
  color: #ff4d4d;
}

.popup a {
  display: block;
  margin-top: 10px;
  text-align: center;
  color: #00ffff;
  text-decoration: none;
  font-size: 0.95em;
  transition: color 0.3s ease;
}

.popup a:hover {
  color: #90e0ef;
  text-decoration: underline;
}

@media (max-width: 600px) {
  header h2 {
    font-size: 2.2rem;
  }

  .sign-in-up {
    flex-direction: column;
    top: auto;
    bottom: 10px;
    transform: none;
    right: 50%;
    transform: translateX(50%);
  }

  .sign-in-up button {
    width: 140px;
  }
}


  </style>
</head>
<body>

<header>
  <div>
    <img src="image.avif" alt="Logo">
    <h2>BANK MANAGEMENT</h2>
  </div>
  <div class="sign-in-up">
    <button onclick="popup('login-popup')">Login</button>
    <button onclick="popup('register-popup')">Register</button>
  </div>
</header>

<!-- Login Popup -->
<div class="popup-container" id="login-popup">
  <?php include('message.php'); ?>
  <div class="popup">
    <form action="login_register.php" method="POST">
      <h2>User Login</h2>
      <button type="button" class="close-btn" onclick="popup('login-popup')">×</button>
      <input type="text" name="email" placeholder="E-mail or Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit" name="login">Login</button>
      <a href="regester.php">you are not regestered please registered</a>
    </form>
  </div>
</div>

<!-- Register Popup -->
<div class="popup-container" id="register-popup">
  <div class="popup">
    <form action="login_register.php" method="POST">
      <h2>User Register</h2>
      <button type="button" class="close-btn" onclick="popup('register-popup')">×</button>
      <input type="text" name="full_name" placeholder="Full Name" required />
      <input type="text" name="username" placeholder="Username" required />
      <input type="email" name="email" placeholder="E-mail" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit" name="register">Register</button>
      <a href="regester.php">you are allready regestered please login</a>
    </form>
  </div>
</div>

<script>
  function popup(id) {
    const popup = document.getElementById(id);
    popup.style.display = popup.style.display === 'flex' ? 'none' : 'flex';
  }
</script>

</body>
</html>
