!function n(e,r,t){function i(u,c){if(!r[u]){if(!e[u]){var a="function"==typeof require&&require;if(!c&&a)return a(u,!0);if(o)return o(u,!0);var f=new Error("Cannot find module '"+u+"'");throw f.code="MODULE_NOT_FOUND",f}var s=r[u]={exports:{}};e[u][0].call(s.exports,function(n){var r=e[u][1][n];return i(r?r:n)},s,s.exports,n,e,r,t)}return r[u].exports}for(var o="function"==typeof require&&require,u=0;u<t.length;u++)i(t[u]);return i}({1:[function(n,e,r){"use strict";$(function(){$("#content").addClass("block-section line-bottom"),$("select.version").change(function(){""!=$(this).val()&&(window.location=_.replace(routes.pageApiIndex,"{version?}",$(this).val()))})}),hljs.initHighlightingOnLoad()},{}]},{},[1]);