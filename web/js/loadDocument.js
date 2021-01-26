function getListDir(dir, parent) {
    var xhr = new XMLHttpRequest();
    var json = {};
    xhr.onload = function () {
//        console.log(xhr.response);
        json = JSON.parse(xhr.response);
        createStruct(json, parent);
    };
    xhr.open('GET', "DocumentListLoad.php?dir-0=" + dir, true);
    xhr.send();
}

function createVirtualDirs(obj) {
    var virtual = {};
    obj["content"].sort(function (a, b) {
        if (a.title && b.title) {
            return a.title.toLowerCase() > b.title.toLowerCase();
        }
    });
    obj["content"].forEach(function (el, i) {
        if (el.title) {
            var titleSplit = el.title.split("|");
            if (titleSplit.length > 1) {
                var key = titleSplit[0].trim();
                el.title = titleSplit[1].trim();
                if (virtual[key]) {
                    virtual[key].push(el);
                } else {
                    virtual[key] = [el];
                }
                obj["content"][i] = null;
            }
        }
    });
    
    if (JSON.stringify(virtual) === JSON.stringify({})) {
        return [];
    }
    
    var items = [];
    for (var key in virtual) {        
        var item = document.createElementNS('http://www.w3.org/1999/xhtml', "div"),
            icon = document.createElementNS('http://www.w3.org/1999/xhtml', "i"),
            content = document.createElementNS('http://www.w3.org/1999/xhtml', "div"),
            header = document.createElementNS('http://www.w3.org/1999/xhtml', "div");
        item.className = "item";
        icon.className = "icon outline folder open";
        header.className = "pointer";
        header.addEventListener("click", function (e) {
            var list = e.target.parentNode.querySelector(".list");            
            var icon = e.target.parentNode.parentNode.querySelector(".icon");

            if (icon.classList.contains("open")) {
                list.style.display = "none";
            } else {
                list.style.display = "block";
            }
            icon.classList.toggle("open");
        });
        content.className = "content";
        header.className += " header";
        header.innerHTML = key;
        content.appendChild(header);
        createStruct({"content": virtual[key]}, content);
        item.appendChild(icon);
        item.appendChild(content);        
        items.push(item);
    }
    return items;
}

function createStruct(obj, parent) {
    // главный див который будет добавлен в parent 
    var main = document.createElementNS('http://www.w3.org/1999/xhtml', "div");
    main.className = "ui list scale_text";
    var items = createVirtualDirs(obj, parent);
    items.forEach(function (el) {
        main.appendChild(el);
    });
    // проходимся в цикле по всем элементам и добавляем каждый как отдельный item  
    // в main div
    obj["content"].forEach(function (e) {
        if (e === null) {
            return;
        }
        var item = document.createElementNS('http://www.w3.org/1999/xhtml', "div"),
                icon = document.createElementNS('http://www.w3.org/1999/xhtml', "i"),
                content = document.createElementNS('http://www.w3.org/1999/xhtml', "div"),
                header = document.createElementNS('http://www.w3.org/1999/xhtml', "div"),
                span = document.createElementNS('http://www.w3.org/1999/xhtml', "span"),
                name = "",
                link = null;
        item.className = "item";
        icon.className = "icon";

        if (e.dir) {
            icon.className += " folder";
            header.className = "pointer";
            name = e.name;
            header.addEventListener("click", function (e) {
                if (icon.classList.contains("open")) {
                    var list = content.querySelector(".list");
                    content.removeChild(list);
                } else {
                    getListDir(name, content);
                }
                icon.classList.toggle("open");
            });
        } else {
            if (!e.parent) {
                return;
            }
            if (e.title) {
                name = e.title;
            } else {
                name = e.name;
            }
            var a = document.createElementNS('http://www.w3.org/1999/xhtml', "a");
            a.href = "DocumentView.php/" + e.parent + e.name;
            a.target = "_blank";
            a.innerHTML = name;
            link = a;
            icon.className += " file";
        }

        if (link !== null) {
            span.appendChild(link);
        } else {
            span.innerHTML = name;
        }

        content.className = "content";
        header.className += " header";

        header.appendChild(span);
        content.appendChild(header);

        item.appendChild(icon);
        item.appendChild(content);
        main.appendChild(item);
    });
    parent.appendChild(main);
}

window.addEventListener('load', function () {
    getListDir("", document.querySelector(".ui.container"));
});
