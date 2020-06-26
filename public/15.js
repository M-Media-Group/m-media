webpackJsonp([15],{"1Z+B":function(t,a){t.exports={render:function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",[e("transition-group",{attrs:{name:"fade",mode:"out-in"}},[e("div",{directives:[{name:"show",rawName:"v-show",value:t.success,expression:"success"}],key:"3",staticClass:"alert alert-success",attrs:{role:"alert"}},[e("strong",[t._v(t._s(t.domain))]),t._v(" is available!"),e("br"),e("br"),t._v(" "),e("a",{staticClass:"button button-secondary",attrs:{href:"/contact"}},[t._v("Contact M Media")]),t._v(" "),e("a",{staticClass:"button",attrs:{href:"#"},on:{click:function(a){a.preventDefault(),t.success=!1}}},[t._v("Try another domain")])]),t._v(" "),e("div",{directives:[{name:"show",rawName:"v-show",value:t.error,expression:"error"}],key:"4",staticClass:"alert alert-danger",attrs:{role:"alert"}},[t._v("\n            This top-level domain (extension) is unsupported by M Media - "+t._s(t.error_msg)),e("br"),t._v(" "),e("a",{staticClass:"button button-primary",attrs:{href:"#"},on:{click:function(a){a.preventDefault(),t.error=!1}}},[t._v("Try another domain")]),t._v(" "),e("a",{staticClass:"button",attrs:{href:"https://blog.mmediagroup.fr/post/top-level-domains-on-m-media/",target:"_BLANK",rel:"noopener"}},[t._v("See the top-level domains we support")])]),t._v(" "),e("form",{directives:[{name:"show",rawName:"v-show",value:!t.success&&!t.error,expression:"!success && !error"}],key:"1",staticClass:"mb-0",attrs:{action:"#",method:"POST",enctype:"multipart/form-data"},on:{submit:function(a){return a.preventDefault(),t.getDomain(a)}}},[e("div",{staticClass:"form-group row"},[e("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"domain"}},[t._v("Domain")]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.domain,expression:"domain"}],staticClass:"form-control",attrs:{name:"domain",id:"domain",type:"text",placeholder:"example.com",disabled:t.loading,required:""},domProps:{value:t.domain},on:{input:[function(a){a.target.composing||(t.domain=a.target.value)},function(a){t.availability=null}]}})])]),t._v(" "),e("div",{staticClass:"form-group row mb-0"},[e("div",{staticClass:"col-md-8 offset-md-4"},[e("button",{staticClass:"button button-primary",attrs:{type:"submit",disabled:t.loading}},[t._v("\n                        Check availability\n                    ")])])])]),t._v(" "),t.availability&&"AVAILABLE"!==t.availability?e("div",{key:"availnotice",staticClass:"alert alert-secondary"},[e("a",{attrs:{href:"/tools/website-debugger/"+t.domain}},[t._v(t._s(t.domain))]),t._v(" is "+t._s(t.availability.toLowerCase())+"\n            "),t.transferability&&"TRANSFERABLE"==t.transferability?e("span",[t._v(", but if you already own it you can transfer it to M Media.")]):t._e()]):t._e(),t._v(" "),t.suggestions&&t.availability&&"AVAILABLE"!==t.availability?e("div",{key:"suggestions",staticClass:"table-responsive"},[e("table",{staticClass:"table"},[e("thead",[e("tr",[e("th",[t._v("Similar available domain")]),t._v(" "),e("th",[t._v("Extension (top level domain)")]),t._v(" "),e("th",[t._v("Contact us")])])]),t._v(" "),e("tbody",t._l(t.suggestions,function(a){return e("tr",{key:a.domain},[e("td",[t._v(t._s(a.domain))]),t._v(" "),e("td",{staticClass:"text-muted"},[t._v(t._s(a.tld))]),t._v(" "),e("td",[e("a",{attrs:{href:"/contact"}},[t._v("Contact us")])])])}),0)])]):t._e(),t._v(" "),e("div",{directives:[{name:"show",rawName:"v-show",value:t.loading,expression:"loading"}],key:"2",staticClass:"alert alert-info",attrs:{role:"alert"}},[t._v("\n            Checking...\n        ")]),t._v(" "),e("div",{key:"5",staticClass:"row"},[e("div",{staticClass:"col-md-8 offset-md-4 text-muted"},[e("a",{attrs:{href:"https://blog.mmediagroup.fr/post/check-if-domain-available-on-m-media/",target:"_BLANK",rel:"noopener"}},[t._v("Need help?")])])])])],1)},staticRenderFns:[]}},"76F6":function(t,a,e){var i=e("VU/8")(e("vWbZ"),e("1Z+B"),!1,null,null,null);t.exports=i.exports},"VU/8":function(t,a){t.exports=function(t,a,e,i,s,o){var n,r=t=t||{},l=typeof t.default;"object"!==l&&"function"!==l||(n=t,r=t.default);var d,c="function"==typeof r?r.options:r;if(a&&(c.render=a.render,c.staticRenderFns=a.staticRenderFns,c._compiled=!0),e&&(c.functional=!0),s&&(c._scopeId=s),o?(d=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},c._ssrRegister=d):i&&(d=i),d){var u=c.functional,v=u?c.render:c.beforeCreate;u?(c._injectStyles=d,c.render=function(t,a){return d.call(a),v(t,a)}):c.beforeCreate=v?[].concat(v,d):[d]}return{esModule:n,exports:r,options:c}}},vWbZ:function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),a.default={props:["url"],data:function(){return{avatar:null,avatar_url:null,domain:"",loading:!1,error:!1,availability:"",transferability:"",success:!1,user:null,progress:0,suggestions:[]}},mounted:function(){},methods:{newFile:function(t){var a=t.target.files;a.length&&(this.avatar=a[0]);var e=URL.createObjectURL(this.avatar);this.avatar_url=e,this.domain=this.avatar.name},updateFile:function(){var t=this,a=new FormData;this.loading=!0,a.append("file",this.avatar),a.append("domain",this.domain);var e={onUploadProgress:function(a){t.progress=Math.floor(100*a.loaded/a.total)}};axios.post(this.url,a,e).then(function(a){t.success=!0,t.error=!1,console.log(a),t.loading=!1,t.file_url=a.data.url,t.avatar_url=null,t.domain=null;var e=t.$refs.fileInput;e.type="text",e.type="file"}).catch(function(a){t.error=!0,t.success=!1,t.error_msg=a.message,console.log(a),t.loading=!1})},getDomain:function(){var t=this,a=this.domain.match(/([a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i);this.domain=a[0],this.availability="",this.loading=!0,axios.get("/api/domains/"+this.domain+"/availability").then(function(a){t.availability=a.data.availability,t.loading=!1,"AVAILABLE"==a.data.availability?t.success=!0:(t.checkIfTransferable(),t.getSuggested())}).catch(function(a){console.log(a),t.loading=!1,t.error=!0})},checkIfTransferable:function(){var t=this,a=this.domain.match(/([a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i);this.domain=a[0],this.transferability="",this.loading=!0,axios.get("/api/domains/"+this.domain+"/transferability").then(function(a){t.transferability=a.data.transferability,t.loading=!1,"TRANSFERABLE"==a.data.transferability&&(t.success=!0)}).catch(function(a){console.log(a),t.loading=!1,t.error=!0})},getSuggested:function(){var t=this;this.suggestions=[],this.loading=!0,axios.get("/api/domains/"+this.domain+"/suggestions").then(function(a){t.suggestions=a.data.suggestions,t.loading=!1}).catch(function(a){console.log(a),t.loading=!1,t.error=!0})}}}}});
//# sourceMappingURL=15.js.map