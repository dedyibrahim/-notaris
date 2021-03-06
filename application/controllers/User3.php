<?php
class user3 extends CI_Controller{
    
public function __construct() {
parent::__construct();
$this->load->helper('download');
$this->load->library('session');
$this->load->model('M_user3');
$this->load->library('Datatables');
$this->load->library('form_validation');
$this->load->library('upload');

if($this->session->userdata('sublevel')  != 'Level 3' ){
redirect(base_url('Menu'));
}
}

public function index(){
$data_tugas = $this->M_user3->data_tugas('Masuk');

$this->load->view('umum/V_header');
$this->load->view('user3/V_user3',['data_tugas'=>$data_tugas]);
}
 
public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
}


public function proses_tugas(){
if($this->input->post()){

 $data = array(
'target_selesai_perizinan' =>$this->input->post('target_kelar'),
'status_berkas'                 =>'Proses'    
);
$this->db->update('data_berkas_perizinan',$data,array('no_berkas_perizinan'=>$this->input->post('no_berkas_perizinan')));

$status = array(
'status' =>"success",
'pesan'  =>"Dokumen masuk kedalam proses perizinan"    
);
echo json_encode($status);

}else{
redirect(404);    
}

}
public function selesaikan_tugas(){
if($this->input->post()){

 $data = array(
'tanggal_selesai'               => date('Y/m/d'),     
'status_berkas'                 =>'Selesai'    
);
$this->db->update('data_berkas_perizinan',$data,array('no_berkas_perizinan'=>$this->input->post('no_berkas_perizinan')));

$status = array(
'status' =>"success",
);
echo json_encode($status);

}else{
redirect(404);    
}

}
public function halaman_proses(){
$data_tugas = $this->M_user3->data_tugas('Proses');    
$this->load->view('umum/V_header');
$this->load->view('user3/V_halaman_proses',['data_tugas'=>$data_tugas]);
}



public function halaman_selesai(){ 
$this->load->view('umum/V_header');
$this->load->view('user3/V_halaman_selesai');  
}

public function json_data_perizinan_selesai(){
echo $this->M_user3->json_data_perizinan_selesai();       
}



public function form_rekam_dokumen(){
if($this->input->post()){
$input = $this->input->post();
$data_client      = $this->M_user3->data_client_where(base64_encode($input['no_client']))->row_array();
$nama_persyaratan = $this->M_user3->nama_persyaratan($input['no_berkas_perizinan'],$data_client['jenis_client'])->row_array();

echo '<div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
<div class="modal-content ">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" >REKAM DOKUMEN MILIK '.$data_client['nama_client'].'<span id="title"></span> </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body text-theme1 " >';
echo "<form action='#' id='form".$nama_persyaratan['no_nama_dokumen']."'>";
echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" readonly="" class="required"  accept="text/plain">';
echo '<input type="hidden" name="no_client" value="'.$input['no_client'].'" readonly="" class="required"  accept="text/plain">';
echo '<input type="hidden" name="no_pekerjaan" value="'.base64_decode($input['no_pekerjaan']).'" readonly="" class="required"  accept="text/plain">';
echo '<input type="hidden" name="no_nama_dokumen" value="'.$nama_persyaratan['no_nama_dokumen'].'" readonly="" class="required"  accept="text/plain">';

$data_meta = $this->M_user3->data_meta($nama_persyaratan['no_nama_dokumen']);

foreach ($data_meta->result_array() as $d){
/*INPUTAN SELECT*/
if($d['jenis_inputan'] == 'select'){
$data_option = $this->db->get_where('data_input_pilihan',array('id_data_meta'=>$d['id_data_meta']));   
echo "<label>".$d['nama_meta']."</label>"
."<select id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' class='form-control form_meta form-control-sm meta required' required='' accept='text/plain'>";
foreach ($data_option->result_array() as $option){
echo "<option>".$option['jenis_pilihan']."</option>";
}
echo "</select>";

/*INPUTAN DATE*/
}else if($d['jenis_inputan'] == 'date'){
echo "<label>".$d['nama_meta']."</label>"
."<input  type='text' id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' placeholder='".$d['nama_meta']."'  maxlength='".$d['maksimal_karakter']."' class='form-control form_meta form-control-sm ".$d['jenis_inputan']." meta required ' required='' accept='text/plain' >";    

/*INPUTAN NUMBER*/
}else if($d['jenis_inputan'] == 'number'){
echo "<label>".$d['nama_meta']."</label>"
."<input  type='text' id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' placeholder='".$d['nama_meta']."'  maxlength='".$d['maksimal_karakter']."' class='form-control form_meta form-control-sm ".$d['jenis_bilangan']." meta required ' required='' accept='text/plain' >";        

/*INPUTAN TEXTAREA*/
}else if($d['jenis_inputan'] == 'textarea'){
echo "<label>".$d['nama_meta']."</label>"
. "<textarea  id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' placeholder='".$d['nama_meta']."'  maxlength='".$d['maksimal_karakter']."' class='form-control form_meta form-control-sm ".$d['jenis_bilangan']." meta required ' required='' accept='text/plain'></textarea>";
}else{
echo "<label>".$d['nama_meta']."</label>"
."<input  type='".$d['jenis_inputan']."' id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' placeholder='".$d['nama_meta']."'  maxlength='".$d['maksimal_karakter']."' class='form-control form_meta form-control-sm  meta required ' required='' accept='text/plain' >";    
}

}
echo "<label>Lampiran</label>"
. "<input type='file' id='file".$nama_persyaratan['no_nama_dokumen']."' class='form-control'>";
echo "<hr>"
. "<button type='button' onclick=upload_data('".$nama_persyaratan['no_nama_dokumen']."','".$input['no_client']."') class='btn btn-sm btn-success btn-block '>Simpan dan rekam</button>"
. "</form>";

echo '</div></div>';
}
}


