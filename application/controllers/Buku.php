<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Buku extends RestController 
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('MBuku');
    }

    // get all data
    function index_get()
    {
        $list_buku = $this->MBuku->get_all();
        if ($list_buku) {
            $jumlah_buku = count($list_buku);
            $this->response(
                array(
                    'status' => true,
                    'jumlah' => $jumlah_buku,
                    'list_buku' => $list_buku
                ),
                200
            );
        } else {
            $this->response(
                array(
                    'status' => false,
                    'message' => 'Data buku tidak ditemukan'
                ),
                404
            );
        }
    }

    // get by id
    function get_by_id_get() 
    {
        $id = $this->get('id');
        if ($id) {
            $data_buku = $this->MBuku->get_by_id($id);
            if ($data_buku) {
                $this->response(
                    array(
                        'status' => true,
                        'data_buku' => $data_buku
                    ),
                    200
                );
            } else {
                $this->response(
                    array(
                        'status' => false,
                        'message' => 'Data buku tidak ditemukan'
                    ),
                    404
                );
            }
        } else {
            $this->response(
                array(
                    'status' => false,
                    'message' => 'Silahkan isi parameter ID Buku'
                ),
                400  // Bad Request
            );
        }
    }

    // tambah data
    function index_post()
    {
        $judul = $this->post('txt_judul');
        $penulis = $this->post('txt_penulis');
        $penerbit = $this->post('txt_penerbit');
        $tahun_terbit = $this->post('txt_tahun_terbit');
        $harga = $this->post('txt_harga');

        $data_buku = array(
            'judul' => $judul,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'harga' => $harga
        );

        $this->MBuku->insert($data_buku);
        $this->response(
            array(
                'status' => true,
                'message' => 'Data buku berhasil disimpan'
            ),
            200
        );
    }

    // update data
    function index_put()
    {
        $judul = $this->put('txt_judul');
        $penulis = $this->put('txt_penulis');
        $penerbit = $this->put('txt_penerbit');
        $tahun_terbit = $this->put('txt_tahun_terbit');
        $harga = $this->put('txt_harga');
        $id = $this->put('id');

        $data_buku = array(
            'judul' => $judul,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'harga' => $harga
        );

        $this->MBuku->update($id, $data_buku);
        $this->response(
            array(
                'status' => true,
                'message' => 'Data buku berhasil diupdate'
            ),
            200
        );
    }

    // delete data
    function index_delete()
    {
        $id = $this->delete('id');
        if ($id) {
            $this->MBuku->delete($id);
            $this->response(
                array(
                    'status' => true,
                    'message' => 'Data buku berhasil dihapus'
                ),
                200
            );
        } else {
            $this->response(
                array(
                    'status' => false,
                    'message' => 'Silahkan isi parameter ID Buku'
                ),
                400  // Bad Request
            );
        }
    }
}
?>