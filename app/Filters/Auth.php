<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface{
    public function before(RequestInterface $request, $argument = null){
        if(!session()->get('log_in')){
            return redirect()->to('/login');
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $argument =null){
        
    }
}
