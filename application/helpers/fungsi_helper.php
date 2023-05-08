<?php
function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    $level = $ci->session->userdata('level');
    if ($user_session) {
        if ($level == 1) {
            redirect('dashboard/admin');
        } else {
            redirect('dashboard/toko');
        }
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if (!$user_session) {
        redirect('auth');
    }
}

function not_admin()
{
    $ci = &get_instance();
    $admin = $ci->session->userdata('level');
    if ($admin == '1') {
        echo 'admin';
        redirect('dashboard/admin');
    } else if ($admin == '2') {
        echo 'user';
        redirect('dashboard/toko');
    }
}
