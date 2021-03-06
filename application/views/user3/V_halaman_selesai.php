<body >
<?php  $this->load->view('umum/user3/V_sidebar_user3'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/user3/V_navbar_user3'); ?>
    <?php $this->load->view('umum/user3/V_data_user3'); ?>

<div class="container-fluid">
<div class="mt-2  text-center  ">
    <h5 align="center " class="text-theme1">Perizinan Selesai<br><span class="fa-2x fab fa-font-awesome-flag"></span></h5>
</div><div class="row">
    <div class="col">
<table style="width:100%;" id="data_selesai" class="table text-theme1 table-striped table-condensed table-xs table-bordered  table-hover table-sm"><thead>
<th align="center" aria-controls="datatable-fixed-header"  >No</th>
<th align="center" aria-controls="datatable-fixed-header"  >Nama client</th>
<th align="center" aria-controls="datatable-fixed-header"  >Jenis pekerjaan</th>
<th align="center" aria-controls="datatable-fixed-header"  >Dokumen</th>
</thead>
<tbody align="center">
</table> 
    </div>    
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#data_selesai").dataTable({
initComplete: function() {
var api = this.api();
$('#data_selesai')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,

ajax: {
"url": "<?php echo base_url('User3/json_data_perizinan_selesai') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "no_berkas_perizinan",
"orderable": false
},
{"data": "nama_client"},
{"data": "jenis_pekerjaan"},
{"data": "nama_dokumen"}


],
order: [[0, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});

</script>  
       
</body>
</html>
