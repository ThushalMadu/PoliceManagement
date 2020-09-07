<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <script src="https://kit.fontawesome.com/c4e3c7b212.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="style.css" />
  <title>Login & Registration</title>
  <script type="text/javascript">
    function preback() {
      window.history.forward();
    }
    setTimeout("preback()", 0);
    window.onunload = function() {
      null
    };
  </script>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form action="#">
        <h1>Create Account</h1>
        <div class="social-container">
          <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
          <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <span>or use your email for registration</span>
        <input type="text" placeholder="Name" />
        <input type="email" placeholder="Email" />
        <input type="password" placeholder="Password" />
        <button>Sign Up</button>
      </form>
    </div>
    <div class="form-container sign-in-container">
      <form action="lscript.php" method="POST">
        <h1>Sign in</h1>
        <br />
        <br />
        <input type="text" id="user" name="username" placeholder="Officer ID" required />
        <input type="password" id="pass" name="password" placeholder="Pasword" required />
        <a href="#"></a>
        <button type="submit" id="btn" value="login">Sign In</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-right">
          <h1>Hello, Department Officer</h1>
          <p>Enter Details and Login</p>
        </div>
      </div>
    </div>
  </div>
  <script src="main.js"></script>
</body>

</html>
<?php
if (isset($_GET["msg"])) {
  $msg = ($_GET["msg"]);
  if ($msg == "empty") {
    echo '<script>
        alert("Invalid Email or Password!");
    </script>';
  }
  if ($msg == "invalidemail") {
    echo '<script>
        alert("Invalid Email!");
    </script>';
  }
  if ($msg == "sent") {
    echo '<script>
        alert("Sent!");
    </script>';
  }
}
?>