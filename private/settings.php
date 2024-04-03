<?php
/**
 * Account settings and profile update page.
 */
declare(strict_types=1);
include_once("../service/user.php");
include_once("../utils/convertors.php");
include_once("../partials/options.php");

session_start();


if(strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
  $service = new UserService();
  $user = $service->get_user_by_email($_SESSION['email']);
  if(isset($user)) {
    $first_name = $user->get_first_name();
    $last_name = $user->get_last_name();
    $email = $user->get_email();
    $role = $user->get_role();
    $team = $user->get_team();  
  }
}
?>

<?php include("../partials/header.php") ?>


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Update Account
        </div>
        <div class="card-body">
          <form action="update_account.php" method="post">
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $first_name?> ">
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="text" class="form-control" id="last_name" name="last_name"  value="<?= $last_name?> ">
            </div>
            <!-- <div class="form-group">
              <label for="password">New Password</label>
              <input type="password" class="form-control" id="password" name="password"  >
            </div> -->
            <div class="form-group">
              <label for="role">Role</label>
              <select name="role" class="form-select" id="role">
                    <?php role_options($role) ?>
              </select>
            </div>
            <div class="form-group">
              <label for="team">Team</label>
              <select name="team"  class="form-select" id="team">
                    <?php team_options($team) ?>
              </select>
            </div>

            <button type="submit" class="btn btn-primary mt-1">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("../partials/footer.php") ?>