public function simpan_persyaratan(){
if($this->input->post()){
$input = $this->input->post();

foreach ($_POST as $key=>$val) {
$this->form_validation->set_rules($key,str_replace('_', ' ', $key), 'required');
}

if ($this->form_validation->run() == FALSE){
$status_input = $this->form_validation->error_array();
$status[] = array(
'status'  => 'error_validasi',
'messages'=>array($status_input),    
);

echo json_encode($status);
}else{
    
$total_berkas = $this->M_user3->total_berkas()->row_array();

$no_berkas = "BK".date('Ymd').str_pad($total_berkas['id_data_berkas'],6,"0",STR_PAD_LEFT);

$data_client = $this->db->get_where('data_client',array('no_client'=>$input['no_client']))->row_array();

if(!empty($_FILES['file_berkas'])){
$config['upload_path']          = './berkas/'.$data_client['nama_folder'];
$config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|xlxs|';
$config['encrypt_name']         = TRUE;
$config['max_size']             = 50000;
$this->upload->initialize($config);   

if (!$this->upload->do_upload('file_berkas')){  
$status[] = array(
"status"     => "error",
"messages"      => $this->upload->display_errors()    
);
echo json_encode($status);

}else{
$lampiran = $this->upload->data('file_name');    
$this->simpan_data_persyaratan($no_berkas,$input,$lampiran);
}

}else{
$lampiran = NULL;
$this->simpan_data_persyaratan($no_berkas,$input,$lampiran);
}

    
//echo "validasi _berhasil";    


}
}else{
redirect(404);    
}
    
}


public function simpan_data_persyaratan($no_berkas,$input,$lampiran){

$data_berkas = array(
'no_berkas'         => $no_berkas,    
'no_client'         => $input['no_client'],    
'no_pekerjaan'      => $input['no_pekerjaan'],
'no_nama_dokumen'   => $input['no_nama_dokumen'],
'nama_berkas'       => $lampiran,
'Pengupload'        => $this->session->userdata('no_user'),
'tanggal_upload'    => date('Y/m/d' ),  
);    

$this->db->insert('data_berkas',$data_berkas);
    
foreach ($input as $key=>$value){
if($key == "no_nama_dokumen" || $key == 'no_client' || $key == 'no_pekerjaan' || $key == 'file_berkas'){
}else{
$meta = array(
'no_pekerjaan'      => $input['no_pekerjaan'],
'no_nama_dokumen'   => $input['no_nama_dokumen'],
'no_berkas'         => $no_berkas,    
'nama_meta'         => $key,
'value_meta'        => $value,    
);
$this->db->insert('data_meta_berkas',$meta);
}
}

$status[] = array(
"status"      => "success",
"messages"    => "Persyaratan berhasil ditambahkan",
"no_client"   =>$input['no_client'],
"no_pekerjaan"=>$input['no_pekerjaan']    
);
echo json_encode($status);
}

