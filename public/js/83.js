(self.webpackChunk=self.webpackChunk||[]).push([[83],{9083:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>s});const o={props:["category"],data:function(){return{loading:!1,error:!1,posts:[]}},mounted:function(){this.getPosts()},methods:{getPosts:function(){var e=this;this.posts=[],this.loading=!0,delete axios.defaults.headers.common["X-Requested-With"],delete axios.defaults.headers.common["X-CSRF-TOKEN"],axios.get("https://blog.mmediagroup.fr/wp-json/wp/v2/posts?categories="+this.category+"&_embed",{responseType:"json"}).then((function(t){e.posts=t.data,e.loading=!1})).catch((function(t){console.log(t),e.loading=!1,e.error=!0}))}}};const s=(0,n(1900).Z)(o,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("ul",e._l(e.posts,(function(t){return n("li",[n("a",{attrs:{href:t.link,target:"_BLANK",rel:"noopener noreferrer"},domProps:{innerHTML:e._s(t.title.rendered)}})])})),0)}),[],!1,null,null,null).exports},1900:(e,t,n)=>{"use strict";function o(e,t,n,o,s,r,i,a){var d,c="function"==typeof e?e.options:e;if(t&&(c.render=t,c.staticRenderFns=n,c._compiled=!0),o&&(c.functional=!0),r&&(c._scopeId="data-v-"+r),i?(d=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),s&&s.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(i)},c._ssrRegister=d):s&&(d=a?function(){s.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:s),d)if(c.functional){c._injectStyles=d;var l=c.render;c.render=function(e,t){return d.call(t),l(e,t)}}else{var u=c.beforeCreate;c.beforeCreate=u?[].concat(u,d):[d]}return{exports:e,options:c}}n.d(t,{Z:()=>o})}}]);
//# sourceMappingURL=83.js.map