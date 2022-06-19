function question_DOM($id, $statement, $score = 1, $options = "") {
    return `
    <div class="question-item" id="${$id}">
        <h4 class="question-statement">${$statement}</h4>
        <div class="options">
            ${$options}
        </div>
        <div class="question-actions">
            <div class="question-action">
                <button data-action="delete-question">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>
            <div class="question-action">
                <button data-action="add-option">
                    <i class="fa-regular fa-square-plus"></i>
                </button>
            </div>
            <div class="question-action">
                Score: <input type='number' min="0" step='1' value="${$score}" name="question-score" id="question-score-${$id}">
            </div>
        </div>
    </div>`;
}
function option_DOM($statement, $question_id, $id, correct) {
    return `
    <h5 class="question-option"><button class="delete-option"><i class="fa-solid fa-xmark"></i></button><input type="checkbox" data-question-id="${$question_id}" id="${$id}"${correct == 1 ? " checked" : ""}> <span>${$statement}</span></h5>`;
}
function option_input_DOM($statement) {
    return `<input type="text" name="option-statement" id="option-statement" class="option-statement" value="${$statement}">`;
}
function image_DOM(src, alt, title = alt) {
    return `<img src="${src}" alt="${alt}" title="${title}">`;
}
function notification(type = "info", message = "Hello World") {
    //
    console.log(`${type}: ${message}`);
}
$(document).ready(function () {
    $(".dashboard .dashboard-sidebar .sidebar-link[data-target]").click(function (e) {
        e.preventDefault();
        target = $(this).attr("data-target");
        $('.dashboard .dashboard-content > [data-label]').hide();
        $(`.dashboard .dashboard-content > [data-label='${target}']`).show();
    });
    $(".prompt form input[type=button][name=cancel]#cancel, .prompt").click(function () {
        $(this).closest(".prompt").hide();
    });
    $(".prompt > *").click(function (e) {
        e.stopPropagation();
    });
    $(document).keydown(function (e) {
        if (e.which == 27) {
            $(".prompt").hide();
        }
    });
    $(".tests .crud-buttons #add-test").click(function () {
        $(".prompt#add-test-prompt").show();
    });
    $(".tests .crud-buttons #edit-questions-test").click(async function () {
        test_id = 0;
        checkedCount = await $(".tests .crud-table input[type='checkbox'][name='select-test']:checked").each(async function () {
            test_id = $(this).attr("id");
            date = $(this).closest("tr").find("td:nth-child(3)").text();
            title = $(this).closest("tr").find("td:nth-child(4)").text();
            description = $(this).closest("tr").find("td:nth-child(5)").text();
        }).length;
        if (checkedCount != 1 || test_id == 0) return;
        $(".prompt#questions-test-prompt form input[type='hidden'][name='test-id']#test-id").val(test_id);
        $.post("/api/questions.php", {
            "action": "get",
            "test_id": test_id
        },
            async function (data, textStatus, jqXHR) {
                if (data.type == "error") { }
                else {
                    $(".prompt#questions-test-prompt .test-questions .test-header .test-title").html(title);
                    $(".prompt#questions-test-prompt .test-questions .test-header .test-description").html(description);
                    $(".prompt#questions-test-prompt .test-questions .test-header .test-date").html(date);
                    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").html("");
                    await data.forEach(async element => {
                        let options = "";
                        await element.options.forEach(async option => {
                            console.log(option);
                            options += option_DOM(option.phrase, element.statement.id, option.id, option.correct)
                        });
                        console.log(element.options.length, Math.random());
                        $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").append(question_DOM(element.statement.id, element.statement.question, element.statement.score, options));
                    });
                }
                console.log(data);
            },
            "json"
        ).done(function () {
            $(".prompt#questions-test-prompt").show();
        });
    });
    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").on("click", ".question-item h4.question-statement", async function () {
        await $(this).replaceWith(`<input type="text" id="question-statement" class="question-statement" name="question-statement" value="${$(this).text()}">`);
        await $(this).closest(".question-item input.question-statement").focus();
        await $(this).closest(".question-item input.question-statement").click();
    })
    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").on("focusout", ".question-item input.question-statement", function () {
        this_ref = this
        statement = $(this).val();
        id = $(this).closest(".question-item").attr("id")
        $.post("/api/questions.php", {
            action: "update",
            id: id,
            statement: statement
        },
            function (data, textStatus, jqXHR) {
                console.log(data);
                if (data.type == "error") { }
                else $(this_ref).replaceWith(`<h4 class="question-statement">${statement}</h4>`);
            },
            "json"
        );
    });
    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").on("change", ".question-item input[name='question-score']", function () {
        if (isNaN(Number($(this).val()))) score = 1
        else {
            num = (Number($(this).val()))
            if (num < 0) score = 1
            else score = Math.round(num)
        }
        $(this).val(score);
        console.log(score);
        id = $(this).closest(".question-item").attr("id")
        $.post("/api/questions.php", {
            action: "update",
            id: id,
            score: score
        },
            function (data, textStatus, jqXHR) {
                console.log(data);
                if (data.type == "error") { }
                else { }
            },
            "json"
        );
    });
    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").on("click", ".question-action button[data-action]", function () {
        $action = $(this).attr("data-action");
        this_ref = this
        if ($action == "add-option") {
            question_id = $(this).closest(".question-item").attr("id");
            phrase = "option1";
            $.post("/api/options.php", {
                action: "create",
                question_id: question_id,
                phrase: phrase,
                correct: 0
            },
                function (data, textStatus, jqXHR) {
                    if (data.type == "error") { }
                    else $(this_ref).closest(".question-item").find(".options").append(option_DOM(phrase, question_id, data.id, 0));
                },
                "json"
            );
        }
        else if ($action == "delete-question") {
            id = $(this).closest(".question-item").attr("id");
            $.post("/api/questions.php", {
                action: "delete",
                id: id,
            },
                function (data, textStatus, jqXHR) {
                    if (data.type == "error") { }
                    else $(this_ref).closest(".question-item").remove();
                },
                "json"
            );
        }
    })
    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").on("click", ".options .question-option input[type='checkbox']", function (e) {
        e.stopPropagation();
        e.preventDefault();
        this_ref = this;
        correct = $(this).is(":checked") ? 1 : 0;
        id = $(this).closest(".question-option").find("input[type='checkbox']").attr("id");
        $.post("/api/options.php", {
            action: "update",
            correct: correct,
            id: id
        },
            function (data, textStatus, jqXHR) {
                if (data.type == "error") { }
                else {
                    this_ref.checked = !this_ref.checked;
                }
            },
            "json"
        );
    });
    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").on("click", ".options .question-option > span", function () {
        $(this).replaceWith(option_input_DOM($(this).text()));
    });
    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").on("focusout", ".options .question-option > input[name='option-statement'].option-statement#option-statement", function () {
        this_ref = this;
        phrase = $(this).val();
        id = $(this).closest(".question-option").find("input[type='checkbox']").attr("id");
        $.post("/api/options.php", {
            action: "update",
            phrase: phrase,
            id: id
        },
            function (data, textStatus, jqXHR) {
                if (data.type == "error") { }
                else {
                    $(this_ref).replaceWith(`<span>${phrase}</span>`);
                }
            },
            "json"
        );
    });
    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").on("click", ".options .question-option button.delete-option", function () {
        this_ref = this
        id = $(this).closest(".question-option").find("input[type='checkbox']").attr("id");
        $.post("/api/options.php", {
            action: "delete",
            id: id
        },
            function (data, textStatus, jqXHR) {
                if (data.type == "error") { }
                else {
                    $(this_ref).closest(".question-option").remove();
                }
            },
            "json"
        );
    })
    $(".tests .crud-buttons #delete-all-tests").click(function () {
        $(".prompt#delete-all-tests-prompt").show();
    });
    $(".tests .crud-buttons #modify-test").click(async function () {
        test = {};
        checkedCount = await $(".tests .crud-table input[type='checkbox'][name='select-test']:checked").each(async function () {
            test.id = $(this).attr("id");
            test.date = $(this).closest("tr").find("td:nth-child(3)").text();
            test.title = $(this).closest("tr").find("td:nth-child(4)").text();
            test.description = $(this).closest("tr").find("td:nth-child(5)").text();
        }).length;
        if (checkedCount != 1 || test.id <= 0) return;
        await $(".prompt#modify-test-prompt").each(async function () {
            $(this).find("input#id").val(test.id);
            $(this).find("input#title").val(test.title);
            $(this).find("input#description").val(test.description);
            $(this).find("span#test-date").text(test.date);
            console.log("test123");
        }).show();
    });
    $(".tests .crud-buttons #delete-test").click(function () {
        ids = "";
        checkedCount = $(".tests .crud-table input[type='checkbox'][name='select-test']:checked").each(function () {
            ids += $(this).attr("id") + ",";
        }).length;
        if (checkedCount == 0) return;
        if (ids != "") ids = ids.slice(0, -1);
        checkedCount = checkedCount == 1 ? checkedCount + " test" : checkedCount + " tests";
        $(".prompt#delete-tests-prompt").find("span#tests-count").html(checkedCount);
        $(".prompt#delete-tests-prompt").find("input#tests-ids").val(ids);
        $(".prompt#delete-tests-prompt").show();
    });
    $(".tests .crud-table input[type='checkbox'][name='select-test']").change(function () {
        checkCount = $(".tests .crud-table input[type='checkbox'][name='select-test']").length;
        checkedCount = $(".tests .crud-table input[type='checkbox'][name='select-test']:checked").length;
        if (checkedCount == 1)
            $(".tests .crud-buttons #modify-test, .tests .crud-buttons #edit-questions-test").removeAttr("disabled");
        else
            $(".tests .crud-buttons #modify-test, .tests .crud-buttons #edit-questions-test").attr("disabled", "disabled");
        if (checkCount == checkedCount) {
            $(".tests .crud-buttons #select-all-tests").attr("disabled", "disabled");
        }
        else {
            $(".tests .crud-buttons #select-all-tests").removeAttr("disabled");
        }
        if (checkedCount > 0) {
            $(".tests .crud-buttons #delete-test").removeAttr("disabled");
            $(".tests .crud-buttons #deselect-all-tests").removeAttr("disabled");
        }
        else {
            $(".tests .crud-buttons #deselect-all-tests").attr("disabled", "disabled");
            $(".tests .crud-buttons #delete-test").attr("disabled", "disabled");
        }
    });
    $(".tests .crud-buttons #select-all-tests").click(function () {
        $(".tests .crud-table input[type='checkbox'][name='select-test']").each(function () {
            this.checked = true;
        }).trigger("change");
    });
    $(".tests .crud-buttons #deselect-all-tests").click(function () {
        $(".tests .crud-table input[type='checkbox'][name='select-test']").each(function () {
            this.checked = false;
        }).trigger("change");
    });
    $(".tests .crud-table tr").click(function () {
        $(this).find("input[type='checkbox'][name='select-test']").each(function () {
            this.checked = !this.checked;
            $(this).trigger("change");
        })
    }).find("input[type='checkbox'][name='select-test']").click(function (e) {
        e.stopPropagation();
    });
    $(".test-questions .icon-button#close-questions").click(function () {
        $(this).closest(".prompt").hide();
    })
    $(".test-questions").on("click", ".icon-button#zoom-questions", function () {
        $(this).closest(".test-questions").css({ "height": "100%", "width": "1200px" });
        $(this).html(`<i class="fa-regular fa-window-restore"></i>`);
        $(this).attr('id', 'restore-questions')
    });
    $(".test-questions").on("click", ".icon-button#restore-questions", function () {
        $(this).closest(".test-questions").removeAttr("style");
        $(this).html(`<i class="fa-regular fa-window-maximize"></i>`);
        $(this).attr('id', 'zoom-questions')
    });
    $(document).on("submit", "form[name='new-question-form']", function () {
        test_id = $(this).find("input[name='test-id']#test-id").val();
        if ($(this).find("input[name='question']#question").val() == "") return false;
        if (!test_id.match(/^[1-9]+[0-9]*$/g)) return false;
        $.post("?", {
            "add-question": 'add_question',
            "test-id": test_id,
            question: btoa($(this).find("input[name='question']#question").val())
        },
            function (data, textStatus, jqXHR) {
                if (data.type == "error") { }
                else {
                    $("form[name='new-question-form'] input[name='question']#question").val("")
                    $(".prompt#questions-test-prompt .test-questions .questions-list .questions-items").append(question_DOM(data.id, data.question, data.score));
                }
            },
            "json"
        );
        return false;
    });

    /**
     * Courses Part
     * started: 19 Juin 2022, 12:08 AM
     */

    $(".courses .crud-buttons #add-course").click(function () {
        $(".courses .prompt#new-course").show();
    });

    /**
     * 
     * New Course Submit
     * Create Course
     * Add Course
     * 
     * */

    $(".courses .prompt#new-course form").submit(function (e) {
        e.preventDefault();
        let data = new FormData(this);
        data.append("_method", "create");
        fetch("/api/courses.php", {
            method: "POST",
            body: data
        })
            .then(data => data.json())
            .then(course => {
                count = $(".courses .crud-table tbody tr").length + 1;
                $(".courses .crud-table tbody").append(`
                <tr>
                    <td>${count}</td>
                    <td>${course.title}</td>
                    <td>${course.description}</td>
                    <td><img src=""></td>
                    <td>${course.description}</td>
                </tr>`)
            })
            .catch(e => console.log("Error: ", e))
        return false;
    });

    /**
     * 
     * Course Image Preview
     * 
     */

    $(".courses .prompt#new-course form .image-input input[type='file'][name='image']").change(function (e) {
        $(".course-image-preview").html("")
        let image = this.files[0];
        if (image) {
            if(image.type.match(/^image\/.*$/)) $(".course-image-preview").append(image_DOM(URL.createObjectURL(image), "Image Preview"));
            else notification("error", "The file should be an image");
        }
    });

    $(".courses .prompt#new-course form .file-input input[type='file'][name='file']").change(function (e) {
        console.log("Changed !");
        let pdf = this.files[0];
        if (pdf) {
            if(pdf.type == "application/pdf") $(this).attr("data-message", pdf.name);
            else notification("error", "The file should be of type pdf");
        }
        else $(this).removeAttr("data-message");
    });
});