public function simpan_laporan(){
if($this->input->post()){
$input = $this->input->post();
$this->form_validation->set_rules('laporan', 'Laporan belum dimasukan', 'required');
if ($this->form_validation->run() == FALSE){
$status_input = $this->form_validation->error_array();
$status[] = array(
'status'  => 'error_validasi',
'messages'=>array($status_input),    
);
echo json_encode($status);

}else{
 $data = array(
'no_berkas_perizinan'    => $input['no_berkas_perizinan'],
'laporan'                => $input['laporan'],
'waktu'                  => date('Y/m/d')    
);
$this->db->insert('data_progress_perizinan',$data);

$status[] = array(
"status"=>"success",
"messages" =>"laporan berhasil tersimpan",
);
echo json_encode($status);
      
}
}  
 }
public function download_berkas_informasi(){
$data = $this->db->get_where('data_informasi_pekerjaan',array('id_data_informasi_pekerjaan'=>$this->uri->segment(3)))->row_array();    
$file_path = "./berkas/".$data['nama_folder']."/".$data['lampiran']; 
$info = new SplFileInfo($data['lampiran']);
force_download($data['nama_informasi'].".".$info->getExtension(), file_get_contents($file_path));
}
public function cari_file(){
if($this->input->post()){
$kata_kunci = $this->input->post('kata_kunci');


$data_dokumen           = $this->M_user3->pencarian_data_dokumen($kata_kunci);

$data_dokumen_utama     = $this->M_user3->pencarian_data_dokumen_utama($kata_kunci);

$data_client            = $this->M_user3->pencarian_data_client($kata_kunci);

$this->load->view('umum/V_header');
$this->load->view('user3/V_pencarian',['data_dokumen'=>$data_dokumen,'data_dokumen_utama'=>$data_dokumen_utama,'data_client'=>$data_client]);

}else{
redirect(404);    
}    
}

public function tolak_tugas(){
if($this->input->post()){
$this->form_validation->set_rules('alasan_penolakan', 'Alasan penolakan perlu di isi', 'required');
if ($this->form_validation->run() == FALSE){
$status_input = $this->form_validation->error_array();
$status[] = array(
'status'  => 'error_validasi',
'messages'=>array($status_input),    
);
echo json_encode($status);

}else{
$input = $this->input->post();    
$data = array(
'no_berkas_perizinan'       => $input['no_berkas_perizinan'],
'laporan'                   => $this->session->userdata('nama_lengkap')." Menolak Tugas dengan alasan ".$input['alasan_penolakan'],
'waktu'                     => date('Y/m/d')    
);
$this->db->insert('data_progress_perizinan',$data);

$update = array(
'status_berkas' => 'Ditolak',    
);
$this->db->update('data_berkas_perizinan',$update,array('no_berkas_perizinan'=>$input['no_berkas_perizinan']));


$status[] = array(
"status"   =>"success",
"messages" =>"Penolakan tugas berhasil",
);
echo json_encode($status);

}  
}else{
redirect(404);    
}
    
}
public function profil(){
$no_user = $this->session->userdata('no_user');
$data_user = $this->M_user3->data_user_where($no_user);
$this->load->view('umum/V_header');
$this->load->view('user3/V_profil',['data_user'=>$data_user]);

}
public function simpan_profile(){
$foto_lama = $this->db->get_where('user',array('no_user'=>$this->session->userdata('no_user')))->row_array();

if(!file_exists('./uploads/user/'.$foto_lama['foto'])){
    
}else{
if($foto_lama['foto'] != NULL){
unlink('./uploads/user/'.$foto_lama['foto']);    
}

}
$img                    =  $this->input->post();
define('UPLOAD_DIR', './uploads/user/');
$image_parts            = explode(";base64,", $img['image']);
$image_type_aux         = explode("image/", $image_parts[0]);
$image_type             = $image_type_aux[1];
$image_base64           = base64_decode($image_parts[1]);
$file_name              = uniqid() . '.png';
$file                   = UPLOAD_DIR .$file_name;
file_put_contents($file,$image_base64);

$data = array(
'foto' =>$file_name,    
);

$this->session->set_userdata($data);
$this->db->update('user',$data,array('no_user'=>$this->session->userdata('no_user')));


$status = array(
"status"     => "success",
"pesan"      => "Foto profil berhasil diperbaharui"    
);
echo json_encode($status);


}


