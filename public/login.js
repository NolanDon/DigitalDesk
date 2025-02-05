const loginForm = document.querySelector(".signin");
const errorContainer = document.querySelector(".error-container");

const user_email = document.getElementById("email");
const user_password = document.getElementById("password");
  
loginForm.addEventListener("submit", (event) => {
  event.preventDefault();

  let email = user_email.value;
  let password = user_password.value;

  firebase
    .auth()
    .signInWithEmailAndPassword(email, password)
    .then((user) => {
      // redirecting to app homepage
      window.location.href = "/";
    })
    .catch(function (error) {
      // Handle Errors here.
      let errorCode = error.code;
      let errorMessage = error.message;
      let parsedError;

      try {
        parsedError = JSON.parse(errorMessage);
      } catch (e) {
        parsedError = { error: { message: "An unknown error occurred." } };
      }

      let errorText = parsedError?.error?.message || "Something went wrong.";
      let friendlyMessage = "";

      // Custom error messages
      if (errorText === "INVALID_LOGIN_CREDENTIALS") {
        friendlyMessage = `
        <div style="margin-top: 10px; border-left: 5px solid red; padding: 15px; background: #ffe6e6; color: #d9534f; border-radius: 5px;">
            <h3 style="margin: 0; font-size: 18px;">⚠️ Login Failed</h3>
            <p>Your email or password is incorrect. Please check your credentials and try again.</p>
        </div>
    `;
      } else {
        friendlyMessage = `
        <div style="border-left: 5px solid orange; padding: 15px; background: #fff3cd; color: #856404; border-radius: 5px;">
            <h3 style="margin: 0; font-size: 18px;">⚠️ Ooops! Something went wrong.</h3>
            <p>${errorText}</p>
        </div>
    `;
      }

      // Display the message in your error container
      errorContainer.innerHTML = friendlyMessage;

      setTimeout(() => {
        errorContainer.innerHTML = ``;
      }, 8000);
    });

  // reset form
  loginForm.reset();
});
