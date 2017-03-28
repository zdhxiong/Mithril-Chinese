<?php
$vars['title'] = 'Promise(executor)';
$vars['filename'] = 'promise';
$vars['prev'] = array(
    'filename' => 'version',
    'title' => 'version'
);
$vars['next'] = array(
    'filename' => 'stream',
    'title' => 'stream()'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>Promise(executor)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li>
                <a href="#signature">签名</a>
                <ul>
                    <li>
                        <a href="#static-members">静态成员</a>
                        <ul>
                            <li><a href="#promiseresolve">Promise.resolve</a></li>
                            <li><a href="#promisereject">Promise.reject</a></li>
                            <li><a href="#promiseall">Promise.all</a></li>
                            <li><a href="#promiserace">Promise.race</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#instance-members">实例成员</a>
                        <ul>
                            <li><a href="#promisethen">promise.then</a></li>
                            <li><a href="#promisecatch">promise.catch</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#how-it-works">工作原理</a></li>
            <li><a href="#promise-chaining">Promise 的链式调用</a></li>
            <li><a href="#promise-absorption">Promise 合并</a></li>
            <li><a href="#error-handling">错误处理</a></li>
            <li><a href="#shorthands">简写</a></li>
            <li><a href="#why-not-callbacks">为什么不使用回调</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p><a href="https://developer.mozilla.org/en/docs/Web/JavaScript/Reference/Global_Objects/Promise">ES6 Promise</a> 的 polyfill。</p>
        <p>Promise 是一种使用异步计算的机制。</p>

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <pre class="doc-container"><code class="lang-js"><?php echo htmlentities('promise = new Promise(executor)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>executor</code></td>
                    <td><code>(Function, Function) -> any</code></td>
                    <td>是</td>
                    <td>一个函数，决定了 promise 是完成还是拒绝</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Promise</code></th>
                    <th></th>
                    <th>返回 Promise</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h3 id="executor"><a href="#executor">executor</a></h3>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('executor(resolve, reject)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>resolve</code></td>
                    <td><code>any -> any</code></td>
                    <td>否</td>
                    <td>调用该函数来完成 promise</td>
                </tr>
                <tr>
                    <td><code>reject</code></td>
                    <td><code>any -> any</code></td>
                    <td>否</td>
                    <td>调用该函数来拒绝 promise</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th></th>
                    <th></th>
                    <th>返回值会被忽略</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h3 id="static-members"><a href="#static-members">静态成员</a></h3>

        <h4 id="promiseresolve"><a href="#promiseresolve">Promise.resolve</a></h4>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('promise = Promise.resolve(value)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>value</code></td>
                    <td><code>any</code></td>
                    <td>否</td>
                    <td>要完成的值</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Promise</code></th>
                    <th></th>
                    <th>完成了 <code>value</code> 的 promise</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h4 id="promisereject"><a href="#promisereject">Promise.reject</a></h4>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('promise = Promise.reject(value)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>value</code></td>
                    <td><code>any</code></td>
                    <td>否</td>
                    <td>拒绝的值</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Promise</code></th>
                    <th></th>
                    <th>一个被拒绝的 promise，<code>value</code> 是被拒绝的原因</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h4 id="promiseall"><a href="#promiseall">Promise.all</a></h4>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('promise = Promise.all(promises)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>promises</code></td>
                    <td><code>Array<Promise|any></code></td>
                    <td>是</td>
                    <td>一个等待中的 promise 列表。如果其中一项不是 promise，就相当于在那一项上调用 <code>Promise.resolve</code></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Promise</code></th>
                    <th></th>
                    <th>如果所有 <code>promises</code> 都已完成，则返回完成的 promise；只要其中有一个 promise 是拒绝的，就返回拒绝的 promise</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h4 id="promiserace"><a href="#promiserace">Promise.race</a></h4>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('promise = Promise.race(promises)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>promises</code></td>
                    <td><code>Array<Promise|any></code></td>
                    <td>是</td>
                    <td>一个等待中的 promise 列表。如果其中一项不是 promise，就相当于在那一项上调用 <code>Promise.resolve</code></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Promise</code></th>
                    <th></th>
                    <th>只要其中一个 promise 被完成或拒绝，就会返回完成的 promise</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h3 id="instance-members"><a href="#instance-members">实例成员</a></h3>

        <h4 id="promisethen"><a href="#promisethen">promise.then</a></h4>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('nextPromise = promise.then(onFulfilled, onRejected)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>onFulfilled</code></td>
                    <td><code>any -> (any|Promise)</code></td>
                    <td>否</td>
                    <td>如果 promise 被完成，则会调用此函数。函数的第一个参数是 promise 完成的值。如果此函数返回的值不是 Promise，则返回值会作为完成 <code>nextPromise</code> 的值。如果返回值是 Promise，则 <code>nextPromise</code> 的值取决于 Promise 的内部状态。如果此函数抛出异常，<code>nextPromise</code> 会被拒绝。如果 <code>onFulfilled</code> 是 <code>null</code>，则它会被忽略。</td>
                </tr>
                <tr>
                    <td><code>onRejected</code></td>
                    <td><code>any -> (any|Promise)</code></td>
                    <td>否</td>
                    <td>如果 promise 被拒绝，则会调用此函数。函数的第一个参数是 promise 被拒绝的原因。如果函数的返回值不是 Promise，则返回值会作为完成 <code>nextPromise</code> 的值。如果返回值是 Promise，则 <code>nextPromise</code> 的值取决于 Promise 的内部状态，如果此函数抛出异常，<code>nextPromise</code> 会被拒绝。如果 <code>onRejected</code> 是 <code>null</code>，则它会被忽略。</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Promise</code></th>
                    <th></th>
                    <th>一个 promise，它的值取决于当前 promise 的状态</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h4 id="promisecatch"><a href="#promisecatch">promise.catch</a></h4>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('nextPromise = promise.catch(onRejected)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>onRejected</code></td>
                    <td><code>any -> (any|Promise)</code></td>
                    <td>否</td>
                    <td>如果 promise 被拒绝，则会调用此函数。此函数的第一个参数 promise 被拒绝的原因。如果此函数的返回值不是 Promise，则返回值会作为完成 <code>nextPromise</code> 的值。如果返回值是 Promise，则 <code>nextPromise</code> 的值取决于 Promise 的内部状态。如果此函数抛出异常，则 <code>nextPromise</code> 会被拒绝。如果 <code>onRejected</code> 是 <code>null</code>，则它会被忽略。</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th><code>返回</code></th>
                    <th><code>Promise</code></th>
                    <th></th>
                    <th>一个 promise，它的值取决于当前 promise 的状态</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p>Promise 是一个对象，表示将来可能会用到的值。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 这个 promise 一秒钟后会被完成
var promise = new Promise(function(resolve, reject) {
  setTimeout(function() {
    resolve("hello")
  }, 1000)
})

promise.then(function(value) {
  // 一秒钟后输出 "hello"
  console.log(value)
})'); ?></code></pre>
        <p>Promise 对于处理异步 API 很有用，例如 <a href="./request.html">m.request</a>。</p>
        <p>异步 API 通常需要花费很长时间来执行，因此使用 <code>return</code> 同步返回函数的值会太耗费时间。它们会在后台执行，在此期间 JavaScript 可以执行其他代码。当请求完成后，会用返回的结果来调用函数。</p>
        <p><code>m.request</code> 的执行需要时间，因为它会向远程服务器发送 HTTP 请求并等待响应，由于网络延迟，可能需要花费几百毫秒。</p>

        <h2 id="promise-chaining"><a href="#promise-chaining">Promise 的链式调用</a></h2>
        <p>Promise 可以链式调用。<code>then</code> 回调函数的返回值可以作为下一个 <code>then</code> 回调的参数。这样可以把代码重构成较小的函数：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('function getUsers() {return m.request("/api/v1/users")}

// 避免这种用法：因为很难对功能进行测试
getUsers().then(function(users) {
  var firstTen = users.slice(0, 9)
  var firstTenNames = firstTen.map(function(user) {return user.firstName + " " + user.lastName})
  alert(firstTenNames)
})

// 推荐这种用法：测试小函数会比较容易
function getFirstTen(items) {return items.slice(0, 9)}
function getUserName(user) {return user.firstName + " " + user.lastName}
function getUserNames(users) {return users.map(getUserName)}

getUsers()
  .then(getFirstTen)
  .then(getUserNames)
  .then(alert)'); ?></code></pre>
        <p>在上面经过重构的代码中，<code>getUsers()</code> 返回一个 Promise，我们链式调用了 3 个回调函数。当 <code>getUsers()</code> 完成后，<code>getFirstTen</code> 函数会被调用，且传入用户列表作为它的第一个参数，并返回前 10 个用户的列表。这 10 个用户的列表会作为 <code>getUserNames</code> 的第一个参数传入，并返回用户名列表。最后，弹出提示框显示用户名列表。</p>
        <p>在上面的原始代码中，对功能进行测试会很困难，因为你必须发送一个 HTTP 请求才能运行代码，且函数的最后调用了 <code>alert()</code>。</p>
        <p>在重构的版本中，没有必要对 <code>getUserName</code> 中 <code>firstName</code> 和 <code>lastName</code> 之间是否添加了空格这种功能进行测试。</p>


        <h2 id="promise-absorption"><a href="#promise-absorption">Promise 合并</a></h2>
        <p>Promise 可以和其他 Promise 合并。这个功能使我们可以平铺嵌套的 Promise，使代码更易管理。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('function searchUsers(q) {return m.request("/api/v1/users/search", {data: {q: q}})}
function getUserProjects(id) {return m.request("/api/v1/users/" + id + "/projects")}

// 避免这种用法：嵌套太深
searchUsers("John").then(function(users) {
  getUserProjects(users[0].id).then(function(projects) {
    var titles = projects.map(function(project) {return project.title})
    alert(titles)
  })
})

// 建议这种用法：扁平的代码
function getFirstId(items) {return items[0].id}
function getProjectTitles(projects) {return projects.map(getProjectTitle)}
function getProjectTitle(project) {return project.title}

searchUsers("John")
  .then(getFirstId)
  .then(getUserProjects)
  .then(getProjectTitles)
  .then(alert)'); ?></code></pre>
        <p>在重构过的代码中，<code>getFirstId</code> 返回一个 id，并把该 id 作为第一个参数传入 <code>getUserProjects</code>，而 <code>getUserProjects</code> 又返回一个完成项目列表的 Promise。这个 Promise 是被合并的，所以 <code>getProjectTitles</code> 的第一个参数不是 Promise，而是项目列表。<code>getProjectTitles</code> 返回标题列表，这个列表最终会被显示在提示框中。</p>

        <h2 id="error-handling"><a href="#error-handling">错误处理</a></h2>
        <p>Promise 可以把错误传递到适当的错误处理函数。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('searchUsers("John")
  .then(getFirstId)
  .then(getUserProjects)
  .then(getProjectTitles)
  .then(alert)
  .catch(function(e) {
    console.log(e)
  })'); ?></code></pre>
        <p>这是之前的例子，并加上了错误处理。当网络断开时，<code>searchUsers</code> 函数会执行失败，导致产生错误。在这种情况下，不会触发 <code>.then</code> 回调，但 <code>.catch</code> 回调会把错误输出到控制台。</p>
        <p>如果 <code>getUserProjects</code> 中的请求失败，<code>getProjectTitles</code> 和 <code>alert</code> 也不会被调用，<code>.catch</code> 回调会记录错误。</p>
        <p>如果 <code>searchUsers</code> 没有返回结果，错误处理程序也会捕获空引用异常，且 <code>getFirstId</code> 会尝试访问一个不存在的数组项的<code>id</code> 属性。</p>
        <p>由于这些错误都是语义化的，容易保持每个函数足够小，且可测试，而不需要到处使用 <code>try</code>/<code>catch</code>。</p>

        <h2 id="shorthands"><a href="#shorthands">简写</a></h2>
        <p>有时，你已经有一个值，但希望把它包裹在 Promise 中。<code>Promise.resolve</code> 和 <code>Promise.reject</code> 就是为了这个目的而存在的。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 这个列表是从 localStorage 中读取的
var users = [{id: 1, firstName: "John", lastName: "Doe"}]

// `users` 存在与否取决于 localStorage 是否存在数据
var promise = users ? Promise.resolve(users) : getUsers()
promise
  .then(getFirstTen)
  .then(getUserNames)
  .then(alert)'); ?></code></pre>

        <h2 id="multiple-promises"><a href="#multiple-promises">多个 Promise</a></h2>
        <p>某些情况下，你可能需要并行发送 HTTP 请求，并在所有请求完成后执行代码。这可以通过 <code>Promise.all</code> 来实现：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('Promise.all([
  searchUsers("John"),
  searchUsers("Mary"),
])
.then(function(data) {
  // data[0] 是名字是 John 的用户数组
  // data[1] 是名字是 Mary 的用户数组

  // 返回值等效于 [
  //   getUserNames(data[0]),
  //   getUserNames(data[1]),
  // ]
  return data.map(getUserNames)
})
.then(alert)'); ?></code></pre>
        <p>上面的例子中，同时进行了两次用户搜索。一旦这两个搜索完成，我们会从两次搜索的结果中获取所有 userName，并显示在提示框中。</p>
        <p>这个例子同时说明了小函数的另一个好处：我们可以重用上面创建的 <code>getUserNames</code> 函数。</p>

        <h2 id="why-not-callbacks"><a href="#why-not-callbacks">为什么不使用回调</a></h2>
        <p>回调是处理异步计算的另一种机制。对于会执行多次的异步计算，使用回调会更合适（例如，<code>onscroll</code> 事件处理）。</p>
        <p>但是，对于只会执行一次的异步计算，使用 Promise 可以更好的重构代码，减少代码的嵌套。</p>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>