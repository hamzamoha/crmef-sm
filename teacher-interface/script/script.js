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
    $(".prompt form").click(function (e) {
        e.stopPropagation();
    });
    $(".tests .crud-buttons #add-test").click(function () {
        $(".prompt#add-test-prompt").show();
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
        if(checkedCount != 1 || test.id <= 0) return;
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
            $(".tests .crud-buttons #modify-test").removeAttr("disabled");
        else
            $(".tests .crud-buttons #modify-test").attr("disabled", "disabled");
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
});