<?php
require_once 'classes/Resize.php';
require_once 'classes/Scale.php';

function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

$img = new Resize('Desert.jpg');
$img2 = new Scale('Desert.jpg');


debug($img);
debug($img2);


$img->resize(80, 50);
$img->save('resize.png');


$img2->scale(75);
$img2->save('scaled.jpg');

