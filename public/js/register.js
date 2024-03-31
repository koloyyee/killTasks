import { toggleDisableBtn } from "./auth.js";

document.addEventListener("DOMContentLoaded", (event) => {
    const registerValidate = {
      first_name: false,
      last_name: false,
      email: false,
      password: false,
    };
      validateRegister(registerValidate);
});
function validateRegister(validate) {
  toggleDisableBtn(validate);
  const element = document.querySelector("#register_form");
  const inputs = element.querySelectorAll("input");
  inputs.forEach((input) => {
    input.addEventListener("keyup", (event) => {
      const target = event.target;
      const errMsg = target.nextElementSibling;
      switch (target.id) {
        case "first_name":
          if (target.value.length < 1) {
            errMsg.innerHTML = "Name must be at least 2 characters";
            validate.first_name = false;
          } else {
            validate.first_name = true;
            errMsg.innerHTML = "";
            toggleDisableBtn(validate);
          }
          break;
        case "last_name":
          if (target.value.length < 2) {
            errMsg.innerHTML = "Name must be at least 2 characters";
            validate.last_name = false;
          } else {
            validate.last_name = true;
            errMsg.innerHTML = "";
            toggleDisableBtn(validate);
          }
          break;
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
          if (target.value.length < 8) {
            errMsg.innerHTML = "Password must be at least 8 characters";
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
