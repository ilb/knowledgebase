var doc = "",
    url = "/knowledgebase/web/AddSubscription.php";
window.addEventListener('load', function () {
    main();
});


function main() {
    // имя документа
    doc = location.href.split("DocumentView.php")[1].split("/").slice(0, -1).join("/").slice(1);

    var btnSubsList = document.querySelectorAll(".subscribe");
    for (var i = 0; i < btnSubsList.length; i++ ) {
        btnSubsList[i].addEventListener("click", subscribe);
    }
    setEvent();
}

function subscribe(e) {
    var target = e.target.parentNode,
        tag = target.tagName === "h1" ? "" : target.id,
        span = document.createElementNS('http://www.w3.org/1999/xhtml', "span"),
        input = document.createElementNS('http://www.w3.org/1999/xhtml',"input"),
        button = document.createElementNS('http://www.w3.org/1999/xhtml', "button"),
        close = document.createElementNS('http://www.w3.org/1999/xhtml', "button");
    input.type = "text";
    span.appendChild(input);
    span.style.display = "inline";
    button.addEventListener("click", function (e) {
        addSubscribe(e, input, span, tag)
    });
    button.textContent = "Подписать";
    close.addEventListener("click", function() {
        closeSpan(span);
    });
    close.textContent = "X";
    span.appendChild(button);
    span.appendChild(close);
    target.appendChild(span);
}

function addSubscribe(e, input, span, tag) {
    var group = input.value,
        query = "";
    query += "?name-0=" + group;
    query += "&document-0=" + doc;
     query += "&group=on";
    query += "&tag-0=" + tag;
    closeSpan(span);
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        var res = "";
        if (xhr.status == 200) {
            console.log("Успешно");
            res = "Успешно";
        } else {
            res = "Неудача";
        }
        alert(res);
    };
    xhr.open('GET', url + query, true);
    xhr.send();
}

function closeSpan(span) {
    span.remove();
}

function setEvent() {
    for (var i = 1; i < 5; i++) {
        addEventHover(document.querySelectorAll("h"+i));
    }
}

function addEventHover(elements) {
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener("mouseenter", function(e) {
            var parent = e.target;
            var span = parent.querySelector("span");
            span.style.display = "inline";
        });
        elements[i].addEventListener("mouseleave", function(e) {
            var parent = e.target;
            var span = parent.querySelector("span");
            span.style.display = "none";
        });
    }
}