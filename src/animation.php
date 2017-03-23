<?php
$vars['title'] = '动画';
$vars['filename'] = 'animation';
$vars['prev'] = array(
    'filename' => 'css',
    'title' => 'CSS'
);
$vars['next'] = array(
    'filename' => 'testing',
    'title' => '测试'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">动画</h1>

    <nav class="doc-toc mdui-text-color-theme">
        <ul>
            <li><a href="#technology-choices">技术选型</a></li>
            <li><a href="#animation-on-element-creation">元素创建时的动画</a></li>
            <li><a href="#animation-on-element-removal">元素移除时的动画</a></li>
            <li><a href="#performance">性能</a></li>
        </ul>
    </nav>

    <div class="doc-chapter-content">
        <h2 id="technology-choices" class="doc-chapter-title mdui-text-color-theme"><a href="#technology-choices">技术选型</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>动画可以使应用更生动。现在的浏览器对 CSS 动画的支持已经很好了，而且还有各种<a href="http://velocityjs.org/" target="_blank">库</a>可以提供基于 JavaScript 的动画。如果你喜欢最前沿的技术的话，还有 <a href="https://developer.mozilla.org/en-US/docs/Web/API/Web_Animations_API/Using_the_Web_Animations_API" target="_blank">Web API</a> 和 <a href="https://github.com/web-animations/web-animations-js" target="_blank">polyfill</a>。</p>
            <p>Mithril 本身不提供任何动画 API，因为已经有很多其他方案来实现丰富、复杂的动画了。但是，Mithril 提供了钩子，在用传统方法实现动画有困难的情况下，可以使用钩子来实现。</p>
        </div>

        <h2 id="animation-on-element-creation" class="doc-chapter-title mdui-text-color-theme"><a href="#animation-on-element-creation">元素创建时的动画</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>元素创建时的动画效果，可以通过 CSS 轻易实现。只需要给 CSS 类添加一个动画：</p>
            <pre class="doc-code"><code class="lang-css"><?php echo htmlentities('.fancy {animation:fade-in 0.5s;}
@keyframes fade-in {
    from {opacity:0;}
    to {opacity:1;}
}'); ?></code></pre>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var FancyComponent = {
    view: function() {
        return m(".fancy", "Hello world")
    }
}

m.mount(document.body, FancyComponent)'); ?></code></pre>
        </div>

        <h2 id="animation-on-element-removal" class="doc-chapter-title mdui-text-color-theme"><a href="#animation-on-element-removal">元素移除时的动画</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>要为移除元素的过程添加动画效果，最大的问题是必须等到动画结束后才能真正移除元素。Mithril 提供了一个 <a href="./lifecycle-methods.html#onbeforeremove"><code>onbeforeremove</code></a> 钩子，允许推迟元素的移除。</p>
            <p>我们来为 <code>exit</code> 类添加动画，使它的 <code>opacity</code> 属性从 1 到 0 渐变。</p>
            <pre class="doc-code"><code class="lang-css"><?php echo htmlentities('.exit {animation:fade-out 0.5s;}
@keyframes fade-out {
    from {opacity:1;}
    to {opacity:0;}
}'); ?></code></pre>
            <p>现在我们创建一个新的组件，用于显示和隐藏之前创建的 <code>FancyComponent</code> 组件：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var on = true

var Toggler = {
    view: function() {
        return [
            m("button", {onclick: function() {on = !on}}, "Toggle"),
            on ? m(FancyComponent) : null,
        ]
    }
}'); ?></code></pre>
            <p>然后我们来修改 <code>FancyComponent</code>，使它被移除时能淡出：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var FancyComponent = {
    onbeforeremove: function(vnode) {
        vnode.dom.classList.add("exit")
        return new Promise(function(resolve) {
            setTimeout(resolve, 500)
        })
    },
    view: function() {
        return m(".fancy", "Hello world")
    }
}'); ?></code></pre>
            <p><code>vnode.dom</code> 指向组件的根 DOM 元素（<code><?php echo htmlentities('<div class="fancy">'); ?></code>），我们在该元素上添加了一个类 <code>exit</code>。</p>
            <p>我们返回一个 <a href="./promise.html">Promise</a>，并在半秒钟后完成。当我们从 <code>onbeforeremove</code> 返回 promise 时，Mithril 会保持等待，直到 promise 被完成，元素才会被移除。在这个例子中，它等待了半秒，给了 exit 足够的时间来完成动画。</p>
            <p>我们把 <code>Toggler</code> 组件渲染到页面上，就能测试这个渐变动画效果了：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.mount(document.body, Toggler)'); ?></code></pre>
        </div>

        <h2 id="performance" class="doc-chapter-title mdui-text-color-theme"><a href="#performance">性能</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>使用 CSS 动画时，建议你只在 <code>opacity</code> 和 <code>transform</code> 属性上使用动画，因为这两个属性的动画会启用硬件加速，会比 <code>top</code>、<code>left</code>、<code>width</code>、<code>height</code> 属性的动画有更高的性能。</p>
            <p>同时也建议你避免使用 <code>box-shadow</code> 属性和类似 <code>:nth-child</code> 这样的选择器，因为这些属性的动画也是很占用资源的。如果你想在 <code>box-shadow</code> 属性上使用动画，建议<a href="http://tobiasahlin.com/blog/how-to-animate-box-shadow/" target="_blank">把 <code>box-shadow</code> 属性放在伪元素中，并用伪元素的 <code>opacity</code> 的变化来代替 <code>box-shadow</code> 的变化。</a>其他比较耗费资源的包括：大型图片或者动态可缩放的图片、使用不同 <code>position</code> 的值进行重叠的元素。</p>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>