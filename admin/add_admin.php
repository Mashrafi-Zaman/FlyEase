<?php include_once '../helpers/helper.php'; ?>
<?php include_once 'header.php'; 
require '../helpers/init_conn_db.php';?>

<style>
 
 @import url(https://fonts.googleapis.com/css?family=Roboto);
fieldset {
  width: 80%;
  margin: 0 auto;
}

input {
  background: none;
  border: 2px solid #31B0D5;
  color: #31B0D5;
  padding: 2px 10px;
  font-size: 18px;
}
input[type=text], input[type=email] {
  border: none;
  border-bottom: 2px solid #31B0D5;
}
input:focus, input:active {
  outline: none;
}
input[type=submit] {
  color: white;
  background-color: #31B0D5;
}

.input-group {
  position: relative;
  display: inline-block;
  width: 80%;
}
.input-group label {
  position: absolute;
  color: #999;
  font-family: "Roboto", sans-serif;
  pointer-events: none;
  transform-origin: 0 0;
  transform: scale(0.9) translateY(100%);
  transition: transform 0.2s linear;
}
.input-group label.animate-label {
  transform: scale(0.6) translateY(0%);
  transition: transform 0.2s linear;
}
.input-group input {
  padding-top: 20px;
  width: 100%;
  box-sizing: border-box;
} 

body {
  background-color: #2b2d33;
  
}
@font-face {
  font-family: 'product sans';
  src: url('assets/css/Product Sans Bold.ttf');
}
h3 {
    text-align: center;
    
    font-family: 'product sans', cursive;      
    font-weight: normal;
    font-size: 55px;
    margin-top: 20px !important;   
}

input {
    
    margin-bottom: 10px;
    border :0px !important;
    border-bottom: 2px solid #838383 !important;
    color :#838383 !important;
    border-radius: 0px !important;
    font-weight: bold !important;
  }
  label {
    color : #838383 !important;      
    font-size: 19px;
  }
.register{
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 60px;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #4e4e4e;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
</style>
<?php
if(isset($_GET['error'])) {
    if($_GET['error'] === 'invalidemail') {
        echo '<script>alert("Invalid email")</script>';
    } else if($_GET['error'] === 'pwdnotmatch') {
        echo '<script>alert("Passwords do not match")</script>';
    } else if($_GET['error'] === 'sqlerror') {
        echo"<script>alert('Database error')</script>";
    } else if($_GET['error'] === 'usernameexists') {
        echo"<script>alert('Username already exists')</script>";
    } else if($_GET['error'] === 'emailexists') {
        echo"<script>alert('Email already exists')</script>";
    }
}
?>

<main>
<div class="container-fluid mt-0 register">
<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-10 register-right">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3 class="register-heading text-secondary">ADMIN REGISTRATION</h3>
                <div class="register-form">
                <form method="POST" action="../includes/admin/register.inc.php">
                    <div class="conrainer-fluid">
                    <div class="row">
                        <div class="col-1 p-0">
                            <i class="fa fa-user text-secondary" 
                                style="float: right;margin-top:35px;"></i>
                        </div>
                        <div class="col-md">
                            <div class="input-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" required />                                
                            </div>  
                        </div>
                        <div class="col-1 p-0 mr-2">
                            <i class="fa fa-envelope text-secondary" 
                                style="float: right;margin-top:35px;"></i>
                        </div>                    
                        <div class="col-md">
                            <div class="input-group">
                                <label for="email_id">Email</label>
                                <input type="text" name="email_id" id="email_id"
                                        required>                                         
                            </div>                                     
                        </div>                        
                    </div>
                    <div class="form-row">
                    <div class="col-1 p-0">
                            <i class="fa fa-lock text-secondary" 
                                style="float: right;margin-top:35px;"></i>
                        </div>                        
                        <div class="col-md">
                            <div class="input-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"            
                                required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one number and one uppercase and lowercase letter,
                                and at least 8 or more characters" />                                        
                            </div>                                     

                        </div>
                        <div class="col-1 p-0 mr-2">
                            <i class="fa fa-lock text-secondary" 
                                style="float: right;margin-top:35px;"></i>
                        </div>                        
                        <div class="col-md">
                            <div class="input-group">
                                <label for="password_repeat">Confirm password</label>
                                <input type="password" name="password_repeat" 
                                    id="password_repeat" required>
                            </div>                                     
                        </div>                                                                                                  
                    </div>
                    <div class="text-center">
                        <button name="signup_submit" type="submit" 
                            class="btn btn-info mt-5">
                            <div style="font-size: 1.5rem;">
                            <i class="fa fa-lg fa-arrow-right"></i> Complete  
                            </div>
                        </button>                            
                    </div>
                    </div>
                </form>
                </div>                        
            </div>
        </div>
    </div> 
    <div class="col-md-1"></div>          
</div>
</div>

<?php include_once 'footer.php'; ?>

<script>
$(document).ready(function(){
  $('.input-group input').focus(function(){
    me = $(this) ;
    $("label[for='"+me.attr('id')+"']").addClass("animate-label");
  }) ;
  $('.input-group input').blur(function(){
    me = $(this) ;
    if ( me.val() == ""){
      $("label[for='"+me.attr('id')+"']").removeClass("animate-label");
    }
  }) ;
  
});    
</script>
 
</main>