window.addEventListener('load', function () {
    main();
});


function main() {
    setFormEvent();
}

function setFormEvent() {
    var form = document.querySelector("form.create_document");
    form.addEventListener("submit", function(e){
        e.preventDefault();
        var dir = this.querySelector("select").value,
            docName = this.querySelector("input").value,
            documentSplit = docName.split(".");
        if (docName === "") {
            alert("Имя документа должно быть заполнено")
            return
        }
        if (documentSplit.length !== 2) {
            docName += ".xhtml";
        } else {
            if (documentSplit[1].trim() !== "xhtml") {
                docName = documentSplit[0] + ".xhtml";
            }
        }
        if (dir !== "---") {
            docName = dir + "/" + docName
        }
        var body = new FormData();
        body.append("name-0", docName)
        var xhr = new XMLHttpRequest();
        xhr.onload = function () {
            console.log(xhr.response)
            var res = JSON.parse(xhr.response);
            if (res["error"]) {
                alert(res["error"]);
            } else {
                alert(res["result"]);
                window.location = "DocumentView.php?url-0=" + docName;
            }
        };
        xhr.open('POST', "AddDocument.php", true);
        xhr.send(body);
    });
}
