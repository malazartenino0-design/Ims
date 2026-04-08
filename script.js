// Wait until the page loads
document.addEventListener("DOMContentLoaded", () => {
  const registerForm = document.getElementById("registerForm");
  const loginForm = document.getElementById("loginForm");

  if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
      const email = this.email.value.trim();
      const password = this.password.value.trim();

      if (!email || !password) {
        alert("Please fill out all fields.");
        e.preventDefault(); // Stop form submission
      } else if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        e.preventDefault();
      }
    });
  }

  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      const email = this.email.value.trim();
      const password = this.password.value.trim();

      if (!email || !password) {
        alert("Please fill out all fields.");
        e.preventDefault();
      }
    });
  }
});
