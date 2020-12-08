(self.webpackChunk=self.webpackChunk||[]).push([[178],{9351:(e,t,n)=>{"use strict";n.d(t,{Z:()=>s});var r=n(4015),o=n.n(r),i=n(3645),a=n.n(i)()(o());a.push([e.id,".form-control[data-v-13b9c6ae]{background:transparent}","",{version:3,sources:["webpack://./resources/js/components/SelectComponent.vue"],names:[],mappings:"AAqDA,+BACA,sBACA",sourcesContent:["<template>\n    <div>\n        <select class=\"form-control\" @change=\"newInput\" v-model=\"is_servicable\">\n            <option v-for=\"option in options\" :value=\"option.id\">{{ option.full_name }}</option>\n            <option value=\"\">No user</option>\n        </select>\n    </div>\n</template>\n\n<script>\nexport default {\n    props: ['current_value', 'url', 'column_title', 'options'],\n    data() {\n        return {\n            set_value: '',\n            is_servicable: '',\n            title: 'user_id',\n        };\n    },\n    mounted() {\n        this.set_value = this.current_value;\n        this.is_servicable = this.current_value;\n        this.title = this.column_title;\n    },\n    methods: {\n        newInput(event) {\n            this.is_servicable = event.target.value;\n            this.updateInput();\n        },\n        updateInput: function () {\n            let data = new FormData();\n            data.append(this.title, this.is_servicable);\n            let config = {\n                onUploadProgress: (progressEvent) => {\n                    //this.progress = Math.floor((progressEvent.loaded * 100) / progressEvent.total);\n                },\n            };\n            data.append('_method', 'patch'); // add this\n            axios\n                .post(this.url, data, config) // change this to post )\n                .then((res) => {\n                    this.set_value = this.is_servicable;\n                })\n                .catch((error) => {\n                    console.log(error);\n                    this.is_servicable = !this.set_value;\n                }); //\n            //console.log(error);\n        },\n    },\n};\n<\/script>\n<style scoped>\n.form-control {\n    background: transparent;\n}\n</style>\n"],sourceRoot:""}]);const s=a},3645:e=>{"use strict";e.exports=function(e){var t=[];return t.toString=function(){return this.map((function(t){var n=e(t);return t[2]?"@media ".concat(t[2]," {").concat(n,"}"):n})).join("")},t.i=function(e,n,r){"string"==typeof e&&(e=[[null,e,""]]);var o={};if(r)for(var i=0;i<this.length;i++){var a=this[i][0];null!=a&&(o[a]=!0)}for(var s=0;s<e.length;s++){var c=[].concat(e[s]);r&&o[c[0]]||(n&&(c[2]?c[2]="".concat(n," and ").concat(c[2]):c[2]=n),t.push(c))}},t}},4015:e=>{"use strict";function t(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if("undefined"==typeof Symbol||!(Symbol.iterator in Object(e)))return;var n=[],r=!0,o=!1,i=void 0;try{for(var a,s=e[Symbol.iterator]();!(r=(a=s.next()).done)&&(n.push(a.value),!t||n.length!==t);r=!0);}catch(e){o=!0,i=e}finally{try{r||null==s.return||s.return()}finally{if(o)throw i}}return n}(e,t)||function(e,t){if(!e)return;if("string"==typeof e)return n(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);"Object"===r&&e.constructor&&(r=e.constructor.name);if("Map"===r||"Set"===r)return Array.from(e);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return n(e,t)}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}e.exports=function(e){var n=t(e,4),r=n[1],o=n[3];if("function"==typeof btoa){var i=btoa(unescape(encodeURIComponent(JSON.stringify(o)))),a="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(i),s="/*# ".concat(a," */"),c=o.sources.map((function(e){return"/*# sourceURL=".concat(o.sourceRoot||"").concat(e," */")}));return[r].concat(c).concat([s]).join("\n")}return[r].join("\n")}},3379:(e,t,n)=>{"use strict";var r,o=function(){return void 0===r&&(r=Boolean(window&&document&&document.all&&!window.atob)),r},i=function(){var e={};return function(t){if(void 0===e[t]){var n=document.querySelector(t);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(e){n=null}e[t]=n}return e[t]}}(),a=[];function s(e){for(var t=-1,n=0;n<a.length;n++)if(a[n].identifier===e){t=n;break}return t}function c(e,t){for(var n={},r=[],o=0;o<e.length;o++){var i=e[o],c=t.base?i[0]+t.base:i[0],u=n[c]||0,l="".concat(c," ").concat(u);n[c]=u+1;var p=s(l),d={css:i[1],media:i[2],sourceMap:i[3]};-1!==p?(a[p].references++,a[p].updater(d)):a.push({identifier:l,updater:m(d,t),references:1}),r.push(l)}return r}function u(e){var t=document.createElement("style"),r=e.attributes||{};if(void 0===r.nonce){var o=n.nc;o&&(r.nonce=o)}if(Object.keys(r).forEach((function(e){t.setAttribute(e,r[e])})),"function"==typeof e.insert)e.insert(t);else{var a=i(e.insert||"head");if(!a)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");a.appendChild(t)}return t}var l,p=(l=[],function(e,t){return l[e]=t,l.filter(Boolean).join("\n")});function d(e,t,n,r){var o=n?"":r.media?"@media ".concat(r.media," {").concat(r.css,"}"):r.css;if(e.styleSheet)e.styleSheet.cssText=p(t,o);else{var i=document.createTextNode(o),a=e.childNodes;a[t]&&e.removeChild(a[t]),a.length?e.insertBefore(i,a[t]):e.appendChild(i)}}function f(e,t,n){var r=n.css,o=n.media,i=n.sourceMap;if(o?e.setAttribute("media",o):e.removeAttribute("media"),i&&"undefined"!=typeof btoa&&(r+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i))))," */")),e.styleSheet)e.styleSheet.cssText=r;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(r))}}var v=null,h=0;function m(e,t){var n,r,o;if(t.singleton){var i=h++;n=v||(v=u(t)),r=d.bind(null,n,i,!1),o=d.bind(null,n,i,!0)}else n=u(t),r=f.bind(null,n,t),o=function(){!function(e){if(null===e.parentNode)return!1;e.parentNode.removeChild(e)}(n)};return r(e),function(t){if(t){if(t.css===e.css&&t.media===e.media&&t.sourceMap===e.sourceMap)return;r(e=t)}else o()}}e.exports=function(e,t){(t=t||{}).singleton||"boolean"==typeof t.singleton||(t.singleton=o());var n=c(e=e||[],t);return function(e){if(e=e||[],"[object Array]"===Object.prototype.toString.call(e)){for(var r=0;r<n.length;r++){var o=s(n[r]);a[o].references--}for(var i=c(e,t),u=0;u<n.length;u++){var l=s(n[u]);0===a[l].references&&(a[l].updater(),a.splice(l,1))}n=i}}}},1178:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>c});const r={props:["current_value","url","column_title","options"],data:function(){return{set_value:"",is_servicable:"",title:"user_id"}},mounted:function(){this.set_value=this.current_value,this.is_servicable=this.current_value,this.title=this.column_title},methods:{newInput:function(e){this.is_servicable=e.target.value,this.updateInput()},updateInput:function(){var e=this,t=new FormData;t.append(this.title,this.is_servicable);t.append("_method","patch"),axios.post(this.url,t,{onUploadProgress:function(e){}}).then((function(t){e.set_value=e.is_servicable})).catch((function(t){console.log(t),e.is_servicable=!e.set_value}))}}};var o=n(3379),i=n.n(o),a=n(9351),s={insert:"head",singleton:!1};i()(a.Z,s);a.Z.locals;const c=(0,n(1900).Z)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("select",{directives:[{name:"model",rawName:"v-model",value:e.is_servicable,expression:"is_servicable"}],staticClass:"form-control",on:{change:[function(t){var n=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.is_servicable=t.target.multiple?n:n[0]},e.newInput]}},[e._l(e.options,(function(t){return n("option",{domProps:{value:t.id}},[e._v(e._s(t.full_name))])})),e._v(" "),n("option",{attrs:{value:""}},[e._v("No user")])],2)])}),[],!1,null,"13b9c6ae",null).exports},1900:(e,t,n)=>{"use strict";function r(e,t,n,r,o,i,a,s){var c,u="function"==typeof e?e.options:e;if(t&&(u.render=t,u.staticRenderFns=n,u._compiled=!0),r&&(u.functional=!0),i&&(u._scopeId="data-v-"+i),a?(c=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),o&&o.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(a)},u._ssrRegister=c):o&&(c=s?function(){o.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:o),c)if(u.functional){u._injectStyles=c;var l=u.render;u.render=function(e,t){return c.call(t),l(e,t)}}else{var p=u.beforeCreate;u.beforeCreate=p?[].concat(p,c):[c]}return{exports:e,options:u}}n.d(t,{Z:()=>r})}}]);
//# sourceMappingURL=178.js.map