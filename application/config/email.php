<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$conf = json_decode(get_site_config_val('correo'));
if ($conf->smtp_host != '') {
    $config = array(
        'protocol' => 'smtp',
        'smtp_host' => $conf->smtp_host,
        'smtp_port' => $conf->smtp_port,
        'smtp_user' => $conf->smtp_user,
        'smtp_pass' => $conf->smtp_pass,
        'crlf' => "\r\n",
        'newline' => "\r\n",
        'send_multipart' => false,
        'smtp_crypto' => 'tls',
        'useragent' => site_name().' - Email'
    );
}else{
    $config = array(
        'protocol' => 'mail',
        'crlf' => "\r\n",
        'newline' => "\r\n",
        'send_multipart' => false,
        'useragent' => site_name() . ' - Email'
    );
}