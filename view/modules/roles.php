<link rel='stylesheet' type='text/css' href='view/modules/vendor/4351/sb-admin.min.css'>
<link rel='stylesheet' type='text/css' href='view/modules/vendor/fontawesome-free/css/all.min.css'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<style>
@media (min-width: 576px){
  .modal-dialog {
    max-width: 610px;
  }
}
.modal-header{
  padding: 1rem 1rem 1rem 0;
}
  .modal-content {
    padding: 0 25px;
  }
  .form-group{
    text-align: left;
    margin-top: 1rem;
    margin-bottom: 1rem;
  }
  .form-group>label {
    display: inline-block;
    margin: 0.5rem 0;
  }

  .form-group>input  {
    display: inline-block;
    float: right;
    width: 75%;
  }
</style>
<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="index.php">Admin Portal</a>

    <h2 style='color: white;' class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <?php echo $_SESSION["first_name"]; echo ' '; echo $_SESSION["last_name"]; ?>
    </h2>

    <!-- Navbar -->
    <div class="navbar-nav ml-auto ml-md-0">
      <img width=30 src="https://image.flaticon.com/icons/svg/172/172163.svg" alt="">
    </div>
      <div>
          <a href="../../logout.php"><i style="font-size: 2em; color:rgba(255,255,255,0.9);margin-left: 15px;" class="fas fa-sign-out-alt"></i></a>
      </div>
  </nav>
  <div id="wrapper">
    <ul class="sidebar navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="../../index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php
          if (isset($_SESSION["roles_id"]) && $_SESSION["roles_id"]=="2")
          {
          ?>

      <li class="nav-item ">
        <a class="nav-link" href=../userdata.php> <i class="fas fa-fw fa-folder"></i>
          <span>Users</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href=../roledata.php> <i class="fas fa-fw fa-chart-area"></i>
          <span>Roles</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../linkdata.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Links</span></a>
      </li>
      <?php
          }
          ?>
        <style>
            .btn-hov:hover{
                color: rgba(255,255,255,.75) !important;
            }
            .btn-hov:focus{
                box-shadow: none;
            }
            .btn-hov:focus, .btn-hov:not(:disabled):not(.disabled):active
            ,.btn-hov:not(:disabled):not(.disabled):active:focus{
                box-shadow: none;
            }
            #editmodal1 .form-group > input{
                width: 55%;
            }
            #editmodal1 .modal-dialog{
                margin-top: 6%;
            }
        </style>
        <li class="nav-item">
            <button style="background-color:transparent;border: none;color: rgba(255,255,255,.5);"
                    class="btn btn-primary editbtn1 btn-hov" data-toggle="modal" data-target="#editmodal1">
                <i class="fas fa-key"></i>
                <span>Change Password</span>
            </button>
        </li>
    </ul>
    <div id="content-wrapper">

      <div class="container-fluid" style='text-align: center; width: 80%;'>
        <table class='table table-striped table-sm' border="1" align="center" style="line-height:25px;">
          <tr>
            <th>Role ID</th>
            <th>Role Name</th>
            <th>Action</th>
          </tr>
          <?php
                $item = null;
                $value = null;
                $roles = new RolesController();
                $roles= RolesController::ctrShowRoles($item, $value);

                foreach($roles as $key => $value) {
                    ?>
          <tr>
            <td><?php echo $value["roles_id"]; ?></td>
            <td><?php echo $value["roles_name"]; ?></td>
            <td>
                <i  style='cursor: pointer; margin: 0 10px;' class='fas fa-edit editbtn' data-toggle="modal" data-target="#editmodal"></i>
                <i  style='cursor: pointer; margin: 0 10px;' class='fas fa-trash deletebtn' data-toggle="modal" data-target="#deletemodal"></i>

            </td>
          </tr>
          <?php
                }
                ?>
                <div class="">
                  <h2 style='float: left;'>Role Details</h2>
                  <button style='float: right;' type="button" class="btn btn-default addbttn" data-toggle="modal" data-target="#addmodal">
                    <i style='font-size: 2em;'class='fas fa-plus-square'></i>
                  </button>

                </div>

        </table>
        <!-- ADD POP UP FORM (Bootstrap MODAL) -->
        <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Roles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" method="POST">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="editUserID">Role Name</label>
                    <input type="text" class="form-control" name="newRolesName" id="role_id">
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                <?php
                            $addRole = new RolesController();
                            $addRole -> ctrCreateRole();
                            ?>
              </form>
            </div>
          </div>
        </div>

        <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Roles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" method="POST">
                <div class="form-group">
                  <label for="editRolesID">User ID</label>
                  <input type="text" class="form-control" name="editRolesID" id="roles_id" readonly>
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="editRolesName">Role Name</label>
                    <input type="text" class="form-control" name="editRolesName" id="roles_name">
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                <?php
                            $editRole = new RolesController();
                            $editRole -> ctrEditRoles();
                            ?>
              </form>
            </div>
          </div>
        </div>

        <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" method="POST">
                <div class="form-group">
                  <label for="deleteRolesID">User ID</label>
                  <input type="text" class="form-control" name="deleteRolesID" id="roles_id1" readonly>
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="deleteRolesName">Role Name</label>
                    <input type="text" class="form-control" name="deleteRolesName" id="roles_name1" readonly>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                <?php
                            $deleteRole = new RolesController();
                            $deleteRole -> ctrDeleteRoles();
                            ?>
              </form>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</body>
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST">
                <div class="form-group">
                    <label for="oldPassword">Old Password</label>
                    <input type="password" class="form-control" name="oldPassword" id="oldpass" required>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="editPassword">New Password</label>
                        <input type="password" class="form-control" name="editPassword" id="editpass" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="editPasswordConf">Confirm New Password</label>
                        <input type="password" class="form-control" name="editPasswordConf" id="editpassConf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                <?php
                $editPassword = new UserController();
                $editPassword -> ctrChangePassword();
                #$editLinks = new LinksController();
                #$editLinks -> ctrEditLinks();
                ?>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editmodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST">
                <div class="form-group">
                    <label for="oldPassword">Old Password</label>
                    <input type="password" class="form-control" name="oldPassword" id="oldpass" required>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="editPassword">New Password</label>
                        <input type="password" class="form-control" name="editPassword" id="editpass" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="editPasswordConf">Confirm New Password</label>
                        <input type="password" class="form-control" name="editPasswordConf" id="editpassConf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                <?php
                $editPassword = new UserController();
                $editPassword -> ctrChangePassword();
                #$editLinks = new LinksController();
                #$editLinks -> ctrEditLinks();
                ?>
            </form>
        </div>
    </div>
</div>

<script>
    var password = document.getElementById("editpass")
        , confirm_password = document.getElementById("editpassConf");

    function validatePassword(){
        if(password.value != confirm_password.value){
            confirm_password.setCustomValidity("New passwords don't Match");
        } else{
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

<script>
    var password = document.getElementById("editpass")
        , confirm_password = document.getElementById("editpassConf");

    function validatePassword(){
        if(password.value != confirm_password.value){
            confirm_password.setCustomValidity("New passwords don't Match");
        } else{
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<!-- Script to autofill information into the form when clicking the edit button -->
<script>
  $(document).ready(function() {
    $('.editbtn').on('click', function() {
      $('#editmodal').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#roles_id').val(data[0]);
      $('#roles_name').val(data[1]);
    });
  });
</script>
<script>
  $('.deletebtn').on('click', function() {
    $('#deletemodal').modal('show');
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();

    console.log(data);
    $('#roles_id1').val(data[0]);
    $('#roles_name1').val(data[1]);
  });
</script>
