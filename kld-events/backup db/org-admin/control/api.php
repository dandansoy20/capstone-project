<?php

    function content_iconv($data, $to = 'utf-8') {
        $encode_array = array('UTF-8','ASCII','GBK','GB2312','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
        $encoded = mb_detect_encoding($data, $encode_array);
        $to = strtoupper($to);
        if($encoded != $to) {
            $data = mb_convert_encoding($data, 'utf-8', $encoded);
        }
        return $data;
    }

?>