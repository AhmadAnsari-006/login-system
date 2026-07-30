<?php require '../includes/header.php'; ?>
<?php require '../config/database.php';
  $errors = [];
  if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Validate the email again 
    if(empty($email)) {
      $errors[] = "Email is required.";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors[] = "Please enter a valid email address.";
    }

    // Validate the password 
    if (empty($password)) {
    $errors[] = "Password is required.";
    }

    if (!empty($errors)) {
      echo "<h2>Validation Errors</h2>";
      echo "<ul>";
      foreach ($errors as $error) {
          echo "<li>$error</li>";
      }
      echo "</ul>";
    }else {
      echo "<h2>Validation Passed ✅</h2>";
    }
  }?>

<div class="container">
  <div class="form-container">
    <h2>Login to Your Account</h2>
    <form
      action=""
      method="POST"
      id="loginForm">

      <div class="input-group">
        <label>Email Address</label>
        <input
          type="email"
          name="email"
          id="email"
          placeholder="Enter your email"
          required>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input
            type="password"
            name="password"
            id="password"
            placeholder="Enter password"
            required>
      </div>
      <div class="checkbox">
        <input
          type="checkbox"
          id="showPassword">
        <label for="showPassword">
          Show Password
        </label>
      </div>
      <button type="submit">
        Login
      </button>
      <p class="login-link">
        Don't have an account?
        <a href="register.php">
          Register
        </a>
      </p>
    </form>
  </div>
</div>

<script>
const checkbox = document.getElementById("showPassword");
checkbox.addEventListener("change", () => {
  document.getElementById("password").type =
    checkbox.checked ? "text" : "password";
});
</script>

<?php require '../includes/footer.php'; ?>