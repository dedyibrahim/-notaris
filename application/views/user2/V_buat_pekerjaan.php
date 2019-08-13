<body>
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid p-2 ">
<div class="mt-2  text-center  ">
    <h5 align="center " class="text-theme1">Tambahkan pekerjaan dan Klien Baru <br><span class="fa-2x fas fa-pencil-alt"></span></h5>
</div>
    <form  id="fileForm" class="mt-2 p-2" method="post" action="<?php echo base_url('User2/create_client') ?>">
<div class="row text-theme1 rounded card-header m-2" >
<div class="col-md-6">
<label>Jenis Pekerjaan</label>
<input type="text" placeholder="Tentukan jenis pekerjaan" name="jenis_pekerjaan"  id="jenis_pekerjaan" class="form-control form-control-sm required"  accept="text/plain">
<input type="hidden" name="id_jenis_pekerjaan" readonly="" id="id_jenis_pekerjaan" class="form-control required"  accept="text/plain">
<label>Target selesai</label>
<input type="text" placeholder="Target selesai pekerjaan" name="target_kelar" readonly="" id="target_kelar" class="form-control form-control-sm required"  accept="text/plain">
<label>Contact Person</label>
<input type="text" placeholder="Contact Person" class="form-control form-control-sm required" id="contact_person" name="contact_person required" accept="text/plain">

<label>Contact TLP/HP</label>
<input type="number" placeholder="Nomor Kontak" class="form-control form-control-sm required" id="contact_number" name="contact_number required" accept="text/plain">

</div>
<div class="col ">
<label>Pilih Jenis client</label>
<select name="jenis" id="pilih_jenis" class="form-control form-control-sm required" accept="text/plain">
<option>-- Klik untuk melihat plihan jenis client --</option>
<option value="Perorangan">Perorangan</option>
<option value="Badan Hukum">Badan Hukum</option>	
</select>    

<div id="form_badan_hukum">
<label  id="label_nama_perorangan">Nama Perorangan</label>
<label  style="display: none;" id="label_nama_hukum">Nama Badan Hukum</label>
<input type="text" placeholder="Nama Badan Hukum / Perorangan" name="badan_hukum" id="badan_hukum" class="form-control form-control-sm required"  accept="text/plain">
</div>

<div id="form_alamat_hukum">
<label style="display: none;" id="label_alamat_hukum">Alamat Badan Hukum</label>
<label  id="label_alamat_perorangan">Alamat Perorangan</label>
<textarea rows="4" placeholder="Alamat Badan Hukum / Perorangan" id="alamat_badan_hukum" class="form-control form-control-sm required" required="" accept="text/plain"></textarea>
<hr>
<button  type="submit" class="btn btn-success btn-md mx-auto btn-block simpan_perizinan">Simpan client dan Buat pekerjaan <i class="fa fa-save"></i></button>

</div>

</div>
<div class="col-md-12 mx-auto  mt-2">
</form>

</div>
</div>
</div>    
</div>
</div>
</div>

<script type="text/javascript">
$("#pilih_jenis").on("change",function(){
var client = $("#pilih_jenis option:selected").text();
if(client == "Perorangan"){
$("#form_client").show(100);
$("#label_alamat_perorangan,#label_nama_perorangan").fadeIn(100);
$("#label_alamat_hukum,#label_nama_hukum").fadeOut(100);
}else if(client == "Badan Hukum"){
$("#form_client").show(100);
$("#label_alamat_hukum,#label_nama_hukum").fadeIn(100);
$("#label_alamat_perorangan,#label_nama_perorangan").fadeOut(100);
}else{
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Silahkan pilih jenis client terlebih dahulu.'
})
}
});

$("#fileForm").submit(function(e) {
e.preventDefault();
$.validator.messages.required = '';
}).validate({
highlight: function (element, errorClass) {
$(element).closest('.form-control').addClass('is-invalid');
},
unhighlight: function (element, errorClass) {
$(element).closest(".form-control").removeClass("is-invalid");
},    
submitHandler: function(form) {
$(".simpan_perizinan").attr("disabled", true);

var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('token',token);
formData.append('jenis_client',$("#pilih_jenis option:selected").text());
formData.append('no_jenis_pekerjaan',$("#id_jenis_pekerjaan").val()),
formData.append('badan_hukum',$("#badan_hukum").val()),
formData.append('target_kelar',$("#target_kelar").val()),
formData.append('alamat_badan_hukum',$("textarea#alamat_badan_hukum").val()),
formData.append('contact_person',$("#contact_person").val()),
formData.append('contact_number',$("#contact_number").val()),


$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(data){   
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function(){
window.location.href='<?php echo base_url('User2/pekerjaan_antrian') ?>';    
});

}

});
return false; 
}
});

$(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#jenis_pekerjaan").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('User2/cari_jenis_pekerjaan') ?>',
select:function(event, ui){
$("#id_jenis_pekerjaan").val("");
$("#id_jenis_pekerjaan,#id_jenis_akta_pekerjaan").val(ui.item.no_jenis_pekerjaan);
}
}
);
});

$(function() {
$("input[name='target_kelar']").datepicker({ minDate:0,dateFormat: 'yy/mm/dd'
});

});
</script>
</div>
</body>
</html>
