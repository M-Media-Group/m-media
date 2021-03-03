(self.webpackChunkbigsite=self.webpackChunkbigsite||[]).push([[358],{1358:(e,t,s)=>{"use strict";s.r(t),s.d(t,{default:()=>o});const a={data:function(){return{title:"",loading:!1,error:!1,error_msg:!1,success:!1,user:null,progress:0,email:null,phone:null,message:null,name:null,surname:null,use_url:!1,is_logged_in_user:!1}},mounted:function(){},methods:{updateFile:function(){var e=this,t=new FormData;this.loading=!0,t.append("name",this.name),t.append("surname",this.surname),t.append("email",this.email),t.append("phone",this.phone),t.append("message",this.message),axios.post("/api/contact",t).then((function(t){e.success=!0,e.error=!1,console.log(t),e.loading=!1,e.title=null,dataLayer.push({event:"contact"})})).catch((function(t){e.error=!0,e.success=!1,e.error_msg=t.message,console.log(t),e.loading=!1}))},getUser:function(){var e=this;axios.get("/api/user").then((function(t){console.log("Go get"),e.is_logged_in_user=t,console.log(t)})).catch((function(e){console.log(e)}))}}};const o=(0,s(1900).Z)(a,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",[s("transition-group",{attrs:{name:"fade",mode:"out-in"}},[s("form",{directives:[{name:"show",rawName:"v-show",value:!e.success&&!e.error&&!e.loading,expression:"!success && !error && !loading"}],key:"1",staticClass:"mb-0",attrs:{action:"#",method:"POST",enctype:"multipart/form-data"},on:{submit:function(t){return t.preventDefault(),e.updateFile(t)}}},[s("div",{staticClass:"form-group row"},[s("label",{staticClass:"four columns col-form-label u-right-text-on-desktop",attrs:{for:"file"}},[e._v("Your first name")]),e._v(" "),s("div",{staticClass:"six columns"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.name,expression:"name"}],staticClass:"form-control mb-0",attrs:{name:"name",id:"name",type:"name",placeholder:"Name (required)",required:""},domProps:{value:e.name},on:{input:function(t){t.target.composing||(e.name=t.target.value)}}})])]),e._v(" "),s("div",{staticClass:"form-group row mb-5"},[s("label",{staticClass:"four columns col-form-label u-right-text-on-desktop",attrs:{for:"file"}},[e._v("Your surname")]),e._v(" "),s("div",{staticClass:"six columns"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.surname,expression:"surname"}],staticClass:"form-control mb-0",attrs:{name:"surname",id:"surname",type:"text",placeholder:"Last name (required)",required:""},domProps:{value:e.surname},on:{input:function(t){t.target.composing||(e.surname=t.target.value)}}})])]),e._v(" "),s("div",{staticClass:"form-group row"},[s("label",{staticClass:"four columns col-form-label u-right-text-on-desktop",attrs:{for:"file"}},[e._v("Your email address")]),e._v(" "),s("div",{staticClass:"six columns"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.email,expression:"email"}],staticClass:"form-control mb-0",attrs:{name:"email",id:"email",type:"email",placeholder:"Email address (required)",required:""},domProps:{value:e.email},on:{input:function(t){t.target.composing||(e.email=t.target.value)}}})])]),e._v(" "),s("div",{staticClass:"form-group row mb-5"},[s("label",{staticClass:"four columns col-form-label u-right-text-on-desktop",attrs:{for:"title"}},[e._v("Your phone number")]),e._v(" "),s("div",{staticClass:"six columns"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.phone,expression:"phone"}],staticClass:"form-control mb-0",attrs:{name:"phone",id:"phone",type:"text",placeholder:"Phone number"},domProps:{value:e.phone},on:{input:function(t){t.target.composing||(e.phone=t.target.value)}}})])]),e._v(" "),s("div",{staticClass:"form-group row"},[s("label",{staticClass:"four columns col-form-label u-right-text-on-desktop",attrs:{for:"title"}},[e._v("Your message")]),e._v(" "),s("div",{staticClass:"six columns"},[s("textarea-autosize",{staticClass:"form-control",attrs:{name:"message",id:"message",placeholder:"Message (required)",rows:"3",required:""},model:{value:e.message,callback:function(t){e.message=t},expression:"message"}})],1)]),e._v(" "),s("div",{staticClass:"form-group row mb-0"},[s("div",{staticClass:"eight columns offset-by-four"},[s("button",{staticClass:"button button-primary",attrs:{type:"submit"}},[e._v("Send message")])])])]),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.loading,expression:"loading"}],key:"2",staticClass:"alert alert-info",attrs:{role:"alert"}},[e._v("\n            Please wait. Your message is being sent...\n            ")]),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.success,expression:"success"}],key:"3",staticClass:"alert alert-success",attrs:{role:"alert"}},[e._v("\n            Message sent!"),s("br")]),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.error,expression:"error"}],key:"4",staticClass:"alert alert-danger",attrs:{role:"alert"}},[e._v("\n            File error! "+e._s(e.error_msg)),s("br"),e._v(" "),s("a",{staticClass:"button button-primary",attrs:{href:"#"},on:{click:function(t){t.preventDefault(),e.error=!1}}},[e._v("Retry file upload")]),e._v(" "),s("a",{staticClass:"button",attrs:{href:"/contact"}},[e._v("Contact us for help")])])])],1)}),[],!1,null,null,null).exports},1900:(e,t,s)=>{"use strict";function a(e,t,s,a,o,r,n,i){var l,u="function"==typeof e?e.options:e;if(t&&(u.render=t,u.staticRenderFns=s,u._compiled=!0),a&&(u.functional=!0),r&&(u._scopeId="data-v-"+r),n?(l=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),o&&o.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(n)},u._ssrRegister=l):o&&(l=i?function(){o.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:o),l)if(u.functional){u._injectStyles=l;var c=u.render;u.render=function(e,t){return l.call(t),c(e,t)}}else{var m=u.beforeCreate;u.beforeCreate=m?[].concat(m,l):[l]}return{exports:e,options:u}}s.d(t,{Z:()=>a})}}]);
//# sourceMappingURL=358.js.map