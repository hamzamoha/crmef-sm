<div class="courses" data-label="#courses" style="display: none;">
    <h1>Courses</h1>
    <div class="crud-buttons">
        <button class="btn-green" id="create-course">Create</button>
    </div>
    <table class="crud-table crud-style-1">
        <thead>
            <tr>
                <th style="width: 50px;">#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($courses != false) foreach ($courses as $count => $course) {
            ?>
                <tr data-id="<?= $course->id ?>">
                    <td><?= $count + 1; ?></td>
                    <td><?= $course->title; ?></td>
                    <td><?= $course->description; ?></td>
                    <td><img src="/courses/images/<?= $course->image; ?>" alt="<?= $course->title; ?>" title="<?= $course->title; ?>"></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="prompt" id="create-course" style="display: none;">
        <form autocomplete="off" enctype="multipart/form-data">
            <h1>Create Course</h1>
            <div class="course-image-preview">
                <div class="new-image"></div>
            </div>
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
                <div class="preview-pdf-file">
                    <div class="new-pdf-file">
                        <i class="fa-regular fa-file-pdf"></i>
                        <p>-- No file chosen --</p>
                    </div>
                </div>
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
                <input type="submit" name="create-test" id="create-test" value="Create" class="btn-green">
            </div>
        </form>
    </div>
    <div class="prompt" id="update-course" style="display: none;">
        <form autocomplete="off" enctype="multipart/form-data">
            <h1>Update Course</h1>
            <div class="course-image-preview">
                <div class="old-image"></div>
                <div class="new-image"></div>
            </div>
            <div class="form-group">
                <div class="file-input image-input">
                    <label for="file">Course image</label>
                    <input type="file" name="image" id="image" accept="image/*">
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
                <div class="preview-pdf-file">
                    <div class="old-pdf-file">
                        <i class="fa-solid fa-file-pdf"></i>
                        <p>-- Old file name --</p>
                    </div>
                    <div class="new-pdf-file">
                        <i class="fa-regular fa-file-pdf"></i>
                        <p>-- No file chosen --</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="file-input pdf-input">
                    <label for="file">Course PDF</label>
                    <input type="file" name="file" id="file" accept="application/pdf">
                </div>
            </div>
            <div class="form-group text-center">
                <input type="hidden" name="id" value="" id="id">
                <input type="button" name="cancel" id="cancel" value="Cancel">
                <input type="button" name="delete-test" id="delete-test" value="Delete" class="btn-red">
                <input type="submit" name="update-test" id="update-test" value="Update" class="btn-green">
            </div>
        </form>
    </div>
    <div class="prompt" id="delete-course" style="display: none;">
        <form autocomplete="off" enctype="multipart/form-data">
            <h1>Delete Course</h1>
            <div class="course-data">
                <div class="course-image"></div>
                <div class="course-file"></div>
                <div class="course-title"></div>
                <div class="course-description"></div>
            </div>
            <div class="form-group text-center">
                <input type="hidden" name="id" value="" id="id">
                <input type="button" name="cancel" id="cancel" value="Cancel">
                <input type="submit" name="delete-test" id="delete-test" value="Delete" class="btn-red">
            </div>
        </form>
    </div>
</div>