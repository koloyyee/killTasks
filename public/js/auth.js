"use strict";
function toggleDisableBtn(validate) {
  const buttonDisabled = Object.entries(validate).every(
    (entry) => entry[1] === true
  );
  const submitBtn = document.getElementById("submit");
  submitBtn.disabled = !buttonDisabled;
}
export { toggleDisableBtn}