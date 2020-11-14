<?php
/**
 * @author Rustam Safarov (RS)
 * created 14.11.2020
 * (c) 2020 RS DevTeam.
 */

include_once 'Namoz.php';
include_once "Utils.php";
include_once "simple_html_dom.php";
include_once "City.php";

class VaqtiNamoz
{
    public $shahr;
    public $hafta;
    public $date_hijri;
    public $date_melodi;

    public $bomdod;
    public $peshin;
    public $asr;
    public $shom;
    public $khuftan;

    private $html;

    function __construct($response)
    {
        $this->bomdod = new Namoz();
        $this->peshin = new Namoz();
        $this->asr = new Namoz();
        $this->shom = new Namoz();
        $this->khuftan = new Namoz();

        $this->html = str_get_html($response);

    }

    function get($city = null)
    {
        if ($city == null) {
            $city = new City();
            $city->name = "Душанбе";
            $city->difference = '+0';

        }

        $this->shahr = $city->name;

        $td_array = $this->html->find('td');
        $this->hafta = $td_array[0]->plaintext;
        $this->date_melodi = $td_array[1]->plaintext;
        $this->date_hijri = $td_array[2]->plaintext;

        $this->bomdod->name = "Бомдод";
        $this->bomdod->start_time = get_start_time($td_array[3]->plaintext, $city);
        $this->bomdod->end_time = get_end_time($td_array[3]->plaintext, $city);

        $this->peshin->name = "Пешин";
        $this->peshin->start_time = get_start_time($td_array[4]->plaintext, $city);
        $this->peshin->end_time = get_end_time($td_array[4]->plaintext, $city);

        $this->asr->name = "Аср";
        $this->asr->start_time = get_start_time($td_array[5]->plaintext, $city);
        $this->asr->end_time = get_end_time($td_array[5]->plaintext, $city);

        $this->shom->name = "Шом";
        $this->shom->start_time = get_start_time($td_array[7]->plaintext, $city);
        $this->shom->end_time = get_end_time($td_array[7]->plaintext, $city);

        $this->khuftan->name = "Хуфтан";
        $this->khuftan->start_time = get_start_time($td_array[8]->plaintext, $city);
        $this->khuftan->end_time = get_end_time($td_array[8]->plaintext, $city);

        return $this;
    }
}