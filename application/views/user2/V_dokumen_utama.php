
<div class="container-fluid mt-2 ">    
<div class="row ">
<div class="col">    
<div class=" mt-2 mb-2 text-center text-theme1 ">
    <b>Dokumen utama yang sudah diupload</b>
<button class="btn btn-dark btn-sm float-md-right" onclick="tambah_dokumen_utama();">Tambah dokumen utama <span class="fa fa-plus"></span></button>
</div>
    <hr>
<table class="table text-theme1 table-sm table-striped table-bordered text-center table-hover">
<tr>
<th>nama file</th>
<th>jenis</th>
<th>tanggal akta</th>
<th>aksi</th>
</tr>
<?php foreach ($dokumen_utama->result_array() as $utama){ ?>
<tr>
<td><?php echo $utama['nama_berkas'] ?></td>   
<td><?php echo $utama['jenis'] ?></td>   
<td><?php echo $utama['tanggal_akta'] ?></td>   
<td>
<select class="form-control data_aksi<?php echo $utama['id_data_dokumen_utama'] ?>"  onchange="aksi_utama('<?php echo $utama['id_data_dokumen_utama'] ?>','<?php echo $utama['id_data_dokumen_utama'] ?>');">
<option>-- Klik untuk lihat menu --</option>   
<option value="1">Hapus</option>   
<option value="2">Download</option>   
</select>    
</td>   
</tr>
<?php } ?>
</table>
</div>
    
</div>
</div>

<!------------------modal tambah dokumen utama------------->
<div class="modal fade" id="modal_dokumen_utama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content ">
<div class="modal-header">
<h6 class="modal-title" id="exampleModalLabel text-center">Upload dokumen utama</h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

</div>
</div>
</div>

<script type="text/javascript">
function tambah_dokumen_utama(){

$('#modal_dokumen_utama').modal('show');
}    
    
    
function aksi_utama(id_data_dokumen_utama){
var val = $(".data_aksi"+id_data_dokumen_utama+" option:selected").val(); 
if (val == 1){
hapus_utama(id_data_dokumen_utama);
}else if(val == 2){
window.location.href="<?php echo base_url('User2/download_utama/') ?>"+btoa(id_data_dokumen_utama);
}
$(".data_aksi"+id_data_dokumen_utama).val("-- Klik untuk lihat menu --");       
}    



function hapus_utama(id_data_dokumen_utama){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
Swal.fire({
title: 'Anda yakin',
text: "file akan dihapus secara permanen",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Ya Hapus'
}).then((result) => {
if (result.value) {
$.ajax({
type:"post",
data:"token="+token+"&id_data_dokumen_utama="+id_data_dokumen_utama,
url:"<?php echo base_url('User2/hapus_file_utama') ?>",
success:function(data){
Swal.fire(
'Terhapus',
'File berhasil dihapus',
'success'
).then(function(){
window.location.href="<?php echo base_url('User2/proses_pekerjaan/'.$this->uri->segment(3))?>";    
});
}
});
}
})
}


$(function() {
$("input[name=tanggal_akta]").daterangepicker({
    singleDatePicker: true,
    dateFormat: 'yy/mm/dd',
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10),
    "locale": {
        "format": "YYYY/MM/DD",
        "separator": "-",
      }
});
});
</script>
