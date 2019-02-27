<html>
    <head>
        <title>Trivial Basic Report</title>
        <?php trivial\models\HtmlHelper::cssBlock(['bootstrap','app']) ?>
    </head>
<body>
    
<?php trivial\models\HtmlHelper::jsRequire(['jquery','bootstrap']) ?>    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#trivialNavbar" aria-controls="trivialNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Trivial Basic</a>

    <div class="collapse navbar-collapse" id="trivialNavbar">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="<?= $_SERVER['BASE'] . '/admin' ?>">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Report <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>Users</h2>

    <div class="container grid-table grid-striped">
        <?php foreach ($report as $row) : ?>
            <div class="row">
                <div class="col">
                    <?= $row['login'] ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php foreach (trivial\models\HtmlHelper::getPagination($pagination) as $key=>$value) : ?>
                <li class="page-item<?= ($value!=$pagination['start']) ?: ' active' ?>">
                    <a class="page-link" href="<?= $_SERVER['BASE'] ?>/admin/report?start=<?= $value ?>&size=<?= $pagination['size'] ?>">
                        <?= t($key) ?></a></li>
            <?php endforeach ?>
        </ul>
    </nav>
</div>
    
<?php trivial\models\HtmlHelper::jsBlock(['jquery','app']) ?>

</body>
</html>