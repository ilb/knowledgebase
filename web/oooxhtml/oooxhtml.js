/* global privilegedAPI */

var privapi = privapi || {};

privapi.openLibreOffice = function (file_) {
  if (!window.privilegedAPI || !privilegedAPI.availiable()) { alert('Not available!'); return false; }
  var file = file_ || ''; var cmd = null;
  if (navigator.userAgent.indexOf('Windows') > 0) { // mozilla only
    cmd = '"${ProgramFiles}\\LibreOffice 5\\program\\soffice.exe" ' + file;
  } else {
    cmd = '/usr/bin/libreoffice ' + file;
  }
  console.log('cmd:', cmd);

  privilegedAPI.exec(
    cmd,
    function (res) { console.log('EXEC_SUCCESS_CALLBACK:', res); },
    function (res) { console.log('EXEC_ERROR_CALLBACK:', res); }
  );
};

var getHeadURL = function () {
  var headURLElem = document.querySelector('meta[name="HeadURL"]');
  var headURL = headURLElem && headURLElem.getAttribute('content');
  console.log('headURL', headURL);
  return (headURL || '').replace(/(^\$HeadURL:\s+)(.*)(\s\$)/, '$2');
};

var editDoc = function () {
  var headURL = getHeadURL();
  if (headURL) { privapi.openLibreOffice(headURL); }
};

var openDocHistory = function () {
  var headURL = getHeadURL();
  if (headURL) { window.open(headURL.replace('/repos/', '/viewvc/').replace('svn.net.ilb', 'svn.ilb'), '_blank'); }
};

var toggleAnnotations = function (event) {
  var body = document.body || document.getElementsByTagName('body')[0];
  body.classList.toggle('with-annotations');
  event.currentTarget.classList.toggle('active');
};

