<?php return [
    "defaultController"=>"admin",
    "displayErrors"=>true,
    "debug"=>true,
    "log"=>[
        "type"=>"file",
        "errorsFile"=>"runtime" . DIR_SEP . "errors.log",
        "dbDebugFile"=>"runtime" . DIR_SEP . "dbDebug.log",
        "conditionsDebugFile"=>"runtime" . DIR_SEP . "conditionsDebug.log",
    ],
    "db"=>[
        "errorLog"=>"display", // error actions: display, log, ignore 
        "queriesLog"=>true, // log ALL queries
        "type"=>"MariaDB", // Your database type
        "servername"=>"localhost", // Your database address
        "username"=>"test", // Your database username
        "password"=>"test", // Your database password
        "database"=>"test", // Your database name
    ],
    "migrationsPath"=>"migrations",
    "fixturesPath"=>"fixtures",
    "testsPath"=>"tests",
    "includedJavascripts"=>[
        'jquery'=>'<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>',
        'popper'=>'<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>',
        'bootstrap'=>'<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>',
        'glyphicons'=>'<script src="https://raw.githubusercontent.com/frexy/svg-icon-webcomponent/master/build/iconwc.js"></script>',
        'polyfill'=>'<script src="//unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>',
        'bootstrap-vue'=>'<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>',
        'vue-dev'=>'<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>',
        'vue'=>'<script src="https://cdn.jsdelivr.net/npm/vue"></script>',
        'axios'=>'<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>',
        'app'=>'<script src="' . $_SERVER['BASE'] .'/js/app.js"></script>',
    ],
    "includedCSS"=>[
        'fontawesome'=>'<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">',
        'bootstrap'=>'<link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>',
        'bootstrap-vue'=>'<link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>',
        'app'=>'<link rel="stylesheet" href="' . $_SERVER['BASE'] . '/css/app.css">',
    ],    
];
