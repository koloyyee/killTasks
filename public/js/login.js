import { toggleDisableBtn } from "./auth";
/**
 * Avoid querySelector return null
 * wait for DOM to be full loaded
 */
document.addEventListener("DOMContentLoaded", () => {
  const loginValidate = {
    email: false,
    password: false,
  };
  validateLogin(loginValidate);
});

/**
 *  Validate the login form
 * Listen to onkeyup events on input fields
 *  
 * @param validate Object - @see loginValidate
 */
function validateLogin(validate) {
  toggleDisableBtn(validate);
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
            toggleDisableBtn(validate);
          }
          break;
        case "password":
          if (target.value.length < 1) {
            errMsg.innerHTML = "Cannot be empty";
            validate.password = false;
          } else {
            validate.password = true;
            errMsg.innerHTML = "";
            toggleDisableBtn(validate);
          }
          break;
        default:
          break;
      }
    });
  });
}
