<?php
$vars['title'] = '生命周期方法';
$vars['filename'] = 'lifecycle-methods';
$vars['prev'] = array(
    'filename' => 'components',
    'title' => '组件'
);
$vars['next'] = array(
    'filename' => 'keys',
    'title' => 'keys'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">生命周期方法</h1>
    <div class="doc-chapter">
        <h2 id="usage" class="doc-chapter-title mdui-text-color-theme"><a href="#usage">用法</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><a href="./components.html">组件</a>和<a href="./vnodes.html">虚拟 DOM 节点</a>都有生命周期方法，也叫<strong>钩子</strong>，它们会在 DOM 元素的生命周期的对应时期被调用。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 组件中的钩子
var ComponentWithHook = {
    oninit: function(vnode) {
        console.log("initialize component")
    },
    view: function() {
        return "hello"
    }
}

// vnode 中的钩子
function initializeVnode() {
    console.log("initialize vnode")
}

m(ComponentWithHook, {oninit: initializeVnode})'); ?></code></pre>
            <p>所有生命周期方法都使用 vnode 作为第一个参数，并把 <code>this</code> 关键字绑定到了 <code>vnode.state</code>。</p>
            <p>生命周期方法只有通过 Mithril 的 <a href="./render.html">m.render()</a> 调用时才会触发。如果不通过 Mithril，而是直接修改 DOM，则不会触发生命周期方法。</p>
        </div>

        <h2 id="the-dom-element-lifecycle" class="doc-chapter-title mdui-text-color-theme"><a href="#the-dom-element-lifecycle">DOM 元素的生命周期</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>DOM 元素被创建后通常会追加到 document 中。当触发事件或更新数据时，可能会导致 DOM 元素的属性和子节点更新；也有可能导致元素从 document 中移除。</p>
            <p>移除元素后，可能会临时保存在内存池中。内存池中的元素可能会在随后的更新中（DOM 回收的过程）重新使用。回收元素可以避免重新创建元素导致的性能开销。</p>
        </div>

        <h2 id="oninit" class="doc-chapter-title mdui-text-color-theme"><a href="#oninit">oninit</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><code>oninit(vnode)</code> 钩子在 vnode 初始化前被调用。<code>oninit</code> 会在 DOM 元素添加到 document 之前运行，并且会先运行父元素上的 <code>oninit</code>，再运行子元素上的。但使用该方法时不能确保 DOM 元素已经存在，所以你不应该从 <code>oninit</code> 方法中访问 <code>vnode.dom</code>。</p>
            <p>当更新一个元素时，不会调用该钩子。但如果元素已经被回收，然后再更新时，就会调用该钩子。</p>
            <p>该钩子可用于通过 <code>vnode.attrs</code> 或 <code>vnode.children</code> 传入的参数来初始化组件状态。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var ComponentWithState = {
    oninit: function(vnode) {
        this.data = vnode.attrs.data
    },
    view: function() {
        return m("div", this.data) // displays data from initialization time
    }
}

m(ComponentWithState, {data: "Hello"})

// 等效 HTML
// <div>Hello</div>'); ?></code></pre>
            <p>不要在该方法中修改模型数据。因为 <code>oninit</code> 被调用时其他元素的状态无法确认，在下一次渲染循环前，该方法中的模型更改可能不会在 UI 中体现出来。</p>
        </div>

        <h2 id="oncreate" class="doc-chapter-title mdui-text-color-theme"><a href="#oncreate">oncreate</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>在 DOM 元素创建完成并添加到 document 后，会调用 <code>oncreate(vnode)</code> 钩子。<code>oncreate</code> 会在渲染循环结束后运行，所以在该方法中，可以读取 <code>vnode.dom.offsetHeight</code> 和 <code>vnode.dom.getBoundingClientRect()</code> 等布局的值。</p>
            <p>当更新元素时，不会调用该钩子。</p>
            <p>和其他钩子一样，<code>oncreate</code> 回调中的 <code>this</code> 关键字指向 <code>vnode.state</code>。vnode 中具有 <code>oncreate</code> 钩子的 DOM 元素不会被回收。</p>
            <p><code>oncreate</code> 钩子可用于读取布局的值，这些布局可能会触发重绘、执行动画、或者初始化需要引用 DOM 元素的第三方库。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var HeightReporter = {
    oncreate: function(vnode) {
        console.log("Initialized with height of: ", vnode.dom.offsetHeight)
    },
    view: function() {}
}

m(HeightReporter, {data: "Hello"})'); ?></code></pre>
            <p>不要在该方法中修改模型数据。因为 <code>oncreate</code> 会在渲染结束时执行，所以在下一次渲染循环前，在该方法中对模型的更改不会体现在 UI 中。</p>
        </div>

        <h2 id="onupdate" class="doc-chapter-title mdui-text-color-theme"><a href="#onupdate">onupdate</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><code>onupdate</code> 钩子会在 DOM 元素被更新后调用。<code>onupdate</code> 会在渲染循环结束后运行，所以可以放心的在该方法中读取布局值，例如 <code>vnode.dom.offsetHeight</code> 和 <code>vnode.dom.getBoundingClientRect()</code>。</p>
            <p>只有当前的渲染循环中存在该元素时，才会调用该钩子。元素被创建或回收时，不会调用该钩子。</p>
            <p>像其他钩子一样，<code>onupdate</code> 回调中的 <code>this</code> 关键字指向 <code>vnode.state</code>。vnode 中含有 <code>onupdate</code> 钩子的 DOM 元素不会被回收。</p>
            <p><code>onupdate</code> 钩子可用于读取会触发重绘的布局的值，以及在模型数据更改后，动态更新第三方库中的 UI 元素的状态。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var RedrawReporter = {
    count: 0,
    onupdate: function(vnode) {
        console.log("Redraws so far: ", ++vnode.state.count)
    },
    view: function() {}
}

m(RedrawReporter, {data: "Hello"})'); ?></code></pre>
        </div>

        <h2 id="onbeforeremove" class="doc-chapter-title mdui-text-color-theme"><a href="#onbeforeremove">onbeforeremove</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><code>onbeforeremove(vnode)</code> 钩子在 DOM 元素从 document 中分离之前被调用。如果返回 Promise，则会在 Promise 完成后再分离。</p>
            <p>该钩子只有在元素失去父元素时才会被调用，当失去子元素时，不会调用该钩子。</p>
            <p>像其他钩子一样，<code>onbeforeremove</code> 回调中的 <code>this</code> 关键字指向 <code>vnode.state</code>。vnode 中含 <code>onbeforeremove</code> 钩子的 DOM 元素不会被回收。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Fader = {
    onbeforeremove: function(vnode) {
        vnode.dom.classList.add("fade-out")
        return new Promise(function(resolve) {
            setTimeout(resolve, 1000)
        })
    },
    view: function() {
        return m("div", "Bye")
    },
}'); ?></code></pre>
        </div>

        <h2 id="onremove" class="doc-chapter-title mdui-text-color-theme"><a href="#onremove">onremove</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><code>onremove(vnode)</code> 钩子在 DOM 元素被移除之前调用。如果同时定义了 <code>onbeforeremove</code> 钩子，<code>onremove</code> 会在从 <code>onbeforeremove</code> 返回的 Promise 完成之后调用。</p>
            <p>该钩子会在任何从 document 中移除的元素上被调用，无论是它直接被移除，还是它的父元素被移除。</p>
            <p>和其他钩子一样，<code>onremove</code> 回调中的 <code>this</code> 关键字指向 <code>vnode.state</code>。vnode 中含 <code>onremove</code> 钩子的 DOM 元素不会被回收。</p>
            <p><code>onremove</code> 钩子可以用于进行清理工作。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Timer = {
    oninit: function(vnode) {
        this.timeout = setTimeout(function() {
            console.log("timed out")
        }, 1000)
    },
    onremove: function(vnode) {
        clearTimeout(this.timeout)
    },
    view: function() {}
}'); ?></code></pre>
        </div>

        <h2 id="onbeforeupdate" class="doc-chapter-title mdui-text-color-theme"><a href="#onbeforeupdate">onbeforeupdate</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><code>onbeforeupdate(vnode, old)</code> 钩子会在对 vnode 进行 diff 之前调用。如果定义了该函数，且返回 false，Mithril 会阻止对 vnode 进行 diff，同时也阻止了对 vnode 的子元素进行 diff。</p>
            <p>这个钩子本身不会阻止生成虚拟 DOM 子树，除非子树被封装在一个组件中。</p>
            <p>像其他钩子一样，<code>onbeforeupdate</code> 回调中的 <code>this</code> 关键字指向 <code>vnode.state</code>。</p>
            <p>该钩子可用于在 DOM 树过大时，减少更新的延迟。</p>
        </div>

        <h2 id="avoid-anti-patterns" class="doc-chapter-title mdui-text-color-theme"><a href="#avoid-anti-patterns">避免反面模式</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <h3 class="doc-chapter-subtitle">避免过早优化</h3>
            <p>用 <code>onbeforeupdate</code> 来跳过 diff 只能作为性能优化的最后的手段，除非你遇到了明显的性能问题，否则应该避免使用它。</p>
            <p>通常可以通过 <code>onbeforeupdate</code> 来修复的性能问题，都是因为数组过大，这里的 “大” 是指一个数组包含了大量的节点，无论是数组的宽度（例如超过 5000 行的表格），还是数组嵌套的深度。</p>
            <p>如果你确实遇到性能问题，首先考虑你的 UI 设计是否合理，否则，请修改你的 UI 设计。例如，用户不会希望在一个 5000 行的表格中来选取数据，这时只返回最相关的几条数据会有更好的用户体验。</p>
            <p>如果你必须用到大量的 DOM 元素，可以在大数组的父元素上使用 <code>onbeforeupdate</code> 来重新评估性能。大多数情况下，单次检查应该是足够的；在罕见的情况下，需要重复多次检查，但是在使用多个 <code>onbeforeupdate</code> 时应该越来越谨慎，因为多个 <code>onbeforeupdate</code> 是一种代码异味，指示设计流程中的优先级问题。</p>
            <p>不要出于 “以防万一” 的目的提前进行性能优化。记住，一般来说，更多的代码意味着更高的维护成本。当你使用 <code>onbeforeupdate</code> 来对元素进行有条件的 diff 时，同时也会导致相关的错误难以排查。</p>
            <p>再次强调，<strong><code>onbeforeupdate</code> 只能作为性能优化的最后的手段。</strong></p>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>