public function update_user(){
if($this->input->post()){
$input= $this->input->post();

$data =array(
'email'         =>$input['email'],
'username'      =>$input['username'],
'nama_lengkap'  =>$input['nama_lengkap'],
'phone'         =>$input['phone']    
);
$this->db->where('no_user',$input['id_user']);
$this->db->update('user',$data);


$status = array(
"status"     => "success",
"pesan"      => "Data profil berhasil diperbaharui"    
);
echo json_encode($status);

}else{
redirect(404);    
}

}
public function update_password(){
if($this->input->post()){
$data = array(
'password' => md5($this->input->post('password'))
);
$this->db->update('user',$data,array('no_user'=>$this->input->post('no_user')));
 
$status = array(
"status"     => "success",
"pesan"      => "Password diperbaharui"    
);
echo json_encode($status);

}else{
redirect(404);    
}    
}

public function riwayat_pekerjaan(){
$this->load->view('umum/V_header');
$this->load->view('user3/V_riwayat_pekerjaan');
}

public function json_data_riwayat(){
echo $this->M_user3->json_data_riwayat();       
}

public function histori($keterangan){
$data = array(
'no_user'   => $this->session->userdata('no_user'),
'keterangan'=>$keterangan,
'tanggal'   =>date('Y/m/d H:i:s'),
);

$this->db->insert('data_histori_pekerjaan',$data);
}

public function data_pekerjaan_baru(){
$this->db->select('nama_dokumen.nama_dokumen,'
        . 'data_berkas_perizinan.id_perizinan');
$this->db->from('data_berkas_perizinan');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_berkas_perizinan.no_nama_dokumen');
$this->db->where('data_berkas_perizinan.no_user_perizinan',$this->session->userdata('no_user'));
$this->db->where('data_berkas_perizinan.status_lihat',NULL);
$query = $this->db->get();

echo json_encode($query->result());
    
}
public function dilihat(){
if($this->input->post()){
$input = $this->input->post();
    
$data = array(
'status_lihat'=>'Dilihat'
);

$this->db->update('data_berkas_perizinan',$data,array('id_perizinan'=>$input['id_perizinan']));

}else{
redirect(404);    
}

}

public function lihat_informasi(){
if($this->input->post()){
$input = $this->input->post();    
$query = $this->db->get_where('data_informasi_pekerjaan',array('id_data_informasi_pekerjaan'=>$input['id_data_informasi_pekerjaan']))->row_array();

echo $query['data_informasi'];


}else{
redirect(404);    
}
}

public function set_toggled(){
if(!$this->session->userdata('toggled')){
$array = array(
'toggled' => 'Aktif',    
);
$this->session->set_userdata($array);    
}else{
unset($_SESSION['toggled']);   
}
echo print_r($this->session->userdata()); 
}


public function data_perekaman(){
if($this->input->post()){
$input = $this->input->post();
$query     = $this->M_user3->data_perekaman($input['no_nama_dokumen'],$input['no_client']);
$query2     = $this->M_user3->data_perekaman2($input['no_nama_dokumen'],$input['no_client']);

echo '<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
<div class="modal-content ">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" >DATA DOKUMEN PERSYARATAN<span id="title"></span> </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body text-theme1 " >
<form id="form_penolakan_tugas">
';

echo "<table class='table text-theme1 table-sm table-striped table-bordered'>";
echo "<thead>
    <tr>";
foreach ($query->result_array() as $d){
echo "<th>".str_replace('_', ' ',$d['nama_meta'])."</th>";
}
echo "<th>Aksi</th>";
echo "</tr>"

. "</thead>";

echo "<tbody>";
foreach ($query2->result_array() as $d){
$b = $this->db->get_where('data_meta_berkas',array('no_berkas'=>$d['no_berkas']));
echo "<tr>";

foreach ($b->result_array() as $i){
echo "<td>".$i['value_meta']."</td>";    
}
echo '<td class="text-center">'
.'<button type="button" class="btn btn-success btn-sm" onclick=cek_download("'.base64_encode($d['no_berkas']).'")><span class="fa fa-download"></span></button>
</td>';
echo "</tr>";
    
    
}
echo "</tbody>";


echo"</table>"; 


echo "</div>"
. "</div>";

}else{
redirect(404);    
}    
}


