const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.getElementById("container");

signUpButton.addEventListener("click", () => {
  location.href = "http://localhost/finalviva-hdv2/RegisterForm.php";
});

signInButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});
