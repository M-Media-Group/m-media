webpackJsonp([17],{SsY5:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={props:["checked","url","column_title"],data:function(){return{is_servicable:!0,title:"is_servicable"}},mounted:function(){this.is_servicable=this.checked,this.title=this.column_title},methods:{newInput:function(e){this.is_servicable=e.target.checked,this.updateInput()},updateInput:function(){var e=this,t=new FormData;t.append(this.title,this.is_servicable?1:0);t.append("_method","patch"),axios.post(this.url,t,{onUploadProgress:function(e){}}).then(function(e){console.log(e)}).catch(function(t){console.log(t),e.is_servicable=!e.is_servicable})}}}},T7PY:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("input",{directives:[{name:"model",rawName:"v-model",value:e.is_servicable,expression:"is_servicable"}],staticClass:"form-control",attrs:{id:"dynamic_checkbox",type:"checkbox",autocomplete:"off",name:"dynamic_checkbox"},domProps:{checked:Array.isArray(e.is_servicable)?e._i(e.is_servicable,null)>-1:e.is_servicable},on:{change:[function(t){var n=e.is_servicable,i=t.target,s=!!i.checked;if(Array.isArray(n)){var r=e._i(n,null);i.checked?r<0&&(e.is_servicable=n.concat([null])):r>-1&&(e.is_servicable=n.slice(0,r).concat(n.slice(r+1)))}else e.is_servicable=s},e.newInput]}})])},staticRenderFns:[]}},Tvqu:function(e,t,n){var i=n("VU/8")(n("SsY5"),n("T7PY"),!1,null,null,null);e.exports=i.exports},"VU/8":function(e,t){e.exports=function(e,t,n,i,s,r){var c,o=e=e||{},a=typeof e.default;"object"!==a&&"function"!==a||(c=e,o=e.default);var l,u="function"==typeof o?o.options:o;if(t&&(u.render=t.render,u.staticRenderFns=t.staticRenderFns,u._compiled=!0),n&&(u.functional=!0),s&&(u._scopeId=s),r?(l=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),i&&i.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(r)},u._ssrRegister=l):i&&(l=i),l){var d=u.functional,_=d?u.render:u.beforeCreate;d?(u._injectStyles=l,u.render=function(e,t){return l.call(t),_(e,t)}):u.beforeCreate=_?[].concat(_,l):[l]}return{esModule:c,exports:o,options:u}}}});
//# sourceMappingURL=17.js.map