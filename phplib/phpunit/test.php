<?php
use PHPUnit\Framework\TestCase; 

require('../common/Util.php');

// ---  test case 测试 ---
// ---   继承TestCase ---
// ---   每个function 是一个自动case ,且都是以test开头 --
// ---   phpunit 其实是assert 的一堆方法集合 ---
class Test extends TestCase {

    CONST MY_COOKIE = 'session=05213c87ffc22beb3598103b72f1ce101c574dc3c99e74cac1b5bbad8437486336d2e5984de88d88f6edde58a3545457; sso_usession=05213c87ffc22beb3598103b72f1ce101c574dc3c99e74cac1b5bbad8437486336d2e5984de88d88f6edde58a3545457; osession=2937397f56740af4066039bce962d65c50354357a4e90850abd3a98c36c14ce3cf84c5ad58068c8b3da63b8b2da8d838776e162fadd7a6717bb60333ff5105994bfd2ba799f86270f28efc67ef64acf3d6cf97c5f7ef6b3c71fd3026827d160b741b2ef0ab64add94bb3d3136cbb1c6a5f47a5e27a1166c78f3c5bb11d8eca6a6f94b5db95be5c33b4b31dcbe15bae9cf0c51706d7b5ae7df7ad9cbd699faa276d01cd5f1cf972cab37888ca5a96c977181de7be9fec336de2e8ab2e2fa86356395ec6a3a3db92fbc9ad8741e1ceb7b22b7c66475df2d23039d8a44af0fabf2a95ca5cf2f230f8aa1ff957e83d25c9ae; uid=c16aa2ec1532-37ea-e4d4-a630-fed81f60';

    public function testPackageList() {

        $url = 'http://xiaoqiang-maze.dev.yiducloud.cn/api/maze/package/getList';
        $arrHeaders = array(
            'Content-Type' => 'application/json',
        );
        $arrParams = array(
            'post' => array(
                'name' => '',
                'page' => 1,
                'pagesize' => 10,
                'step' => '',
                'type' => '',
            ),
            'cookie' => self::MY_COOKIE,
        );

        $arrListResult = Util::curlReqeust($url, $arrParams, false, $arrHeaders);
        var_dump($arrListResult);exit;
    }
}
?>
