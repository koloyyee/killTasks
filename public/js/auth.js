"use strict";
console.log("auth.js is connected");
const registerValidate = {
  first_name: false,
  last_name: false,
  email: false,
  password: false,
};
const loginValidate = {
  email: false,
};
export { validateRegister, validateLogin}