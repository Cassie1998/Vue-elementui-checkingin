<?php

// bsf管理模板函数文件

/**
 * 给树状菜单添加level并去掉没有子菜单的菜单项
 * @param  array   $data  [description]
 * @param  integer $root  [description]
 * @param  string  $child [description]
 * @param  string  $level [description]
 */
function memuLevelClear($data, $root=1, $child='child', $level='level')
{
    if (is_array($data)) {
        foreach($data as $key => $val){
            //给当前数组增加selected和level二个属性
            $data[$key]['selected'] = false;
            $data[$key]['level'] = $root;
            if (!empty($val[$child]) && is_array($val[$child])) {
                //如果有下级菜单，递归调用，处理下一层级
                $data[$key][$child] = memuLevelClear($val[$child],$root+1);
            }else if ($root<3&&$data[$key]['menu_type']==1) //如果层级1、2，存在空的层级，则不显示
            {
                unset($data[$key]);
            }
            /**
             * 1、回头处理1级菜单中如果有空
             * 2、无子菜单的menu被删除后，会使下面操作数组下标越界，这段代码似无必要
             *             if (empty($data[$key][$child])&&($data[$key]['level']==1)&&($data[$key]['menu_type']==1)) {
             *                 unset($data[$key]);
             *              }
             */
        }
        return array_values($data);
    }
    return array();
}

/**
 * [rulesDeal 给树状规则表处理成 module-controller-action ]
 * @AuthorHTL
 * @DateTime  2017-01-16T16:01:46+0800
 * @param     [array]                   $data [树状规则数组]
 * @return    [array]                         [返回数组]
 */
function rulesDeal($data)
{
    if (is_array($data)) {
        $ret = [];
        foreach ($data as $k1 => $v1) {
            $str1 = $v1['name'];
            if (is_array($v1['child'])) {
                foreach ($v1['child'] as $k2 => $v2) {
                    $str2 = $str1.'-'.$v2['name'];
                    if (is_array($v2['child'])) {
                        foreach ($v2['child'] as $k3 => $v3) {
                            $str3 = $str2.'-'.$v3['name'];
                            $ret[] = $str3;
                        }
                    }else{
                        $ret[] = $str2;
                    }
                }
            }else{
                $ret[] = $str1;
            }
        }
        return $ret;
    }
    return [];
}


/**
 * cookies加密函数
 * @param string 加密后字符串
 *  $key = 'oScGU3fj8m/tDCyvsbEhwI91M1FcwvQqWuFpPoDHlFk='; //echo base64_encode(openssl_random_pseudo_bytes(32));
$iv = 'w2wJCnctEG09danPPI7SxQ=='; //echo base64_encode(openssl_random_pseudo_bytes(16));
 */
function encrypt($data, $key = 'oScGU3fj8m/tDCyvsbEhwI91M1fcwvQqWuFpPoDHlFk=',$iv = 'w4wJCnctEG09danPPI7SxQ==')
{
    /*
    $prep_code = serialize($data);
    $block = mcrypt_get_block_size('des', 'ecb');
    if (($pad = $block - (strlen($prep_code) % $block)) < $block) {
        $prep_code .= str_repeat(chr($pad), $pad);
    }
    $encrypt = mcrypt_encrypt(MCRYPT_DES, $key, $prep_code, MCRYPT_MODE_ECB);
    return base64_encode($encrypt);
    */
    $prep_code = serialize($data);
    $encrypt = openssl_encrypt($prep_code, 'aes-256-cbc', base64_decode($key), OPENSSL_RAW_DATA, base64_decode($iv));
    return base64_encode($encrypt);

}

/**
 * cookies 解密密函数
 * @param array 解密后数组
 */
function decrypt($str, $key = 'oScGU3fj8m/tDCyvsbEhwI91M1fcwvQqWuFpPoDHlFk=',$iv = 'w4wJCnctEG09danPPI7SxQ==')
{
    /*
    $str = base64_decode($str);
    $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
    $block = mcrypt_get_block_size('des', 'ecb');
    $pad = ord($str[($len = strlen($str)) - 1]);
    if ($pad && $pad < $block && preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str)) {
        $str = substr($str, 0, strlen($str) - $pad);
    }
    return unserialize($str);
    */
    $encrypted = base64_decode($str);
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', base64_decode($key), OPENSSL_RAW_DATA, base64_decode($iv));
    return  unserialize($decrypted); ;
}
