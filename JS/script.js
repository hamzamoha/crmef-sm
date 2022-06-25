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
     * @returns {PDF_Reader} this object
     */
    constructor(div) {
        pdfjsLib.GlobalWorkerOptions.workerSrc = "/JS/pdf.js/pdf.worker.min.js";
        this.div = div;
        this.url = div.getAttribute("data-pdf");
        this.document = pdfjsLib.getDocument(this.url);
        this.loadPdf();
        this.pages = [];
        return this;
    }
    async loadPdf() {
        let this_ref = this;
        this.document.promise.then(function (pdf) {
            this_ref.pdf = pdf;
            this_ref.numPages = pdf.numPages;
            this_ref.output();
        }, function (reason) {
            // PDF loading error
            notification("error", reason.message)
            console.error("Erron Reason !", reason);
        });
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
        for (let i = 0; i < this.numPages; i++) {
            let canvas = document.createElement("canvas");
            await this.loadPage(canvas, i + 1);
            $(canvas).hide()
            this.div.appendChild(canvas);
        }
        $(this.div).find("canvas:first-child").show();
        return this;
    }
}
$(document).ready(function () {
    $(".pdf-viewer-buttons #next-page").click(function () {
        let next_canvas = $("#pdf-viewer canvas:visible").next();
        $("#pdf-viewer canvas").hide();
        if (next_canvas.length == 0) {
            $("#pdf-viewer canvas:first-child").show();
        }
        else {
            next_canvas.show();
        }
    });

    $(".pdf-viewer-buttons #prev-page").click(function () {
        let prev_canvas = $("#pdf-viewer canvas:visible").prev();
        $("#pdf-viewer canvas").hide();
        if (prev_canvas.length == 0) {
            $("#pdf-viewer canvas:last-child").show();
        }
        else {
            prev_canvas.show();
        }
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
})