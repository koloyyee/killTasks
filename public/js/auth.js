"use strict";

function handleOnChange(form) {}

function checkInput(event, form) {
  event.preventDefault();
  console.log(form);
  const name = form.querySelector("#first_name");
  console.log(name.value);
  const formData = new FormData(form);
  for (const [key, value] of formData.entries()) {
    console.log(key, value);
  }
}

export { checkInput };
