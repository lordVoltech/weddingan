<?php
session_start();

if (isset($_SESSION['error_message'])) {
    echo '<div style="
            background-color: #f8d7da; 
            color: #721c24; 
            padding: 15px 20px; 
            border: 1px solid #f5c6cb; 
            margin-bottom: 20px; 
            position: fixed; 
            top: 20px; 
            left: 50%; 
            transform: translateX(-50%);
            z-index: 1000;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            min-width: 300px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
          ">
            <span style="flex-grow:1; text-align: center;">' . $_SESSION['error_message'] . '</span>
            <span style="
                cursor: pointer;
                margin-left: 10px;
                font-weight: bold;
                color: #721c24;
                font-size: 18px;
            " onclick="this.parentElement.style.display=\'none\'">&times;</span>
          </div>';
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    echo '<div style="
            background-color: #d4edda;
            color: #155724;
            padding: 10px 20px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            min-width: 300px;
            text-align: center;
          ">
            <span>' . $_SESSION['success_message'] . '</span>
            <span style="
                position: absolute;
                top: 5px;
                right: 10px;
                background: none;
                border: none;
                font-weight: bold;
                color: #155724;
                font-size: 16px;
                cursor: pointer;" 
                onclick="this.parentElement.style.display=\'none\'">×</span>
          </div>';
    unset($_SESSION['success_message']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NUVA - Register</title>
  <link rel="stylesheet" href="style.css"> <!-- Pastikan sama kayak login ya sayang -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="session">
    <div class="left">
        <svg enable-background="new 0 0 300 302.5" version="1.1" viewBox="0 0 300 302.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
        <style type="text/css">
          .st01{fill:#fff;}
        </style>
              <path class="st01" d="m126 302.2c-2.3 0.7-5.7 0.2-7.7-1.2l-105-71.6c-2-1.3-3.7-4.4-3.9-6.7l-9.4-126.7c-0.2-2.4 1.1-5.6 2.8-7.2l93.2-86.4c1.7-1.6 5.1-2.6 7.4-2.3l125.6 18.9c2.3 0.4 5.2 2.3 6.4 4.4l63.5 110.1c1.2 2 1.4 5.5 0.6 7.7l-46.4 118.3c-0.9 2.2-3.4 4.6-5.7 5.3l-121.4 37.4zm63.4-102.7c2.3-0.7 4.8-3.1 5.7-5.3l19.9-50.8c0.9-2.2 0.6-5.7-0.6-7.7l-27.3-47.3c-1.2-2-4.1-4-6.4-4.4l-53.9-8c-2.3-0.4-5.7 0.7-7.4 2.3l-40 37.1c-1.7 1.6-3 4.9-2.8 7.2l4.1 54.4c0.2 2.4 1.9 5.4 3.9 6.7l45.1 30.8c2 1.3 5.4 1.9 7.7 1.2l52-16.2z"/>
        </svg>      
    </div>

    <?php
    $emailValue = isset($_SESSION['old_email']) ? $_SESSION['old_email'] : '';
    unset($_SESSION['old_email']); 
    ?>


    <form action="register.php" method="POST" class="log-in" autocomplete="off">
      <h4>Join <span>NUVA</span></h4>
      <p>Create your account to get started:</p>

      <div class="floating-label">
      <input placeholder="Email" type="email" name="email" required value="<?= htmlspecialchars($emailValue) ?>" required>
      <label for="email">Email:</label>
      </div>

      <div class="floating-label">
        <input placeholder="Password" type="password" name="password" id="password" required>
        <label for="password">Password:</label>
      </div>

      <div class="floating-label">
        <input placeholder="Confirm Password" type="password" name="repeat_password" id="repeat_password" required>
        <label for="repeat_password">Confirm Password:</label>
      </div>

      <button type="submit">Register</button>

      <p class="register-link">
        Already have an account? <a href="index.php">Log in</a>
      </p>
    </form>
  </div>
</body>
</html>
