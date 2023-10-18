<?php

function hResponse($data, $msg = 'success', $status = 200)
{
    $response = [
        'data' => $data,
        'msg' => $msg
    ];
    return response($response, $status);
}

function hMessageFactories($type = null) {
    $response = '';
    if($type) {
        if($type == 'delete') $response = 'success delete data';
        elseif($type == 'create') $resposne = 'success create data';
        elseif($type == 'update') $response = 'success update data';
    }
    return $response;
}

function hValidatorMessage($field, $type) {
    $rule = '';
    if($type === 'required') $rule = 'tidak boleh kosong.';
    if($type === 'unique') $rule = 'telah terdaftar, coba yang lainnya.';
    if($type === 'numeric') $rule = 'pastikan hanya mengisikan angka saja.';
    if($type === 'email') $rule = 'format tidak valid.';
    if($type === 'uploadRequired') $rule = 'harus di upload.';
    return ucwords($field) . ' ' . $rule;
}