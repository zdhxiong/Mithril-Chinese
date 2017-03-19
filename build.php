<?php
/**
 * =====================================
 * ======== 生成最终的 HTML 文件 =========
 * =====================================
 */
// 源文件目录相对于当前文件的路径
define('SRC_PATH', realpath('./src'));
// 构建后的文件存放路径
define('BUILD_PATH', __DIR__ . '/build');

$guide_files = array(
    'introduction',
    'installation',
    'simple-application',
    'jsx',
    'es6',
    'css',
    'animation',
    'testing',
    'examples',
    'vnodes',
    'components',
    'lifecycle-methods',
    'keys',
    'autoredraw',
    'framework-comparison',
    'change-log'
);
$api_files = array(
    'api',
    'hyperscript',
    'render',
    'mount',
    'route',
    'request',
    'jsonp',
    'parseQueryString',
    'buildQueryString',
    'withAttr',
    'trust',
    'fragment',
    'redraw',
    'version',
    'promise',
    'stream'
);

$files = array_merge($guide_files, $api_files);

foreach($files as $file) {
    $file_path = BUILD_PATH . '/' . $file . '.html';
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    ob_start();

    if (in_array($file, $guide_files)) {
        $vars['section'] = 'guide';
    } elseif (in_array($file, $api_files)) {
        $vars['section'] = 'api';
    }

    include SRC_PATH . '/' . $file . '.php';
    $file_content = ob_get_contents();
    file_put_contents($file_path, $file_content);
    ob_end_clean();
}