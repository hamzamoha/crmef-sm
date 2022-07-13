<div class="kata" data-label="#kata" style="display: none;">
    <h1>Kata</h1>
    <div class="crud-buttons">
        <button class="btn-green" id="create-kata">Create</button>
    </div>
    <table class="crud-table crud-style-2">
        <thead>
            <tr>
                <th style="width: 50px;">#</th>
                <th>Title</th>
                <th>Language</th>
            </tr>
        </thead>
        <?php
        if ($katas != false) foreach ($katas as $count => $k) {
        ?>
            <tr>
                <td><?= $count + 1; ?></td>
                <td><?= $k->title; ?></td>
                <td><?= $k->language; ?></td>
            </tr>
        <?php
        }
        ?>
        <tbody>
        </tbody>
    </table>
    <div class="prompt" id="create-kata" style="display: none;">
        <form autocomplete="off" enctype="multipart/form-data">
            <h1>Create Kata</h1>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required="required">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" name="description" id="description" required="required" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="language">Language</label>
                <select name="language" id="language" required>
                    <option disabled selected value*>-- Select --</option>
                    <option value="javascript">JavaScript</option>
                    <option value="python">Python</option>
                    <option value="php">PHP</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tester</label>
                <div id="tester_code"></div>
                <button name="beautify" id="beautify">Beautify</button>
                <script src="/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
                <script src="/ace-builds/src-min-noconflict/ext-beautify.js" type="text/javascript" charset="utf-8"></script>
                <script>
                    let editor = ace.edit("tester_code");
                    editor.setTheme("ace/theme/cobalt");
                    editor.session.setMode("ace/mode/javascript");
                    editor.setFontSize(16);
                    editor.setOptions({
                        minLines: 10,
                        maxLines: 30
                    });
                </script>
            </div>
            <div class="form-group text-center">
                <input type="button" name="cancel" id="cancel" value="Cancel">
                <input type="reset" value="Reset">
                <input type="submit" name="create-test" id="create-test" value="Create" class="btn-green">
            </div>
        </form>
    </div>
</div>