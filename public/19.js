webpackJsonp([19],{Bpx2:function(t,s,e){var n=e("VU/8")(e("xx+P"),e("FtqZ"),!1,null,null,null);t.exports=n.exports},FtqZ:function(t,s){t.exports={render:function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("transition-group",{staticStyle:{width:"100%"},attrs:{name:"fade",mode:"out-in",tag:"div"}},[t.ads.length>0?e("div",{key:"notifications",staticClass:"list-group"},t._l(t.ads,function(s){return e("article",{staticClass:"list-group-item list-group-item-action action-section round-all-round mt-5",staticStyle:{cursor:"pointer"},attrs:{"data-aos":"fade"}},[e("div",{staticClass:"d-flex w-100 justify-content-between"},[e("h5",{staticClass:"mb-1 mt-0"},[t._v(t._s(s.name))])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md"},[e("div",[t._v(t._s(s.impressions))]),t._v(" "),e("div",[t._v("Impressions")])]),t._v(" "),e("div",{staticClass:"col-md"},[e("div",[t._v(t._s(s.clicks))]),t._v(" "),e("div",[t._v("Clicks")])]),t._v(" "),e("div",{staticClass:"col-md"},[e("div",[t._v(t._s(s.conversions))]),t._v(" "),e("div",[t._v("Conversions")])])]),t._v(" "),e("div",{staticClass:"row mt-3"},[e("div",{staticClass:"col-md"},[e("div",[t._v(t._s(s.cost))]),t._v(" "),e("div",[t._v("Cost")])]),t._v(" "),e("div",{staticClass:"col-md"}),t._v(" "),e("div",{staticClass:"col-md"},[e("div",[t._v(t._s(s.conversion_rate))]),t._v(" "),e("div",[t._v("Conversion rate")])])])])}),0):t.loading?e("div",{key:"loading",staticClass:"alert",attrs:{"data-aos":"fade"}},[t._v("\n        Loading...\n    ")]):e("div",{key:"error",staticClass:"alert text-muted"},[t._v("\n        You have no ad accounts.\n    ")])])},staticRenderFns:[]}},"VU/8":function(t,s){t.exports=function(t,s,e,n,i,o){var a,r=t=t||{},d=typeof t.default;"object"!==d&&"function"!==d||(a=t,r=t.default);var c,l="function"==typeof r?r.options:r;if(s&&(l.render=s.render,l.staticRenderFns=s.staticRenderFns,l._compiled=!0),e&&(l.functional=!0),i&&(l._scopeId=i),o?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),n&&n.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},l._ssrRegister=c):n&&(c=n),c){var v=l.functional,_=v?l.render:l.beforeCreate;v?(l._injectStyles=c,l.render=function(t,s){return c.call(s),_(t,s)}):l.beforeCreate=_?[].concat(_,c):[c]}return{esModule:a,exports:r,options:l}}},"xx+P":function(t,s,e){"use strict";Object.defineProperty(s,"__esModule",{value:!0}),s.default={props:["adaccountid"],data:function(){return{loading:!0,error:!1,success:!1,ads:[]}},mounted:function(){this.getAds()},methods:{timestamp:function(t){return moment(t).fromNow()},getAds:function(){var t=this;this.loading=!0,axios.get("/api/ad-accounts/"+this.adaccountid).then(function(s){t.ads=s.data.ads,t.loading=!1}).catch(function(s){console.log(s),t.loading=!1,t.error=!0})}}}}});
//# sourceMappingURL=19.js.map