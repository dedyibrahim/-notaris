<body onload="refresh()">
<?php $this->load->view('umum/user2/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php $this->load->view('umum/user2/V_navbar_user2'); ?>
<?php $this->load->view('umum/user2/V_data_user2'); ?>
<?php $static = $query->row_array(); ?>
<div class="container text-theme1">    
<div class="card-header text-theme1 mt-2 mb-2 text-center">
HALAMAN BUAT PERIZINAN <?php echo $static['nama_client'] ?>
<button class="btn btn-success btn-sm float-md-right "  onclick="lanjutkan_proses_perizinan('<?php echo $this->uri->segment(3) ?>');">Selesaikan pekerjaan <span class="fa fa-check"></span></button>
</div>



<div class="row m-1 text-theme1">
<div class="col-md-6 card-header">
<div class="row">

<div class="col">
<label>Pembuat Client</label><br>    

</div>
<div class="col"> :
<?php echo $static['pembuat_client'] ?>        
</div>
</div>    
<div class="row">
<div class="col">
<label>Nama client</label><br>    

</div>
<div class="col"> :
<?php echo $static['nama_client'] ?>  
</div>
</div>
<div class="row">
<div class="col">
<label>Alamat client</label><br>    

</div>
<div class="col"> :
<?php echo $static['alamat_client'] ?>        
</div>
</div>

<div class="row">
<div class="col">
<label>Jenis Client</label><br>    

</div>
<div class="col"> :
<?php echo $static['jenis_client'] ?>        
</div>
</div>
<div class="row">
<div class="col">
<label>Nama Kontak</label><br>    

</div>
<div class="col"> :
<?php echo $static['contact_person'] ?>        
</div>
</div>
<div class="row">
<div class="col">
<label>Nomor Kontak</label><br>    

</div>
<div class="col"> :
<?php echo $static['contact_number'] ?>        
</div>
</div>
<div class="row">
<div class="col">
<label>Jenis Kontak</label><br>    

</div>
<div class="col"> :
<?php echo $static['jenis_kontak'] ?>        
</div>
</div>
    <hr>
    <button onclick=form_edit_client("<?php echo base64_encode($static['no_client']) ?>"); class="btn btn-success btn-sm btn-block">Edit client <span class="fa fa-edit"></span></button>    
</div>

<div class="col card-header ml-1">
<div class="row">
<div class="col">
<label>Pembuat pekerjaan</label><br>    

</div>
<div class="col"> :
<?php echo $static['pembuat_pekerjaan'] ?>        
</div>
</div>
<div class="row">
<div class="col">
<label>Jenis Pekerjaan</label><br>    

</div>
<div class="col"> :
<?php echo $static['nama_jenis'] ?>        
</div>
</div>

<div class="row">
<div class="col">
<label>Tanggal dibuat pekerjaan</label><br>    

</div>
<div class="col"> :
<?php echo $static['tanggal_dibuat'] ?>        
</div>
</div>
<div class="row">
<div class="col">
<label>Target selesai pekerjaan</label><br>    

</div>
<div class="col"> :
    
<?php
if($static['target_kelar']  == date('Y/m/d')){
echo "<b><span class='text-warning'>Hari ini</span></b>";    
}else if($static['target_kelar']  <= date('Y/m/d')){
$startTimeStamp = strtotime(date('Y/m/d'));
$endTimeStamp = strtotime($static['target_kelar'] );
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400; 
$numberDays = intval($numberDays);
echo "<b><span class='text-danger'> Terlewat ".$numberDays." Hari </span></b>" ;
}else{
$startTimeStamp = strtotime(date('Y/m/d'));
$endTimeStamp = strtotime($static['target_kelar'] );
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400; 
$numberDays = intval($numberDays);
echo "<b><span class='text-success'>".$numberDays." Hari lagi </span></b>" ;
}
?> 
</div>
</div>    
<hr>
<button onclick=form_edit_pekerjaan("<?php echo base64_encode($static['no_pekerjaan']) ?>","<?php echo base64_encode($static['no_client']) ?>"); class="btn btn-success btn-sm btn-block">Edit pekerjaan <span class="fa fa-edit"></span></button>    
</div>

</div>
    
<!-----------------------------PIHAK2 YANG TERLIBAT--------------------------------------------------->    
<div class="card-header text-theme1 mt-2 mb-2 text-center">Daftar Pihak-pihak yang terlibat
</div>
<div class=" card-header" >
<div class="row">
<div class="col-md-5">    
<div class="col ">
<form id="form_pihak_terlibat">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash(); ?>" readonly="" class="required"  accept="text/plain">
<input type="hidden" name="no_pekerjaan" value="<?php echo $this->uri->segment(3) ?>" readonly="" class="required"  accept="text/plain">   
    
<label>Pilih Jenis pihak</label>
<select name="jenis_client" id="jenis_client" class="form-control form-control-sm required" accept="text/plain">
<option></option>
<option value="Perorangan">Perorangan</option>
<option value="Badan Hukum">Badan Hukum</option>	
</select>    

<label>Nama Pihak</label>
<input type="text" placeholder="Nama Pihak" name="nama_pihak" id="nama_pihak" class="form-control form-control-sm required"  accept="text/plain">
<input type="hidden" id="no_client" name="no_client" class="form-control">

<label >Alamat Pihak</label>
<textarea name="alamat_pihak" rows="6" placeholder="Alamat Pihak" id="alamat_pihak" class="form-control form-control-sm required" required="" accept="text/plain"></textarea>

<label>Jenis pihak yang bisa dihubungi</label>
<select name="jenis_kontak" id="jenis_kontak" class="form-control form-control-sm required" accept="text/plain">
<option></option>
<option value="Staff">Staff</option>
<option value="Pribadi">Pribadi</option>	
</select>  

<label>Nama pihak yang bisa dihubungi</label>
<input type="text" placeholder="Kontak yang bisa dihubungi" class="form-control form-control-sm required" id="contact_person" name="contact_person" accept="text/plain">
<label>Nomor Kontak Telephone / HP</label>
<input type="text" placeholder="Nomor Kontak Telephone  / HP" class="form-control form-control-sm required" id="contact_number" name="contact_number" accept="text/plain">

</form>
</div>    
<hr>
<button type="button" onclick="simpan_pihak();" class="btn btn-sm btn-success btn-block"> Tambahkan pihak yang terlibat</button>
</div>

<div class="col text-theme1 ">
<div class="row text-center">
<div class="col"><b>Nama</div>
<div class="col">Aksi</b></div>
</div>
<div class="para_pihak">

</div>    
    
</div>    
</div>
</div>

</div>
</div>
    
<!--------------- data modal --------------->    
<div class="modal fade" id="data_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
<div class="modal-content ">
    
</div>
</div>
</div>

    
    
<script type="text/javascript">
function hapus_berkas_persyaratan(no_client,no_pekerjaan,id_data_berkas){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>" ;      

$.ajax({
type:"post",
url:"<?php echo base_url('Data_lama/hapus_berkas_persyaratan/') ?>",
data:"token="+token+"&id_data_berkas="+id_data_berkas,
success:function(data){
tampilkan_form(no_client,no_pekerjaan);
read_response(data);
}
});    
    
}        
    
$(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#nama_pihak").autocomplete({
minLength:0,
delay:0,
source: function( request, rse ) {
$.ajax({
url: "<?php echo base_url('User2/cari_nama_client') ?>",
method:'post',
data: {
token:token,  
term: request.term,
jenis_pemilik: $("#jenis_client option:selected").text()
},success: function( data ) {
var d = JSON.parse(data);
rse(d);
}
});
},select:function(event, ui){
if(ui.item.no_client != null){
$("#no_client").val(ui.item.no_client).attr('readonly', true);
$("#alamat_pihak").val(ui.item.alamat_pihak).attr('readonly', true);
$("#jenis_kontak option[value='"+ui.item.jenis_kontak+"']").attr("selected","selected");
$("#jenis_kontak").attr('readonly', true);
$("#contact_person").val(ui.item.contact_person).attr('readonly', true);
$("#contact_number").val(ui.item.contact_number).attr('readonly', true);
}else{
$("#no_client").attr('readonly', false).val("");
$("#alamat_pihak").attr('readonly', false).val("");
$("#jenis_kontak option[value='"+ui.item.jenis_kontak+"']").attr("selected","selected");
$("#jenis_kontak").attr('readonly', false).val("");
$("#contact_person").attr('readonly', false).val("");
$("#contact_number").attr('readonly', false).val("");
}
}
});
});


