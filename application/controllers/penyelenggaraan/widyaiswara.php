<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author bharata
 */
class Widyaiswara extends Penyelenggaraan_Controller{
    
    protected $thn;
    
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('mdl_penyelenggaraan','slng');
        $this->load->model('mdl_perencanaan','rnc');
        $this->thn = date('Y');
    }
    
    function index(){
	$this->list_widyaiswara();       
    }
     
    function list_widyaiswara(){
        $data['sub_title']='Daftar Widyaiswara';
        $data['list']=$this->slng->getall_widyaiswara();
        $this->template->display('simdik/penyelenggaraan/list_widyaiswara',$data);
    }
    
    function detail_widyaiswara($id){
        $data['data'] = $this->slng->get_widyaiswara($id);
        $data['sub_title']='Detail Data '.$data['data']['nama'];
        
        if($data['data']){
            $this->template->display('simdik/penyelenggaraan/detail_widyaiswara',$data);
        }else{
            $this->session->set_flashdata('msg',$this->editor->alert_error('Widyaiswara tidak ditemukan'));
            redirect(base_url().'penyelenggaraan/widyaiswara/list_widyaiswara');
        }
    }
    
    function add_widyaiswara(){
        $data['sub_title']='Isi Data Widyaiswara';
        $this->template->display('simdik/penyelenggaraan/cv_widyaiswara',$data);
    }
    
    function insert_widyaiswara(){
        $data['nama']=$this->input->post('nama');
        $data['nip']=$this->input->post('nip');
        $data['tempat_lahir']=$this->input->post('tempat');
        $data['tanggal_lahir']=$this->input->post('tanggal');
        $data['pangkat']=$this->input->post('pangkat');
        $data['golongan']=$this->input->post('gol');
        $data['instansi']=$this->input->post('instansi');
        $data['alamat_rumah']=$this->input->post('alamat_rumah');
        $data['tlp_rumah']=$this->input->post('tlp_rumah');
        $data['alamat_kantor']=$this->input->post('alamat_kantor');
        $data['tlp_kantor']=$this->input->post('tlp_kantor');
        $data['jabatan']=$this->input->post('jabatan');
        
        //mengambil data pendidikan dalam negeri
        $dlm_ngri=$this->input->post('dlm_ngri');
        $periode_dlm_ngri=$this->input->post('periode_dlm_ngri');
        $data['pendidikan_dn']='';
        if(count($dlm_ngri)>0){
            for($i=0;$i<count($dlm_ngri);$i++){
                if($dlm_ngri[$i]==''){
                    $dlm_ngri[$i]='-';
                }
                if($periode_dlm_ngri[$i]==''){
                    $periode_dlm_ngri[$i]='-';
                }
                $text = '<li>'.$periode_dlm_ngri[$i].' : '.$dlm_ngri[$i].'</li>';
                $data['pendidikan_dn'].=$text;
            }
        }
        
        //mengambil data pendidikan luar negeri
        $luar_ngri=$this->input->post('luar_ngri');
        $periode_luar_ngri=$this->input->post('periode_luar_ngri');
        $data['pendidikan_ln']='';
        if(count($luar_ngri)>0){
            for($i=0;$i<count($luar_ngri);$i++){
                if($luar_ngri[$i]==''){
                    $luar_ngri[$i]='-';
                }
                if($periode_luar_ngri[$i]==''){
                    $periode_luar_ngri[$i]='-';
                }
                $text = '<li>'.$periode_luar_ngri[$i].' : '.$luar_ngri[$i].'</li>';
                $data['pendidikan_ln'].=$text;
            }
        }
        
        //mengambil data history jabatan
        $riwayat_jbtn=$this->input->post('riwayat_jbtn');
        $periode_jbtn=$this->input->post('periode_jbtn');
        $data['history_jabatan']='';
        if(count($riwayat_jbtn)>0){
            for($i=0;$i<count($riwayat_jbtn);$i++){
                if($riwayat_jbtn[$i]==''){
                    $riwayat_jbtn[$i]='-';
                }
                if($periode_jbtn[$i]==''){
                    $periode_jbtn[$i]='-';
                }
                $text = '<li>'.$periode_jbtn[$i].' : '.$riwayat_jbtn[$i].'</li>';
                $data['history_jabatan'].=$text;
            }
        }
        
        //mengambil data kursus
        $kursus=$this->input->post('kursus');
        $periode_kursus=$this->input->post('thn_kursus');
        $data['history_kursus']='';
        if(count($kursus)>0){
            for($i=0;$i<count($kursus);$i++){
                if($kursus[$i]==''){
                    $kursus[$i]='-';
                }
                if($periode_kursus[$i]==''){
                    $periode_kursus[$i]='-';
                }
                $text = '<li>'.$kursus[$i].' : '.$periode_kursus[$i].'</li>';
                $data['history_kursus'].=$text;
            }
        }
        
        //mengambil data diklat
        $diklat=$this->input->post('diklat');
        $data['history_diklat']='';
        if(count($diklat)>0){
            for($i=0;$i<count($diklat);$i++){
                if($diklat[$i]!=''){
                    $text = '<li>'.$diklat[$i].'</li>';
                    $data['history_diklat'].=$text;
                }
            }
        }
        
        
        $data['status']=1;
        
        $this->slng->insert_widyaiswara($data);
        $this->session->set_flashdata('msg',$this->editor->alert_ok('Widyaiswara telah ditambahkan'));
        redirect(base_url().'penyelenggaraan/widyaiswara/list_widyaiswara');
    }
    
    function edit_widyaiswara($id){
        $data['data'] = $this->slng->get_widyaiswara($id);

        //parsing data pendidikan dn
        $pnddkn_dn=array();
        $periode_dn=array();
        
        $pendidikan_dn=$data['data']['pendidikan_dn'];
        $pendidikan_dn=str_replace('<li>', '', $pendidikan_dn);
        $pendidikan_dn=str_replace('</li>', ' # ', $pendidikan_dn);
        
        $per_dn=explode('#',$pendidikan_dn);
        $i=0;
        foreach($per_dn as $a){
            if(trim($a)!=''){
                $dn=explode(':',trim($a));
                $pnddkn_dn[$i]=trim($dn[1]);
                $periode_dn[$i]=trim($dn[0]);
                $i++;
            }
        }
        $data['data']['dn']=$pnddkn_dn;
        $data['data']['periode_dn']=$periode_dn;
        
        
        //parsing data pendidikan ln
        $pnddkn_ln=array();
        $periode_ln=array();
        
        $pendidikan_ln=$data['data']['pendidikan_ln'];
        $pendidikan_ln=str_replace('<li>', '', $pendidikan_ln);
        $pendidikan_ln=str_replace('</li>', ' # ', $pendidikan_ln);
        
        $per_ln=explode('#',$pendidikan_ln);
        $i=0;
        foreach($per_ln as $a){
            if(trim($a)!=''){
                $ln=explode(':',trim($a));
                $pnddkn_ln[$i]=trim($ln[1]);
                $periode_ln[$i]=trim($ln[0]);
                $i++;
            }
        }
        $data['data']['ln']=$pnddkn_ln;
        $data['data']['periode_ln']=$periode_ln;
        
        
        //parsing data riwayat pekerjaan
        $data_riwayat=array();
        $data_periode=array();
        
        $riwayat_pekerjaan=$data['data']['history_jabatan'];
        $riwayat_pekerjaan=str_replace('<li>', '', $riwayat_pekerjaan);
        $riwayat_pekerjaan=str_replace('</li>', ' # ', $riwayat_pekerjaan);
        
        $per_riwayat=  explode('#', $riwayat_pekerjaan);
        $i=0;
        foreach($per_riwayat as $a){
            if(trim($a)!=''){
                $riwayat=explode(':',trim($a));
                $data_riwayat[$i]=trim($riwayat[1]);
                $data_periode[$i]=trim($riwayat[0]);
                $i++;
            }
        }
        $data['data']['riwayat']=$data_riwayat;
        $data['data']['periode']=$data_periode;
        
        //parsing data riwayat kursus
        $data_kursus=array();
        $kursus_periode=array();
        
        $riwayat_kursus=$data['data']['history_kursus'];
        $riwayat_kursus=str_replace('<li>', '', $riwayat_kursus);
        $riwayat_kursus=str_replace('</li>', ' # ', $riwayat_kursus);
        
        $per_riwayat=  explode('#', $riwayat_kursus);
        $i=0;
        foreach($per_riwayat as $a){
            if(trim($a)!=''){
                $riwayat=explode(':',trim($a));
                $data_kursus[$i]=trim($riwayat[1]);
                $kursus_periode[$i]=trim($riwayat[0]);
                $i++;
            }
        }
        $data['data']['kursus']=$data_kursus;
        $data['data']['periode_kursus']=$kursus_periode;
        
        //parsing data riwayat diklat
        $data_diklat=array();
        
        $riwayat_diklat=$data['data']['history_diklat'];
        $riwayat_diklat=str_replace('<li>', '', $riwayat_diklat);
        $riwayat_diklat=str_replace('</li>', ' # ', $riwayat_diklat);
        
        $per_riwayat=  explode('#', $riwayat_diklat);
        $i=0;
        foreach($per_riwayat as $a){
            if(trim($a)!=''){
                $data_diklat=$a;
                $i++;
            }
        }
        $data['data']['diklat']=$data_diklat;
        
        $data['sub_title']='Edit Data '.$data['data']['nama'];
        if($data['data']){
            $this->template->display('simdik/penyelenggaraan/edit_widyaiswara',$data);
        }else{
            $this->session->set_flashdata('msg',$this->editor->alert_error('Widyaiswara tidak ditemukan'));
            redirect(base_url().'penyelenggaraan/widyaiswara/list_widyaiswara');
        }
    }
    
    function edit_process(){
        $clause=$this->input->post('id');
        $data['nama']=$this->input->post('nama');
        $data['nip']=$this->input->post('nip');
        $data['tempat_lahir']=$this->input->post('tempat');
        $data['tanggal_lahir']=$this->input->post('tanggal');
        $data['pangkat']=$this->input->post('pangkat');
        $data['golongan']=$this->input->post('gol');
        $data['instansi']=$this->input->post('instansi');
        $data['jabatan']=$this->input->post('jabatan');
        $data['alamat_rumah']=$this->input->post('alamat_rumah');
        $data['tlp_rumah']=$this->input->post('tlp_rumah');
        $data['alamat_kantor']=$this->input->post('alamat_kantor');
        $data['tlp_kantor']=$this->input->post('tlp_kantor');
        
        //mengambil data pendidikan dalam negeri
        $dlm_ngri=$this->input->post('dlm_ngri');
        $periode_dlm_ngri=$this->input->post('periode_dlm_ngri');
        $data['pendidikan_dn']='';
        if(count($dlm_ngri)>0){
            for($i=0;$i<count($dlm_ngri);$i++){
                if($dlm_ngri[$i]==''){
                    $dlm_ngri[$i]='-';
                }
                if($periode_dlm_ngri[$i]==''){
                    $periode_dlm_ngri[$i]='-';
                }
                $text = '<li>'.$periode_dlm_ngri[$i].' : '.$dlm_ngri[$i].'</li>';
                $data['pendidikan_dn'].=$text;
            }
        }
        
        //mengambil data pendidikan luar negeri
        $luar_ngri=$this->input->post('luar_ngri');
        $periode_luar_ngri=$this->input->post('periode_luar_ngri');
        $data['pendidikan_ln']='';
        if(count($luar_ngri)>0){
            for($i=0;$i<count($luar_ngri);$i++){
                if($luar_ngri[$i]==''){
                    $luar_ngri[$i]='-';
                }
                if($periode_luar_ngri[$i]==''){
                    $periode_luar_ngri[$i]='-';
                }
                $text = '<li>'.$periode_luar_ngri[$i].' : '.$luar_ngri[$i].'</li>';
                $data['pendidikan_ln'].=$text;
            }
        }
        
        //mengambil data history jabatan
        $riwayat_jbtn=$this->input->post('riwayat_jbtn');
        $periode_jbtn=$this->input->post('periode_jbtn');
        $data['history_jabatan']='';
        if(count($riwayat_jbtn)>0){
            for($i=0;$i<count($riwayat_jbtn);$i++){
                if($riwayat_jbtn[$i]==''){
                    $riwayat_jbtn[$i]='-';
                }
                if($periode_jbtn[$i]==''){
                    $periode_jbtn[$i]='-';
                }
                $text = '<li>'.$periode_jbtn[$i].' : '.$riwayat_jbtn[$i].'</li>';
                $data['history_jabatan'].=$text;
            }
        }
        
        //mengambil data kursus
        $kursus=$this->input->post('kursus');
        $periode_kursus=$this->input->post('thn_kursus');
        $data['history_kursus']='';
        if(count($kursus)>0){
            for($i=0;$i<count($kursus);$i++){
                if($kursus[$i]==''){
                    $kursus[$i]='-';
                }
                if($periode_kursus[$i]==''){
                    $periode_kursus[$i]='-';
                }
                $text = '<li>'.$periode_kursus[$i].' : '.$kursus[$i].'</li>';
                $data['history_kursus'].=$text;
            }
        }
        
        //mengambil data diklat
        $diklat=$this->input->post('diklat');
        $data['history_diklat']='';
        if(count($diklat)>0){
            for($i=0;$i<count($diklat);$i++){
                if($diklat[$i]!=''){
                    $text = '<li>'.$diklat[$i].'</li>';
                    $data['history_diklat'].=$text;
                }
            }
        }
        
        $this->slng->update_widyaiswara($clause,$data);
        $this->session->set_flashdata('msg',$this->editor->alert_ok('Widyaiswara telah diubah'));
        redirect(base_url().'penyelenggaraan/widyaiswara/detail_widyaiswara/'.$clause);
    }
    
    function delete_widyaiswara($id){
        
        $data['data'] = $this->slng->get_widyaiswara($id);
        $data['sub_title']='Registrasi Diklat';
        if($data['data']){
            $this->slng->delete_widyaiswara($id);
            $this->session->set_flashdata('msg',$this->editor->alert_warning('Widyaiswara telah dihapus'));
            redirect(base_url().'penyelenggaraan/dashboard/list_widyaiswara');
        }else{
            $this->session->set_flashdata('msg',$this->editor->alert_error('Widyaiswara tidak ditemukan'));
            redirect(base_url().'penyelenggaraan/widyaiswara/list_widyaiswara');
        }
    }
}
