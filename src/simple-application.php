<?php
$vars['title'] = '简单应用教程';
$vars['filename'] = 'simple-application';
$vars['prev'] = array(
    'filename' => 'installation',
    'title' => '安装'
);
$vars['next'] = array(
    'filename' => 'jsx',
    'title' => 'JSX'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">简单应用教程</h1>

    <nav class="doc-toc mdui-text-color-theme">
        <ul>
            <li><a href="#app-init">初始化应用</a></li>
            <li><a href="#app-model">创建模型</a></li>
            <li><a href="#app-view">创建视图</a></li>
            <li><a href="#app-mount">渲染视图</a></li>
            <li><a href="#app-style">添加样式</a></li>
            <li><a href="#add-route">添加路由</a></li>
            <li><a href="#app-edit">编辑用户</a></li>
            <li><a href="#app-save">保存用户</a></li>
            <li><a href="#app-layout">组件布局</a></li>
            <li><a href="#app-end">结束</a></li>
        </ul>
    </nav>

    <div class="doc-chapter">
        <h2 id="app-init" class="doc-chapter-title mdui-text-color-theme"><a href="#app-init">初始化应用</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>让我们来开发一个简单的应用，通过这个应用可以学习到开发单页面应用所需的主要知识。</p>
            <p>首先在项目文件夹下创建应用的入口文件 <code>index.html</code>：</p>
            <pre class="doc-code" data-filename="index.html"><code class="lang-html"><?php echo htmlentities('<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>My Application</title>
    </head>
    <body>
        <script src="bin/app.js"></script>
    </body>
</html>'); ?></code></pre>
            <p>为了便于维护代码，我们需要把代码分成多个模块，并最终把这些模块合并成一个包 <code>bin/app.js</code>。</p>
            <p>我们使用 NPM 包管理器来管理打包工具。请按照<a href="./installation.html">安装</a>页面的说明使用 npm 进行安装。安装完成后就可以准备创建引用了。</p>
        </div>

        <h2 id="app-model" class="doc-chapter-title mdui-text-color-theme"><a href="#app-model">创建模型</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>我们首先创建一个模型文件 <code>src/models/User.js</code>，并添加了一个 <code>list</code> 方法用于保存用户对象：</p>
            <pre class="doc-code" data-filename="src/models/User.js"><code class="lang-js"><?php echo htmlentities('var User = {
    list: []
}

module.exports = User'); ?></code></pre>
            <p>在这个应用中我们需要从服务器加载数据。为了与服务器通信，我们需要使用 Mithril 的 XHR 工具：<code>m.request</code>。首先，在模块中引入 Mithril：</p>
            <pre class="doc-code" data-filename="src/models/User.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var User = {
    list: []
}

module.exports = User'); ?></code></pre>
            <p>接下来，创建一个用于触发 XHR 请求的函数。我们把它命名为 <code>loadList</code>：</p>
            <pre class="doc-code" data-filename="src/models/User.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var User = {
    list: [],
    loadList: function() {
        // TODO: make XHR call
    }
}

module.exports = User'); ?></code></pre>
            <p>然后，我们用 <code>m.request</code> 来发送 XHR 请求，并用接口的响应来填充数据。</p>
            <pre class="doc-code" data-filename="src/models/User.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var User = {
    list: [],
    loadList: function() {
        return m.request({
            method: "GET",
            url: "http://rem-rest-api.herokuapp.com/api/users",
            withCredentials: true,
        })
        .then(function(result) {
            User.list = result.data
        })
    },
}

