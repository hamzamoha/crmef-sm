<div class="tests" data-label="#tests" style="display: none;">
    <h1>Tests</h1>
    <div class="crud-buttons">
        <button class="btn-green" id="add-test">Add</button>
        <button class="btn-purple" id="edit-questions-test" disabled>Edit Questions</button>
        <button class="btn-yellow" id="modify-test" disabled>Modify</button>
        <button class="btn-red" id="delete-test" disabled>Delete</button>
        <button class="btn-blue" id="select-all-tests">Select All</button>
        <button class="btn-gray" id="deselect-all-tests" disabled>Deselect All</button>
        <button class="btn-red" id="delete-all-tests">Delete All</button>
    </div>
    <table class="crud-table">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Date</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($tests != false) foreach ($tests as $count => $t) {
                $t->date = (new DateTime($t->date))->format("jS F Y");
            ?>
                <tr>
                    <td><input type="checkbox" name="select-test" id="<?= $t->id; ?>"></td>
                    <td><?= $count + 1; ?></td>
                    <td><?= $t->date; ?></td>
                    <td><?= $t->title; ?></td>
                    <td><?= $t->description; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="prompt" style="display: none;" id="add-test-prompt">
        <form method="POST" autocomplete="off">
            <div class="form-title">
                <h2>Add a Test</h2>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" placeholder="Description">
            </div>
            <div class="form-group text-center">
                <input type="button" name="cancel" id="cancel" value="Cancel">
                <input type="reset" value="Reset">
                <input type="submit" name="add-test" id="add-test" value="Add" class="btn-green">
            </div>
        </form>
    </div>
    <div class="prompt" style="display: none;" id="modify-test-prompt">
        <form method="POST" autocomplete="off">
            <div class="form-title">
                <h2>Modify a Test</h2>
            </div>
            <div class="from-group">
                <h4>Date: <span id="test-date"></span></h4>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" placeholder="Description">
            </div>
            <div class="form-group text-center">
                <input type="hidden" name="id" id="id" value="">
                <input type="button" name="cancel" id="cancel" value="Cancel">
                <input type="submit" name="modify-test" id="modify-test" value="Modify" class="btn-green">
            </div>
        </form>
    </div>
    <div class="prompt" style="display: none;" id="delete-tests-prompt">
        <form method="POST" autocomplete="off">
            <div class="form-title">
                <h2>You Sure You Wanna Delete <span id="tests-count"></span></h2>
            </div>
            <h4>There's no comming back !!</h4>
            <div class="form-group text-center">
                <input type="hidden" value="" name="tests-ids" id="tests-ids">
                <input type="button" name="cancel" id="cancel" value="Cancel">
                <input type="submit" name="delete-tests" id="delete-tests" value="Delete" class="btn-red">
            </div>
        </form>
    </div>
    <div class="prompt" style="display: none;" id="delete-all-tests-prompt">
        <form method="POST" autocomplete="off">
            <div class="form-title">
                <h2>You Sure You Wanna Delete <span class="color-red">All Tests</span> ?</h2>
            </div>
            <h4>There's no comming back !!</h4>
            <div class="form-group text-center">
                <input type="button" name="cancel" id="cancel" value="Cancel">
                <input type="submit" name="delete-all-tests" id="delete-all-tests" value="Delete" class="btn-red">
            </div>
        </form>
    </div>
    <div class="prompt" style="display: none;" id="questions-test-prompt">
        <div class="test-questions">
            <div class="questions-buttons">
                <button id="close-questions" class="icon-button"><i class="fa-solid fa-x"></i></button>
                <button id="zoom-questions" class="icon-button"><i class="fa-regular fa-window-maximize"></i></button>
            </div>
            <div class="questions-list">
                <div class="test-header">
                    <h2 class="test-title"></h2>
                    <p class="test-description"></p>
                    <p class="test-date"></p>
                </div>
                <div class="new-question">
                    <h3>Add Question</h3>
                    <form action="#" method="POST" autocomplete="off" name="new-question-form">
                        <input type="hidden" name="test-id" id="test-id" value="">
                        <input type="text" name="question" id="question" placeholder="Type your question here ...">
                        <div class="dir-rtl">
                            <input class="btn-green" type="submit" value="Add Question">
                        </div>
                    </form>
                </div>
                <div class="questions-items">
                </div>
            </div>
        </div>
    </div>
</div>