<?php

function required_feild($req_feild)
{
    $errors = array();
    foreach ($req_feild as $feild) {
        if (empty(trim($_POST[$feild]))) {
            $errors[] = $feild .  " is required!";
        }
    }
    return $errors;
}

function min_len_check($req_feild)
{

    $errors = array();

    foreach ($req_feild as $key => $feild) {
        if (strlen(trim($_POST[$feild])) < $key) {
            $errors[] = $feild . " req min" . $key;
        }
    }

    return $errors;
}


function query_check($result)
{
    if (!$result) {
        die("Query Faild!" . mysqli_error($result));
    }
}
