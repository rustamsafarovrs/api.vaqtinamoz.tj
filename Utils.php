<?php
/**
 * @author Rustam Safarov (RS)
 * created 14.11.2020
 * (c) 2020 RS DevTeam.
 */


/**
 * @param $date
 * @param $city
 * @return string
 */

function get_start_time($date, $city)
{
    $date = trim($date);
    $selectedTime = trim(explode('-', $date)[0]);

    $endTime = strtotime($city->difference . " minutes", strtotime($selectedTime));
    return date('H:i', $endTime);
}


/**
 * @param $date
 * @param $city
 * @return string
 * @throws Exception
 */

function get_end_time($date, $city)
{
    $date = trim($date);
    $selectedTime = trim(explode('-', $date)[1]);

    $endTime = strtotime($city->difference . " minutes", strtotime($selectedTime));
    return date('H:i', $endTime);
}

function get_city_by_id($id)
{
    $cities = array(
        new City("Душанбе", "+0"),
        new City("Истаравшан", "-5"),
        new City("Кӯлоб", "-5"),
        new City("Хуҷанд", "-7"),
        new City("Рашт", "-7"),
        new City("Конибодом", "-9"),
        new City("Исфара", "-9"),
        new City("Ашт", "-9"),
        new City("Хоруғ", "-12"),
        new City("Мурғоб", "-20"),
        new City("Қурғонтеппа", "+4"),
        new City("Панҷакент", "+5"),
        new City("Шаҳритус", "+5"),
        new City("Айнӣ", "+5")
    );
    return $cities[$id];
}