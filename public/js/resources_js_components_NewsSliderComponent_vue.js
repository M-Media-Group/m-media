/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunkbigsite"] = self["webpackChunkbigsite"] || []).push([["resources_js_components_NewsSliderComponent_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NewsSliderComponent.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NewsSliderComponent.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => __WEBPACK_DEFAULT_EXPORT__\n/* harmony export */ });\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({\n  name: 'carrousel',\n  data: function data() {\n    return {\n      swiperOptions: {\n        autoHeight: true,\n        loop: true,\n        preloadImages: false,\n        pagination: {\n          el: '.swiper-pagination',\n          type: 'bullets',\n          clickable: true\n        },\n        navigation: {\n          nextEl: '.swiper-button-next',\n          prevEl: '.swiper-button-prev'\n        } // Some Swiper option/callback...\n\n      },\n      news: [],\n      loading: false\n    };\n  },\n  computed: {\n    swiper: function swiper() {\n      return this.$refs.mySwiper.$swiper;\n    }\n  },\n  mounted: function mounted() {\n    // console.log('Current Swiper instance object', this.swiper)\n    this.getNews();\n  },\n  methods: {\n    getNews: function getNews() {\n      var _this = this;\n\n      this.news = [];\n      this.loading = true; //data.append('_method', 'put'); // add this\n\n      delete axios.defaults.headers.common['X-Requested-With'];\n      delete axios.defaults.headers.common['X-CSRF-TOKEN'];\n      delete axios.defaults.headers.common['X-SOCKET-ID'];\n      delete axios.defaults.headers.common['x-socket-id'];\n      axios.get('https://blog.mmediagroup.fr/wp-json/wp/v2/posts?parent_category=52&_embed', {\n        responseType: 'json' // withCredentials: true,\n\n      }) // change this to post )\n      .then(function (res) {\n        //console.log(res)\n        _this.news = res.data;\n        _this.loading = false;\n\n        _this.swiper.slideTo(1, 1000, false);\n      })[\"catch\"](function (error) {\n        console.log(error);\n        _this.loading = false;\n        _this.error = true;\n      }); //\n      //console.log(error);\n    }\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9iaWdzaXRlL3Jlc291cmNlcy9qcy9jb21wb25lbnRzL05ld3NTbGlkZXJDb21wb25lbnQudnVlPzMxMTciXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBa0JBO0FBQ0EsbUJBREE7QUFFQSxNQUZBLGtCQUVBO0FBQ0E7QUFDQTtBQUNBLHdCQURBO0FBRUEsa0JBRkE7QUFHQSw0QkFIQTtBQUlBO0FBQ0Esa0NBREE7QUFFQSx5QkFGQTtBQUdBO0FBSEEsU0FKQTtBQVNBO0FBQ0EsdUNBREE7QUFFQTtBQUZBLFNBVEEsQ0FhQTs7QUFiQSxPQURBO0FBZ0JBLGNBaEJBO0FBaUJBO0FBakJBO0FBbUJBLEdBdEJBO0FBdUJBO0FBQ0EsVUFEQSxvQkFDQTtBQUNBO0FBQ0E7QUFIQSxHQXZCQTtBQTRCQSxTQTVCQSxxQkE0QkE7QUFDQTtBQUNBO0FBQ0EsR0EvQkE7QUFnQ0E7QUFDQTtBQUFBOztBQUNBO0FBQ0EsMEJBRkEsQ0FHQTs7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBLFlBQ0EsR0FEQSxDQUNBLDJFQURBLEVBQ0E7QUFDQSw0QkFEQSxDQUVBOztBQUZBLE9BREEsRUFJQTtBQUpBLE9BS0EsSUFMQSxDQUtBO0FBQ0E7QUFDQTtBQUNBOztBQUNBO0FBQ0EsT0FWQSxXQVdBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsT0FmQSxFQVRBLENBeUJBO0FBQ0E7QUFDQTtBQTVCQTtBQWhDQSIsImZpbGUiOiIuL25vZGVfbW9kdWxlcy9iYWJlbC1sb2FkZXIvbGliL2luZGV4LmpzPz9jbG9uZWRSdWxlU2V0LTVbMF0ucnVsZXNbMF0udXNlWzBdIS4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2luZGV4LmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi9yZXNvdXJjZXMvanMvY29tcG9uZW50cy9OZXdzU2xpZGVyQ29tcG9uZW50LnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyYuanMiLCJzb3VyY2VzQ29udGVudCI6WyI8dGVtcGxhdGU+XG4gICAgPHN3aXBlciByZWY9XCJteVN3aXBlclwiIDpvcHRpb25zPVwic3dpcGVyT3B0aW9uc1wiPlxuICAgICAgICA8c3dpcGVyLXNsaWRlIHYtZm9yPVwicG9zdCBpbiBuZXdzXCIgPlxuICAgICAgICAgICAgPGRpdiBjbGFzcz1cImhlYWRlci1zZWN0aW9uIHJvdyBtLTAgdGV4dC1jZW50ZXIgdS1iZy1wcmltYXJ5IHdpdGgtYmctZGVjIHUtYmctYmx1clwiIDpzdHlsZT1cIihwb3N0WydfZW1iZWRkZWQnXVsnd3A6ZmVhdHVyZWRtZWRpYSddID8gJ2JhY2tncm91bmQ6IHVybCgnK3Bvc3RbJ19lbWJlZGRlZCddWyd3cDpmZWF0dXJlZG1lZGlhJ11bMF0uc291cmNlX3VybCsnKSByZ2JhKDM2LDExMCwxODUsMC41MCk7YmFja2dyb3VuZC1ibGVuZC1tb2RlOiBtdWx0aXBseTsnIDogJycpKycgYmFja2dyb3VuZC1wb3NpdGlvbjogY2VudGVyIHRvcDtiYWNrZ3JvdW5kLXJlcGVhdDogbm8tcmVwZWF0O2JhY2tncm91bmQtc2l6ZTogY292ZXI7aGVpZ2h0OjEwMCU7J1wiPlxuICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJjb2wtbWQtMTJcIj5cbiAgICAgICAgICAgICAgICAgICAgPHAgY2xhc3M9XCJtYi0wIG10LTMgbS10ZXh0LWxhYmVsIG14LWF1dG9cIiBkYXRhLWFvcz1cImZhZGVcIiBkYXRhLWFvcy1kZWxheT1cIjE1MFwiPk5ld3M8L3A+XG4gICAgICAgICAgICAgICAgICAgIDxoMyBjbGFzcz1cIm10LTAgbXgtYXV0byB0ZXh0LXRpdGxlLWhlYWRpbmdcIiBkYXRhLWFvcz1cImZhZGVcIj57e3Bvc3QudGl0bGUucmVuZGVyZWR9fTwvaDM+XG4gICAgICAgICAgICAgICAgICAgIDxkaXYgZGF0YS1hb3M9XCJmYWRlXCIgY2xhc3M9XCJteC1hdXRvIG0tdGV4dC1ib2R5IGQtbm9uZSBkLW1kLWJsb2NrIG1iLW4zXCIgZGF0YS1hb3MtZGVsYXk9XCIzMDBcIiB2LWh0bWw9XCJwb3N0LmV4Y2VycHQucmVuZGVyZWRcIj48L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgPGEgY2xhc3M9XCJidXR0b24gYnV0dG9uLXNlY29uZGFyeSBtdC0wIG1iLTVcIiA6aHJlZj1cInBvc3QubGlua1wiIHRhcmdldD1cIl9CTEFOS1wiIGRhdGEtYW9zPVwiZmFkZVwiIGRhdGEtYW9zLWRlbGF5PVwiMzAwXCI+UmVhZCB0aGUgZnVsbCBhcnRpY2xlPC9hPlxuICAgICAgICAgICAgICAgIDwvZGl2PlxuICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgIDwvc3dpcGVyLXNsaWRlPlxuICAgICAgICA8ZGl2IGNsYXNzPVwic3dpcGVyLXBhZ2luYXRpb25cIiBzbG90PVwicGFnaW5hdGlvblwiPjwvZGl2PlxuICAgICAgICA8ZGl2IGNsYXNzPVwic3dpcGVyLWJ1dHRvbi1wcmV2XCIgc2xvdD1cImJ1dHRvbi1wcmV2XCI+PC9kaXY+XG4gICAgICAgIDxkaXYgY2xhc3M9XCJzd2lwZXItYnV0dG9uLW5leHRcIiBzbG90PVwiYnV0dG9uLW5leHRcIj48L2Rpdj5cbiAgICA8L3N3aXBlcj5cbjwvdGVtcGxhdGU+XG48c2NyaXB0PlxuZXhwb3J0IGRlZmF1bHQge1xuICAgIG5hbWU6ICdjYXJyb3VzZWwnLFxuICAgIGRhdGEoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzd2lwZXJPcHRpb25zOiB7XG4gICAgICAgICAgICAgICAgYXV0b0hlaWdodDogdHJ1ZSxcbiAgICAgICAgICAgICAgICBsb29wOiB0cnVlLFxuICAgICAgICAgICAgICAgIHByZWxvYWRJbWFnZXM6IGZhbHNlLFxuICAgICAgICAgICAgICAgIHBhZ2luYXRpb246IHtcbiAgICAgICAgICAgICAgICAgICAgZWw6ICcuc3dpcGVyLXBhZ2luYXRpb24nLFxuICAgICAgICAgICAgICAgICAgICB0eXBlOiAnYnVsbGV0cycsXG4gICAgICAgICAgICAgICAgICAgIGNsaWNrYWJsZTp0cnVlLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgbmF2aWdhdGlvbjoge1xuICAgICAgICAgICAgICAgICAgICBuZXh0RWw6ICcuc3dpcGVyLWJ1dHRvbi1uZXh0JyxcbiAgICAgICAgICAgICAgICAgICAgcHJldkVsOiAnLnN3aXBlci1idXR0b24tcHJldicsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAvLyBTb21lIFN3aXBlciBvcHRpb24vY2FsbGJhY2suLi5cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBuZXdzOiBbXSxcbiAgICAgICAgICAgIGxvYWRpbmc6IGZhbHNlLFxuICAgICAgICB9XG4gICAgfSxcbiAgICBjb21wdXRlZDoge1xuICAgICAgICBzd2lwZXIoKSB7XG4gICAgICAgICAgICByZXR1cm4gdGhpcy4kcmVmcy5teVN3aXBlci4kc3dpcGVyXG4gICAgICAgIH1cbiAgICB9LFxuICAgIG1vdW50ZWQoKSB7XG4gICAgICAgIC8vIGNvbnNvbGUubG9nKCdDdXJyZW50IFN3aXBlciBpbnN0YW5jZSBvYmplY3QnLCB0aGlzLnN3aXBlcilcbiAgICAgICAgdGhpcy5nZXROZXdzKClcbiAgICB9LFxuICAgIG1ldGhvZHM6IHtcbiAgICAgICAgZ2V0TmV3czogZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICB0aGlzLm5ld3MgPSBbXTtcbiAgICAgICAgICAgIHRoaXMubG9hZGluZyA9IHRydWU7XG4gICAgICAgICAgICAvL2RhdGEuYXBwZW5kKCdfbWV0aG9kJywgJ3B1dCcpOyAvLyBhZGQgdGhpc1xuICAgICAgICAgICAgZGVsZXRlIGF4aW9zLmRlZmF1bHRzLmhlYWRlcnMuY29tbW9uWydYLVJlcXVlc3RlZC1XaXRoJ107XG4gICAgICAgICAgICBkZWxldGUgYXhpb3MuZGVmYXVsdHMuaGVhZGVycy5jb21tb25bJ1gtQ1NSRi1UT0tFTiddO1xuICAgICAgICAgICAgZGVsZXRlIGF4aW9zLmRlZmF1bHRzLmhlYWRlcnMuY29tbW9uWydYLVNPQ0tFVC1JRCddO1xuICAgICAgICAgICAgZGVsZXRlIGF4aW9zLmRlZmF1bHRzLmhlYWRlcnMuY29tbW9uWyd4LXNvY2tldC1pZCddO1xuXG4gICAgICAgICAgICBheGlvc1xuICAgICAgICAgICAgICAgIC5nZXQoJ2h0dHBzOi8vYmxvZy5tbWVkaWFncm91cC5mci93cC1qc29uL3dwL3YyL3Bvc3RzP3BhcmVudF9jYXRlZ29yeT01MiZfZW1iZWQnLCB7XG4gICAgICAgICAgICAgICAgICAgIHJlc3BvbnNlVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgICAgICAgICAvLyB3aXRoQ3JlZGVudGlhbHM6IHRydWUsXG4gICAgICAgICAgICAgICAgfSkgLy8gY2hhbmdlIHRoaXMgdG8gcG9zdCApXG4gICAgICAgICAgICAgICAgLnRoZW4oKHJlcykgPT4ge1xuICAgICAgICAgICAgICAgICAgICAvL2NvbnNvbGUubG9nKHJlcylcbiAgICAgICAgICAgICAgICAgICAgdGhpcy5uZXdzID0gcmVzLmRhdGE7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMubG9hZGluZyA9IGZhbHNlO1xuICAgICAgICAgICAgICAgICAgICB0aGlzLnN3aXBlci5zbGlkZVRvKDEsIDEwMDAsIGZhbHNlKVxuICAgICAgICAgICAgICAgIH0pXG4gICAgICAgICAgICAgICAgLmNhdGNoKChlcnJvcikgPT4ge1xuICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyhlcnJvcik7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMubG9hZGluZyA9IGZhbHNlO1xuICAgICAgICAgICAgICAgICAgICB0aGlzLmVycm9yID0gdHJ1ZTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIC8vXG4gICAgICAgICAgICAvL2NvbnNvbGUubG9nKGVycm9yKTtcbiAgICAgICAgfSxcbiAgICB9XG59XG5cbjwvc2NyaXB0PlxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NewsSliderComponent.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./resources/js/components/NewsSliderComponent.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/NewsSliderComponent.vue ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => __WEBPACK_DEFAULT_EXPORT__\n/* harmony export */ });\n/* harmony import */ var _NewsSliderComponent_vue_vue_type_template_id_c13b61a4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./NewsSliderComponent.vue?vue&type=template&id=c13b61a4& */ \"./resources/js/components/NewsSliderComponent.vue?vue&type=template&id=c13b61a4&\");\n/* harmony import */ var _NewsSliderComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./NewsSliderComponent.vue?vue&type=script&lang=js& */ \"./resources/js/components/NewsSliderComponent.vue?vue&type=script&lang=js&\");\n/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n/* normalize component */\n;\nvar component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(\n  _NewsSliderComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,\n  _NewsSliderComponent_vue_vue_type_template_id_c13b61a4___WEBPACK_IMPORTED_MODULE_0__.render,\n  _NewsSliderComponent_vue_vue_type_template_id_c13b61a4___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"resources/js/components/NewsSliderComponent.vue\"\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9iaWdzaXRlLy4vcmVzb3VyY2VzL2pzL2NvbXBvbmVudHMvTmV3c1NsaWRlckNvbXBvbmVudC52dWU/ZDEwNiJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7Ozs7O0FBQWtHO0FBQzNCO0FBQ0w7OztBQUdsRTtBQUNBLENBQTZGO0FBQzdGLGdCQUFnQixvR0FBVTtBQUMxQixFQUFFLHNGQUFNO0FBQ1IsRUFBRSwyRkFBTTtBQUNSLEVBQUUsb0dBQWU7QUFDakI7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7O0FBRUE7QUFDQSxJQUFJLEtBQVUsRUFBRSxZQWlCZjtBQUNEO0FBQ0EsaUVBQWUsaUIiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY29tcG9uZW50cy9OZXdzU2xpZGVyQ29tcG9uZW50LnZ1ZS5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IHJlbmRlciwgc3RhdGljUmVuZGVyRm5zIH0gZnJvbSBcIi4vTmV3c1NsaWRlckNvbXBvbmVudC52dWU/dnVlJnR5cGU9dGVtcGxhdGUmaWQ9YzEzYjYxYTQmXCJcbmltcG9ydCBzY3JpcHQgZnJvbSBcIi4vTmV3c1NsaWRlckNvbXBvbmVudC52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmXCJcbmV4cG9ydCAqIGZyb20gXCIuL05ld3NTbGlkZXJDb21wb25lbnQudnVlP3Z1ZSZ0eXBlPXNjcmlwdCZsYW5nPWpzJlwiXG5cblxuLyogbm9ybWFsaXplIGNvbXBvbmVudCAqL1xuaW1wb3J0IG5vcm1hbGl6ZXIgZnJvbSBcIiEuLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvcnVudGltZS9jb21wb25lbnROb3JtYWxpemVyLmpzXCJcbnZhciBjb21wb25lbnQgPSBub3JtYWxpemVyKFxuICBzY3JpcHQsXG4gIHJlbmRlcixcbiAgc3RhdGljUmVuZGVyRm5zLFxuICBmYWxzZSxcbiAgbnVsbCxcbiAgbnVsbCxcbiAgbnVsbFxuICBcbilcblxuLyogaG90IHJlbG9hZCAqL1xuaWYgKG1vZHVsZS5ob3QpIHtcbiAgdmFyIGFwaSA9IHJlcXVpcmUoXCIvVXNlcnMvbXdhcmdhbi9Eb2N1bWVudHMvTU1lZGlhL2JpZ3NpdGUvbm9kZV9tb2R1bGVzL3Z1ZS1ob3QtcmVsb2FkLWFwaS9kaXN0L2luZGV4LmpzXCIpXG4gIGFwaS5pbnN0YWxsKHJlcXVpcmUoJ3Z1ZScpKVxuICBpZiAoYXBpLmNvbXBhdGlibGUpIHtcbiAgICBtb2R1bGUuaG90LmFjY2VwdCgpXG4gICAgaWYgKCFhcGkuaXNSZWNvcmRlZCgnYzEzYjYxYTQnKSkge1xuICAgICAgYXBpLmNyZWF0ZVJlY29yZCgnYzEzYjYxYTQnLCBjb21wb25lbnQub3B0aW9ucylcbiAgICB9IGVsc2Uge1xuICAgICAgYXBpLnJlbG9hZCgnYzEzYjYxYTQnLCBjb21wb25lbnQub3B0aW9ucylcbiAgICB9XG4gICAgbW9kdWxlLmhvdC5hY2NlcHQoXCIuL05ld3NTbGlkZXJDb21wb25lbnQudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPWMxM2I2MWE0JlwiLCBmdW5jdGlvbiAoKSB7XG4gICAgICBhcGkucmVyZW5kZXIoJ2MxM2I2MWE0Jywge1xuICAgICAgICByZW5kZXI6IHJlbmRlcixcbiAgICAgICAgc3RhdGljUmVuZGVyRm5zOiBzdGF0aWNSZW5kZXJGbnNcbiAgICAgIH0pXG4gICAgfSlcbiAgfVxufVxuY29tcG9uZW50Lm9wdGlvbnMuX19maWxlID0gXCJyZXNvdXJjZXMvanMvY29tcG9uZW50cy9OZXdzU2xpZGVyQ29tcG9uZW50LnZ1ZVwiXG5leHBvcnQgZGVmYXVsdCBjb21wb25lbnQuZXhwb3J0cyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/components/NewsSliderComponent.vue\n");

/***/ }),

/***/ "./resources/js/components/NewsSliderComponent.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/NewsSliderComponent.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => __WEBPACK_DEFAULT_EXPORT__\n/* harmony export */ });\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NewsSliderComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./NewsSliderComponent.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NewsSliderComponent.vue?vue&type=script&lang=js&\");\n /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NewsSliderComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); //# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9iaWdzaXRlLy4vcmVzb3VyY2VzL2pzL2NvbXBvbmVudHMvTmV3c1NsaWRlckNvbXBvbmVudC52dWU/ODc0ZSJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7OztBQUE2TixDQUFDLGlFQUFlLHFOQUFHLEVBQUMiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY29tcG9uZW50cy9OZXdzU2xpZGVyQ29tcG9uZW50LnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyYuanMiLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgbW9kIGZyb20gXCItIS4uLy4uLy4uL25vZGVfbW9kdWxlcy9iYWJlbC1sb2FkZXIvbGliL2luZGV4LmpzPz9jbG9uZWRSdWxlU2V0LTVbMF0ucnVsZXNbMF0udXNlWzBdIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9pbmRleC5qcz8/dnVlLWxvYWRlci1vcHRpb25zIS4vTmV3c1NsaWRlckNvbXBvbmVudC52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmXCI7IGV4cG9ydCBkZWZhdWx0IG1vZDsgZXhwb3J0ICogZnJvbSBcIi0hLi4vLi4vLi4vbm9kZV9tb2R1bGVzL2JhYmVsLWxvYWRlci9saWIvaW5kZXguanM/P2Nsb25lZFJ1bGVTZXQtNVswXS5ydWxlc1swXS51c2VbMF0hLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2luZGV4LmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi9OZXdzU2xpZGVyQ29tcG9uZW50LnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/components/NewsSliderComponent.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./resources/js/components/NewsSliderComponent.vue?vue&type=template&id=c13b61a4&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/NewsSliderComponent.vue?vue&type=template&id=c13b61a4& ***!
  \****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NewsSliderComponent_vue_vue_type_template_id_c13b61a4___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NewsSliderComponent_vue_vue_type_template_id_c13b61a4___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NewsSliderComponent_vue_vue_type_template_id_c13b61a4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./NewsSliderComponent.vue?vue&type=template&id=c13b61a4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NewsSliderComponent.vue?vue&type=template&id=c13b61a4&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NewsSliderComponent.vue?vue&type=template&id=c13b61a4&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NewsSliderComponent.vue?vue&type=template&id=c13b61a4& ***!
  \*******************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"render\": () => /* binding */ render,\n/* harmony export */   \"staticRenderFns\": () => /* binding */ staticRenderFns\n/* harmony export */ });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\n    \"swiper\",\n    { ref: \"mySwiper\", attrs: { options: _vm.swiperOptions } },\n    [\n      _vm._l(_vm.news, function(post) {\n        return _c(\"swiper-slide\", [\n          _c(\n            \"div\",\n            {\n              staticClass:\n                \"header-section row m-0 text-center u-bg-primary with-bg-dec u-bg-blur\",\n              style:\n                (post[\"_embedded\"][\"wp:featuredmedia\"]\n                  ? \"background: url(\" +\n                    post[\"_embedded\"][\"wp:featuredmedia\"][0].source_url +\n                    \") rgba(36,110,185,0.50);background-blend-mode: multiply;\"\n                  : \"\") +\n                \" background-position: center top;background-repeat: no-repeat;background-size: cover;height:100%;\"\n            },\n            [\n              _c(\"div\", { staticClass: \"col-md-12\" }, [\n                _c(\n                  \"p\",\n                  {\n                    staticClass: \"mb-0 mt-3 m-text-label mx-auto\",\n                    attrs: { \"data-aos\": \"fade\", \"data-aos-delay\": \"150\" }\n                  },\n                  [_vm._v(\"News\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"h3\",\n                  {\n                    staticClass: \"mt-0 mx-auto text-title-heading\",\n                    attrs: { \"data-aos\": \"fade\" }\n                  },\n                  [_vm._v(_vm._s(post.title.rendered))]\n                ),\n                _vm._v(\" \"),\n                _c(\"div\", {\n                  staticClass: \"mx-auto m-text-body d-none d-md-block mb-n3\",\n                  attrs: { \"data-aos\": \"fade\", \"data-aos-delay\": \"300\" },\n                  domProps: { innerHTML: _vm._s(post.excerpt.rendered) }\n                }),\n                _vm._v(\" \"),\n                _c(\n                  \"a\",\n                  {\n                    staticClass: \"button button-secondary mt-0 mb-5\",\n                    attrs: {\n                      href: post.link,\n                      target: \"_BLANK\",\n                      \"data-aos\": \"fade\",\n                      \"data-aos-delay\": \"300\"\n                    }\n                  },\n                  [_vm._v(\"Read the full article\")]\n                )\n              ])\n            ]\n          )\n        ])\n      }),\n      _vm._v(\" \"),\n      _c(\"div\", {\n        staticClass: \"swiper-pagination\",\n        attrs: { slot: \"pagination\" },\n        slot: \"pagination\"\n      }),\n      _vm._v(\" \"),\n      _c(\"div\", {\n        staticClass: \"swiper-button-prev\",\n        attrs: { slot: \"button-prev\" },\n        slot: \"button-prev\"\n      }),\n      _vm._v(\" \"),\n      _c(\"div\", {\n        staticClass: \"swiper-button-next\",\n        attrs: { slot: \"button-next\" },\n        slot: \"button-next\"\n      })\n    ],\n    2\n  )\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9iaWdzaXRlLy4vcmVzb3VyY2VzL2pzL2NvbXBvbmVudHMvTmV3c1NsaWRlckNvbXBvbmVudC52dWU/Y2FhNiJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7OztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLEtBQUssMEJBQTBCLDZCQUE2QixFQUFFO0FBQzlEO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLDZDQUE2QyxnQ0FBZ0M7QUFDN0U7QUFDQSxrREFBa0QsNkJBQTZCLHVCQUF1QixZQUFZO0FBQ2xILGFBQWE7QUFDYjtBQUNBLHlCQUF5QiwyQkFBMkI7QUFDcEQ7QUFDQTtBQUNBO0FBQ0E7QUFDQSw0QkFBNEI7QUFDNUIsbUJBQW1CO0FBQ25CO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsNEJBQTRCO0FBQzVCLG1CQUFtQjtBQUNuQjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsMEJBQTBCLDhDQUE4QztBQUN4RSw2QkFBNkI7QUFDN0IsaUJBQWlCO0FBQ2pCO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxtQkFBbUI7QUFDbkI7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsT0FBTztBQUNQO0FBQ0E7QUFDQTtBQUNBLGdCQUFnQixxQkFBcUI7QUFDckM7QUFDQSxPQUFPO0FBQ1A7QUFDQTtBQUNBO0FBQ0EsZ0JBQWdCLHNCQUFzQjtBQUN0QztBQUNBLE9BQU87QUFDUDtBQUNBO0FBQ0E7QUFDQSxnQkFBZ0Isc0JBQXNCO0FBQ3RDO0FBQ0EsT0FBTztBQUNQO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiIuL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9sb2FkZXJzL3RlbXBsYXRlTG9hZGVyLmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/P3Z1ZS1sb2FkZXItb3B0aW9ucyEuL3Jlc291cmNlcy9qcy9jb21wb25lbnRzL05ld3NTbGlkZXJDb21wb25lbnQudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPWMxM2I2MWE0Ji5qcyIsInNvdXJjZXNDb250ZW50IjpbInZhciByZW5kZXIgPSBmdW5jdGlvbigpIHtcbiAgdmFyIF92bSA9IHRoaXNcbiAgdmFyIF9oID0gX3ZtLiRjcmVhdGVFbGVtZW50XG4gIHZhciBfYyA9IF92bS5fc2VsZi5fYyB8fCBfaFxuICByZXR1cm4gX2MoXG4gICAgXCJzd2lwZXJcIixcbiAgICB7IHJlZjogXCJteVN3aXBlclwiLCBhdHRyczogeyBvcHRpb25zOiBfdm0uc3dpcGVyT3B0aW9ucyB9IH0sXG4gICAgW1xuICAgICAgX3ZtLl9sKF92bS5uZXdzLCBmdW5jdGlvbihwb3N0KSB7XG4gICAgICAgIHJldHVybiBfYyhcInN3aXBlci1zbGlkZVwiLCBbXG4gICAgICAgICAgX2MoXG4gICAgICAgICAgICBcImRpdlwiLFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICBzdGF0aWNDbGFzczpcbiAgICAgICAgICAgICAgICBcImhlYWRlci1zZWN0aW9uIHJvdyBtLTAgdGV4dC1jZW50ZXIgdS1iZy1wcmltYXJ5IHdpdGgtYmctZGVjIHUtYmctYmx1clwiLFxuICAgICAgICAgICAgICBzdHlsZTpcbiAgICAgICAgICAgICAgICAocG9zdFtcIl9lbWJlZGRlZFwiXVtcIndwOmZlYXR1cmVkbWVkaWFcIl1cbiAgICAgICAgICAgICAgICAgID8gXCJiYWNrZ3JvdW5kOiB1cmwoXCIgK1xuICAgICAgICAgICAgICAgICAgICBwb3N0W1wiX2VtYmVkZGVkXCJdW1wid3A6ZmVhdHVyZWRtZWRpYVwiXVswXS5zb3VyY2VfdXJsICtcbiAgICAgICAgICAgICAgICAgICAgXCIpIHJnYmEoMzYsMTEwLDE4NSwwLjUwKTtiYWNrZ3JvdW5kLWJsZW5kLW1vZGU6IG11bHRpcGx5O1wiXG4gICAgICAgICAgICAgICAgICA6IFwiXCIpICtcbiAgICAgICAgICAgICAgICBcIiBiYWNrZ3JvdW5kLXBvc2l0aW9uOiBjZW50ZXIgdG9wO2JhY2tncm91bmQtcmVwZWF0OiBuby1yZXBlYXQ7YmFja2dyb3VuZC1zaXplOiBjb3ZlcjtoZWlnaHQ6MTAwJTtcIlxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIFtcbiAgICAgICAgICAgICAgX2MoXCJkaXZcIiwgeyBzdGF0aWNDbGFzczogXCJjb2wtbWQtMTJcIiB9LCBbXG4gICAgICAgICAgICAgICAgX2MoXG4gICAgICAgICAgICAgICAgICBcInBcIixcbiAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgc3RhdGljQ2xhc3M6IFwibWItMCBtdC0zIG0tdGV4dC1sYWJlbCBteC1hdXRvXCIsXG4gICAgICAgICAgICAgICAgICAgIGF0dHJzOiB7IFwiZGF0YS1hb3NcIjogXCJmYWRlXCIsIFwiZGF0YS1hb3MtZGVsYXlcIjogXCIxNTBcIiB9XG4gICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgW192bS5fdihcIk5ld3NcIildXG4gICAgICAgICAgICAgICAgKSxcbiAgICAgICAgICAgICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgICAgICAgICAgIF9jKFxuICAgICAgICAgICAgICAgICAgXCJoM1wiLFxuICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICBzdGF0aWNDbGFzczogXCJtdC0wIG14LWF1dG8gdGV4dC10aXRsZS1oZWFkaW5nXCIsXG4gICAgICAgICAgICAgICAgICAgIGF0dHJzOiB7IFwiZGF0YS1hb3NcIjogXCJmYWRlXCIgfVxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgIFtfdm0uX3YoX3ZtLl9zKHBvc3QudGl0bGUucmVuZGVyZWQpKV1cbiAgICAgICAgICAgICAgICApLFxuICAgICAgICAgICAgICAgIF92bS5fdihcIiBcIiksXG4gICAgICAgICAgICAgICAgX2MoXCJkaXZcIiwge1xuICAgICAgICAgICAgICAgICAgc3RhdGljQ2xhc3M6IFwibXgtYXV0byBtLXRleHQtYm9keSBkLW5vbmUgZC1tZC1ibG9jayBtYi1uM1wiLFxuICAgICAgICAgICAgICAgICAgYXR0cnM6IHsgXCJkYXRhLWFvc1wiOiBcImZhZGVcIiwgXCJkYXRhLWFvcy1kZWxheVwiOiBcIjMwMFwiIH0sXG4gICAgICAgICAgICAgICAgICBkb21Qcm9wczogeyBpbm5lckhUTUw6IF92bS5fcyhwb3N0LmV4Y2VycHQucmVuZGVyZWQpIH1cbiAgICAgICAgICAgICAgICB9KSxcbiAgICAgICAgICAgICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgICAgICAgICAgIF9jKFxuICAgICAgICAgICAgICAgICAgXCJhXCIsXG4gICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIHN0YXRpY0NsYXNzOiBcImJ1dHRvbiBidXR0b24tc2Vjb25kYXJ5IG10LTAgbWItNVwiLFxuICAgICAgICAgICAgICAgICAgICBhdHRyczoge1xuICAgICAgICAgICAgICAgICAgICAgIGhyZWY6IHBvc3QubGluayxcbiAgICAgICAgICAgICAgICAgICAgICB0YXJnZXQ6IFwiX0JMQU5LXCIsXG4gICAgICAgICAgICAgICAgICAgICAgXCJkYXRhLWFvc1wiOiBcImZhZGVcIixcbiAgICAgICAgICAgICAgICAgICAgICBcImRhdGEtYW9zLWRlbGF5XCI6IFwiMzAwXCJcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgIFtfdm0uX3YoXCJSZWFkIHRoZSBmdWxsIGFydGljbGVcIildXG4gICAgICAgICAgICAgICAgKVxuICAgICAgICAgICAgICBdKVxuICAgICAgICAgICAgXVxuICAgICAgICAgIClcbiAgICAgICAgXSlcbiAgICAgIH0pLFxuICAgICAgX3ZtLl92KFwiIFwiKSxcbiAgICAgIF9jKFwiZGl2XCIsIHtcbiAgICAgICAgc3RhdGljQ2xhc3M6IFwic3dpcGVyLXBhZ2luYXRpb25cIixcbiAgICAgICAgYXR0cnM6IHsgc2xvdDogXCJwYWdpbmF0aW9uXCIgfSxcbiAgICAgICAgc2xvdDogXCJwYWdpbmF0aW9uXCJcbiAgICAgIH0pLFxuICAgICAgX3ZtLl92KFwiIFwiKSxcbiAgICAgIF9jKFwiZGl2XCIsIHtcbiAgICAgICAgc3RhdGljQ2xhc3M6IFwic3dpcGVyLWJ1dHRvbi1wcmV2XCIsXG4gICAgICAgIGF0dHJzOiB7IHNsb3Q6IFwiYnV0dG9uLXByZXZcIiB9LFxuICAgICAgICBzbG90OiBcImJ1dHRvbi1wcmV2XCJcbiAgICAgIH0pLFxuICAgICAgX3ZtLl92KFwiIFwiKSxcbiAgICAgIF9jKFwiZGl2XCIsIHtcbiAgICAgICAgc3RhdGljQ2xhc3M6IFwic3dpcGVyLWJ1dHRvbi1uZXh0XCIsXG4gICAgICAgIGF0dHJzOiB7IHNsb3Q6IFwiYnV0dG9uLW5leHRcIiB9LFxuICAgICAgICBzbG90OiBcImJ1dHRvbi1uZXh0XCJcbiAgICAgIH0pXG4gICAgXSxcbiAgICAyXG4gIClcbn1cbnZhciBzdGF0aWNSZW5kZXJGbnMgPSBbXVxucmVuZGVyLl93aXRoU3RyaXBwZWQgPSB0cnVlXG5cbmV4cG9ydCB7IHJlbmRlciwgc3RhdGljUmVuZGVyRm5zIH0iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NewsSliderComponent.vue?vue&type=template&id=c13b61a4&\n");

/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => /* binding */ normalizeComponent\n/* harmony export */ });\n/* globals __VUE_SSR_CONTEXT__ */\n\n// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).\n// This module is a runtime utility for cleaner component module output and will\n// be included in the final webpack user bundle.\n\nfunction normalizeComponent (\n  scriptExports,\n  render,\n  staticRenderFns,\n  functionalTemplate,\n  injectStyles,\n  scopeId,\n  moduleIdentifier, /* server only */\n  shadowMode /* vue-cli only */\n) {\n  // Vue.extend constructor export interop\n  var options = typeof scriptExports === 'function'\n    ? scriptExports.options\n    : scriptExports\n\n  // render functions\n  if (render) {\n    options.render = render\n    options.staticRenderFns = staticRenderFns\n    options._compiled = true\n  }\n\n  // functional template\n  if (functionalTemplate) {\n    options.functional = true\n  }\n\n  // scopedId\n  if (scopeId) {\n    options._scopeId = 'data-v-' + scopeId\n  }\n\n  var hook\n  if (moduleIdentifier) { // server build\n    hook = function (context) {\n      // 2.3 injection\n      context =\n        context || // cached call\n        (this.$vnode && this.$vnode.ssrContext) || // stateful\n        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional\n      // 2.2 with runInNewContext: true\n      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {\n        context = __VUE_SSR_CONTEXT__\n      }\n      // inject component styles\n      if (injectStyles) {\n        injectStyles.call(this, context)\n      }\n      // register component module identifier for async chunk inferrence\n      if (context && context._registeredComponents) {\n        context._registeredComponents.add(moduleIdentifier)\n      }\n    }\n    // used by ssr in case component is cached and beforeCreate\n    // never gets called\n    options._ssrRegister = hook\n  } else if (injectStyles) {\n    hook = shadowMode\n      ? function () {\n        injectStyles.call(\n          this,\n          (options.functional ? this.parent : this).$root.$options.shadowRoot\n        )\n      }\n      : injectStyles\n  }\n\n  if (hook) {\n    if (options.functional) {\n      // for template-only hot-reload because in that case the render fn doesn't\n      // go through the normalizer\n      options._injectStyles = hook\n      // register for functional component in vue file\n      var originalRender = options.render\n      options.render = function renderWithStyleInjection (h, context) {\n        hook.call(context)\n        return originalRender(h, context)\n      }\n    } else {\n      // inject component registration as beforeCreate hook\n      var existing = options.beforeCreate\n      options.beforeCreate = existing\n        ? [].concat(existing, hook)\n        : [hook]\n    }\n  }\n\n  return {\n    exports: scriptExports,\n    options: options\n  }\n}\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9iaWdzaXRlLy4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL3J1bnRpbWUvY29tcG9uZW50Tm9ybWFsaXplci5qcz8yODc3Il0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiI7Ozs7QUFBQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRWU7QUFDZjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQSx5QkFBeUI7QUFDekI7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxHQUFHO0FBQ0g7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxLQUFLO0FBQ0w7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiIuL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9ydW50aW1lL2NvbXBvbmVudE5vcm1hbGl6ZXIuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvKiBnbG9iYWxzIF9fVlVFX1NTUl9DT05URVhUX18gKi9cblxuLy8gSU1QT1JUQU5UOiBEbyBOT1QgdXNlIEVTMjAxNSBmZWF0dXJlcyBpbiB0aGlzIGZpbGUgKGV4Y2VwdCBmb3IgbW9kdWxlcykuXG4vLyBUaGlzIG1vZHVsZSBpcyBhIHJ1bnRpbWUgdXRpbGl0eSBmb3IgY2xlYW5lciBjb21wb25lbnQgbW9kdWxlIG91dHB1dCBhbmQgd2lsbFxuLy8gYmUgaW5jbHVkZWQgaW4gdGhlIGZpbmFsIHdlYnBhY2sgdXNlciBidW5kbGUuXG5cbmV4cG9ydCBkZWZhdWx0IGZ1bmN0aW9uIG5vcm1hbGl6ZUNvbXBvbmVudCAoXG4gIHNjcmlwdEV4cG9ydHMsXG4gIHJlbmRlcixcbiAgc3RhdGljUmVuZGVyRm5zLFxuICBmdW5jdGlvbmFsVGVtcGxhdGUsXG4gIGluamVjdFN0eWxlcyxcbiAgc2NvcGVJZCxcbiAgbW9kdWxlSWRlbnRpZmllciwgLyogc2VydmVyIG9ubHkgKi9cbiAgc2hhZG93TW9kZSAvKiB2dWUtY2xpIG9ubHkgKi9cbikge1xuICAvLyBWdWUuZXh0ZW5kIGNvbnN0cnVjdG9yIGV4cG9ydCBpbnRlcm9wXG4gIHZhciBvcHRpb25zID0gdHlwZW9mIHNjcmlwdEV4cG9ydHMgPT09ICdmdW5jdGlvbidcbiAgICA/IHNjcmlwdEV4cG9ydHMub3B0aW9uc1xuICAgIDogc2NyaXB0RXhwb3J0c1xuXG4gIC8vIHJlbmRlciBmdW5jdGlvbnNcbiAgaWYgKHJlbmRlcikge1xuICAgIG9wdGlvbnMucmVuZGVyID0gcmVuZGVyXG4gICAgb3B0aW9ucy5zdGF0aWNSZW5kZXJGbnMgPSBzdGF0aWNSZW5kZXJGbnNcbiAgICBvcHRpb25zLl9jb21waWxlZCA9IHRydWVcbiAgfVxuXG4gIC8vIGZ1bmN0aW9uYWwgdGVtcGxhdGVcbiAgaWYgKGZ1bmN0aW9uYWxUZW1wbGF0ZSkge1xuICAgIG9wdGlvbnMuZnVuY3Rpb25hbCA9IHRydWVcbiAgfVxuXG4gIC8vIHNjb3BlZElkXG4gIGlmIChzY29wZUlkKSB7XG4gICAgb3B0aW9ucy5fc2NvcGVJZCA9ICdkYXRhLXYtJyArIHNjb3BlSWRcbiAgfVxuXG4gIHZhciBob29rXG4gIGlmIChtb2R1bGVJZGVudGlmaWVyKSB7IC8vIHNlcnZlciBidWlsZFxuICAgIGhvb2sgPSBmdW5jdGlvbiAoY29udGV4dCkge1xuICAgICAgLy8gMi4zIGluamVjdGlvblxuICAgICAgY29udGV4dCA9XG4gICAgICAgIGNvbnRleHQgfHwgLy8gY2FjaGVkIGNhbGxcbiAgICAgICAgKHRoaXMuJHZub2RlICYmIHRoaXMuJHZub2RlLnNzckNvbnRleHQpIHx8IC8vIHN0YXRlZnVsXG4gICAgICAgICh0aGlzLnBhcmVudCAmJiB0aGlzLnBhcmVudC4kdm5vZGUgJiYgdGhpcy5wYXJlbnQuJHZub2RlLnNzckNvbnRleHQpIC8vIGZ1bmN0aW9uYWxcbiAgICAgIC8vIDIuMiB3aXRoIHJ1bkluTmV3Q29udGV4dDogdHJ1ZVxuICAgICAgaWYgKCFjb250ZXh0ICYmIHR5cGVvZiBfX1ZVRV9TU1JfQ09OVEVYVF9fICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICBjb250ZXh0ID0gX19WVUVfU1NSX0NPTlRFWFRfX1xuICAgICAgfVxuICAgICAgLy8gaW5qZWN0IGNvbXBvbmVudCBzdHlsZXNcbiAgICAgIGlmIChpbmplY3RTdHlsZXMpIHtcbiAgICAgICAgaW5qZWN0U3R5bGVzLmNhbGwodGhpcywgY29udGV4dClcbiAgICAgIH1cbiAgICAgIC8vIHJlZ2lzdGVyIGNvbXBvbmVudCBtb2R1bGUgaWRlbnRpZmllciBmb3IgYXN5bmMgY2h1bmsgaW5mZXJyZW5jZVxuICAgICAgaWYgKGNvbnRleHQgJiYgY29udGV4dC5fcmVnaXN0ZXJlZENvbXBvbmVudHMpIHtcbiAgICAgICAgY29udGV4dC5fcmVnaXN0ZXJlZENvbXBvbmVudHMuYWRkKG1vZHVsZUlkZW50aWZpZXIpXG4gICAgICB9XG4gICAgfVxuICAgIC8vIHVzZWQgYnkgc3NyIGluIGNhc2UgY29tcG9uZW50IGlzIGNhY2hlZCBhbmQgYmVmb3JlQ3JlYXRlXG4gICAgLy8gbmV2ZXIgZ2V0cyBjYWxsZWRcbiAgICBvcHRpb25zLl9zc3JSZWdpc3RlciA9IGhvb2tcbiAgfSBlbHNlIGlmIChpbmplY3RTdHlsZXMpIHtcbiAgICBob29rID0gc2hhZG93TW9kZVxuICAgICAgPyBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGluamVjdFN0eWxlcy5jYWxsKFxuICAgICAgICAgIHRoaXMsXG4gICAgICAgICAgKG9wdGlvbnMuZnVuY3Rpb25hbCA/IHRoaXMucGFyZW50IDogdGhpcykuJHJvb3QuJG9wdGlvbnMuc2hhZG93Um9vdFxuICAgICAgICApXG4gICAgICB9XG4gICAgICA6IGluamVjdFN0eWxlc1xuICB9XG5cbiAgaWYgKGhvb2spIHtcbiAgICBpZiAob3B0aW9ucy5mdW5jdGlvbmFsKSB7XG4gICAgICAvLyBmb3IgdGVtcGxhdGUtb25seSBob3QtcmVsb2FkIGJlY2F1c2UgaW4gdGhhdCBjYXNlIHRoZSByZW5kZXIgZm4gZG9lc24ndFxuICAgICAgLy8gZ28gdGhyb3VnaCB0aGUgbm9ybWFsaXplclxuICAgICAgb3B0aW9ucy5faW5qZWN0U3R5bGVzID0gaG9va1xuICAgICAgLy8gcmVnaXN0ZXIgZm9yIGZ1bmN0aW9uYWwgY29tcG9uZW50IGluIHZ1ZSBmaWxlXG4gICAgICB2YXIgb3JpZ2luYWxSZW5kZXIgPSBvcHRpb25zLnJlbmRlclxuICAgICAgb3B0aW9ucy5yZW5kZXIgPSBmdW5jdGlvbiByZW5kZXJXaXRoU3R5bGVJbmplY3Rpb24gKGgsIGNvbnRleHQpIHtcbiAgICAgICAgaG9vay5jYWxsKGNvbnRleHQpXG4gICAgICAgIHJldHVybiBvcmlnaW5hbFJlbmRlcihoLCBjb250ZXh0KVxuICAgICAgfVxuICAgIH0gZWxzZSB7XG4gICAgICAvLyBpbmplY3QgY29tcG9uZW50IHJlZ2lzdHJhdGlvbiBhcyBiZWZvcmVDcmVhdGUgaG9va1xuICAgICAgdmFyIGV4aXN0aW5nID0gb3B0aW9ucy5iZWZvcmVDcmVhdGVcbiAgICAgIG9wdGlvbnMuYmVmb3JlQ3JlYXRlID0gZXhpc3RpbmdcbiAgICAgICAgPyBbXS5jb25jYXQoZXhpc3RpbmcsIGhvb2spXG4gICAgICAgIDogW2hvb2tdXG4gICAgfVxuICB9XG5cbiAgcmV0dXJuIHtcbiAgICBleHBvcnRzOiBzY3JpcHRFeHBvcnRzLFxuICAgIG9wdGlvbnM6IG9wdGlvbnNcbiAgfVxufVxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./node_modules/vue-loader/lib/runtime/componentNormalizer.js\n");

/***/ })

}]);