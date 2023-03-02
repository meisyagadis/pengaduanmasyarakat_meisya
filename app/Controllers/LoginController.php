<?php

namespace App\Controllers;

use App\Models\Masyarakat;
use App\Models\Petugas;


class LoginController extends BaseController
{
    protected $masyarakats;
    function __construct()
    {
        $this->masyarakats = new Masyarakat();
    }
    public function index()
    {
        return view('login_view');
    }
    public function register()
    {
        return view('register_view');
    }

    public function saveregister()
    {
        $ceknik = $this->masyarakats->where('nik', $this->request->getPost('nik'))->findAll();
        if ($ceknik == null) {
            $data = array(
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password') . "", PASSWORD_DEFAULT),
                'telp' => $this->request->getPost('telp'),
            );
            $this->masyarakats->insert($data);
            return redirect('login');
        } else {
            return redirect('register')->with("error", lang('Nik Sudah Ada'));
        }
    }
    public function login()
    {
        $masy = new Masyarakat();
        $petugas = new Petugas();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password') . "";
        $cekPetugas = $petugas->where(['username' => $username])->first();
        $cekmasy = $masy->where(['username' => $username])->first();

        if (!($cekmasy) && !($cekPetugas)) {
            return redirect('login')->with("error", lang('username tidak ditemukan'));
        } else {
            if ($cekmasy) {
                if (password_verify($password, $cekmasy['password'])) {
                    session()->set([
                        'nik' => $cekmasy['nik'],
                        'nama' => $cekmasy['nama'],
                        'log_in' => true,
                        'level' => 'masyarakat',
                    ]);
                    return redirect('/');
                } else {
                    return redirect('login')->with("error", lang('password masyarakat salah'));
                }
            }
            if ($cekPetugas) {
                if (password_verify($password, $cekPetugas['password'])) {
                    session()->set([
                        'id_petugas' => $cekPetugas['id_petugas'],
                        'nama_petugas' => $cekPetugas['nama_petugas'],
                        'log_in' => true,
                        'level' => $cekPetugas['level'],
                    ]);
                    return redirect('/');
                } else {
                    return redirect('login')->with("error", lang('password petugas salah'));
                }
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return $this->response->redirect('/login');
    }


    public function lihatprofil()
    {
        $petugas = new Petugas();
        $masyarakats = new Masyarakat();
        if (session('level') == 'masyarakat') {
            $data['user'] = $masyarakats->where('nik', session('nik'))->findAll();
        } else {
            $data['user'] = $petugas->where('id_petugas', session('id_petugas'))->findAll();
        }
        return view('profile', $data);
    }
    public function editProfil()
    {
        $petugas = new Petugas();
        $masyarakats = new Masyarakat();
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $telp = $this->request->getPost('telp');
        $pass_old = $this->request->getPost('password_old');
        $pass_new = $this->request->getPost('password_new');

        if (session('level') == 'masyarakat') {
            $datamasy = $masyarakats->where('id_masyarakat', $id)->findAll();
            if (empty($pass_old)) {
                $data = [
                    'nama' => $nama,
                    'username' => $username,
                    'telp' => $telp,
                ];
            } else {
                if (password_verify($pass_old, $datamasy['password'])) {
                    $data = [
                        'nama' => $nama,
                        'username' => $username,
                        'telp' => $telp,
                        'password' => password_hash($pass_new, PASSWORD_DEFAULT)
                    ];
                }
            }
            $masyarakats->update($id, $data);
        } else {
            $datapetugas = $petugas->where('id_petugas', $id)->first();
            if (empty($pass_old)) {
                $data = [
                    'nama_petugas' => $nama,
                    'username' => $username,
                    'telp' => $telp,
                ];
            } else {
                if (password_verify($pass_old, $datapetugas['password'])) {
                    $data = [
                        'nama_petugas' => $nama,
                        'username' => $username,
                        'telp' => $telp,
                        'password' => password_hash($pass_new, PASSWORD_DEFAULT)
                    ];
                }
            }
            $petugas->update($id, $data);
        }
        session()->setFlashdata('success', 'update profil berhasil');
        return redirect('profile');
    }
}
