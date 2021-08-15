<!-- edit profile -->
<div class="modal fade" id="Change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Changed Password
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
              <label>Current Password: </label>
              <div class="col-lg-12">
                <input type="password" class="form-control" name="password" id="cpassword" value="<?php echo $rowadm['password_temp'];?>" readonly > 
                <input type="checkbox" value="1" name="reveal" id="reveal" onchange="reveal_pass(this); "> Show Password 

                <script type="text/javascript">

                        function reveal_pass(check_box){

                            var textbox_elem = document.getElementById("cpassword");

                            if(check_box.checked)

                            textbox_elem.setAttribute("type", "text");

                            else

                            textbox_elem.setAttribute("type", "password");

                        }

                        </script>
              </div>
            </div>

            <div class="form-group ">
              <label>New Password: </label>
              <div class="col-lg-12">
                <input type="password" class="form-control" name="password" id="npassword" onkeyup="checkPass(); return false;" required>  
                <span id="confirmMessage" class="confirmMessage"></span>
              </div>
            </div>
         
        </div>
        <div class="modal-footer">
          <input type="submit" name="update_pass" id="btn_update" class="btn btn-success" value="Save changes">
        <!--   <a class="btn btn-primary" href="login.html">Logout</a> -->
        </div>
         </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('cpassword');
    var pass2 = document.getElementById('npassword');

    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "New Password should not be the same as Current Password!"
        $("#btn_update").prop("disabled", true);
    }
    else if ($("#npassword").val().length < 6) 
    {
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "New Password Must be 6 to 15 Characters!"
        $("#btn_update").prop("disabled", true);
    }

    else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "New Password Ok!";
        $("#btn_update").prop("disabled", false);
    }
}  
</script>

<!-- <?php
  //   if(isset($_POST['update_pass']))
  //   {
  //     $id=$_POST['id'];
     
  //     $password=md5($_POST['password']);
  //     $password_temp=$_POST['password'];
     
  //   mysqli_query($conn,"UPDATE tbl_users SET password='$password', password_temp='$password_temp'where id='$id'");


    
  //      echo"
  //         <script type='text/javascript'>
  //         alert('Password Successfully Updated, Please Login Again');
  //         window.location.href = '../logout.php';
  //         </script>
  //       ";
    
  // }

?> -->