<?php

include 'simple_html_dom.php';



$html = file_get_html('http://shuroiulamo.tj/tj/namaz');

$namaz_table = $html->find('table[class="namaz_month"]', 0);

$tbody = $namaz_table->find('tbody', 0);

$tr_array = $tbody->find('tr');
echo $tr_array[13];
