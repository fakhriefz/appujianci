<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Jenssegers\Blade\Blade;

class Welcome extends CI_Controller
{
    
    public function index()
    {
        $blade = new Blade(VIEWPATH, APPPATH . 'cache');
        echo $blade->make('form', [])->render();
    }

    public function tampil()
    {

        $nama = $this->input->post('namaku');
        $nim = $this->input->post('nim');
        $umur = $this->input->post('umur');

        $status = '';

        if ($umur < 10) {
            $status = 'Anak';
        } elseif ($umur < 20) {
            $status = 'Remaja';
        } elseif ($umur < 30) {
            $status = 'Dewasa';
        } else {
            $status = 'Tua';
        }

        $blade = new Blade(VIEWPATH, APPPATH . 'cache');
        $array_data = [
            'nama' => $nama,
            'nim' => $nim,
            'umur' => $umur,
            'status' => $status,
        ];

        echo $blade->make('tampil', $array_data)->render();
    }
}