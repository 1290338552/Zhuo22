<?php
//�����Ự������������֤�뱣�浽�Ự������
//Session����·��

session_start();
function getrandom($length, $mode)
{
    switch ($mode) {
        case '1':
            $str = '1234567890';
            break;
        case '2':
            $str = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case '3':
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case '4':
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case '5':
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            break;
        case '6':
            $str = 'abcdefghijklmnopqrstuvwxyz1234567890';
            break;
        default:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
            break;
    }
    $result = '';
    $l = strlen($str);
    for ($i = 0; $i < $length; $i++) {
        $num = rand(0, $l - 1);
        $result .= $str[$num];
    }
    return $result;
}

if (function_exists("imagecreate")) {
    mt_srand((double)microtime() * 1000000);
    $mode = 1;//mt_rand(1,5);
    $text = getrandom(4, $mode);//ȡ����֤�룡
    $_SESSION["v_ckstr"] = strtolower($text);//��ʼ������

    Header("Content-type: image/PNG");
    $im = imagecreate(50, 20);//�ƶ�ͼƬ������С
    $black = ImageColorAllocate($im, 0, 0, 0); //�趨������ɫ
    $white = ImageColorAllocate($im, 255, 255, 255);
    $gray = ImageColorAllocate($im, 200, 200, 200);
    imagefill($im, 0, 0, $white); //��䱳��ɫ//����������䷨���趨��0,0��

// �� col ��ɫ���ַ��� s ���� image �������ͼ��� x��y ���괦��ͼ������Ͻ�Ϊ 0, 0����
//��� font �� 1��2��3��4 �� 5����ʹ����������
    imagestring($im, 6, 10, 3, $text, $black);//����λ������֤�����ͼƬ

    for ($i = 0; $i < 200; $i++) //�����������
    {
        $randcolor = ImageColorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
        imagesetpixel($im, rand() % 70, rand() % 30, $randcolor);
    }

    imagepng($im);
    imagedestroy($im);
} else {
    //��֧��GD��ֻ�����ĸ ABCD
    //PutCookie("dd_ckstr","abcd",1800,"/");
    $_SESSION['v_ckstr'] = "abcd";
    header("content-type:image/jpeg\r\n");
    header("Pragma:no-cache\r\n");
    header("Cache-Control:no-cache\r\n");
    header("Expires:0\r\n");
    $fp = fopen("./vdcode.jpg", "r");
    echo fread($fp, filesize("./vdcode.jpg"));
    fclose($fp);
}
?>