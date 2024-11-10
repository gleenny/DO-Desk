<?php include('loginHeader.php'); ?>

<body>
  <div class="container">
    <div class="left">
      <div class="header">
        <img class="animation i1" src="../PICTURE/DoDeskViolet.png" alt="">
        <h2 class="animation a1">Welcome back</h2>
        <h4 class="animation a2">Log in to your account using email and password</h4><br>
      </div>
      <div class="form">
        <form action="../PHP/logincheck.php" method="POST">
          <input type="text" name="username" class="form-field animation a3" placeholder="Username" required><br>
          <input type="password" name="password" class="form-field animation a4" placeholder="Password" required><br>
          <button type="submit" class="animation a6">Login</button>
        </form>
      </div>
    </div>
    <div class="right">
      <a href="https://www.facebook.com/globalcity.sti.edu">
        <img class="animation i1" id="logo" src="../PICTURE/STI GLOBAL LOGO.png" alt="logo of STI">
      </a>
      <h1 class="animation i1">DO DESK</h1>
      <h2 class="animation i1">Disciplinary Officer Management System</h2>

    </div>
  </div>
</body>
</body>

</html>