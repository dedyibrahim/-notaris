<?php 
class M_user2 extends CI_model{
function json_data_client(){
    
$this->datatables->select('id_data_client,'
.'data_client.no_client as no_client,'
.'data_client.pembuat_client as pembuat_client,'
.'data_client.jenis_client as jenis_client,'
.'data_client.nama_client as nama_client,'
);
$this->datatables->from('data_client');
$this->datatables->where('no_user',$this->session->userdata('no_user'));
$this->datatables->add_column('view',""
        . "<select onchange=opsi_client('$1','$2') class='form-control opsi_pekerjaan$1'>"
        . "<option></option>"
        . "<option value='1'>Lihat berkas</option>"
        . "<option value='2'>Pekerjaan baru</option>"
        . "</select>"
        . "",'id_data_client , base64_encode(no_client)');
return $this->datatables->generate();
}
public function simpan_syarat($data){
$this->db->insert('data_syarat_jenis_dokumen',$data);    
}

public function cari_jenis_dokumen($term){
$this->db->from("data_jenis_dokumen");
$this->db->limit(15);
$array = array('nama_jenis' => $term);
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}


public function hitung_pekerjaan(){
       $query = $this->db->get('data_pekerjaan');
return $query;
}
public function data_client(){
$query = $this->db->get('data_client');  
return $query;
}



function json_data_perorangan(){
    
$this->datatables->select('id_perorangan,'
.'data_perorangan.id_perorangan as id_perorangan,'
.'data_perorangan.no_nama_perorangan as no_nama_perorangan,'
.'data_perorangan.nama_identitas as nama_identitas,'
.'data_perorangan.no_identitas as no_identitas,'
.'data_perorangan.jenis_identitas as jenis_identitas,'
.'data_perorangan.status_jabatan as status_jabatan,'
);
$this->datatables->from('data_perorangan');
//$this->datatables->where('no_user',$this->session->userdata('no_user'));
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=download_lampiran('$1'); > Download lampiran <i class='fa fa-download'></i></button>",'id_perorangan');
return $this->datatables->generate();
}
function json_data_riwayat(){
    
$this->datatables->select('id_data_histori_pekerjaan,'
.'data_histori_pekerjaan.keterangan as keterangan,'
.'data_histori_pekerjaan.tanggal as tanggal,'
);
$this->datatables->from('data_histori_pekerjaan');
$this->datatables->where('no_user',$this->session->userdata('no_user'));
return $this->datatables->generate();
}

function json_data_pekerjaan_selesai(){
    
$this->datatables->select('id_data_pekerjaan,'
.'data_pekerjaan.id_data_pekerjaan as id_data_pekerjaan,'
.'data_pekerjaan.no_pekerjaan as no_pekerjaan,'
.'data_pekerjaan.jenis_perizinan as jenis_perizinan,'
.'data_pekerjaan.pembuat_pekerjaan as pembuat_pekerjaan,'
.'data_client.nama_client as nama_client,'
.'data_pekerjaan.tanggal_selesai as tanggal_selesai,'
);
$this->datatables->from('data_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->datatables->where('data_pekerjaan.no_user',$this->session->userdata('no_user'));
$this->datatables->where('data_pekerjaan.status_pekerjaan','Selesai');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=download_lampiran('$1'); >Lihat File <i class='fa fa-eye'></i></button>",'id_perorangan');
return $this->datatables->generate();
}

public function data_pekerjaan_histori($no_pekerjaan){
$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_pekerjaan.no_pekerjaan',$no_pekerjaan,FALSE);
$query = $this->db->get();

return $query;
}
public function data_pekerjaan($param){
$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_pekerjaan.status_pekerjaan',$param);
$this->db->where('data_pekerjaan.no_user',$this->session->userdata('no_user'),FALSE);
$query = $this->db->get();

return $query;
}

public function data_pekerjaan_persyaratan($param){
$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_pekerjaan.no_pekerjaan',$param);
$query = $this->db->get();

return $query;
}

public function data_dokumen_utama($no_berkas){
 $query = $this->db->get_where('data_dokumen_utama',array('no_berkas'=> base64_decode($no_berkas)));
 return $query;
    
}

public function  data_form_perorangan($no_berkas){
         $this->db->order_by('id_data_syarat_perorangan',"DESC");
$query = $this->db->get_where('data_syarat_perorangan',array('no_berkas'=> base64_decode($no_berkas)));    
    
return $query;    
}

public function data_user(){
$query = $this->db->get_where('user',array('sublevel'=>'Level 3'));   
return $query;    
}
public function  data_form_perizinan($no_berkas){

$this->db->order_by('id_syarat_dokumen',"DESC");
$query = $this->db->get_where('data_syarat_jenis_dokumen',array('no_berkas'=> base64_decode($no_berkas)));       
return $query;    
}
public function data_pekerjaan_proses($id){

$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('data_persyaratan_pekerjaan', 'data_persyaratan_pekerjaan.no_jenis_dokumen = data_pekerjaan.no_jenis_perizinan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_pekerjaan.no_pekerjaan', base64_decode($id));
$query = $this->db->get();   

return $query;
}

public function data_perorangan(){
$query = $this->db->get('data_perorangan');    
    
return $query;    
    
}


public function hapus_data_syarat_perorangan($id_data_syarat_perorangan){
$this->db->delete('data_syarat_perorangan',array('id_data_syarat_perorangan'=>$id_data_syarat_perorangan));    
}
public function hapus_syarat_dokumen($id_syarat_dokumen){
$this->db->delete('data_syarat_jenis_dokumen',array('id_syarat_dokumen'=>$id_syarat_dokumen));    
}

public function cari_data_perorangan($term){
$this->db->from("data_perorangan");
$this->db->limit(15);
$array = array('nama_identitas' => $term);
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}

public function data_persyaratan_upload($no_pekerjaan){
$this->db->select('*');
$this->db->group_by('data_meta_berkas.nama_berkas');
$this->db->from('data_meta_berkas');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_meta_berkas.no_nama_dokumen');
$this->db->where('data_meta_berkas.no_pekerjaan',base64_decode($no_pekerjaan));
$query = $this->db->get();  
return $query;    
}

public function data_user_where($no_user){

$query = $this->db->get_where('user',array('no_user'=>$no_user));

return $query;
}

}
?>