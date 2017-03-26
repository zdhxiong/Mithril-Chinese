<?php
$vars['title'] = '安装';
$vars['filename'] = 'installation';
$vars['prev'] = array(
    'filename' => 'introduction',
    'title' => '介绍'
);
$vars['next'] = array(
    'filename' => 'simple-application',
    'title' => '简单应用教程'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>安装</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#cdn">CDN</a></li>
            <li><a href="#npm">NPM</a></li>
            <li><a href="#other">其他相关介绍</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="cdn"><a href="#cdn">CDN</a></h2>
        <p>直接从 CDN 引入 Mithril 文件是最简单的方式：</p>
        <pre class="doc-code"><code class="lang-html"><?php  echo htmlentities('<script src="https://unpkg.com/mithril/mithril.js"></script>');?></code></pre>

        <h2 id="npm"><a href="#npm">NPM</a></h2>
        <p>对于生产级项目，建议使用 NPM 来安装。在使用 NPM 之前你需要自行安装好 <a href="https://nodejs.org/en/" target="_blank">Node.js</a>。</p>
        <p>在命令行中进入项目文件夹，执行以下命令来初始化项目：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('npm init --yes');?></code></pre>
        <p>然后执行命令来安装 Mithril：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('npm install mithril --save');?></code></pre>
        <p>现在已经完成了 Mithril 的安装。</p>

        <h3>模块化</h3>
        <p>模块化是指把代码拆分到多个文件中。这样可以更好的组织代码，便于理解代码之间的依赖关系，并方便测试。</p>
        <p>我们使用 <a href="https://webpack.js.org/" target="_blank">Webpack</a> 来打包模块。在命令行中执行以下命令来安装 Webpack：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('npm install webpack --save-dev');?></code></pre>
        <p>然后打开项目文件夹下的 <code>package.json</code> 文件，在 <code>script</code> 中添加一行指令：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "start": "webpack src/index.js bin/app.js -d --watch"
    }
}');?></code></pre>
        <p>指令中的 <code>-d</code> 表示使用开发模式，该模式会生成 source maps，便于调试。<code>--watch</code> 表示监控文件系统，在检测到文件更改后，自动重新创建 <code>app.js</code>。</p>
        <p>现在可以在命令行中执行 <code>npm start</code> 来执行该脚本了：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('npm start');?></code></pre>
        <p>执行完脚本后便创建了 <code>bin/app.js</code> 文件，你可以在 HTML 中引入该文件：</p>
        <pre class="doc-code"><code class="lang-html"><?php  echo htmlentities('<html>
  <head>
    <title>Hello world</title>
  </head>
  <body>
    <script src="bin/app.js"></script>
  </body>
</html>');?></code></pre>

        <h3>模块的导入导出</h3>
        <p>要导出一个模块，请将要导出的内容分配到 <code>module.exports</code> 对象：</p>
        <pre class="doc-code" data-filename="mycomponent.js"><code class="lang-js"><?php  echo htmlentities('module.exports = {
    view: function() {return "hello from a module"}
}');?></code></pre>
        <p>我们使用 <code>require</code> 函数来导入模块。</p>
        <p>你可以通过库名来导入 NPM 模块（例如：<code>require("mithril")</code> 或 <code>require("jquery")</code>）；也可以通过去掉了文件扩展名的文件相对路径来导入你自己的模块（例如：<code>require("./mycomponent")</code>）。</p>
        <p>在 <code>index.js</code> 文件中，通过下列代码来导入模块：</p>
        <pre class="doc-code" data-filename="index.js"><code class="lang-js"><?php  echo htmlentities('var m = require("mithril")

var MyComponent = require("./mycomponent")

m.mount(document.body, MyComponent)');?></code></pre>

        <h3>生产环境构建</h3>
        <p><code>bin/app.js</code> 文件中的代码没有压缩，不适宜用在生产环境。要生成压缩后的文件，可以在 <code>package.json</code> 文件中添加一个新的 npm 脚本：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "start": "webpack src/index.js bin/app.js -d --watch",
        "build": "webpack src/index.js bin/app.js -p",
    }
}'); ?></code></pre>
        <p>在生产环境中，可以使用钩子来自动运行构建脚本。下面是一个 <a href="https://www.heroku.com/" target="_blank">Heroku</a> 的例子：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "start": "webpack -d --watch",
        "build": "webpack -p",
        "heroku-postbuild": "webpack -p"
    }
}');?></code></pre>

        <h2 id="other"><a href="#other">其他相关介绍</a></h2>
        <h3>开发环境的 live reload</h3>
        <p>Live reload 是指在代码发生更改后自动刷新页面的功能。<a href="https://github.com/mattdesl/budo" target="_blank">Budo</a> 是一个启用实时刷新的工具。</p>
            <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('# 1) 安装
npm install mithril --save
npm install budo -g

# 2) 在 package.json 文件的 scripts 中加入这一行
#    "scripts": {
#        "start": "budo --live --open index.js"
#    }

# 3) 创建一个 `index.js` 文件

# 4) 运行 budo
npm start');?></code></pre>
        <p>启动后，源文件 <code>index.js</code> 会被编译，并在浏览器中打开该文件。当源文件发生任何更改时，都会重新编译，并刷新浏览器。</p>

        <h3>Mithril bundler</h3>
        <p>Mithril 自带一个打包工具。对于基于 ES5、除了 Mithril 之外没有其他依赖的项目来说，它足够用了；但对于有其他 NPM 依赖的项目来说，它目前还是实验性的。它生成的包比 webpack 要小，但目前不要在生产环境中使用它。</p>
        <p>如果你想要试用它，可以打开 <code>package.json</code> 文件，并把 webpack 的 npm 脚本替换为：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "build": "bundle index.js --output app.js --watch"
    }
}'); ?></code></pre>

        <h3>Vanilla</h3>
        <p>如果因为某些原因无法运行 bundler 脚本，则可以选择不使用模块化系统：</p>
        <pre class="doc-code"><code class="lang-html"><?php echo htmlentities('<html>
  <head>
    <title>Hello world</title>
  </head>
  <body>
    <script src="https://cdn.rawgit.com/lhorie/mithril.js/rewrite/mithril.js"></script>
    <script src="index.js"></script>
  </body>
</html>'); ?></code></pre>
        <pre class="doc-code" data-filename="index.js"><code class="lang-js"><?php echo htmlentities('// 如果未检测到模块化环境，则 Mithril 会被创建在全局作用域
m.render(document.body, "hello world")'); ?></code></pre>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>