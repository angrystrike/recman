<?php

function returnJSON($data)
{
    header('Content-type: application/json;');
    echo json_encode($data);
    return true;
}
