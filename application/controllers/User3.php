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
'tanggal_proses_tugas'   =>date('d/m/Y'),
'target_kelar_perizinan' =>$this->input->post('target_kelar'),
'status'                 =>'Proses'    
);
$this->db->update('data_berkas',$data,array('id_data_berkas'=>$this->input->post('id_data_berkas')));


$status = array(
'status' =>"success",
'pesan'  =>"Dokumen masuk kedalam proses perizinan"    
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

public function simpan_file_perizinan(){
if($this->input->post()){
$get_syarat = $this->db->get_where('data_syarat_jenis_dokumen',array('id_syarat_dokumen'=>$this->input->post('id_syarat_dokumen')))->row_array();

$config['upload_path']          = './berkas/'.$get_syarat['file_berkas'].'/';
$config['allowed_types']        = 'jpg|png|pdf|docx|doc|xls|xlsx|';
$config['encrypt_name']         = TRUE;
$this->upload->initialize($config);

if (!$this->upload->do_upload('dokumen_perizinan')){

$status = array(
"status"=>"Gagal",
"pesan" => $this->upload->display_errors()
);
echo json_encode($status);
}else{

$data2 = array(
'file_berkas'      => $get_syarat['file_berkas'],
'lampiran'         => $this->upload->data('file_name'),
'status_berkas'    => "Selesai",
'tanggal_selesai'  => date('Y/m/d H:i:s'),  
);
$this->db->update('data_syarat_jenis_dokumen',$data2,array('id_syarat_dokumen'=>$this->input->post('id_syarat_dokumen')));

$data_dokumen = array(
'no_nama_dokumen'  => $get_syarat['no_nama_dokumen'],
'nama_dokumen'     => $get_syarat['nama_dokumen'],
'no_berkas'        => $get_syarat['no_berkas'],
'no_client'        => $get_syarat['no_client'],
'file_berkas'      => $get_syarat['file_berkas'],
'lampiran'         => $this->upload->data('file_name'),
'pengupload'       => $this->session->userdata('nama_lengkap'),
'no_user'          => $this->session->userdata('no_user'),
'status_dokumen'   => 'Selesai',
);    
$this->db->insert('data_dokumen',$data_dokumen);    
   




$status = array(
"status"=>"Berhasil",
"pesan" =>"File ".$get_syarat['nama_dokumen']." Berhasil di upload",
);
echo json_encode($status);
    
}
}else{
redirect(404);    
}    
}

public function halaman_selesai(){
$data_tugas = $this->M_user3->data_tugas('Selesai');    
    
$this->load->view('umum/V_header');
$this->load->view('user3/V_halaman_selesai',['data_tugas'=>$data_tugas]);
    
}
public function json_data_perizinan_selesai(){
echo $this->M_user3->json_data_perizinan_selesai();       
}



public function lihat_persyaratan(){
if($this->input->post()){
$input = $this->input->post();
$data = $this->db->get_where('data_berkas',array('no_pekerjaan'=>$input['no_pekerjaan'],'status_berkas'=>'Persyaratan'));

foreach ($data->result_array() as $d){
 echo "<button onclick=download('".$d['id_data_berkas']."'); class='btn btn-light btn-block p-2 m-2' >".$d['nama_file']." <span class='fa float-right fa-download'></button>";  
}
}else{
redirect(404);    
}
}
public function download_berkas(){
$data = $this->db->get_where('data_berkas',array('id_data_berkas'=>$this->uri->segment(3)))->row_array();    
$file_path = "./berkas/".$data['nama_folder']."/".$data['nama_berkas']; 
$info = new SplFileInfo($data['nama_berkas']);
force_download($data['nama_file'].".".$info->getExtension(), file_get_contents($file_path));
}

public function form_upload_berkas(){
if($this->input->post()){
$input = $this->input->post();    
$data = $this->db->get_where('data_berkas',array('id_data_berkas'=>$input['id_data_berkas']))->row_array();

$data_meta = $this->db->get_where('data_meta',array('no_nama_dokumen'=>$data['no_nama_dokumen']));
echo "<form action='".base_url('User3/simpan_berkas')."' method='post' enctype='multipart/form-data'>"
. "<input type='hidden' name='".$this->security->get_csrf_token_name()."' value='".$this->security->get_csrf_hash()."'>"
. "<input type='hidden' name='id_data_berkas' value='".$input['id_data_berkas']."'>";

echo "<label>Nama Berkas</label>"
. "<input type='text' class='form-control' name='Nama_berkas' value='".$data['nama_file']."'>";
foreach ($data_meta->result_array() as $m){
echo "<label>".$m['nama_meta']."</label>"
."<input type='text' class='form-control' required name='".$m['nama_meta']."'>";    
}

echo "<label>Upload ".$data['nama_file']."</label>"
. "<input type='file' class='form-control' name='file_berkas' required >"
. "<hr>"
. "<button class='btn btn-success btn-block'>Upload <span class='fa fa-upload'></span></butto>"
. "</form>";

}else{
redirect(404);    
}    
}
public function simpan_berkas(){
    
if($this->input->post()){
$input = $this->input->post();

$this->db->select('*');
$this->db->from('data_berkas');
$this->db->join('data_client', 'data_client.no_client = data_berkas.no_client');
$this->db->where('data_berkas.id_data_berkas',$input['id_data_berkas']);
$data_static = $this->db->get()->row_array();


$config['upload_path']          = './berkas/'.$data_static['nama_folder'];
$config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|xlxs|';
$config['encrypt_name']         = TRUE;

$this->upload->initialize($config);
if (!$this->upload->do_upload('file_berkas')){
$error = array('error' => $this->upload->display_errors());
echo print_r($error);
}else{
$data_berkas = array(
'no_client'         => $data_static['no_client'],
'no_pekerjaan'      => $data_static['no_pekerjaan'],
'no_nama_dokumen'   => $data_static['no_nama_dokumen'],
'nama_folder'       => $data_static['nama_folder'],
'nama_berkas'       => $this->upload->data('file_name'),
'nama_file'         => $this->input->post('Nama_berkas'),    
'Pengupload'        => $this->session->userdata('nama_lengkap'),
'status'            =>'Selesai'    
    
);    
$this->db->update('data_berkas',$data_berkas,array('id_data_berkas'=>$input['id_data_berkas']));


foreach ($_POST as $key => $value){
if($value == $input['id_data_berkas'] ){
}else{
$data_meta = array(
'nama_berkas'    =>$this->upload->data('file_name'),
'no_client'      => $data_static['no_client'],
'no_pekerjaan'   => $data_static['no_pekerjaan'],
'no_nama_dokumen'=> $data_static['no_nama_dokumen'],
'nama_folder'    => $data_static['nama_folder'],
'nama_meta'      => $key,
'value_meta'     =>$value,    
);
$this->db->insert('data_meta_berkas',$data_meta);
}    
    
}

redirect(base_url('User3/halaman_proses'));
}
}else{
redirect(404);    
}

}
}
