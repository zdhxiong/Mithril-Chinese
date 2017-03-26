<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title><?php if ($vars['title']) {echo $vars['title'].' - ';} ?>Mithril 中文文档，中文教程</title>
    <link rel="stylesheet" href="./static/mdui/css/mdui.min.css"/>
    <link rel="stylesheet" href="http://cdn.bootcss.com/highlight.js/9.10.0/styles/github-gist.min.css"/>
    <link rel="stylesheet" href="./static/css/app.css"/>
</head>
<body class="mdui-drawer-body-left mdui-appbar-with-toolbar">
<header class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-indigo">
        <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer'}"><i class="mdui-icon material-icons">&#xe5d2;</i></span>
        <a href="./" class="mdui-typo-headline mdui-hidden-xs">Mithril</a>
        <a href="" class="mdui-typo-title"><?php echo $vars['title']; ?></a>
        <div class="mdui-toolbar-spacer"></div>
        <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-menu="{target: '#header-menu', fixed: true}"><i class="mdui-icon material-icons">&#xe5d4;</i></span>
        <ul class="mdui-menu" id="header-menu">
            <li class="mdui-menu-item">
                <a href="https://github.com/zdhxiong/Mithril-Chinese" target="_blank" class="mdui-ripple">中文文档 Github</a>
            </li>
            <li class="mdui-menu-item">
                <a href="http://mithril.js.org" class="mdui-ripple">英文官方文档</a>
            </li>
            <li class="mdui-menu-item">
                <a href="https://github.com/lhorie/mithril.js" target="_blank" class="mdui-ripple">官方 Github</a>
            </li>
        </ul>
    </div>
</header>
<div class="mdui-drawer" id="main-drawer">
    <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
        <?php
        if ($vars['section'] == 'guide') {
            include "nav_api.php";
            include "nav_guide.php";
        } else if ($vars['section'] == 'api') {
            include "nav_guide.php";
            include "nav_api.php";
        }
        ?>
    </div>
</div>