!function r(t,e,o){function n(a,u){if(!e[a]){if(!t[a]){var s="function"==typeof require&&require;if(!u&&s)return s(a,!0);if(i)return i(a,!0);var f=new Error("Cannot find module '"+a+"'");throw f.code="MODULE_NOT_FOUND",f}var c=e[a]={exports:{}};t[a][0].call(c.exports,function(r){var e=t[a][1][r];return n(e?e:r)},c,c.exports,r,t,e,o)}return e[a].exports}for(var i="function"==typeof require&&require,a=0;a<o.length;a++)n(o[a]);return n}({1:[function(r,t,e){"use strict";$(function(){$("li.glosarium").addClass("active")}),new Vue({el:"#content",data:{total:0,words:words,categories:[]},mounted:function(){this.sameCategory(routes.glosariumWordSimilar)},methods:{sameCategory:function(r){var t=this;axios.post(r,{origin:this.words.origin}).then(function(r){t.categories=r.data})}}})},{}]},{},[1]);