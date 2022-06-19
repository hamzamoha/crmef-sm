<div class="courses" data-label="#courses">
    <h1>Courses</h1>
    <div class="crud-buttons">
        <button class="btn-green" id="add-course">Add</button>
    </div>
    <table class="crud-table crud-style-1">
        <thead>
            <tr>
                <th style="width: 50px;">#</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($courses != false) foreach ($courses as $count => $course) {
            ?>
                <tr id="<?= $course->id ?>">
                    <td><?= $count + 1; ?></td>
                    <td><?= $course->title; ?></td>
                    <td><?= $course->description; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="prompt" id="new-course" style="display: none;">
        <form autocomplete="off" enctype="multipart/form-data">
            <h1>New Course</h1>
            <div class="course-image-preview"></div>
            <div class="form-group">
                <div class="file-input image-input">
                    <label for="file">Course image</label>
                    <input type="file" name="image" id="image" accept="image/*" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required="required">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" required="required">
            </div>
            <div class="form-group">
                <div class="file-input pdf-input">
                    <label for="file">Course PDF</label>
                    <input type="file" name="file" id="file" accept="application/pdf" required="required">
                </div>
            </div>
            <div class="form-group text-center">
                <input type="button" name="cancel" id="cancel" value="Cancel">
                <input type="reset" name="reset" id="reset" value="Reset">
                <input type="submit" name="add-test" id="add-test" value="Add" class="btn-green">
            </div>
        </form>
    </div>
    <div class="prompt" id="update-course" style="display: none;">
        <form autocomplete="off" enctype="multipart/form-data">
            <h1>New Course</h1>
            <div class="course-image-preview"></div>
            <div class="form-group">
                <div class="file-input image-input">
                    <label for="file">Course image</label>
                    <input type="file" name="image" id="image" accept="image/*" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required="required">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" required="required">
            </div>
            <div class="form-group">
                <div class="file-input pdf-input">
                    <label for="file">Course PDF</label>
                    <input type="file" name="file" id="file" accept="application/pdf" required="required">
                </div>
            </div>
            <div class="form-group text-center">
                <input type="button" name="cancel" id="cancel" value="Cancel">
                <input type="reset" name="reset" id="reset" value="Reset">
                <input type="submit" name="add-test" id="add-test" value="Add" class="btn-green">
            </div>
        </form>
    </div>
</div>