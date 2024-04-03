'use strict';

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
