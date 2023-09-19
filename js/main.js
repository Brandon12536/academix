function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var showPasswordIcon = document.querySelector(".show-password");
  
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      showPasswordIcon.innerHTML = "&#128064;";
    } else {
      passwordInput.type = "password";
      showPasswordIcon.innerHTML = "&#128065;";
    }
  }