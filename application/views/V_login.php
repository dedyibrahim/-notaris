<body class="bg_login">
<br>
<br>
<br>
<div class="container ">

<div class="row">    
   
<div class="col-md-4 mx-auto " >
<div class='text-center'>
<img style='width:240px;' src='<?php echo base_url('assets/icon.png') ?>'>      
</div>
<label>Username</label>
<input type="text" class="form-control" id="username" placeholder="username . . .">
<label>Password</label>
<input type="password" class="form-control" id="password" placeholder="password . . .">
<br>
<button class="btn btn-md btn-outline-dark btn-block" id="proses_login">Sign in <i class="fa fa-key"></i></button>

</div>    

</div>
</div>

</div>

<div class="mt-5 pt-5">
<div class="row">
<div class="mx-auto">    
    <p class="text-center">App Management Document <br> V.1.0.1</p>
</div>
</div>
</div>   
</body>
<script type="text/javascript">
var callback = function() {
$("#proses_login").attr("disabled", true);

var token    = "<?php echo $this->security->get_csrf_hash() ?>";
var username = $("#username").val();
var password = $("#password").val();

$.ajax({
type:"post",
url:"<?php echo base_url('Login/proses_login') ?>",
data:"token="+token+"&username="+username+"&password="+password,
success:function(data){
var r =JSON.parse(data);

if(r.status == "Berhasil"){
const Toast = Swal.mixin({
toast: true,
position: 'top',
showConfirmButton: false,
timer: 1000,
animation: false,
customClass: 'animated fadeInDown'
});

Toast.fire({
type: 'success',
title: 'Signed in successfully'
}).then(function() {
window.location.href = "<?php echo base_url('Menu'); ?>";
});    

}else{
const Toast = Swal.mixin({
toast: true,
position: 'top',
showConfirmButton: false,
timer: 1000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'The login is invalid.'
})
$('#proses_login').removeAttr("disabled");
}



}
});


};

$(document).keypress(function() {
if (event.which == 13) callback();
});
$('#proses_login').click(callback);   
</script>

<html>


