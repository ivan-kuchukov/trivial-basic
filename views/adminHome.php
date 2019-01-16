<html>
    <head>
        <title>Trivial Basic</title>
        <?php trivial\models\HtmlHelper::cssRequire(['bootstrap','app']) ?>
    </head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#trivialNavbar" aria-controls="trivialNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Trivial Basic</a>

    <div class="collapse navbar-collapse" id="trivialNavbar">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $_SERVER['BASE'] . '/admin/report' ?>">Report</a>
            </li>
        </ul>
    </div>
</nav>
    
<div class="container">
    <h2>Hie!</h2>
    <pre>It's basic example of using Trivial.</pre>
</div>

<?php trivial\models\HtmlHelper::jsRequire(['jquery','bootstrap','app']) ?>

</body>
</html>