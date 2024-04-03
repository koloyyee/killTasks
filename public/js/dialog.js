'use strict';
import {toggleDisableBtn } from './auth.js';

const dialog = document.querySelector("#create_task_dialog");
const showButton = document.querySelector("#show_dialog_btn");
const closeButton = document.querySelector("#close_dialog_btn");

// "Show the dialog" button opens the dialog modally
showButton.addEventListener("click", () => {
  dialog.showModal();
});

// "Close" button closes the dialog
closeButton.addEventListener("click", () => {
  dialog.close();
});

  const validate= {
    task_name: false,
    task_description: false,
    category: false,
    team: false,
    start_date: false,
    due_date: false,
  };


function validateInput(elName, validate, message = "Cannot be empty") {
  toggleDisableBtn(validate);
  const element = document.querySelector(elName);
  const inputs = element.querySelectorAll("input");
  const errSpan = document.createElement("span");
  errSpan.classList.add("err_msg");

  inputs.forEach((input) => {
    input.addEventListener("change", (event) => {
      const target = event.target;
      target.parentElement.appendChild(errSpan);

      switch (target.id) {
        case "task_name":
        case "task_description":
        case "team":
        case "category":
        case "start_date":
        case "due_date":
        default:
          if (target.value.trim().length < 1) {
            errSpan.innerHTML = message;
            validate[target.id]= false;
          } else {
            validate[target.id]= true;
            errSpan.innerHTML = "";
            toggleDisableBtn(validate);
          }
          break;
      }
      console.log(validate);
    });
  });
}


const form = document.querySelector(".create_task_form");
form.addEventListener("submit", (event) => {
  event.preventDefault();
  const formData = new FormData(form);
  for(const[key, value] of formData.entries()) {
    console.log(key, value);
  }
  // form.reset();
  // dialog.close();
});

validateInput(".create_task_form", validate);