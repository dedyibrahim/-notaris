<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <button class="btn btn-success" id="menu-toggle"><span id="z" class="fa fa-chevron-left"> </span> Menu</button>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
    
<form class="input-group col-md-6 mx-auto" id="adv-search" action="<?php echo base_url('User2/cari_file') ?>" method="post" >        
<input type="hidden" class="form-control" name="<?php echo  $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" />
<input type="text" class="form-control" name="cari_dokumen" id="pencarian_nama_dokumen" placeholder="Cari File Dokumen" />
<div class="btn-group" role="group">
<button type="submit" style="padding: 0.63rem 0.75rem;" type="button" class="btn btn-dark"><span class="fa fa-search" aria-hidden="true"></span></button>
</div>

</form>
<style>
.dropdown.dropdown-lg .dropdown-menu {
    margin-top: -1px;
    padding: 6px 20px;
}
.input-group-btn .btn-group {
    display: flex !important;
}
.btn-group .btn {
    border-radius: 0;
    margin-left: -1px;
}
.btn-group .btn:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}
.btn-group .form-horizontal .btn[type="submit"] {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.form-horizontal .form-group {
    margin-left: 0;
    margin-right: 0;
}
.form-group .form-control:last-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

@media screen and (min-width: 768px) {
    #adv-search {
        width: 500px;
        margin: 0 auto;
    }
    .dropdown.dropdown-lg {
        position: static !important;
    }
    .dropdown.dropdown-lg .dropdown-menu {
        min-width: 600px;
    }
}
    </style>
    
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
<li class="nav-item active">
<a class="nav-link" href="<?php echo base_url() ?>">Beranda <span class="fa fa-home "></span></a>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Pilihan
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="<?php echo base_url('User2/profil') ?>">Profil</a>
<a class="dropdown-item" href="<?php echo base_url('User2/riwayat_pekerjaan') ?>">Histori pekerjaan</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="<?php echo base_url('User2/keluar') ?>">Keluar</a>
</div>
</li>
</ul>
</div>
</nav>


<div class="container-fluid">
<div class="row">
    
    
<div class="col-md-4 "><a href="<?php echo base_url('User2/pekerjaan_antrian') ?>">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="	fa fa-hourglass-start float-right fa-3x sticky-top"></span>
In <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Pekerjaan Masuk  <div class="float-right">
<?php echo $this->db->get_where('data_pekerjaan',array('no_user'=>$this->session->userdata('no_user'),'status_pekerjaan'=>"Masuk" ))->num_rows(); ?>   
   
</div></div>
</div></a>	
</div>	


<div class="col-md-4  "><a href="<?php echo base_url('User2/pekerjaan_proses') ?>">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-hourglass-half float-right fa-3x sticky-top"></span>
Proses <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Pekerjaan Dikerjakan
<div class="float-right">
<?php echo $this->db->get_where('data_pekerjaan',array('no_user'=>$this->session->userdata('no_user'),'status_pekerjaan'=>"Proses" ))->num_rows(); ?>   
    
</div>
</div>
</div>	</a>
</div>

<div class="col-md-4 "><a href="<?php echo base_url('User2/pekerjaan_selesai') ?>">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-hourglass-end float-right fa-3x sticky-top"></span>
Out <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Dokumen Diselesaikan <div class="float-right">
<?php echo $this->db->get_where('data_pekerjaan',array('no_user'=>$this->session->userdata('no_user'),'status_pekerjaan'=>"Selesai" ))->num_rows(); ?>   

</div></div>
</div></a>	
</div>	

</div>	
</div>

<script type="text/javascript">
$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
var cek_icon = $(".fa-chevron-left").html();
if(cek_icon != undefined){
$("#z").addClass("fa-chevron-right");
}else{
$("#z").addClass("fa-chevron-left");
}


});    
</script>    