<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bank Management Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #f0f0f0;
      min-height: 100vh;
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .go-back {
      background: linear-gradient(90deg, #00ffe7, #00bfa5);
      color: #101820;
      padding: 10px 20px;
      margin-bottom: 20px;
      border-radius: 8px;
      font-weight: bold;
      text-decoration: none;
      transition: all 0.3s ease;
      align-self: flex-start;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
    }

    .go-back:hover {
      background: linear-gradient(90deg, #00bfa5, #00ffe7);
      transform: translateY(-3px);
      color: #fff;
    }

    header h1 {
      font-size: 2.5rem;
      color: #00ffe7;
      margin-bottom: 30px;
      text-shadow: 0 0 8px #00ffe7;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      width: 100%;
      max-width: 1200px;
    }

    .box {
      height: 160px;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.4s ease;
      overflow: hidden;
      position: relative;
    }

    .box:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 40px rgba(0, 255, 255, 0.4);
    }

    .box::before {
      content: '';
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      opacity: 0.25;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      transition: opacity 0.3s;
    }

    .box a {
      z-index: 1;
      color: #ffffff;
      font-size: 20px;
      font-weight: 600;
      text-decoration: none;
      text-shadow: 0 0 8px #00ffe7;
      padding: 10px 20px;
      border-radius: 8px;
      background-color: rgba(0, 255, 231, 0.08);
      backdrop-filter: blur(2px);
      transition: background 0.3s, color 0.3s;
    }

    .box a:hover {
      background-color: rgba(0, 255, 231, 0.3);
      color: #00ffe7;
    }

    /* Assigning images using nth-child instead of inline style */
    .box:nth-child(1)::before { background-image: url('dashboard.png'); }
    .box:nth-child(2)::before { background-image: url('withdraw.jpeg'); }
    .box:nth-child(3)::before { background-image: url('deposite.jpg'); }
    .box:nth-child(4)::before { background-image: url('account.webp'); }
    .box:nth-child(5)::before { background-image: url('transaction.jpg'); }
    .box:nth-child(6)::before { background-image: url('information.jpeg'); }
    .box:nth-child(7)::before { background-image: url('feedback.jpeg'); }
    .box:nth-child(8)::before { background-image: url('message.png'); }

    @media (max-width: 768px) {
      header h1 {
        font-size: 1.8rem;
      }

      .box a {
        font-size: 16px;
      }
    }
  </style>
</head>

<body>

  <a href="admin_login.php" class="go-back">← Go Back</a>

  <header>
    <h1>Bank Management Dashboard</h1>
  </header>

  <div class="container">
    <div class="box"><a href="transaction.php">Dashboard</a></div>
    <div class="box"><a href="withdrawfetch1.php">Withdraw</a></div>
    <div class="box"><a href="depositefetch1.php">Deposit</a></div>
    <div class="box"><a href="Account.php">Accounts</a></div>
    <div class="box"><a href="depositeinformation.php">Deposit Info</a></div>
    <div class="box"><a href="withdrawinformation.php">Withdraw Info</a></div>
    <div class="box"><a href="feeddback.php">Submit Feedback</a></div>
    <div class="box"><a href="feedbackmessage.php">View Feedback</a></div>
  </div>

</body>
</html>
