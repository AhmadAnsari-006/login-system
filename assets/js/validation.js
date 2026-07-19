const form = document.getElementById("registerForm");
const showPassword = document.getElementById("showPassword");

showPassword.addEventListener("change", () => {//making show password checkbox dynamic 
  const type = showPassword.checked ? "text" : "password";
  document.getElementById("password").type = type;
  document.getElementById("confirm_password").type = type;
}); 

form.addEventListener("submit", function(e){
    
    document.getElementById("nameError").textContent = "";
    document.getElementById("emailError").textContent = "";
    document.getElementById("passwordError").textContent = "";
    document.getElementById("confirmPasswordError").textContent = "";
    
    let valid = true;

    const fullName = document.getElementById("full_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;

    const emailRegex =
      /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(fullName === ""){//CHECK FULL NAME NOT EMPTY
      document.getElementById("nameError").textContent =
          "Full Name is required.";
      valid = false;
    }
    if(!emailRegex.test(email)){//CHECK EMAIL NOT EMPTY
      document.getElementById("emailError").textContent =
        "Please enter a valid email.";
      valid = false;
    }
    if(password.length < 8){//CHECK LENGTH OF PASSWORD
      document.getElementById("passwordError").textContent =
        "Password must contain at least 8 characters.";
      valid = false;
    }
    if(password !== confirmPassword){//CHECKS IF PASSWOD AND CONFIRM PASSWORD SAME 
      document.getElementById("confirmPasswordError").textContent =
        "Passwords do not match.";
       valid = false;
    }

    if(!valid){
        e.preventDefault();//Restricts submission if any condition false
    }
});