<html>
    <head>
        <title>Trivial Basic Report</title>
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

    <div class="table-responsive">
        <table class="table table-bordered table-striped"><thead>
            <tr>
                <th>Login</th>
            </tr>
        </thead><tbody>
            <?php foreach ($report as $row) : ?>
            <tr>
                <td><?= $row['login'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody></table>
    </div>
</div>
    
<?php trivial\models\HtmlHelper::jsRequire(['jquery','bootstrap','app']) ?>

</body>
</html>