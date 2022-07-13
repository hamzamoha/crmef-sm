/**
 * 
 * @param {HTMLElement} element The element that you wanna calculate its width
 * @returns {number} the width of the element
 * 
 */
function getWidth(element) {
    if (!element) return 0;
    let computedStyle = getComputedStyle(element);
    let width = element.clientWidth - parseFloat(computedStyle.paddingRight) - parseFloat(computedStyle.paddingLeft);
    return width;
}
/**
 * 
 * @param {string} type
 * @param {string} message
 * @returns {void} nothing
 * 
 */
function notification(type = "info", message = "Hello World") {
    console.log(`${type}: ${message}`);
    return;
}
class PDF_Reader {
    /**
     * 
     * @param {string} url The URL to the pdf
     * @param {HTMLElement} div The output element
     * @param {HTMLElement} input The page number output
     * @returns {PDF_Reader} this object
     */
    constructor(div, input) {
        pdfjsLib.GlobalWorkerOptions.workerSrc = "/JS/pdf.js/pdf.worker.min.js";
        this.div = div;
        this.input = input;
        this.url = div.getAttribute("data-pdf");
        this.document = pdfjsLib.getDocument(this.url);
        this.pages = [];
        return this.loadPdf();
    }
    /**
     * 
     * @param {Function} callback 
     */
    init(callback) {
        callback.bind(this)();
    }

    async loadPdf() {
        let this_ref = this;
        await this.document.promise.then(async function (pdf) {
            this_ref.pdf = pdf;
            this_ref.numPages = pdf.numPages;
            await this_ref.output();
        }, async function (reason) {
            // PDF loading error
            notification("error", reason.message);
            console.error("Erron Reason !", reason);
        });
        return this.setPaginator();
    }
    /**
     * 
     * @param {HTMLElement} canvas the canvas element
     * @param {number} pageNumber the page number
     * @returns {PDF_Reader} this object
     */
    async loadPage(canvas, pageNumber = 1) {
        let this_ref = this;
        await this.pdf.getPage(pageNumber).then(async function (page) {
            let scale = getWidth(this_ref.div) / page.getViewport().viewBox[2];
            let viewport = page.getViewport({ scale: scale });

            var context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);
            await renderTask.promise;
        });
    }
    /**
     * Start Output the PDF
     */
    async output() {
        this.div.innerHTML = ``;
        let canvas_group = document.createElement("div");
        canvas_group.className = "canvas-group";
        for (let i = 0; i < this.numPages; i++) {
            let canvas = document.createElement("canvas");
            await this.loadPage(canvas, i + 1);
            await canvas_group.appendChild(canvas);
        }
        this.div.appendChild(canvas_group);
        return this;
    }
    /**
     * 
     * @param {HTMLElement} input 
     */
    async setPaginator() {
        this.input.parentElement.setAttribute("data-max", this.numPages);
        this.input.setAttribute("max", this.numPages);
        this.input.setAttribute("min", Math.min(this.numPages, 1));
        this.input.value = 1;
        let this_ref = this;
        this.input.addEventListener("change", async function (e) {
            let page_index = parseInt(this.value);
            if (page_index > this_ref.numPages) this.value = page_index = this_ref.numPages;
            else if (page_index < 0) this.value = page_index = 1;
            else if (page_index == 0) return false;
            else this.value = page_index;
            this_ref.div.querySelector(".canvas-group").style.transform = `translateX(calc(-${page_index - 1} * 100%))`;
        });
    }
}
$(document).ready(function () {
    $(".pdf-viewer-buttons #next-page").click(function () {
        let input = $(this).closest(".pdf-viewer-buttons").find("#page-number input");
        let page_index = parseInt(input.val());
        let max = parseInt(input.attr("max"));
        let min = parseInt(input.attr("min"));
        if (page_index >= max) input.val(min);
        else if (page_index < min) input.val(min);
        else input.val((page_index + 1));
        input[0].dispatchEvent(new Event("change"));
    });

    $(".pdf-viewer-buttons #prev-page").click(function () {
        let input = $(this).closest(".pdf-viewer-buttons").find("#page-number input");
        let page_index = parseInt(input.val());
        let max = parseInt(input.attr("max"));
        let min = parseInt(input.attr("min"));
        if (page_index <= min) input.val(max);
        else if (page_index > max) input.val(max);
        else input.val((page_index - 1));
        input[0].dispatchEvent(new Event("change"));
    });

    /**
     * 
     * Submit the answers
     * Submit the test
     * Submit test
     * Test submit
     * 
     */
    $("#submit-test").click(async function () {
        let test = {};
        await $(this).closest(".questions").find("form").each(async function (form) {
            let answers = "";
            await $(this).find("input:checked").each(async function () {
                answers += this.value + ",";
            });
            answers = answers.slice(0, -1);
            test[this.getAttribute("data-id")] = answers;
        });
        let url = new URL(window.location.href);
        let data = {
            _method: "create",
            id: url.searchParams.get("id"),
            test: test
        }
        $.post("/api/answers.php", data,
            function (data, textStatus, jqXHR) {
                notification(data.type, data.message);
                if (data.type == "success") {
                    window.scrollTo(0, 0)
                    window.location.reload();
                }
            },
            "json"
        );
    })

    /**
     * Solve Kata
     */
    $(".kata button#solve").click(function (e) {
        let data = new FormData();
        data.append("_method", "get");
        data.append("id", this.getAttribute("data-kata-id"));
        fetch("/api/kata.php", {
            method: "POST",
            body: data
        })
        .then(res => res.json())
        .then(async function (data) {
            if(data.type == "success"){
                let editor = document.querySelector(".kata .prompt#solve-kata form #solve_kata");
                await ace.edit(editor).setValue(data.message);
                $(".kata .prompt#solve-kata").show();
            }
        });
    })
    /**
     * View Code
     */
    $(".kata button#view-code").click(function (e) {
        let data = new FormData();
        data.append("_method", "get");
        data.append("id", this.getAttribute("data-kata-id"));
        e.preventDefault();
        fetch("/api/kata.php", {
            method: "POST",
            body: data
        })
        .then(res => res.json())
        .then(async function (data) {
            if(data.type == "success"){
                await ace.edit(document.querySelector(".kata .prompt#show-code #code_kata")).setValue(data.message);
                $(".kata .prompt#show-code").show();
            }
        });
        return false;
    })
    $(".kata .prompt#solve-kata form").submit(async function (e) {
        e.preventDefault();
        let data = new FormData();
        data.append("_method", "create");
        data.append("code", ace.edit(this.querySelector("#solve_kata")).getValue());
        data.append("id", this.id.value);
        fetch("/api/kata.php", {
            method: "POST",
            body: data
        })
            .then(response => response.json())
            .then(async function (data) {
                notification(data.type, data.message);
                if (data.type == "success") {
                    setInterval(() => {
                        window.location.reload();
                    }, 1000);
                }
                else {
                }
            });
    });
    //beautify
    $(".kata .prompt#create-kata form button[name=beautify]#beautify").click(function(e) {
        e.preventDefault();
        let tester_code = $(this).closest("form").find("#tester_code")[0];
        let beautify = ace.require("ace/ext/beautify"); // get reference to extension
        beautify.beautify(ace.edit(tester_code).session);
        return false;
    });
})