public function hapus_berkas_persyaratan(){
if($this->input->post()){
$input = $this->input->post();    

$data = $this->M_user3->hapus_berkas($input['id_data_berkas'])->row_array();

$filename = './berkas/'.$data['nama_folder']."/".$data['nama_berkas'];

if(!file_exists($filename)){
unlink($filename);
}

$this->db->delete('data_berkas',array('id_data_berkas'=>$this->input->post('id_data_berkas')));    

$status = array(
"status"     => "success",
"pesan"      => "Data persyaratan dihapus",    
);

echo json_encode($status);

$keterangan = $this->session->userdata('nama_lengkap')." Menghapus File Persyaratan ".$data['nama_dokumen'];  
$this->histori($keterangan);

}else{
redirect(404);    
} 


}
public function data_pencarian(){
if($this->input->post()){
$input = $this->input->post();
$data_dokumen         = $this->M_user3->pencarian_data_dokumen($input['kata_kunci']);
$data_client          = $this->M_user3->pencarian_data_client($input['kata_kunci']);
$dokumen_utama        = $this->M_user3->pencarian_data_dokumen_utama($input['kata_kunci']);

if($data_dokumen->num_rows() == 0){
$json_data_dokumen[] = array(
"Tidak ditemukan data dokumen"    
);
    
}else{   
foreach ($data_dokumen->result_array()as $d){
$json_data_dokumen[] = array(    
$d['value_meta']
);
}
}

if($data_client->num_rows() == 0){
$json_data_client[] = array(
"Tidak ditemukan data client"
);    
}else{
foreach ($data_client->result_array()as $data_client){
$json_data_client[] = array(
$data_client['nama_client']    
);
}
}

if($dokumen_utama->num_rows() == 0){
$data_dokumen_utama[] = array(
"Tidak ditemukan dokumen utama"
);    
}else{
foreach ($dokumen_utama->result_array()as $dokut){
$data_dokumen_utama[] = array(
$dokut['nama_berkas']    
);
}

}

$data = array(
 'data_dokumen'         => $json_data_dokumen,
 'data_client'          => $json_data_client,  
 'data_dokumen_utama'   => $data_dokumen_utama   
);


echo json_encode($data);

}else{
redirect(404);    
}

}


public function cek_download_berkas(){
if($this->input->post()){
$input =  $this->input->post();    
$this->db->select('data_berkas.nama_berkas,'
        . 'data_client.nama_folder');    
$this->db->from('data_berkas');
$this->db->join('data_client', 'data_client.no_client = data_berkas.no_client');
$this->db->where('data_berkas.no_berkas', base64_decode($input['no_berkas']));
$query= $this->db->get()->row_array();    

if($query['nama_berkas'] == NULL){
$status = array(
"status"     => "warning",
"pesan"      => "Lampiran file tidak dimasukan hanya meta data"    
);    
}else if(!file_exists('./berkas/'.$query['nama_folder']."/".$query['nama_berkas'])){
$status = array(
"status"     => "error",
"pesan"      => "File tidak tersedia"    
);      
}else{
$status = array(
"status"     => "success",
);      
}

echo json_encode($status);
}else{
redirect(404);    
}

}


public function data_perekaman_pencarian(){
if($this->input->post()){
$input = $this->input->post();
$query     = $this->M_user3->data_perekaman(base64_decode($input['no_nama_dokumen']),base64_decode($input['no_client']));
$query2     = $this->M_user3->data_perekaman2(base64_decode($input['no_nama_dokumen']),base64_decode($input['no_client']));

echo "<table class='table text-theme1 table-sm table-striped table-bordered'>";
echo "<thead>
    <tr>";
foreach ($query->result_array() as $d){
echo "<th>".$d['nama_meta']."</th>";
}
echo "</tr>"

. "</thead>";

echo "<tbody>";
foreach ($query2->result_array() as $d){
$b = $this->db->get_where('data_meta_berkas',array('no_berkas'=>$d['no_berkas']));
echo "<tr>";

foreach ($b->result_array() as $i){
echo "<td>".$i['value_meta']."</td>";    
}

        echo '</td>';
echo "</tr>";
    
    
}
echo "</tbody>";


echo"</table>";   
}else{
redirect(404);    
}
}

