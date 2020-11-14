<?php
/**
 * @author Rustam Safarov (RS)
 * created 14.11.2020
 * (c) 2020 RS DevTeam.
 */

// required headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");

include_once 'CurlPost.php';
include_once "VaqtiNamoz.php";

$curl = new CurlPost('http://shuroiulamo.tj/tj/namaz/ntime');

try {

    $day = date('j');
    $month = date('n');
    $year = date('Y');

    $response = $curl([
        'fday' => $day,
        'fmonth' => $month,
        'fyear' => $year
    ]);

    $vaqti_namoz = new VaqtiNamoz($response);

    $city = get_city_by_id($_GET['cid']);

    http_response_code(200);
    echo json_encode($vaqti_namoz->get($city), JSON_UNESCAPED_UNICODE);
} catch (RuntimeException $ex) {
    // catch errors
    die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
}

