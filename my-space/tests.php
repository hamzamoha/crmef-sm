<?php
require_once(__DIR__ . "/../Includes/Models/Tests.php");
require_once(__DIR__ . "/../Includes/Models/Questions.php");
require_once(__DIR__ . "/../Includes/Models/Options.php");

if (isset($_GET['id'])) {
    $test = Tests::get(intval($_GET['id']));
    if ($test) {
        $questions = Questions::select("test_id=" . $test->id);
        $fullScore = 0;
        foreach ($questions as $question) {
            $question->options = Options::select("question_id=" . $question->id);
            $fullScore += intval($question->score);
        }
    }
} else {
    $tests = Tests::paginate();
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
    <link rel="stylesheet" href="/FontAwesome6/css/all.min.css">
    <script src="/JS/jquery.min.js"></script>
    <script src="/JS/script.js"></script>
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
                <div class="tests">
                    <?php if (isset($tests)) { ?>
                        <h1 class="content-title">Tests</h1>
                        <div class="elements-cards">
                            <?php if ($tests) foreach ($tests as $count => $test) { ?>
                                <div class="element-card">
                                    <a href="?id=<?= $test->id; ?>" class="element-card-body">
                                        <div class="element-card-title">
                                            <h2><?= $test->title; ?></h2>
                                        </div>
                                        <div class="element-card-subtitle"><?= $test->description; ?></div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else if ($test) { ?>
                        <h1 class="content-title">Test: <?= $test->title; ?></h1>
                        <p class="content-description"><?= $test->description; ?></p>
                        <?php if (Tests::is_passed($test->id)) {
                            $disabled = " disabled";
                            $score = Tests::score($test->id); ?>
                            <p class="score">Score: <?= $score; ?>/<?= $fullScore; ?>
                            <?php } ?>
                            <div class="questions">
                                <?php if ($questions) foreach ($questions as $question) { ?>
                                    <form onsubmit="return false;" novalidate method="POST" class="question" data-id="<?= $question->id ?>">
                                        <h1 class="statement"><?= $question->question; ?> (<?= $question->score; ?> points)</h1>
                                        <div class="options">
                                            <?php if ($question->options) foreach ($question->options as $option) { ?>
                                                <div class="option">
                                                    <input type="checkbox" value="<?= $option->id ?>" id="op<?= $option->id ?>" <?= Options::is_answer($option->id) ? ' checked' : ""; ?><?= isset($disabled)?$disabled:""; ?>>
                                                    <label for="op<?= $option->id ?>"><?= $option->phrase ?></label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                <?php } ?>
                                <div class="submit-test">
                                    <button class="btn-green" id="submit-test">Submit your answers</button>
                                </div>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>