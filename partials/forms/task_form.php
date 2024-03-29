<?php

function create_task(string $uri)
{
  return "
    <form action='$uri' method='POST'>
      <label for='task_name'>Task</label>
      <input type='text' name='task_name' id='task_name' required>
      <label for='task_description'>Description</label>
      <input type='text' name='task_description' id='task_description' required>
      <button type='submit'>Create</button> 
    </form>
  ";
}

function update_task()
{
  return "
    <form action='../service/update'>
      <label for='task'>Task</label>
      <input type='text' name='task' id='task' required>
      <label for='description'>Description</label>
      <input type='text' name='description' id='description' required>
      <button type='submit'>Update</button> 
    </form>
  ";
}