(function(){
  document.addEventListener('keydown', function(event) {
    if (event.altKey || event.metaKey) {
      const key = String.fromCharCode(event.which).toLowerCase();
      switch (key) {
        case 'e':
          event.preventDefault();
          editDoc();
          break;
        case 'h':
          event.preventDefault();
          openHistory();
          break;
        default:
      }
    }
  }, false);

  var appendStyles = function() {
    var css = '.settings-content { position: fixed; top: 0; right: 0; padding: 0.5rem; background: #fff; z-index: 21;' +
                '-moz-transform: translateX(100%); -webkit-transform: translateX(100%); transform: translateX(100%);' +
                'transition: all 0.1s ease-out;' +
              '}' +
              '.settings-content button { font-size: 1.3rem; height: 2.3rem; min-width: 2.3rem; cursor: pointer; margin: 0.1rem; }' +
              '.settings-content button.active { background-color: lightblue }' +
              '.settings:hover .settings-content { -moz-transform: none; -webkit-transform: none; transform: none; box-shadow: 0 0 20px rgba(23, 32, 30, 0.3); }' +
              '.settings-label { position: fixed; top: 0; right: 0; background: rgb(0,90,156); color: white; z-index: 20; font-size: 1.7rem; padding: 0.3rem 0.5rem; opacity: 0.7; }';
    var head = document.head || document.getElementsByTagName('head')[0];
    var style = document.createElementNS('http://www.w3.org/1999/xhtml','style');

    style.type = 'text/css';
    style.appendChild(document.createTextNode(css));
    head.appendChild(style);
    console.log('settings styles appended');
  };

  var appendSettings = function() {
    var settings = document.createElementNS('http://www.w3.org/1999/xhtml','div');
    settings.className = 'settings';

    var settingsLabel = document.createElementNS('http://www.w3.org/1999/xhtml','div');
    settingsLabel.className = 'settings-label';
    settingsLabel.innerHTML = '\u2699';
    settings.appendChild(settingsLabel);

    var settingsContent = document.createElementNS('http://www.w3.org/1999/xhtml','div');
    settingsContent.className = 'settings-content';

    var editButton = document.createElementNS('http://www.w3.org/1999/xhtml','button');
    editButton.innerHTML = '\u270e';
    editButton.setAttribute('title', 'Редактировать (alt+E)');
    editButton.setAttribute('onclick', 'editDoc()');
    settingsContent.appendChild(editButton);

    var historyButton = document.createElementNS('http://www.w3.org/1999/xhtml','button');
    historyButton.innerHTML = '\u25f4';
    historyButton.setAttribute('title', 'История изменений (alt+H)');
    historyButton.setAttribute('onclick', 'openDocHistory()');
    settingsContent.appendChild(historyButton);

    var annotationsButton = document.createElementNS('http://www.w3.org/1999/xhtml','button');
    annotationsButton.innerHTML = 'A';
    annotationsButton.setAttribute('title', 'Показать/скрыть аннотации');
    var hasAnnotation = document.querySelector('.annotation');
    annotationsButton.addEventListener('click', toggleAnnotations);
    settingsContent.appendChild(annotationsButton);
    if (hasAnnotation) {
      annotationsButton.click();
    } else {
      annotationsButton.setAttribute('disabled', 'disabled');
    }

    var helpButton = document.createElementNS('http://www.w3.org/1999/xhtml','button');
    helpButton.innerHTML = '?';
    helpButton.setAttribute('title', 'Справка');
    helpButton.setAttribute('onclick', 'window.open("https://docs.ilb.ru/oooxhtml/readme.xhtml")');
    settingsContent.appendChild(helpButton);

    settings.appendChild(settingsContent);
    var body = document.body || document.getElementsByTagName('body')[0];
    body.appendChild(settings);
    console.log('settings created');
  };

  appendStyles();
  appendSettings();
}());
;(function(){
  var makeRequest = function (args) {
    var url = args.url,
        request = args.request,
        method = args.method,
        accept = args.accept,
        contentType = args.contentType;

    return new Promise(function(resolve, reject) {
      var xhr = new XMLHttpRequest();
      xhr.withCredentials = true;
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200 || xhr.status === 204) {
            resolve(xhr.responseText || '');
          } else {
            var error = xhr.responseText || xhr.response;
            error = typeof error === 'string' ? error : error.statusText || error.data || error.message || 'Внутренняя ошибка приложения'
            reject(error);
          }
        }
      };
      xhr.open(method || 'GET', url, true);
      if (contentType) { xhr.setRequestHeader('Content-type', contentType); }
      // xhr.setRequestHeader('Accept', accept || 'application/json');
      xhr.send(method === 'POST' ? JSON.stringify(request) : null);
    });
  };

  var appendStyles = function() {
    var css = '.sidebar-menu { position: fixed; top: 0; left: 0; min-width: 20rem; max-width: 90vw; overflow: auto; height: 100vh; ' +
                'padding: 1rem 1rem 1rem 2rem; background: #fff; font-size: 1rem;' +
                '-moz-transform: translateX(-100%); -webkit-transform: translateX(-100%); transform: translateX(-100%);' +
                'transition: all 0.1s ease-out;' +
              '}' +
              '.sidebar:hover .sidebar-menu { -moz-transform: none; -webkit-transform: none; transform: none; box-shadow: 0 0 20px rgba(23, 32, 30, 0.3); }' +
              '.sidebar-label { position: fixed; top: 0; left: 0; background: rgb(0,90,156); color: white; z-index: 1; font-size: 1.3rem; padding: 0.4rem 0.6rem; opacity: 0.8; }' +
              '.sidebar .current { background: lightblue }' +
              '.sidebar-dir-btn { background: white; border: 0; outline: none; width: 1.5rem; height: 1rem; }' +
              '.sidebar-hidden { display: none; }';
    var head = document.head || document.getElementsByTagName('head')[0];
    var style = document.createElementNS('http://www.w3.org/1999/xhtml','style');

    style.type = 'text/css';
    style.appendChild(document.createTextNode(css));
    head.appendChild(style);
    console.log('sidebar styles appended');
  };

  var appendSidebar = function() {
    var sidebar = document.createElementNS('http://www.w3.org/1999/xhtml','div');
    sidebar.className = 'sidebar';

    var sidebarLabel = document.createElementNS('http://www.w3.org/1999/xhtml','div');
    sidebarLabel.className = 'sidebar-label';
    sidebarLabel.innerHTML = '\u2630';
    sidebar.appendChild(sidebarLabel);

    var sidebarMenu = document.createElementNS('http://www.w3.org/1999/xhtml','div');
    sidebarMenu.className = 'sidebar-menu';
    sidebarMenu.innerHTML = 'Loading...';
    sidebar.appendChild(sidebarMenu);
    var body = document.body || document.getElementsByTagName('body')[0];
    body.appendChild(sidebar);
    console.log('sidebar created');
  };

  var highlightCurrent = function(content) {
    var anchors = content && content.querySelectorAll && content.querySelectorAll('a');
    var currentUrl = location.href.split(/\?|\#/)[0];
    if (anchors && anchors.length) {
      [].forEach.call(anchors, function (anchor) {
        if (decodeURIComponent(anchor.href) === decodeURIComponent(currentUrl)) {
          var tr = anchor.parentNode.parentNode;
          if (tr.tagName.toLowerCase() === 'tr') {
            tr.classList.add('current');
          }
        }
      });
    }
  };

  var parseContent = function(table, parent) {
    console.log('parseContent', table);
    if (!table || !table.querySelectorAll) { return table; }
    var menuElems = [];
    var trs = table.querySelectorAll('tr');
    var count = 0;
    [].forEach.call(trs, function (tr) {
      var tds = tr.querySelectorAll('td');
      if (!tds || tds.length < 3) { return; }
      var a = tds[0].querySelector('a');
      if (!a) { return; }
      var link = (parent && parent.href && !/^\//.test(a.href)) ? parent.href + a.getAttribute('href') : a.href;
      var menuElem = {
        link: link,
        name: (a.textContent || a.innerText || '').trim(),
        description: tds[3] && (tds[3].textContent || tds[3].innerText || '').trim()
      };
      menuElem.isDirectory = /\/$/.test(menuElem.name);
      menuElem.displayName = (menuElem.description || menuElem.name).replace(/\/$/, '');

      if (count === 0 && menuElem.name.toLowerCase() === 'parent directory') {
        menuElem.displayName = 'Родительский каталог';
        menuElem.parentLink = true;
      }

      menuElems.push(menuElem);
      count++;
    });

    menuElems = prepareVirtualDirs(menuElems);

    if (!menuElems.length) { return table; }
    menuElems = menuElems.filter(function(el) { return el && (!el.parentLink || !parent); }); // remove parent directory link from sub menu
    if (!menuElems.length) { menuElems.push({ name: 'Пустой каталог' }); }
    return createMenuList(menuElems);
  };

  var createMenuList = function(menuElems) {
    var newMenu = document.createElementNS('http://www.w3.org/1999/xhtml','ul');
    newMenu.style.listStyleType = 'none';
    var currentUrl = location.href.split(/\?|\#/)[0];
    menuElems.forEach(function(menuElem) {
      var li = document.createElementNS('http://www.w3.org/1999/xhtml','li');
      if (menuElem.parentLink) { li.style.marginLeft = '-1rem'; }
      if (menuElem.isDirectory) {
        var button = document.createElementNS('http://www.w3.org/1999/xhtml','button');
        button.className = 'sidebar-dir-btn';
        button.innerHTML = '+';
        button.addEventListener('click', openSidebarDir);
        li.appendChild(button);
        li.style.marginLeft = '-1.5rem';
      }

      var anchor = document.createElementNS('http://www.w3.org/1999/xhtml', menuElem.link ? 'a' : 'span');
      anchor.setAttribute('href', menuElem.link);
      anchor.innerHTML = menuElem.displayName;
      li.appendChild(anchor);

      if (menuElem.childrens) {
        var subtree = document.createElementNS('http://www.w3.org/1999/xhtml','div');
        subtree.className = 'sidebar-subtree sidebar-virtual sidebar-hidden';
        subtree.appendChild(createMenuList(menuElem.childrens));
        li.appendChild(subtree);
      }

      if (decodeURIComponent(menuElem.link) === decodeURIComponent(currentUrl)) {
        li.classList.add('current');

        // open virtual sum menus on current active link
        setTimeout(function () {
          var parentNode = li.parentNode;
          while (parentNode && parentNode.classList) {
            if (parentNode.classList.contains('sidebar-hidden')) {
              parentNode.parentNode.querySelector('.sidebar-dir-btn').click();
            }
            parentNode = parentNode.parentNode;
          }
        }, 10);
      }
      newMenu.appendChild(li);
    });
    return newMenu;
  };

  var prepareVirtualDirs = function(menuElems) {
    if (!menuElems || !menuElems.length) { return; }
    var newMenuElems = [];
    menuElems.forEach(function(menuElem) {
      var nameParts = menuElem.displayName.split('|');
      if (nameParts.length > 1) {
        menuElem.isDirectory = true;
        menuElem.displayName = nameParts[0].trim();
        var childrenName = nameParts.slice(1).join('|').trim();
        var children = {
          name: childrenName,
          isDirectory: nameParts.length > 2,
          displayName: childrenName,
          link: menuElem.link
        };
        menuElem.link = null;

        var existedElem = [].reduce.call(newMenuElems, function (w, e) {
          return w || ((e.displayName === menuElem.displayName && e.childrens) ? e : null)
        }, null);
        if (existedElem) {
          existedElem.childrens.push(children);
          return;
        } else {
          menuElem.childrens = [children],
          newMenuElems.push(menuElem);
        }
      } else {
        newMenuElems.push(menuElem);
      }
    });


    newMenuElems.forEach(function(menuElem) {
      if (menuElem.childrens) {
        menuElem.childrens = prepareVirtualDirs(menuElem.childrens);
      }
    });

    newMenuElems.sort(sortMenuStrategy);
    return newMenuElems;
  };

  var sortMenuStrategy = function(a, b) {
    if (a.parentLink && !b.parentLink) { return -1; }
    if (!a.parentLink && b.parentLink) { return 1; }
    if (a.isDirectory && !b.isDirectory) { return -1; }
    if (!a.isDirectory && b.isDirectory) { return 1; }
    if (a.displayName.toLowerCase() < b.displayName.toLowerCase()) { return -1; }
    if (a.displayName.toLowerCase() > b.displayName.toLowerCase()) { return 1; }
    return 0;
  };

  var openSidebarDir = function(e) {
    var button = e.target;
    var nextText = button.innerHTML === '+' ? '-' : '+';
    button.innerHTML = '\u00b7\u00b7\u00b7';
    button.setAttribute('disabled', 'disabled');

    var subtree = button.parentNode.querySelector('.sidebar-subtree');
    var isVirtual = subtree && subtree.classList.contains('sidebar-virtual');
    if (isVirtual) {
      var classMethod = nextText === '-' ? 'remove' : 'add';
      subtree.classList[classMethod]('sidebar-hidden');
      if (classMethod === 'add') { // close all inner virtual sub menus
        var dirBtns = subtree.querySelectorAll('.sidebar-dir-btn');
        [].forEach.call(dirBtns, function (dirBtn) {
          if (dirBtn.innerHTML === '-') { dirBtn.click(); }
        })
      }
      button.removeAttribute('disabled', 'disabled');
      button.innerHTML = nextText;
      return;
    }
    if (subtree) { subtree.parentNode.removeChild(subtree); }
    if (nextText === '-') {
      var link = button.parentNode.querySelector('a');
      var url = link && link.href;
      subtree = document.createElementNS('http://www.w3.org/1999/xhtml','div');
      subtree.className = 'sidebar-subtree';
      loadContent({
        url: url,
        onsuccess: function (content) {
          console.log('content', content);
          subtree.appendChild(content);
          var parsedContent = parseContent(subtree.parentNode.querySelector('.sidebar-subtree > table'), link);
          console.log('parsedContent', parsedContent);
          if (parsedContent) {
            subtree.innerHTML = '';
            subtree.appendChild(parsedContent);
          }
          button.removeAttribute('disabled', 'disabled');
          button.innerHTML = nextText;
        },
        onerror: function(err) {
          subtree.innerHTML = err;
          button.removeAttribute('disabled', 'disabled');
          button.innerHTML = nextText;
        }});
        button.parentNode.appendChild(subtree);
    } else {
      button.removeAttribute('disabled', 'disabled');
      button.innerHTML = nextText;
    }
  };

  var loadContent = function(args) {
    var url = args.url,
        onsuccess = args.onsuccess,
        onerror = args.onerror;
    makeRequest({ url: url })
      .then(function(response) {
        if (!response) { onerror('No content'); return; }
        var parser = new DOMParser();
        var doc = parser.parseFromString(response, 'text/html');
        var docHeadURL = doc.querySelector('meta[name="HeadURL"]');
        var sidebarContent = null;
        if (docHeadURL) { // probably index.xhtml
          var currentHeadURL = document.querySelector('meta[name="HeadURL"]');
          if (currentHeadURL && currentHeadURL.content && currentHeadURL.content === docHeadURL.content) { // if headURLs equal - remove sidebar
            var sidebar = document.querySelector('.sidebar');
            sidebar.parentNode.removeChild(sidebar)
            console.log('removing sidebar');
            return;
          }
          sidebarContent = document.createElementNS('http://www.w3.org/1999/xhtml','div');
          sidebarContent.innerHTML = doc.querySelector('body').innerHTML;
          var scripts = sidebarContent.querySelectorAll('script');
          [].forEach.call(scripts, function (script) { script.parentNode.removeChild(script); });
        } else {
          var table = doc.querySelector('table');
          sidebarContent = table;
        }

        if (sidebarContent) {
          onsuccess(sidebarContent);
        } else {
          onerror('Empty sidebarContent!!!');
        }
      })
      .catch(function(error) {
        onerror('Can\'t create tree:<br/>' + error);
        console.log('sidebar content NOT filled');
      });
  }

  var fillSidebarContent = function() {
    var contentDiv = document.querySelector('.sidebar .sidebar-menu');
    if (!contentDiv) { return false; }
    var url = location.href.split('/').slice(0, -1).join('/');
    contentDiv.innerHTML = '';
    loadContent({
      url: url,
      onsuccess: function (content) {
        contentDiv.appendChild(content);
        highlightCurrent(contentDiv);
        var parsedContent = parseContent(contentDiv.parentNode.querySelector('.sidebar-menu > table'));
        console.log('parsedContent', parsedContent);
        if (parsedContent) {
          contentDiv.innerHTML = '';
          contentDiv.appendChild(parsedContent);
        }
      },
      onerror: function(err) {
        contentDiv.innerHTML = err;
      }});
  };

  appendStyles();
  appendSidebar();
  fillSidebarContent();
}());
;window.onload=function() {
    if (document.location.hash) {
        document.location = document.location;
        console.log('xslt trick: reload hash location ');
    }
};