function simpan_pihak(){
$("#form_pihak_terlibat").find(".form-control").removeClass("is-invalid").addClass("is-valid");
$("#form_pihak_terlibat").find('.form-control + p').remove();
$.ajax({
type:"post",
data:$("#form_pihak_terlibat").serialize(),
url:"<?php echo base_url('User2/simpan_pihak_terlibat') ?>",
success:function(data){
var r  = JSON.parse(data);
if(r[0].status == 'error_validasi'){
$.each(r[0].messages, function(key, value){
$.each(value, function(key, value){
$("#form_pihak_terlibat").find("#"+key).addClass("is-invalid").after("<p class='"+key+"alert text-danger'>"+value+"</p>");
$("#form_pihak_terlibat").find("#"+key).removeClass("is-valid");
});
});
}else{
read_response(data);
$("#form_pihak_terlibat").find(".form-control").val("").attr('readonly', false).removeClass("is-valid");
refresh();
}
}

});
}

function para_pihak(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>" ;      

$.ajax({
type:"post",
url:"<?php echo base_url('User2/data_para_pihak/') ?>",
data:"token="+token+"&proses=perizinan&no_pekerjaan="+"<?php echo $this->uri->segment(3) ?>",
success:function(data){
$(".para_pihak").html(data);
}
});
}

