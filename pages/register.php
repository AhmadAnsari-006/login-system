<?php //configure whether database file is there or not
  require '../config/database.php';
  if($_SERVER["REQUEST_METHOD"] == "POST"){//POST the user data to database
    $fullName = trim($_POST["full_name"]); //remove spaces a post full name
    $email = trim($_POST["email"]); //remove spaces a post email
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
  }

  $errors = [];// conditions for various kind of errors 
  if(empty($fullName)){
    $errors[] = "Full name is required.";
  }
  if(empty($email)){
      $errors[] = "Email is required.";
  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){//filter var is used to check valid email format
      $errors[] = "Invalid email address.";
  }
  if(strlen($password) < 8){
      $errors[] = "Password must be at least 8 characters.";
  }
  if($password !== $confirmPassword){
      $errors[] = "Passwords do not match.";
  }

  //SQL Commands!! 
  $sql = "SELECT id FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql); //used to prevent sql injection/cyber threats 
  $stmt->bind_param("s", $email); // s means string as we are using for email 
  $stmt->execute();
  $result = $stmt->get_result();
  
  if($result->num_rows > 0){ //check if email already exist or not 
    $errors[] = "Email already registered.";
  }

  $passwordHash = password_hash($password, PASSWORD_DEFAULT); //hashes the password for security 

  if(count($errors) == 0){
    $sql = "INSERT INTO users(full_name,email,password)
            VALUES(?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
      "sss",
      $fullName,
      $email,
      $passwordHash
    );
    if ($stmt->execute()) {
      $success = "Registration Successful!";
    }else{
      $errors[] = "Something went wrong.";
    }
  }
?>


<?php //commmon header file
  include '../includes/header.php'; 
?>

<?php
  if(!empty($errors)){
    foreach ($errors as $error) {
      echo "<p style='color:red;'>$error</p>";
      }
  }
  if(isset($success)){
    echo "<p style='color:green;'>$success</p>";
  }
?>

<div class="container">
  <div class="form-card">
    <h2>Create Account</h2>
      <form id="registerForm" action="" method="POST">
        
        <div class="form-group"><!--FULL NAME-->
          <label>Full Name</label>
          <input
            type="text"
            id="full_name"
            name="full_name"
            placeholder="Enter your full name">
        </div>
        <div class="form-group"><!--EMAIL-->
          <label>Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter your email">
        </div>
        <div class="form-group"><!--PASSWORD-->
          <label>Password</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Create password">
        </div>
        <div class="form-group"><!--CONFIRM PASSWORD-->
          <label>Confirm Password</label>
            <input
              type="password"
              id="confirm_password"
              name="confirm_password"
              placeholder="Confirm password">
            <small class="error" id="confirmPasswordError"></small>
        </div>    
        <div class="checkbox"><!--SHOW PASSWORD CHECKBOX-->
          <input type="checkbox" id="showPassword">
          <label for="showPassword">
            Show Password
          </label>
        </div>

        <button type="submit"><!--SUBMIT BUTTON-->
          Register
        </button>
        <p class="login-link"><!--LOGIN LINK IF ALREADY HAVE AN ACCOUNT-->
          Already have an account?
          <a href="login.php">
            Login
          </a>
        </p>
      </form>
    </div>
</div>

<script src="../assets/js/validation.js"></script>

<?php // common footer file
  include '../includes/footer.php'; 
?>