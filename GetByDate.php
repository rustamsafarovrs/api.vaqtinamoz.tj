<?php
/**
 * @author Rustam Safarov (RS)
 * created 14.11.2020
 * (c) 2020 RS DevTeam.
 */

// required headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");

include_once 'CurlPost.php';
include_once "VaqtiNamoz.php";

// get posted data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->day) &&
    !empty($data->month) &&
    !empty($data->year) &&
    !empty($data->cid)
) {
    $curl = new \CurlPost('http://shuroiulamo.tj/tj/namaz/ntime');

    try {

        $response = $curl([
            'fday' => $data->day,
            'fmonth' => $data->month,
            'fyear' => $data->year
        ]);

        $vaqti_namoz = new VaqtiNamoz($response);

        $city = get_city_by_id($data->cid);

        http_response_code(200);
        echo json_encode($vaqti_namoz->get($city), JSON_UNESCAPED_UNICODE);
    } catch (\RuntimeException $ex) {
        // catch errors
        die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Bad request"));
}