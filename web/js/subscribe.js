var doc = "",
    url = "AddSubscription.php";
window.addEventListener('load', function () {
    main();
});


function main() {
    // имя документа
    doc = window.location.search.split("=")[1].split("#")[0];

    var btnSubsList = document.querySelectorAll(".subscribe");
    btnSubsList.forEach(function (el) {
        el.addEventListener("click", subscribe);
    });
}

function subscribe(e) {
    var target = e.target.parentNode,
        tag = target.id,
        span = document.createElement("span"),
        input = document.createElement("input"),
        button = document.createElement("button"),
        close = document.createElement("button");
    input.type = "text";
    span.appendChild(input);
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
        res = "";
        if (xhr.status == 201) {
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