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
        }).length;
        if (checkedCount != 1 || test_id == 0) return;
        $(".prompt#questions-test-prompt form input[type='hidden'][name='test-id']#test-id").val(test_id);
        //get questions
        $(".prompt#questions-test-prompt").show();
    });
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
        $.post("?", {
            "add-question": 'add_question',
            "test-id": test_id,
            question: btoa($(this).find("input[name='question']#question").val())
        },
            function (data, textStatus, jqXHR) {
                console.log(data, textStatus, jqXHR);
            },
            "json"
        );
        return false;
    });
});