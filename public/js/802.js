(self.webpackChunkbigsite=self.webpackChunkbigsite||[]).push([[802],{5802:(t,i,n)=>{"use strict";n.r(i),n.d(i,{default:()=>o});const e={props:["userid"],data:function(){return{loading:!0,error:!1,success:!1,notifications:[]}},computed:{unreadMessages:function(){return this.notifications.filter((function(t){return null==t.read_at}))}},mounted:function(){var t=this;this.getNotifications(),Echo.private("App.User.".concat(this.userid)).notification((function(i){"Notification"in window?"granted"===Notification.permission?t.displayNotification(i):"denied"!==Notification.permission&&Notification.requestPermission().then((function(t){"granted"===t&&this.displayNotification(i)})):console.log("This browser does not support desktop notification"),t.notifications.unshift({data:{title:i.title,message:i.message,action:i.action,action_text:i.action_text},created_at:(new Date).toLocaleString()}),t.playSound()}))},methods:{playSound:function(){new Audio("/sounds/bell.mp3").play()},getNotifications:function(){var t=this;this.loading=!0,axios.get("/api/users/"+this.userid+"/notifications").then((function(i){t.notifications=i.data,t.loading=!1})).catch((function(i){console.log(i),t.loading=!1,t.error=!0}))},displayNotification:function(t){new Notification(t.title,{body:t.message,icon:"/images/logo.png"})}}};const o=(0,n(1900).Z)(e,(function(){var t=this,i=t.$createElement,n=t._self._c||i;return t.unreadMessages.length>0?n("span",{key:"notifications",staticClass:"text-primary",staticStyle:{background:"#246eba","border-radius":"50%",color:"#ffffff !important",display:"inline-block","line-height":"1.6em","margin-right":"5px","text-align":"center",width:"1.6em"}},[t._v("\n    "+t._s(t.unreadMessages.length)+"\n")]):t._e()}),[],!1,null,null,null).exports},1900:(t,i,n)=>{"use strict";function e(t,i,n,e,o,s,a,r){var c,d="function"==typeof t?t.options:t;if(i&&(d.render=i,d.staticRenderFns=n,d._compiled=!0),e&&(d.functional=!0),s&&(d._scopeId="data-v-"+s),a?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},d._ssrRegister=c):o&&(c=r?function(){o.call(this,(d.functional?this.parent:this).$root.$options.shadowRoot)}:o),c)if(d.functional){d._injectStyles=c;var f=d.render;d.render=function(t,i){return c.call(i),f(t,i)}}else{var l=d.beforeCreate;d.beforeCreate=l?[].concat(l,c):[c]}return{exports:t,options:d}}n.d(i,{Z:()=>e})}}]);
//# sourceMappingURL=802.js.map