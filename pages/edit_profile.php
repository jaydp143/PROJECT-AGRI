
<!-- edit profile -->
<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile Settings
          </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" class="form-horizontal" id="form" role="form" name="form_validation" onsubmit='return validateForm();' >

            <div class="form-group ">
                <input type="hidden" readonly class="form-control" name="id" id="user_id" value="<?php echo $rowadm['id'];?>" >  
            </div>

            <div class="form-group ">
              <label>Userlevel: </label>
              <div class="col-lg-12">
                <input type="text" readonly class="form-control" name="userlevel" id="userlevel_id" value="<?php echo $rowadm['userlevel'];?>" >  
              </div>
            </div>

            <div class="form-group ">
              <label>Username: </label>
              <div class="col-lg-12">
                <input type="text" readonly class="form-control" name="username" id="username_id" value="<?php echo $rowadm['username'];?>" >  
              </div>
            </div>

            <div class="form-group ">
              <label>Firstname: </label>
              <div class="col-lg-12">
                <input type="text"  class="form-control" name="firstname" id="firstname_id" value="<?php echo $rowadm['firstname'];?>">  
              </div>
            </div>


            <div class="form-group ">
              <label>Middlename: </label>
              <div class="col-lg-12">
                <input type="text"  class="form-control" name="middlename" id="username_id" value="<?php echo $rowadm['middlename'];?>">  
              </div>
            </div>

            <div class="form-group ">
              <label>Lastname: </label>
              <div class="col-lg-12">
                <input type="text"  class="form-control" name="lastname" id="username_id" value="<?php echo $rowadm['lastname'];?>">  
              </div>
            </div>

            <div class="form-group ">
              <label>Contact Number: </label>
              <div class="col-lg-12">
                <input type="text"  class="form-control" name="contact_no" id="username_id" maxlength="11" value="<?php echo $rowadm['contact_no'];?>">  
              </div>
            </div>

            <div class="form-group ">
              <label>Email: </label>
              <div class="col-lg-12">
                <input type="email"  class="form-control" name="email" id="username_id" value="<?php echo $rowadm['email'];?>" >  
              </div>
            </div>
            
         
        </div>
        <div class="modal-footer">
          <input type="submit" name="update_user" class="btn btn-success" value="Save changes">
        <!--   <a class="btn btn-primary" href="login.html">Logout</a> -->
        </div>
         </form>
      </div>
    </div>
  </div>