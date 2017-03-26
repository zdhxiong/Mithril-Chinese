<?php
$vars['title'] = 'ES6';
$vars['filename'] = 'es6';
$vars['prev'] = array(
    'filename' => 'jsx',
    'title' => 'JSX'
);
$vars['next'] = array(
    'filename' => 'css',
    'title' => 'CSS'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>ES6</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#introduction">介绍</a></li>
            <li><a href="#setup">安装</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="introduction"><a href="#introduction">介绍</a></h2>
        <p>Mithril 使用 ES5 编写，且与 ES6 完全兼容。ES6 是最新的 JavaScript 语言的标准，为各种常见情况引入了新的语法糖。它并不支持所有主流浏览器，它也不是编写应用所必须的，你可以根据你的喜好来决定是否使用它。</p>
        <p>在大多数情况下，为了获得更好的兼容性，我们需要使用一些工具（如 <a href="https://babeljs.io/" target="_blank">Babel</a>）来把 ES6 编译成 ES5。</p>

        <h2 id="setup"><a href="#setup">安装</a></h2>
        <p>编译 ES6 最简单的方式是使用 <a href="https://babeljs.io/" target="_blank">Babel</a></p>

        <h3>独立安装 Babel</h3>
        <p>确保你已经安装了 <a href="https://nodejs.org/en/" target="_blank">Node.js</a> 后，在项目文件夹中执行以下命令来初始化项目：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('npm init -y'); ?></code></pre>
        <p>然后执行以下命令安装 Babel：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('npm install babel-cli babel-preset-es2015 babel-plugin-transform-react-jsx --save-dev'); ?></code></pre>
        <p>安装完后会创建 <code>.babelrc</code> 文件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "presets": ["es2015"],
    "plugins": [
        ["transform-react-jsx", {
            "pragma": "m"
        }]
    ]
}'); ?></code></pre>
        <p>然后在命令行中运行：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('babel src --out-dir bin --source-maps'); ?></code></pre>

        <h3>通过 Webpack 使用 Babel</h3>
        <p>如果你的项目已经使用了 Webpack，你可以按以下步骤把 Babel 集成到 Webpack 中。首先执行以下命令安装 Babel：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('npm install babel-core babel-loader babel-preset-es2015 babel-plugin-transform-react-jsx --save-dev'); ?></code></pre>
        <p>安装完后会创建 <code>.babelrc</code> 文件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "presets": ["es2015"],
    "plugins": [
        ["transform-react-jsx", {
            "pragma": "m"
        }]
    ]
}'); ?></code></pre>
        <p>然后，创建一个 <code>webpack.config.js</code> 配置文件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('module.exports = {
    entry: \'./src/index.js\',
    output: {
        path: \'./bin\',
        filename: \'app.js\',
    },
    module: {
        loaders: [{
            test: /\.js$/,
            exclude: /node_modules/,
            loader: \'babel-loader\'
        }]
    }
}'); ?></code></pre>
        <p>这个配置文件设置了应用的入口文件为 <code>src/index.js</code>，且打包后输出到 <code>bin/app.js</code>。</p>
        <p>要运行 bundler，需要设置一个 npm 脚本。打开 <code>package.json</code> 文件并在 <code>"scripts"</code> 中添加一行命令：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "start": "webpack -d --watch"
    }
}'); ?></code></pre>
        <p>现在，可以在命令行中执行以下命令来运行 bundler：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('npm start'); ?></code></pre>

        <h3>生产环境构建</h3>
        <p>要压缩生成的文件，请打开 <code>package.json</code> 文件，并添加一个新的 npm 脚本 <code>build</code>：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "start": "webpack -d --watch",
        "build": "webpack -p"
    }
}'); ?></code></pre>
        <p>在生产环境中,你可以使用钩子来自动运行构建脚本。这是一个使用 <a href="https://www.heroku.com/" target="_blank">Heroku</a> 的例子：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "start": "webpack -d --watch",
        "build": "webpack -p",
        "heroku-postbuild": "webpack -p"
    }
}'); ?></code></pre>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>