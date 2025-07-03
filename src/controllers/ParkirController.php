<?php

class ParkirController extends BaseController{

    private $kendaraanModel;
    public function __construct(){
        $this->kendaraanModel = $this->model('KendaraanModel');
    }
    public function index(){
        echo 'Hello World from parkir index';
    }
    public function addView(){
        $this->view('parkir/masuk');
    }
    public function deleteView(){
        $this->view('parkir/keluar');
    }
    public function add(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $plat_nomor = trim($_POST['plat_nomor']);
            $jenis = $_POST['jenis'];

            // Validasi input
            if (empty($plat_nomor)) {
                $_SESSION['error'] = "Nomor plat harus diisi!";
                $this->redirect(BASEURL . '/parkir/add');
                return;
            }

            if (empty($jenis)) {
                $_SESSION['error'] = "Jenis kendaraan harus dipilih!";
                $this->redirect(BASEURL . '/parkir/add');
                return;
            }

            // Simpan ke database
            $result = $this->kendaraanModel->addVehicle($plat_nomor, $jenis);

            if ($result) {
                $_SESSION['success'] = "Kendaraan berhasil ditambahkan!";
            } else {
                $_SESSION['error'] = "Gagal menambahkan kendaraan. Plat nomor mungkin sudah ada!";
            }
            
            $this->redirect(BASEURL . '/parkir/add');
        }
    }
    public function delete(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $plat_nomor = trim($_POST['plat_nomor']);
            
            // Panggil model untuk proses keluar
            $result = $this->kendaraanModel->exitVehicle($plat_nomor);
            
            if ($result['success']) {
                $_SESSION['exit_data'] = $result['data'];
                // Redirect tanpa slash di awal
                $this->redirect(BASEURL . '/parkir/delete');
            } else {
                $_SESSION['error'] = "Kendaraan tidak ditemukan atau sudah keluar.";
                $this->redirect(BASEURL . '/parkir/delete');
            }
        } else {
            $this->view('parkir/keluar');
        }
    }
    public function aktifView(){
        $data = [
            'title' => 'Kendaran Terparkir',
            'AllKendaraan' => $this->kendaraanModel->getParkedVehicles(),
        ];
        $this->view('parkir/aktif', $data);
    }      
}