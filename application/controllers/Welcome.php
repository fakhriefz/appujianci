<?php
session_start();

defined('BASEPATH') or exit('No direct script access allowed');

use Jenssegers\Blade\Blade;

class Welcome extends CI_Controller
{
   
    public function index()
    {
        $this->load->helper('url');
        if (isset($_POST['nama']) && isset($_POST['nim']) && isset($_POST['umur'])) {
            $_SESSION['nama'] = $_POST['nama'];
            $_SESSION['nim'] = $_POST['nim'];
            $_SESSION['umur'] = $_POST['umur'];
            redirect('Welcome/tampil');
        }

        $blade = new Blade(VIEWPATH, APPPATH . 'cache');
        echo $blade->make('form', [])->render();
    }

    public function tampil()
    
    {
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $umur = $_SESSION['umur'];
        $status = '';

        if ($umur >= 0 && $umur <= 10) {
            $status = 'Anak';
        } elseif ($umur > 10 && $umur <= 20) {
            $status = 'Remaja';
        } elseif ($umur > 20 && $umur <= 30) {
            $status = 'Dewasa';
        } elseif ($umur > 30) {
            $status = 'Tua';
        }

        session_unset();
        session_destroy();
        $blade = new Blade(VIEWPATH, APPPATH . 'cache');
        echo $blade->make('tampil', ['nama' => $nama, 'nim' => $nim, 'umur' => $umur, 'status' => $status])->render();
    }
}