function refresh(){
para_pihak();
regis_js();
}


function tampilkan_form(no_client,no_pekerjaan){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>" ;      

$.ajax({
type:"post",
data:"token="+token+"&no_client="+no_client+"&no_pekerjaan="+no_pekerjaan,
url:"<?php echo base_url('User2/form_persyaratan') ?>",
success:function(data){
$('#data_modal').modal('show');
$(".modal-content").html(data);


regis_js();
}
});    
}

function upload_data(no_nama_dokumen,no_client){

$("#form"+no_nama_dokumen).find(".form-control").removeClass("is-invalid").addClass("is-valid");
$("#form"+no_nama_dokumen).find('.form-control + p').remove();


var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>" ;      
formdata = new FormData();
var x = $('#form'+no_nama_dokumen).serializeArray();
$.each(x,function(prop,obj){
formdata.append(obj.name, obj.value);
});
formdata.append("file_berkas", $("#file"+no_nama_dokumen).prop('files')[0]);

$.ajax({
type:"post",
data:formdata,
processData: false,
contentType: false,
url:"<?php echo base_url('User2/simpan_persyaratan') ?>",
success:function(data){
var r = JSON.parse(data); 

if(r[0].status == 'error_validasi'){
$.each(r[0].messages, function(key, value){
$.each(value, function(key, value){
$("#form"+no_nama_dokumen).find("#"+key).addClass("is-invalid").after("<p class='"+key+"alert text-danger'>"+value+"</p>");
$("#form"+no_nama_dokumen).find("#"+key).removeClass("is-valid");
});
});
}else{
read_response(data);
refresh(); 
tampilkan_form(r[0].no_client,btoa(r[0].no_pekerjaan));

}    
}
});


}
function regis_js(){
$(".Desimal").keyup(function(){
var string = numeral(this.value).format('0,0');
$("#"+this.id).val(string);
});
$(".Bulat").keyup(function(){
var string = this.value;
$("#"+this.id).val(string);
});

$(function() {
$(".date").daterangepicker({ 
    dateFormat: 'yy/mm/dd',
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    changeMonth: false,
   changeYear: false,
    maxYear: parseInt(moment().format('YYYY'),10),
    "locale": {
        "format": "YYYY/MM/DD",
        "separator": "-",
      }
});
});

}



function  form_edit_client(no_client){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$.ajax({
type:"post",
url:"<?php echo base_url('User2/form_edit_client') ?>",
data:"token="+token+"&no_client="+no_client,
success:function(data){
$(".modal-content").html(data);    
$('#data_modal').modal('show');
}
});
}

function update_client(){
$(".update_client").attr("disabled", true);
$("#form_update_client").find(".form-control").removeClass("is-invalid").addClass("is-valid");
$('.form-control + p').remove();
$.ajax({
url  : "<?php echo base_url("User2/update_client") ?>",
type : "post",
data : $("#form_update_client").serialize(),
success: function(data) {
var r  = JSON.parse(data);
if(r[0].status == 'error_validasi'){
$.each(r[0].messages, function(key, value){
$.each(value, function(key, value){
$("#form_update_client").find("#"+key).addClass("is-invalid").after("<p class='"+key+"alert text-danger'>"+value+"</p>");
$("#form_update_client").find("#"+key).removeClass("is-valid");
});
});
}else{
read_response(data);
$('#data_modal').modal('hide');
}
$(".update_client").attr("disabled", false);
}

});
}

