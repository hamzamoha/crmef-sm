<?php
require_once(__DIR__ . "/../Includes/Models/Kata.php");

if (isset($_GET['id'])) {
    $kata = Kata::get(intval($_GET['id']));
} else {
    $katas = Kata::paginate();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests</title>
    <link rel="stylesheet" href="/CSS/fonts.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/CSS/prompt.css">
    <link rel="stylesheet" href="/FontAwesome6/css/all.min.css">
    <script src="/JS/jquery.min.js"></script>
    <script src="/JS/script.js"></script>
    <script src="/JS/prompt.js"></script>
    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <header class="header">
        <?php include(__DIR__ . '/../navbar.php'); ?>
    </header>
    <main>
        <div class="dashboard">
            <div class="dashboard-sidebar">
                <?php include(__DIR__ . "/dashboard-sidebar-menu.php"); ?>
            </div>
            <div class="dashboard-content">
                <div class="kata">
                    <?php if (isset($katas)) { ?>
                        <h1 class="content-title">Katas</h1>
                        <div class="elements-cards">
                            <?php if ($katas) foreach ($katas as $count => $kata) { ?>
                                <div class="element-card">
                                    <a href="?id=<?= $kata->id; ?>" class="element-card-body">
                                        <div class="element-card-title">
                                            <h2><?= $kata->title; ?></h2>
                                        </div>
                                        <div class="element-card-subtitle"><?= $kata->language; ?></div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else if ($kata) { ?>
                        <h1 class="content-title">Kata: <?= $kata->title; ?></h1>
                        <div class="content-subtitle">
                            <div class="pill <?= $kata->language; ?>"><?= $kata->language; ?></div>
                        </div>
                        <p class="content-description"><?= str_replace("\n", "<br>", $kata->description); ?></p>
                        <?php if (Kata::is_solved($kata->id)) { ?>
                            <h2 class="text-green fw-bold my-3 mx-2"><i class="fa-solid fa-check"></i> Solved</h2>
                            <button id="view-code" data-kata-id="<?= $kata->id; ?>">View Code</button>
                        <?php } else { ?>
                            <button class="btn-green my-4" id="solve" data-kata-id="<?= $kata->id; ?>">Solve</button>
                        <?php } ?>
                    <?php } ?>
                    <div class="prompt" id="solve-kata" style="display: none;">
                        <form autocomplete="off" enctype="multipart/form-data">
                            <h1>Solve Kata</h1>
                            <h2><?= $kata->title; ?></h2>
                            <div class="form-group">
                                <div id="solve_kata"></div>
                                <button type="button" class="my-2">Beautify</button>
                                <script src="/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
                                <script src="/ace-builds/src-min-noconflict/ext-beautify.js" type="text/javascript" charset="utf-8"></script>
                                <script>
                                    let editor = ace.edit("solve_kata");
                                    editor.setTheme("ace/theme/cobalt");
                                    editor.session.setMode("ace/mode/<?= $kata->language; ?>");
                                    editor.setFontSize(16);
                                    editor.setOptions({
                                        minLines: 10,
                                        maxLines: 30
                                    });
                                </script>
                            </div>
                            <div class="form-group text-center">
                                <input type="hidden" name="id" value="<?= $kata->id; ?>">
                                <input type="button" name="cancel" id="cancel" value="Cancel">
                                <input type="submit" name="submit-kata" id="submit-kata" value="Submit" class="btn-green">
                            </div>
                        </form>
                    </div>
                    <div class="prompt" id="show-code" style="display: none;">
                        <form autocomplete="off" enctype="multipart/form-data" onsubmit="return false" novalidate>
                            <h1>Code Kata</h1>
                            <h2><?= $kata->title; ?></h2>
                            <div class="form-group">
                                <div id="code_kata"></div>
                                <script src="/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
                                <script src="/ace-builds/src-min-noconflict/ext-beautify.js" type="text/javascript" charset="utf-8"></script>
                                <script>
                                    let editor1 = ace.edit("code_kata");
                                    editor1.setTheme("ace/theme/cobalt");
                                    editor1.session.setMode("ace/mode/<?= $kata->language; ?>");
                                    editor1.setFontSize(16);
                                    editor1.setOptions({
                                        minLines: 10,
                                        maxLines: 30
                                    });
                                    editor1.setReadOnly(true);
                                </script>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>