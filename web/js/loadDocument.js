function getListDir(dir, parent) {
    var xhr = new XMLHttpRequest();
    let json = {};
    xhr.onload = function () {
//        console.log(xhr.response);
        json = JSON.parse(xhr.response);
        createStruct(json, parent);
    };
    xhr.open('GET', "DocumentListLoad.php?dir-0="+dir, true);
    xhr.send();
}


function createStruct(obj, parent) {
    // главный див который будет добавлен в parent 
    let main = document.createElement("div");
    main.className = "ui list scale_text";
    // проходимся в цикле по всем элементам и добавляем каждый как отдельный item  
    // в main div
    obj["content"].forEach(function (e) {
        let item = document.createElement("div"),
                icon = document.createElement("i"),
                content = document.createElement("div"),
                header = document.createElement("div"),
                span = document.createElement("span"),
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
                    let list = content.querySelector(".list");
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
            let a = document.createElement("a");
            a.href = "DocumentView.php/" + e.parent + "/" + e.name;
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