module.exports = User'); ?></code></pre>
            <p><code>m.request</code> 返回一个 Promise。默认情况下，Mithril 会把 HTTP 请求的响应数据当成 JSON 格式，并自动解析为 JavaScript 对象或数组。<code>.then</code> 回调会在 XHR 请求完成后运行。</p>
            <p>我们在 <code>loadList</code> 中使用了 <code>return</code> 语句。这在使用 Promise 时是一个很好的做法，它允许我们注册更多的回调，以便在 XHR 请求完成后运行。</p>
            <p>这个简单的模型暴露了两个方法：<code>User.list</code>（一个保存用户对象的数组），<code>User.loadList</code>（一个把服务器返回的数据填充到 <code>User.list</code> 的方法）。</p>
        </div>

        <h2 id="app-view" class="doc-chapter-title mdui-text-color-theme"><a href="#app-view">创建视图</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>现在，我们创建一个视图文件 <code>src/views/UserList.js</code>，用于显示来自 <code>User</code> 模型的数据。</p>
            <p>首先，引入 Mithril 和 <code>User</code> 模型，因为在视图中会同时用到这两个模块：</p>
            <pre class="doc-code" data-filename="src/views/UserList.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")
var User = require("../models/User")'); ?></code></pre>
            <p>然后，创建一个 Mithril 组件。组件只是一个包含 <code>view</code> 方法的对象：</p>
            <pre class="doc-code" data-filename="src/views/UserList.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")
var User = require("../models/User")

module.exports = {
    view: function() {
        // TODO add code here
    }
}'); ?></code></pre>
            <p>接着我们用 Mithril hyperscript 来创建一个列表。Hyperscript 是编写视图最常用方式，当然你也可以用 <a href="jsx.html">JSX</a> 来创建视图。</p>
            <pre class="doc-code" data-filename="src/views/UserList.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")
var User = require("../models/User")

module.exports = {
    view: function() {
        return m(".user-list")
    }
}'); ?></code></pre>
            <p><code>.user-list</code> 是一个 CSS 选择器。当没有指定标签时，默认使用 <code>div</code>，所以这个视图和 <code><?php echo htmlentities('<div class="user-list"></div>'); ?></code> 等效。</p>
            <p>现在，我们从之前创建的 <code>User</code> 模型中引用用户列表，以循环数据：</p>
            <pre class="doc-code" data-filename="src/views/UserList.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")
var User = require("../models/User")

module.exports = {
    view: function() {
        return m(".user-list", User.list.map(function(user) {
            return m(".user-list-item", user.firstName + " " + user.lastName)
        }))
    }
}'); ?></code></pre>
            <p>因为 <code>User.list</code> 是一个 JavaScript 数组，而 hyperscript 视图是 JavaScript 代码，所以我们可以用 <code>.map</code> 方法来循环这个数组。这创建了一个由 <code>div</code> 组成的 vnode 数组，每一个都包含一个用户的名称。</p>
            <p>问题是，我们从来没有调用过 <code>User.list</code> 方法，因此 <code>User.list</code> 仍是一个空数组，且此视图也将显示空白页。我们希望在渲染这个组件时，能自动调用 <code>User.list</code>，我们可以使用组件的<a href="./lifecycle-methods.html">生命周期方法</a>来实现：</p>
            <pre class="doc-code" data-filename="src/views/UserList.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")
var User = require("../models/User")

module.exports = {
    oninit: User.loadList,
    view: function() {
        return m(".user-list", User.list.map(function(user) {
            return m(".user-list-item", user.firstName + " " + user.lastName)
        }))
    }
}'); ?></code></pre>
            <p>我们向组件添加了一个 <code>oninit</code> 方法，该方法引用了 <code>User.loadList</code>。这意味着在组件初始化时，会自动调用 <code>User.list</code> 方法。</p>
            <p>注意：这里我们用的<strong>不是</strong> <code>oninit: User.loadList()</code>（末尾带括号）。区别是 <code>oninit: User.loadList()</code> 会立即调用，即使组件未被渲染；且只会调用一次，即使重新创建组件，也不会被再次调用。而 <code>oninit: User.loadList</code> 只有在渲染组件时才会被调用。</p>
        </div>

        <h2 id="app-mount" class="doc-chapter-title mdui-text-color-theme"><a href="#app-mount">渲染视图</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>我们创建一个入口文件 <code>src/index.js</code>，在该文件中来渲染视图：</p>
            <pre class="doc-code" data-filename="src/index.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var UserList = require("./views/UserList")

