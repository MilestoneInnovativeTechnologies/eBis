<?php

exec('RD /S /Q milestone\ebis\assets\css');
exec('RD /S /Q milestone\ebis\assets\fonts');
exec('RD /S /Q milestone\ebis\assets\icons');
exec('RD /S /Q milestone\ebis\assets\js');

exec('XCOPY "dist/pwa/js" "milestone/ebis/assets/js" /EHRYI');
exec('XCOPY "dist/pwa/css" "milestone/ebis/assets/css" /EHRYI');
exec('XCOPY "dist/pwa/icons" "milestone/ebis/assets/icons" /EHRYI');
exec('XCOPY "dist/pwa/fonts" "milestone/ebis/assets/fonts" /EHRYI');

exec('COPY dist\pwa\favicon.ico milestone\ebis\assets\favicon.ico /Y');
exec('COPY dist\pwa\*.js* milestone\ebis\assets /Y');

$json = [];
preg_match_all('/(link href|script src)=(css|js)\/(vendor|app).(.{8}).(css|js)/',file_get_contents(implode(DIRECTORY_SEPARATOR,[__DIR__,'..','..','dist','pwa','index.html'])),$matches);
foreach ($matches[5] as $idx => $ext){
    if(!array_key_exists($ext,$json)) $json[$ext] = [];
    if(!array_key_exists($matches[3][$idx],$json[$ext])) $json[$ext][$matches[3][$idx]] = "";
    $json[$ext][$matches[3][$idx]] = $matches[4][$idx];
}

file_put_contents(implode(DIRECTORY_SEPARATOR,[__DIR__,'assets','pack.json']),json_encode($json));

exec('XCOPY "' . implode(DIRECTORY_SEPARATOR,[__DIR__,'assets']) . '" "' . implode(DIRECTORY_SEPARATOR,[__DIR__,'..','..','public']) . '" /EHRYI');
