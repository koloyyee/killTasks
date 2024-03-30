document.addEventListener("DOMContentLoaded", () => {
  const loginValidate = {
    email: false,
    password: false,
  };
  validateLogin(loginValidate);
});

function validateForm(validate) {
  const buttonDisabled = Object.entries(validate).every(
    (entry) => entry[1] === true
  );
  const submitBtn = document.getElementById("submit");
  submitBtn.disabled = !buttonDisabled;
}

function validateLogin(validate) {
  validateForm(validate);
  const element = document.querySelector("#login_form");
  const inputs = element.querySelectorAll("input");
  inputs.forEach((input) => {
    input.addEventListener("keyup", (event) => {
      const target = event.target;
      const errMsg = target.nextElementSibling;
      switch (target.id) {
        case "email":
          if (!target.value.includes("@")) {
            errMsg.innerHTML = "Email must be valid";
            validate.email = false;
          } else {
            validate.email = true;
            errMsg.innerHTML = "";
            validateForm(validate);
          }
          break;
        case "password":
          if (target.value.length < 1) {
            errMsg.innerHTML = "Cannot be empty";
            validate.password = false;
          } else {
            validate.password = true;
            errMsg.innerHTML = "";
            validateForm(validate);
          }
          break;
        default:
          break;
      }
    });
  });
}
