webpackJsonp([13],{"0F53":function(t,e,a){var r=a("VU/8")(a("9Hkg"),a("TtJg"),!1,null,null,null);t.exports=r.exports},"9Hkg":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:["url"],data:function(){return{avatar:null,avatar_url:null,title:"",loading:!1,error:!1,error_msg:!1,success:!1,user:null,progress:0,file_url:null,file_user_id:null,upload_url:null,use_url:!1}},mounted:function(){},methods:{newFile:function(t){var e=t.target.files;e.length&&(this.avatar=e[0]);var a=URL.createObjectURL(this.avatar);this.avatar_url=a,this.title=this.avatar.name},updateFile:function(){var t=this,e=new FormData;this.loading=!0,e.append("title",this.title),this.use_url&&this.upload_url?e.append("url",this.upload_url):e.append("file",this.avatar);var a={onUploadProgress:function(e){t.progress=Math.floor(100*e.loaded/e.total)}};axios.post(this.url,e,a).then(function(e){if(t.success=!0,t.error=!1,console.log(e),t.loading=!1,t.file_url=e.data.id,t.file_user_id=e.data.user_id,t.avatar_url=null,t.title=null,t.use_url||t.upload_url)t.upload_url=null;else{var a=t.$refs.fileInput;a.type="text",a.type="file"}}).catch(function(e){t.error=!0,t.success=!1,t.error_msg=e.message,console.log(e),t.loading=!1})},getUser:function(){axios.get("/api/user").then(function(t){console.log("Go get"),console.log(t)}).catch(function(t){console.log(t)})}}}},TtJg:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("transition-group",{attrs:{name:"fade",mode:"out-in"}},[a("form",{directives:[{name:"show",rawName:"v-show",value:!t.success&&!t.error&&!t.loading,expression:"!success && !error && !loading"}],key:"1",staticClass:"mb-0",attrs:{action:"#",method:"POST",enctype:"multipart/form-data"},on:{submit:function(e){return e.preventDefault(),t.updateFile(e)}}},[a("div",{directives:[{name:"show",rawName:"v-show",value:t.avatar_url,expression:"avatar_url"}],staticClass:"row mb-3"},[a("img",{staticClass:"u-center",staticStyle:{"max-height":"100px"},attrs:{src:t.avatar_url}})]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"file"}},[t._v("File")]),t._v(" "),a("div",{staticClass:"col-md-6"},[t.use_url?a("input",{directives:[{name:"model",rawName:"v-model",value:t.upload_url,expression:"upload_url"}],staticClass:"form-control mb-0",attrs:{name:"URL",id:"url",type:"url",placeholder:"URL to the file"},domProps:{value:t.upload_url},on:{input:function(e){e.target.composing||(t.upload_url=e.target.value)}}}):a("input",{ref:"fileInput",staticClass:"form-control mb-0",attrs:{type:"file",name:"file",id:"file",required:"",autofocus:""},on:{change:t.newFile}}),t._v(" "),a("a",{staticClass:"small text-muted",attrs:{href:"##"},on:{click:function(e){t.use_url=!t.use_url}}},[t._v(t._s(t.use_url?"Upload a file":"Upload via a URL"))])])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"title"}},[t._v("Title")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.title,expression:"title"}],staticClass:"form-control",attrs:{name:"title",id:"title",type:"text",placeholder:"Descriptive titles help us tag the file"},domProps:{value:t.title},on:{input:function(e){e.target.composing||(t.title=e.target.value)}}})])]),t._v(" "),a("div",{staticClass:"form-group row mb-0"},[a("div",{staticClass:"col-md-8 offset-md-4"},[a("button",{staticClass:"button button-primary",attrs:{type:"submit"}},[t._v("\n                        Upload\n                    ")])])])]),t._v(" "),a("div",{directives:[{name:"show",rawName:"v-show",value:t.loading,expression:"loading"}],key:"2",staticClass:"alert alert-info",attrs:{role:"alert"}},[t._v("\n            Please wait. Your file is uploading...\n            "),a("div",{staticClass:"progress"},[a("div",{staticClass:"progress-bar",style:"width:"+t.progress+"%",attrs:{role:"progressbar","aria-valuenow":t.progress,"aria-valuemin":"0","aria-valuemax":"100"}})])]),t._v(" "),a("div",{directives:[{name:"show",rawName:"v-show",value:t.success,expression:"success"}],key:"3",staticClass:"alert alert-success",attrs:{role:"alert"}},[t._v("\n            File uploaded!"),a("br"),t._v(" "),a("a",{staticClass:"button button-primary",attrs:{href:"#"},on:{click:function(e){e.preventDefault(),t.success=!1}}},[t._v("Upload another file")]),t._v(" "),a("a",{staticClass:"button",attrs:{href:"/files/"+t.file_url}},[t._v("Open file")]),t._v(" "),a("a",{staticClass:"button",attrs:{href:"/files?user="+t.file_user_id}},[t._v("See all files")])]),t._v(" "),a("div",{directives:[{name:"show",rawName:"v-show",value:t.error,expression:"error"}],key:"4",staticClass:"alert alert-danger",attrs:{role:"alert"}},[t._v("\n            File error! "+t._s(t.error_msg)),a("br"),t._v(" "),a("a",{staticClass:"button button-primary",attrs:{href:"#"},on:{click:function(e){e.preventDefault(),t.error=!1}}},[t._v("Retry file upload")]),t._v(" "),a("a",{staticClass:"button",attrs:{href:"/contact"}},[t._v("Contact us for help")])]),t._v(" "),a("div",{key:"5",staticClass:"row"},[a("div",{staticClass:"col-md-8 offset-md-4 text-muted"},[a("span",{directives:[{name:"tooltip",rawName:"v-tooltip:top",value:"Each URL generated to your file is only valid for five minutes. If you want your file public with long-lived URLs, contact us.",expression:"\n                        'Each URL generated to your file is only valid for five minutes. If you want your file public with long-lived URLs, contact us.'\n                    ",arg:"top"}],staticClass:"label label-default"},[t._v("Your file is private by default.")]),t._v(" "),a("br"),t._v(" "),a("a",{attrs:{href:"https://blog.mmediagroup.fr/post/share-files-with-m-media/",target:"_BLANK",rel:"noopener"}},[t._v("Need help?")])])])])],1)},staticRenderFns:[]}},"VU/8":function(t,e){t.exports=function(t,e,a,r,s,l){var o,i=t=t||{},n=typeof t.default;"object"!==n&&"function"!==n||(o=t,i=t.default);var u,c="function"==typeof i?i.options:i;if(e&&(c.render=e.render,c.staticRenderFns=e.staticRenderFns,c._compiled=!0),a&&(c.functional=!0),s&&(c._scopeId=s),l?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(l)},c._ssrRegister=u):r&&(u=r),u){var d=c.functional,v=d?c.render:c.beforeCreate;d?(c._injectStyles=u,c.render=function(t,e){return u.call(e),v(t,e)}):c.beforeCreate=v?[].concat(v,u):[u]}return{esModule:o,exports:i,options:c}}}});
//# sourceMappingURL=13.js.map