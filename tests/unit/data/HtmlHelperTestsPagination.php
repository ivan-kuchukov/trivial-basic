<?php
$tests=[];
$tests[]=[
    'input'=>['count'=>0,'start'=>1,'size'=>5],
    'output'=>[]
];
$tests[]=[
    'input'=>['count'=>1,'start'=>1,'size'=>5],
    'output'=>[]
];
$tests[]=[
    'input'=>['count'=>4,'start'=>1,'size'=>5],
    'output'=>[]
];
$tests[]=[
    'input'=>['count'=>5,'start'=>1,'size'=>5],
    'output'=>[]
];
$tests[]=[
    'input'=>['count'=>6,'start'=>1,'size'=>5],
    'output'=>['1'=>(double)1,'2'=>(double)6,'Next'=>(int)6]
];
$tests[]=[
    'input'=>['count'=>9,'start'=>1,'size'=>5],
    'output'=>['1'=>(double)1,'2'=>(double)6,'Next'=>(int)6]
];
$tests[]=[
    'input'=>['count'=>11,'start'=>1,'size'=>5],
    'output'=>['1'=>(double)1,'2'=>(double)6,'3'=>(double)11,'Next'=>(int)6]
];
$tests[]=[
    'input'=>['count'=>9,'start'=>2,'size'=>5],
    'output'=>['1'=>(double)2,'2'=>(double)7,'Next'=>(int)7]
];
$tests[]=[
    'input'=>['count'=>11,'start'=>3,'size'=>5],
    'output'=>['1'=>(double)3,'2'=>(double)8,'3'=>(double)13,'Next'=>(int)8]
];
$tests[]=[
    'input'=>['count'=>11,'start'=>11,'size'=>5],
    'output'=>['Prev'=>(int)6,'1'=>(double)1,'2'=>(double)6,'3'=>(double)11]
];
$tests[]=[
    'input'=>['count'=>100,'start'=>1,'size'=>5],
    'output'=>['1'=>(double)1,'2'=>(double)6,'3'=>(double)11,'4'=>(double)16,'5'=>(double)21,'6'=>(double)26
        ,'7'=>(double)31,'8'=>(double)36,'9'=>(double)41,'Next'=>(int)6]
];
$tests[]=[
    'input'=>['count'=>100,'start'=>6,'size'=>5],
    'output'=>['Prev'=>(int)1,'1'=>(double)1,'2'=>(double)6,'3'=>(double)11,'4'=>(double)16,'5'=>(double)21
        ,'6'=>(double)26,'7'=>(double)31,'8'=>(double)36,'9'=>(double)41,'Next'=>(int)11]
];
$tests[]=[
    'input'=>['count'=>100,'start'=>11,'size'=>5],
    'output'=>['Prev'=>(int)6,'1'=>(double)1,'2'=>(double)6,'3'=>(double)11,'4'=>(double)16,'5'=>(double)21
        ,'6'=>(double)26,'7'=>(double)31,'8'=>(double)36,'9'=>(double)41,'Next'=>(int)16]
];
$tests[]=[
    'input'=>['count'=>100,'start'=>81,'size'=>5],
    'output'=>['Prev'=>(int)76,'12'=>(double)56,'13'=>(double)61,'14'=>(double)66,'15'=>(double)71
        ,'16'=>(double)76,'17'=>(double)81,'18'=>(double)86,'19'=>(double)91,'20'=>(double)96,'Next'=>(int)86]
];
$tests[]=[
    'input'=>['count'=>100,'start'=>91,'size'=>5],
    'output'=>['Prev'=>(int)86,'12'=>(double)56,'13'=>(double)61,'14'=>(double)66,'15'=>(double)71
        ,'16'=>(double)76,'17'=>(double)81,'18'=>(double)86,'19'=>(double)91,'20'=>(double)96,'Next'=>(int)96]
];
$tests[]=[
    'input'=>['count'=>100,'start'=>96,'size'=>5],
    'output'=>['Prev'=>(int)91,'12'=>(double)56,'13'=>(double)61,'14'=>(double)66,'15'=>(double)71
        ,'16'=>(double)76,'17'=>(double)81,'18'=>(double)86,'19'=>(double)91,'20'=>(double)96]
];

return $tests;
