<?php

defined('ABSPATH') || exit;

class Quickbase{
    
    public static function get_vehicle_quickbase() {
        
        $host = get_field( 'qb_hostname', 'option' );
        $token = get_field( 'qb_authorization', 'option' );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.quickbase.com/v1/records/query');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"from\":\"bqickas7a\",\"select\":[7,8,36,15,11,18,10,12,13,17,20,21,28,29,30,31,32,33,23,37,54],\"where\":\"{37.CT.DISPONIBLE'}AND{54.CT.'DISPONIBLE'}AND{7.CT.'MASERATI'}\"}'");

        $headers = array();
        $headers[] = 'Qb-Realm-Hostname: '.$host;
        $headers[] = 'User-Agent: {User-Agent}';
        $headers[] = 'Authorization: QB-USER-TOKEN '.$token;
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }
}
