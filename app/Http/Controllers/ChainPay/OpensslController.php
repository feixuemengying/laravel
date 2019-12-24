<?php
namespace App\Http\Controllers\ChainPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ShengQianFu\Secret\Secret as Secret;

class OpensslController extends Controller
{
    private $rsa_prefix = "08M0026853";

    /**
     * 生成密钥文件
     */
    function make()
    {
        Secret::getInstace($this->rsa_prefix,__DIR__)->rsa();
    }
    /**
     * 加密
     * 
     * @param string $crypt_data 需要加密的数据
     */
    function jiami($crypt_data)
    {
        return view("ChainPay.index")->with("data",Secret::getInstace($this->rsa_prefix,__DIR__)->crypt($crypt_data));
    }

    /**
     * 解密
     */
    function jiemi(Request $request)
    {
        $data= $request->all();
        return Secret::getInstace($this->rsa_prefix,__DIR__)->decrypt($data['id']);
    }
}