public function data_perekaman_user_client(){
if($this->input->post()){
$input = $this->input->post();    

$data_berkas  = $this->M_user3->data_telah_dilampirkan(base64_decode($input['no_client']));
foreach ($data_berkas->result_array() as $u){  
echo'<div class=" m-1">
<div class="row">
<div class="col ">'.$u['nama_dokumen'].'</div> 
<div class="col-md-4  text-right">
<button type="button" onclick=lihat_meta_berkas("'.base64_encode($u['no_nama_dokumen']).'","'.$input['no_client'].'") class="btn btn-sm btn-outline-dark btn-block">Lihat data <span class="fa fa-eye"></span></button>';
echo "</div>    
</div>
</div>";
}


}
else{
redirect(404);    
}
}
public function download_berkas(){
$data = $this->M_user3->data_berkas_where($this->uri->segment(3))->row_array();

$file_path = "./berkas/".$data['nama_folder']."/".$data['nama_berkas']; 
$info = new SplFileInfo($data['nama_berkas']);
force_download($data['nama_dokumen'].".".$info->getExtension(), file_get_contents($file_path));
}


public function download_utama($id_data_dokumen_utama){

$this->db->select('data_dokumen_utama.nama_file,'
        . 'data_client.nama_folder,'
        . 'data_dokumen_utama.nama_berkas');    
$this->db->from('data_dokumen_utama');
$this->db->join('data_pekerjaan', 'data_pekerjaan.no_pekerjaan = data_dokumen_utama.no_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('id_data_dokumen_utama',base64_decode($id_data_dokumen_utama));
$data= $this->db->get()->row_array();    


$file_path = "./berkas/".$data['nama_folder']."/".$data['nama_file']; 
$info = new SplFileInfo($data['nama_file']);
force_download($data['nama_berkas'].".".$info->getExtension(), file_get_contents($file_path));
}

function form_tolak_perizinan(){
if($this->input->post()){    
$input = $this->input->post();
echo '<div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
<div class="modal-content ">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" >MASUKAN ALASAN PENOLAKAN PERIZINAN <span id="title"></span> </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body text-theme1 " >
<form id="form_penolakan_tugas">
';
 echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" readonly="" class="required"  accept="text/plain">';

echo '<input type="hidden" name="no_berkas_perizinan" id="no_berkas_perizinan" class="no_berkas_perizinan" value="'.$input['no_berkas_perizinan'].'">    
<input name="no_pekerjaan" id="no_pekerjaan" type="hidden" class="no_pekerjaan" value="'.$input['no_pekerjaan'].'">    
<textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control alasan_penolakan" placeholder="Masukan alasan penolakan"></textarea>
';    

echo "</div>"
. "<div class='modal-footer'>"
        . "<button onclick=simpan_penolakan(); class='btn btn-sm btn-success btn_tolak_tugas btn-block'>Simpan Perubahan <span class='fa fa-save'</button></form>"
        . "</form></div>"
. "</div>";

echo "</div>"
. "</div>";


}else{
    redirect(404);    
}
}



function form_laporan(){
if($this->input->post()){    
$input = $this->input->post();
echo '<div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
<div class="modal-content ">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" >MASUKAN LAPORAN PERIZINAN<span id="title"></span> </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body text-theme1 " >
<form id="form_laporan">
';
 echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" readonly="" class="required"  accept="text/plain">';

echo '<input type="hidden" name="no_berkas_perizinan" id="no_berkas_perizinan" class="no_berkas_perizinan" value="'.$input['no_berkas_perizinan'].'">    
<input name="no_pekerjaan" id="no_pekerjaan" type="hidden" class="no_pekerjaan" value="'.$input['no_pekerjaan'].'">    
<textarea name="laporan" id="laporan" class="form-control alasan_penolakan" placeholder="Masukan laporan perizinan"></textarea>
';    

echo "</div>"
. "<div class='modal-footer'>"
        . "<button onclick=simpan_laporan(); class='btn btn-sm btn-success btn_simpan_laporan btn-block'>Simpan Perubahan <span class='fa fa-save'</button></form>"
        . "</form></div>"
. "</div>";

echo "</div>"
. "</div>";


}else{
    redirect(404);    
}
}

public function json_data_lampiran_client($no_client){
echo $this->M_user3->json_data_lampiran_client($no_client);  
}

public function lihat_lampiran_client(){    
$data_client = $this->M_user3->data_client_where($this->uri->segment(3));       

$this->load->view('umum/V_header');
$this->load->view('user3/V_lihat_lampiran_client',['data_client'=>$data_client]);   
}



function lihat_meta(){
if($this->input->post()){ 
$input = $this->input->post(); 
$data = $this->db->get_where('data_meta_berkas',array('no_berkas'=>$input['no_berkas']));    
    
echo '<div class="modal-content ">
<div class="modal-header">
<h6 class="modal-title" id="exampleModalLabel text-center">Data yang telah direkam<span class="i"><span></h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body data_perekaman">';
if($data->num_rows() == 0){
echo "<p class='text-center'>Meta Data Tidak Tersedia</p><hr>";    
}else{
echo '<table class="table table-sm table-bordered ">';

foreach ($data->result_array() as $d){
echo "<tr><td>".str_replace('_', ' ',$d['nama_meta'])."</td><td>".$d['value_meta']."</td></tr>";    
}

echo "<table>"
. "<hr>";
}
echo "<button onclick=cek_download('".base64_encode($input['no_berkas'])."') class='btn btn-sm  mr-2 btn-success '>Download lampiran <span class='fa fa-save'></span></button>";


echo "<button onclick=edit_meta('".$input['no_berkas']."','".$input['no_nama_dokumen']."','".$input['no_pekerjaan']."') class='btn btn-sm  mr-2  btn-warning  '>Meta lampiran <span class='fa fa-edit'></span></button>";

echo "<button  onclick=hapus_lampiran('".base64_encode($input['no_berkas'])."') class='btn btn-sm  mr-2 btn-danger  '>Hapus lampiran <span class='fa fa-trash'></span></button>";
echo'</div>'
. '</div>';    


}else{
redirect(404);
}    
}


public function hapus_lampiran(){
if($this->input->post()){
$input = $this->input->post();    
$data = $this->M_user3->hapus_lampiran(base64_decode($input['no_berkas']))->row_array();

$filename = './berkas/'.$data['nama_folder']."/".$data['nama_berkas'];

if(file_exists($filename)){
unlink($filename);
}
$this->db->delete('data_berkas',array('no_berkas'=> base64_decode($input['no_berkas'])));    

$status[] = array(
"status"        => "success",
"messages"      => "Data persyaratan dihapus",    
);
echo json_encode($status);

$keterangan = $this->session->userdata('nama_lengkap')." Menghapus File dokumen".$data['nama_dokumen'];  
$this->histori($keterangan);


}else{
redirect(404);    
}
}


function form_meta(){
if($this->input->post()){ 
$input = $this->input->post();    
$this->db->get_where('data_meta_berkas',array('no_berkas'=>$input['no_berkas']));    

$data_meta = $this->M_user3->data_meta($input['no_nama_dokumen']);

echo '<div class="modal-content ">
<div class="modal-header">
<h6 class="modal-title" id="exampleModalLabel text-center">Data yang telah direkam<span class="i"><span></h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body data_perekaman">
<form id="form_edit_meta">';
echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" readonly="" class="required"  accept="text/plain">';
echo '<input type="hidden" name="no_berkas" value="'.$input['no_berkas'].'" readonly="" class="required"  accept="text/plain">';
echo '<input type="hidden" name="no_pekerjaan" value="'.$input['no_pekerjaan'].'" readonly="" class="required"  accept="text/plain">';
echo '<input type="hidden" name="no_nama_dokumen" value="'.$input['no_nama_dokumen'].'" readonly="" class="required"  accept="text/plain">';


foreach ($data_meta->result_array()  as $d ){
$val = $this->M_user3->data_edit($input['no_berkas'],str_replace(' ', '_',$d['nama_meta']))->row_array();
//INPUTAN SELECT   
if($d['jenis_inputan'] == 'select'){
$data_option = $this->db->get_where('data_input_pilihan',array('id_data_meta'=>$d['id_data_meta']));   
echo "<label>".$d['nama_meta']."</label>"
."<select id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' class='form-control form_meta form-control-sm meta required' required='' accept='text/plain'>";
foreach ($data_option->result_array() as $option){
echo "<option ";
if($val['value_meta'] == $option['jenis_pilihan']){
echo "selected";    
}
echo ">".$option['jenis_pilihan']."</option>";
}
echo "</select>";
//INPUTAN DATE
}else if($d['jenis_inputan'] == 'date'){
echo "<label>".$d['nama_meta']."</label>"
."<input value='".$val['value_meta']."'  type='text' id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' placeholder='".$d['nama_meta']."'  maxlength='".$d['maksimal_karakter']."' class='form-control form_meta form-control-sm ".$d['jenis_inputan']." meta required ' required='' accept='text/plain' >";    
///INPUTAN NUMBER
}else if($d['jenis_inputan'] == 'number'){
echo "<label>".$d['nama_meta']."</label>"
."<input value='".$val['value_meta']."' type='text' id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' placeholder='".$d['nama_meta']."'  maxlength='".$d['maksimal_karakter']."' class='form-control form_meta form-control-sm ".$d['jenis_bilangan']." meta required ' required='' accept='text/plain' >";        
//INPUTAN TEXTAREA
}else if($d['jenis_inputan'] == 'textarea'){
echo "<label>".$d['nama_meta']."</label>"
. "<textarea  id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' placeholder='".$d['nama_meta']."'  maxlength='".$d['maksimal_karakter']."' class='form-control form_meta form-control-sm ".$d['jenis_bilangan']." meta required ' required='' accept='text/plain'>".$val['value_meta']."</textarea>";
}else{
echo "<label>".$d['nama_meta']."</label>"
."<input  type='".$d['jenis_inputan']."' value='".$val['value_meta']."' id='".str_replace(' ', '_',$d['nama_meta'])."' name='".$d['nama_meta']."' placeholder='".$d['nama_meta']."'  maxlength='".$d['maksimal_karakter']."' class='form-control form_meta form-control-sm  meta required ' required='' accept='text/plain' >";    
}
}
echo "</form><hr>";
echo "<button onclick=update_meta('".base64_encode($input['no_berkas'])."') class='btn btn-block btn-sm  mr-2 btn-success '>Simpan Meta <span class='fa fa-save'></span></button>";
echo'</div>'
. '</div>';    

}else{
redirect(404);
}    
}


function update_meta(){
if($this->input->post()){
$input = $this->input->post();
$cek_meta = $this->db->get_where('data_meta_berkas',array('no_berkas'=>$input['no_berkas']));
if($cek_meta->num_rows() == 0){
$this->simpan_meta($input);    
}else{
foreach ($input as $key=>$value){
if($key != "no_berkas"){
$data = array(
'value_meta'=>$value    
);
$this->db->update('data_meta_berkas',$data,array('no_berkas'=>$input['no_berkas'],'nama_meta'=>$key));
}
}
$status[] = array(
'status'  => 'success',
'messages'=> "Meta Data diperbaharui",    
);
echo json_encode($status);
}
}else{
redirect(404);    
}

    
}

public function  simpan_meta(){
$input = $this->input->post();
foreach ($input as $key=>$value){
if($key == 'no_berkas' || $key == "no_nama_dokumen" || $key == 'no_client' || $key == 'no_pekerjaan' || $key == 'file_berkas'){
}else{
$meta = array(
'no_pekerjaan'      => $input['no_pekerjaan'],
'no_nama_dokumen'   => $input['no_nama_dokumen'],
'no_berkas'         => $input['no_berkas'],    
'nama_meta'         => $key,
'value_meta'        => $value,    
);
$this->db->insert('data_meta_berkas',$meta);
}
}
$status[] = array(
"status"        => "success",
"messages"      => "Meta Berhasil disimpan",
);
echo json_encode($status);
}

}