function form_edit_pekerjaan(no_pekerjaan,no_client){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&no_client="+no_client,
url :"<?php echo base_url('User2/form_edit_pekerjaan') ?>",
success:function(data){
$('#data_modal').modal('show');
$(".modal-content").html(data);
cari_pekerjaan();

}

});
}

function cari_pekerjaan(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       

$("#cari_pekerjaan").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('User2/cari_jenis_pekerjaan') ?>',
select:function(event, ui){
$("#id_jenis_pekerjaan").val(ui.item.no_jenis_pekerjaan);
}
}
);

}

function update_pekerjaan(){
$(".update_pekerjaan").attr("disabled", true);
$("#form_update_pekerjaan").find(".form-control").removeClass("is-invalid").addClass("is-valid");
$('.form-control + p').remove();
$.ajax({
url  : "<?php echo base_url("User2/update_pekerjaan") ?>",
type : "post",
data : $("#form_update_pekerjaan").serialize(),
success: function(data) {
var r  = JSON.parse(data);
if(r[0].status == 'error_validasi'){
$.each(r[0].messages, function(key, value){
$.each(value, function(key, value){
$("#form_update_pekerjaan").find("#"+key).addClass("is-invalid").after("<p class='"+key+"alert text-danger'>"+value+"</p>");
$("#form_update_pekerjaan").find("#"+key).removeClass("is-valid");
});
});
}else{
read_response(data);
$('#data_modal').modal('hide');
}
$(".update_pekerjaan").attr("disabled", false);
}

});
}

function lanjutkan_proses_perizinan(no_pekerjaan){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan,
url :"<?php echo base_url('User2/lanjutkan_proses_perizinan') ?>",
success:function(data){
read_response(data);

}

});
}

function tampilkan_form_perizinan(no_client,no_pekerjaan){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$.ajax({
type:"post",
url:"<?php echo base_url('User2/form_data_perizinan') ?>",
data:"token="+token+"&no_client="+no_client+"&no_pekerjaan="+no_pekerjaan,
success:function(data){
$(".modal-content").html(data);    
$('#data_modal').modal('show');

}
});
}

function simpan_perizinan(no_pekerjaan,no_client){
var token                    = "<?php echo $this->security->get_csrf_hash() ?>";
var no_petugas               = $(".data_nama_petugas option:selected").val();
var no_dokumen               = $(".data_nama_dokumen option:selected").val();

$.ajax({
type:"post",
url:"<?php echo base_url('User2/simpan_perizinan') ?>",
data:"token="+token+"&no_petugas="+no_petugas+"&no_nama_dokumen="+no_dokumen+"&no_pekerjaan="+no_pekerjaan+"&no_client="+no_client,
success:function(data){
read_response(data);
tampilkan_form_perizinan(no_client,btoa(no_pekerjaan));
}
});
}


function hapus_perizinan(no_berkas_perizinan,no_client,no_pekerjaan){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",	
url:"<?php echo base_url('User2/hapus_perizinan') ?>",	
data:"token="+token+"&no_berkas_perizinan="+no_berkas_perizinan,
success:function(data){	
read_response(data);
tampilkan_form_perizinan(no_client,no_pekerjaan);
}
});
}

function alihkan_perizinan(no_berkas_perizinan,no_client,no_pekerjaan){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",	
url:"<?php echo base_url('User2/option_user_level3') ?>",	
data:"token="+token+"&no_berkas_perizinan="+no_berkas_perizinan+"&no_client="+no_client+"&no_pekerjaan="+no_pekerjaan,
success:function(data){	
$("#"+no_berkas_perizinan).html(data);
}
});

}

function simpan_alihan_perizinan(no_berkas_perizinan,no_client,no_pekerjaan){
var no_user = $("."+no_berkas_perizinan+" option:selected").val();
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",	
url:"<?php echo base_url('User2/simpan_petugas_perizinan') ?>",	
data:"token="+token+"&no_berkas_perizinan="+no_berkas_perizinan+"&no_user="+no_user,
success:function(data){	
read_response(data);
tampilkan_form_perizinan(no_client,no_pekerjaan);
}
});
}

function lihat_laporan_perizinan(no_berkas_perizinan){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&no_berkas_perizinan="+no_berkas_perizinan,
url:"<?php echo base_url('User2/lihat_laporan_perizinan') ?>",
success:function(data){
$(".modal-content").html(data);    
$('#data_modal').modal('show');
}
});
}

</script>    


