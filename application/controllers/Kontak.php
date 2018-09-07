<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Author : Asep Yayat
 * Date 7 September 2018
 * Free to Use or Modified
 */
class Kontak extends CI_Controller {
    /**
     * Fungsi constructor
     */    
    public function __construct(){
        parent::__construct();
        $this->load->model('m_kontak');
    }

    /**
     * Halaman List Kontak
     */
	public function index()
	{
        /**
         * Data yang akan di kirimkan ke views
         */        
        $context =  array(
            'title' => 'Index Dashboard',
            'pages' => 'dashboard',
            'kontak' => $this->m_kontak->get_kontak()
        );

        /**
         * Load halaman views
         */
		$this->load->view('index', $context);
    }

    /**
     * Halaman Tambah kontak / Edit
     */
	public function create()
	{
        /**
         * Ini berfungsi untuk mendeteksi edit atau simpan data
         */
        $pk = $this->uri->segment(3);

        /**
         * Data yang akan di kirimkan ke views
         */
        $context =  array(
            'title' => $pk ? 'Edit Kontak' : 'Tambah Kontak',
            'pages' => 'create',
            'pk' => $pk
        );

        if($pk == null){
            $context['query'] = null;
        } else {
            $context['query'] = $this->m_kontak->get_by_pk($pk);
        }

        /**
         * Load halaman views
         */
		$this->load->view('index', $context);
    }    
    
    public function delete(){
        $response = array();
        $pk = $this->input->post('pk');

        /**
         * Jika nilai primary key tidak kosong
         */
        if($pk){
            /**
             * Jika berhasil mendelete kontak
             */
            if($this->m_kontak->delete_kontak($pk)){
                $response['type'] = 'deleted';
            } else {
                $response['type'] = 'canceled';
            }
        } else {
            $response['type'] = 'canceled';
        }

        /**
         * Munculkan response yang telah kita buat
         */
        echo json_encode($response);        
    }

    /**
     * Fungsi untuk save data ke tabel
     */
    public function save(){
        /**
         * Ini berfungsi untuk mendeteksi edit atau simpan data
         */
        $pk = $this->uri->segment(3);

        /**
         * Untuk menampung response JSON yang akan di tampilkan di view
         */
        $response = array();

        /**
         * Data yang akan di kirimkan ke views
         */
        $data = array(
            'name' => $this->input->post('name'),
            'number' => $this->input->post('number'),
            'email' => $this->input->post('email')
        );

        /**
         * Jika primary keynya null maka aksinya menyimpan, kalo ada berarti update
         */
        if($pk == null){
            $this->m_kontak->insert_kontak($data);
            $response['type'] = 'saved';
        } else {
            $this->m_kontak->update_kontak($data, $pk);
            $response['type'] = 'updated';
        }

        /**
         * Munculkan response yang telah kita buat
         */
        echo json_encode($response);
    }
}
