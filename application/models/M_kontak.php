<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Author : Asep Yayat
 * Date 7 September 2018
 * Free to Use or Modified
 */
class M_Kontak extends CI_Model {
    /**
     * Mendefinisikan Primary key
     * Mendefinisikan kolom id sebagai primary key
     */
    public $pk = 'id';

    /**
     * Mendefinisikan tabel yang akan di pakai
     * Mendefinisikan tabel kontak
     */
    public $table = 'kontak';

    /**
     * Fungsi memasukan data kedalam tabel kontak
     * $data = berisi array yang akan di masukan dalam tabel
     */
    public function insert_kontak($data){
        return $this->db
            ->insert($this->table, $data);
    }

    /**
     * Fungsi update data kontak
     * $data = berisi array data-data baru
     * $pk = primary key
     */
    public function update_kontak($data, $pk){
        return $this->db
            ->where($this->pk, $pk)
            ->update($this->table, $data);
    }

    /**
     * Fungsi delete kontak
     * $pk = primary key
     */
    public function delete_kontak($pk){
        return  $this->db
            ->where($this->pk, $pk)
            ->delete($this->table);
    }

    /**
     * Fungi untuk mendapatkan data kontak by primary key
     */
    public function get_by_pk($pk){
        $query =  $this->db
                ->where($this->pk, $pk)
                ->get($this->table);
        /**
         * Check apakah terdapat data dengan id tersebut
         * jika tidak akan diarahkan ke halaman kontak
         */
        if($query->num_rows() != 1){
            redirect(base_url('kontak'));
        } else {
            return $query->row();
        }
    }

    /**
     * Mengambil data kontak
     */
    public function get_kontak(){
        return $this->db
            ->get($this->table)
            ->result();
    }
}