m.mount(document.body, UserList)'); ?></code></pre>
            <p>调用 <code>m.mount</code> 把指定的组件（<code>UserList</code>）渲染到 DOM 元素（<code>document.body</code>）中，并移除先前存在的任何 DOM。现在在浏览器中打开这个 HTML 文件，会显示人名列表。</p>
        </div>

        <h2 id="app-style" class="doc-chapter-title mdui-text-color-theme"><a href="#app-style">添加样式</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>现在列表看起来很简陋，因为我们还没有添加任何样式。</p>
            <p>我们创建一个 <code>styles.css</code> 文件，并在 <code>index.html</code> 文件中引入它：</p>
            <pre class="doc-code" data-filename="index.html"><code class="lang-html"><?php echo htmlentities('<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>My Application</title>
        <link href="styles.css" rel="stylesheet" />
    </head>
    <body>
        <script src="bin/app.js"></script>
    </body>
</html>'); ?></code></pre>
            <p>现在在 <code>styles.css</code> 文件中来为 <code>UserList</code> 组件编写样式：</p>
            <pre class="doc-code" data-filename="styles.css"><code class="lang-css"><?php echo htmlentities('.user-list {list-style:none;margin:0 0 10px;padding:0;}
.user-list-item {background:#fafafa;border:1px solid #ddd;color:#333;display:block;margin:0 0 1px;padding:8px 15px;text-decoration:none;}
.user-list-item:hover {text-decoration:underline;}'); ?></code></pre>
            <p>现在刷新浏览器就能看到带样式的列表了。</p>
        </div>

        <h2 id="add-route" class="doc-chapter-title mdui-text-color-theme"><a href="#add-route">添加路由</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>路由提供了页面切换功能。我们通过 <code>m.route</code> 来添加路由：</p>
            <pre class="doc-code" data-filename="src/index.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var UserList = require("./views/UserList")

m.route(document.body, "/list", {
    "/list": UserList
})'); ?></code></pre>
            <p><code>m.route</code> 的第一个参数指定了组件会被渲染到 <code>document.body</code> 元素中。第二个参数是默认路由，当访问的 URL 对应的路由不存在时，则会重定向到该路由。第三个参数是路由和对应的组件的映射，定义了每个路由会解析哪个组件。</p>
            <p>现在刷新浏览器，URL 后面会被追加 <code>#!/list</code>，该路由对应的是 <code>UserList</code> 组件，所以页面上会看到人名列表。</p>
            <p>字符串 <code>#!</code> 称为 hashbang，它常用于实现客户端路由，可以通过 <code>m.route.prefix</code> 来配置该字符串。因为有些配置需要配合服务器端进行更改，所以本教程中继续使用 <code>#!</code> 作为 hashbang。</p>
        </div>

        <h2 id="app-edit" class="doc-chapter-title mdui-text-color-theme"><a href="#app-edit">编辑用户</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>我们为应用添加一个编辑用户功能。首先创建一个视图文件 <code>src/views/UserForm.js</code>：</p>
            <pre class="doc-code" data-filename="src/views/UserForm.js"><code class="lang-js"><?php echo htmlentities('/module.exports = {
    view: function() {
        // TODO implement view
    }
}'); ?></code></pre>
            <p>然后在 <code>src/index.js</code> 文件中引入该模块：</p>
            <pre class="doc-code" data-filename="src/index.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var UserList = require("./views/UserList")
var UserForm = require("./views/UserForm")

m.route(document.body, "/list", {
    "/list": UserList
})'); ?></code></pre>
            <p>最后，创建一个路由来访问该模块：</p>
            <pre class="doc-code" data-filename="src/index.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var UserList = require("./views/UserList")
var UserForm = require("./views/UserForm")

m.route(document.body, "/list", {
    "/list": UserList,
    "/edit/:id": UserForm,
})'); ?></code></pre>
            <p>注意，新路由中有一个 <code>:id</code>，这是一个路由参数，在后面会用到。</p>
            <p>我们来实现 <code>UserForm</code> 组件：</p>
            <pre class="doc-code" data-filename="src/views/UserForm.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

module.exports = {
    view: function() {
        return m("form", [
            m("label.label", "First name"),
            m("input.input[type=text][placeholder=First name]"),
            m("label.label", "Last name"),
            m("input.input[placeholder=Last name]"),
            m("button.button[type=submit]", "Save"),
        ])
    }
}'); ?></code></pre>
            <p>并在 <code>styles.css</code> 中添加一些样式：</p>
            <pre class="doc-code" data-filename="styles.css"><code class="lang-css"><?php echo htmlentities('body,.input,.button {font:normal 16px Verdana;margin:0;}

.user-list {list-style:none;margin:0 0 10px;padding:0;}
.user-list-item {background:#fafafa;border:1px solid #ddd;color:#333;display:block;margin:0 0 1px;padding:8px 15px;text-decoration:none;}
.user-list-item:hover {text-decoration:underline;}

.label {display:block;margin:0 0 5px;}
.input {border:1px solid #ddd;border-radius:3px;box-sizing:border-box;display:block;margin:0 0 10px;padding:10px 15px;width:100%;}
.button {background:#eee;border:1px solid #ddd;border-radius:3px;color:#333;display:inline-block;margin:0 0 10px;padding:10px 15px;text-decoration:none;}
.button:hover {background:#e8e8e8;}'); ?></code></pre>
            <p>现在组件还不会响应用户事件。我们需要在 <code>User</code> 模型中添加一些代码。这是 <code>User</code> 模型之前的代码：</p>
            <pre class="doc-code" data-filename="src/models/User.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var User = {
    list: [],
    loadList: function() {
        return m.request({
            method: "GET",
            url: "http://rem-rest-api.herokuapp.com/api/users",
            withCredentials: true,
        })
        .then(function(result) {
            User.list = result.data
        })
    },
}

module.exports = User'); ?></code></pre>
            <p>我们来添加一些代码，使我们可以加载单个用户：</p>
            <pre class="doc-code" data-filename="src/models/User.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var User = {
    list: [],
    loadList: function() {
        return m.request({
            method: "GET",
            url: "http://rem-rest-api.herokuapp.com/api/users",
            withCredentials: true,
        })
        .then(function(result) {
            User.list = result.data
        })
    },

    current: {},
    load: function(id) {
        return m.request({
            method: "GET",
            url: "http://rem-rest-api.herokuapp.com/api/users/:id",
            data: {id: id},
            withCredentials: true,
        })
        .then(function(result) {
            User.current = result
        })
    }
}

module.exports = User'); ?></code></pre>
            <p>注意，我们添加了一个 <code>User.current</code> 属性，和一个 <code>User.load(id)</code> 方法，该方法会把当前用户的信息填充到 <code>User.current</code> 属性中。现在我们可以用这个新的方法来填充 <code>UserForm</code> 视图：</p>
            <pre class="doc-code" data-filename="src/views/UserForm.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")
var User = require("../models/User")

module.exports = {
    oninit: function(vnode) {User.load(vnode.attrs.id)},
    view: function() {
        return m("form", [
            m("label.label", "First name"),
            m("input.input[type=text][placeholder=First name]", {value: User.current.firstName}),
            m("label.label", "Last name"),
            m("input.input[placeholder=Last name]", {value: User.current.lastName}),
            m("button.button[type=submit]", "Save"),
        ])
    }
}'); ?></code></pre>
            <p>和 <code>UserList</code> 组件类似，我们在 <code>oninit</code> 方法中调用 <code>User.load()</code>。还记得在前面的 <code>"/edit/:id": UserForm</code> 路由中有一个路由参数 <code>:id</code> 吗？该路由参数会成为 <code>UserForm</code> 组件的 vnode 的属性，所以路由 <code>/edit/1</code> 会使 <code>vnode.attrs.id</code> 的值为 <code>1</code>。</p>
            <p>现在我们来修改 <code>UserList</code> 视图，使它可以链接到 <code>UserForm</code> 视图：</p>
            <pre class="doc-code" data-filename="src/views/UserList.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")
var User = require("../models/User")

module.exports = {
    oninit: User.loadList,
    view: function() {
        return m(".user-list", User.list.map(function(user) {
            return m("a.user-list-item", {href: "/edit/" + user.id, oncreate: m.route.link}, user.firstName + " " + user.lastName)
        }))
    }
}'); ?></code></pre>
            <p>我们把 <code>.user-list-item</code> 改成了 <code>a.user-list-item</code>，添加了 <code>href</code> 指向目标路由。我们还添加了 <code>oncreate: m.route.link</code>，这会使该链接变成一个路由链接，当点击链接时，会改变 URL 中 <code>#!</code> 后面的部分，但不会导致整个页面刷新。</p>
            <p>现在你刷新该页面，就能看到人名列表，点击某一个人名，就能进入表单。你可以通过浏览器的返回按钮回到人名列表。</p>
        </div>

        <h2 id="app-save" class="doc-chapter-title mdui-text-color-theme"><a href="#app-save">保存用户</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>现在你点击“保存”按钮，还无法保存表单。我们继续来让这个表单可以工作：</p>
            <pre class="doc-code" data-filename="src/views/UserForm.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")
var User = require("../models/User")

module.exports = {
    oninit: function(vnode) {User.load(vnode.attrs.id)},
    view: function() {
        return m("form", [
            m("label.label", "First name"),
            m("input.input[type=text][placeholder=First name]", {
                oninput: m.withAttr("value", function(value) {User.current.firstName = value}),
                value: User.current.firstName
            }),
            m("label.label", "Last name"),
            m("input.input[placeholder=Last name]", {
                oninput: m.withAttr("value", function(value) {User.current.lastName = value}),
                value: User.current.lastName
            }),
            m("button.button[type=submit]", {onclick: User.save}, "Save"),
        ])
    }
}'); ?></code></pre>
            <p>我们在输入框中添加了事件 <code>oninput</code>，该事件会把用户的输入实时更新到 <code>User.current.firstName</code> 和 <code>User.current.lastName</code> 中。</p>
            <p>此外，我们声明了在按下“保存”按钮时，调用 <code>User.save</code> 方法，下面我们来实现这个方法：</p>
            <pre class="doc-code" data-filename="src/models/User.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var User = {
    list: [],
    loadList: function() {
        return m.request({
            method: "GET",
            url: "http://rem-rest-api.herokuapp.com/api/users",
            withCredentials: true,
        })
        .then(function(result) {
            User.list = result.data
        })
    },

    current: {},
    load: function(id) {
        return m.request({
            method: "GET",
            url: "http://rem-rest-api.herokuapp.com/api/users/:id",
            data: {id: id},
            withCredentials: true,
        })
        .then(function(result) {
            User.current = result
        })
    },

    save: function() {
        return m.request({
            method: "PUT",
            url: "http://rem-rest-api.herokuapp.com/api/users/:id",
            data: User.current,
            withCredentials: true,
        })
    }
}

module.exports = User'); ?></code></pre>
            <p>在最下面的 <code>save</code> 方法中，我们把 <code>User.current</code> 中的数据传输到了服务器端。</p>
            <p>现在试着编辑应用中的用户名。保存更改后，应该可以看到用户列表中的用户名也发生了更改。</p>
        </div>

        <h2 id="app-layout" class="doc-chapter-title mdui-text-color-theme"><a href="#app-layout">组件布局</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>目前，我们还只能通过浏览器的后退按钮返回到用户列表。下面我们来为应用添加一个全局菜单。</p>
            <p>首先创建一个文件 <code>src/views/Layout.js</code>：</p>
            <pre class="doc-code" data-filename="src/views/Layout.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

module.exports = {
    view: function(vnode) {
        return m("main.layout", [
            m("nav.menu", [
                m("a[href=\'/list\']", {oncreate: m.route.link}, "Users")
            ]),
            m("section", vnode.children)
        ])
    }
}'); ?></code></pre>
            <p>这个组件非常简单，它包含了一个指向用户列表的链接，我们为这个链接加上了 <code>m.route.link</code> 使它称为一个路由链接。</p>
            <p>这个组件还包含一个 <code><?php echo htmlentities('<section>'); ?></code> 元素，它的子元素是 <code>vnode.children</code>。<code>vnode</code> 是 Layout 组件实例的引用。<code>vnode.children</code> 则表示 <code>vnode</code> 中的所有子元素。</p>
            <p>我们来添加一些样式：</p>
            <pre class="doc-code" data-filename="src/styles.css"><code class="lang-css"><?php echo htmlentities('body,.input,.button {font:normal 16px Verdana;margin:0;}

.layout {margin:10px auto;max-width:1000px;}
.menu {margin:0 0 30px;}

.user-list {list-style:none;margin:0 0 10px;padding:0;}
.user-list-item {background:#fafafa;border:1px solid #ddd;color:#333;display:block;margin:0 0 1px;padding:8px 15px;text-decoration:none;}
.user-list-item:hover {text-decoration:underline;}

.label {display:block;margin:0 0 5px;}
.input {border:1px solid #ddd;border-radius:3px;box-sizing:border-box;display:block;margin:0 0 10px;padding:10px 15px;width:100%;}
.button {background:#eee;border:1px solid #ddd;border-radius:3px;color:#333;display:inline-block;margin:0 0 10px;padding:10px 15px;text-decoration:none;}
.button:hover {background:#e8e8e8;}'); ?></code></pre>
            <p>然后修改 <code>src/index.js</code> 文件，把布局添加路由当中：</p>
            <pre class="doc-code" data-filename="src/index.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

var UserList = require("./views/UserList")
var UserForm = require("./views/UserForm")
var Layout = require("./views/Layout")

m.route(document.body, "/list", {
    "/list": {
        render: function() {
            return m(Layout, m(UserList))
        }
    },
    "/edit/:id": {
        render: function(vnode) {
            return m(Layout, m(UserForm, vnode.attrs))
        }
    },
})'); ?></code></pre>
            <p>我们把每一个组件都替换成了 <a href="./route.html#routeresolver">RouteResolver</a>（一个含 <code>render</code> 方法的对象）。<code>render</code> 方法的写法和普通组件的写法一样，嵌套调用 <code>m()</code>。</p>
            <p>值得注意的是，<code>m()</code> 函数的第一个参数用的是组件，而不是选择器。在 <code>/list</code> 路由中，我们用了 <code>m(Layout, m(UserList))</code>。这意味着用 <code>Layout</code> 组件作为根 vnode，<code>UserList</code> 则是它的唯一子元素。</p>
            <p>在 <code>/edit/:id</code> 路由中，<code>vnode</code> 参数把路由参数传入到了 <code>UserForm</code> 组件中。如果 URL 是 <code>/edit/1</code>，那么 <code>vnode.attrs</code> 则是 <code>{id: 1}</code>，<code>m(UserForm, vnode.attrs)</code> 和 <code>m(UserForm, {id: 1})</code> 是等效的。等效的 JSX 代码为 <code><?php echo htmlentities('<UserForm id={vnode.attrs.id} />'); ?></code>。</p>
            <p>现在刷新页面，你会看到在应用的每个页面上都有一个全局菜单。</p>
        </div>


        <h2 id="app-end" class="doc-chapter-title mdui-text-color-theme"><a href="#app-end">结束</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>本教程到此结束。</p>
            <p>在本教程中，我们创建了一个非常简单的应用，我们可以从服务器获取用户列表，编辑用户，并保存到服务器。你可以尝试自己来实现用户的创建和删除功能。</p>
            <p>你可以在<a href="./examples.html">示例</a>页面看到更多 Mithril 的代码示例。</p>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>