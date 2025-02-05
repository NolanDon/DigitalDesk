const signupForm = document.querySelector(".signup");
const errorContainer = document.querySelector(".error-container");

const user_email = document.getElementById("email");
const user_password = document.getElementById("password");
const confirm_password = document.getElementById("password");

function displayError(container, message) {
    container.innerHTML = `
      <div style="margin-top: 20px; border-left: 5px solid red; padding: 15px; background: #ffe6e6; color: #d9534f; border-radius: 5px;">
          <h3 style="margin: 0; font-size: 18px;">⚠️ Error</h3>
          <p>${message}</p>
      </div>
    `;
    setTimeout(() => { container.innerHTML = ""; }, 5000);
  }

// 🔹 Signup Event Listener
signupForm.addEventListener("submit", (event) => {
    event.preventDefault();
  
    let email = user_email.value;
    let password = user_password.value;
    let confirmPass = confirm_password.value;
  
    if (password !== confirmPass) {
      displayError(errorContainer, "⚠️ Passwords do not match. Please try again.");
      return;
    }
  
    firebase.auth().createUserWithEmailAndPassword(email, password)
      .then(() => {
        // ✅ Redirect to homepage after successful signup
        window.location.href = "/";
      })
      .catch((error) => {
        displayError(errorContainer, error.message);
      });
  
    signupForm.reset();
  });
