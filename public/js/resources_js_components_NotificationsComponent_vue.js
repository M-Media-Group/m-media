/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunkbigsite"] = self["webpackChunkbigsite"] || []).push([["resources_js_components_NotificationsComponent_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NotificationsComponent.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NotificationsComponent.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => __WEBPACK_DEFAULT_EXPORT__\n/* harmony export */ });\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({\n  props: ['userid'],\n  data: function data() {\n    return {\n      loading: true,\n      error: false,\n      success: false,\n      notifications: []\n    };\n  },\n  mounted: function mounted() {\n    var _this = this;\n\n    this.getNotifications();\n    Echo[\"private\"](\"App.User.\".concat(this.userid)).notification(function (notification) {\n      _this.notifications.unshift({\n        data: {\n          title: notification.title,\n          message: notification.message,\n          action: notification.action,\n          action_text: notification.action_text\n        },\n        created_at: moment.now()\n      });\n    });\n  },\n  methods: {\n    timestamp: function timestamp(_timestamp) {\n      return moment(_timestamp).fromNow();\n    },\n    redirect: function redirect(notification) {\n      location.href = notification.data.action ? notification.data.action : '#';\n    },\n    getNotifications: function getNotifications() {\n      var _this2 = this;\n\n      this.loading = true; //data.append('_method', 'put'); // add this\n\n      axios.get('/api/users/' + this.userid + '/notifications') // change this to post )\n      .then(function (res) {\n        _this2.notifications = res.data;\n        _this2.loading = false;\n        console.log(_this2.notifications);\n      })[\"catch\"](function (error) {\n        console.log(error);\n        _this2.loading = false;\n        _this2.error = true;\n      });\n    }\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9iaWdzaXRlL3Jlc291cmNlcy9qcy9jb21wb25lbnRzL05vdGlmaWNhdGlvbnNDb21wb25lbnQudnVlPzM3YTYiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQW1CQTtBQUNBLG1CQURBO0FBRUEsTUFGQSxrQkFFQTtBQUNBO0FBQ0EsbUJBREE7QUFFQSxrQkFGQTtBQUdBLG9CQUhBO0FBSUE7QUFKQTtBQU1BLEdBVEE7QUFXQSxTQVhBLHFCQVdBO0FBQUE7O0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxtQ0FEQTtBQUVBLHVDQUZBO0FBR0EscUNBSEE7QUFJQTtBQUpBLFNBREE7QUFPQTtBQVBBO0FBU0EsS0FWQTtBQVdBLEdBeEJBO0FBeUJBO0FBQ0E7QUFDQTtBQUNBLEtBSEE7QUFLQTtBQUNBO0FBQ0EsS0FQQTtBQVNBO0FBQUE7O0FBQ0EsMEJBREEsQ0FFQTs7QUFDQSxZQUNBLEdBREEsQ0FDQSw4Q0FEQSxFQUNBO0FBREEsT0FFQSxJQUZBLENBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQSxPQU5BLFdBT0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxPQVhBO0FBWUE7QUF4QkE7QUF6QkEiLCJmaWxlIjoiLi9ub2RlX21vZHVsZXMvYmFiZWwtbG9hZGVyL2xpYi9pbmRleC5qcz8/Y2xvbmVkUnVsZVNldC01WzBdLnJ1bGVzWzBdLnVzZVswXSEuL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9pbmRleC5qcz8/dnVlLWxvYWRlci1vcHRpb25zIS4vcmVzb3VyY2VzL2pzL2NvbXBvbmVudHMvTm90aWZpY2F0aW9uc0NvbXBvbmVudC52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmLmpzIiwic291cmNlc0NvbnRlbnQiOlsiPHRlbXBsYXRlPlxuICAgIDx0cmFuc2l0aW9uLWdyb3VwIG5hbWU9XCJmYWRlXCIgbW9kZT1cIm91dC1pblwiIHRhZz1cImRpdlwiIHN0eWxlPVwid2lkdGg6IDEwMCVcIj5cbiAgICAgICAgPGRpdiB2LWlmPVwibm90aWZpY2F0aW9ucy5sZW5ndGggPiAwXCIga2V5PVwibm90aWZpY2F0aW9uc1wiPlxuICAgICAgICAgICAgPGFydGljbGUgdi1mb3I9XCJub3RpZmljYXRpb24gaW4gbm90aWZpY2F0aW9uc1wiIGNsYXNzPVwibm90aWZpY2F0aW9uXCIgc3R5bGU9XCJjdXJzb3I6IHBvaW50ZXJcIiBkYXRhLWFvcz1cImZhZGVcIiBAY2xpY2s9XCJyZWRpcmVjdChub3RpZmljYXRpb24pXCI+XG4gICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cIm5vdGlmaWNhdGlvbi1oZWFkZXJcIj5cbiAgICAgICAgICAgICAgICAgICAgPGg0Pnt7IG5vdGlmaWNhdGlvbi5kYXRhLnRpdGxlIH19PC9oND5cbiAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJ0ZXh0LW11dGVkXCIgdi1iaW5kOmNsYXNzPVwieyAndGV4dC1zZWNvbmRhcnknOiAhbm90aWZpY2F0aW9uLnJlYWRfYXQgfVwiPnt7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgdGltZXN0YW1wKG5vdGlmaWNhdGlvbi5jcmVhdGVkX2F0KVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH19PC9zcGFuPlxuICAgICAgICAgICAgICAgIDwvZGl2PlxuICAgICAgICAgICAgICAgIDxwIHN0eWxlPVwid2hpdGUtc3BhY2U6IHByZS13cmFwO1wiPnt7IG5vdGlmaWNhdGlvbi5kYXRhLm1lc3NhZ2UgfX08L3A+XG4gICAgICAgICAgICAgICAgPGEgY2xhc3M9XCJidXR0b24gYnV0dG9uLXByaW1hcnlcIiB2LWlmPVwibm90aWZpY2F0aW9uLmRhdGEuYWN0aW9uX3RleHRcIiA6aHJlZj1cIm5vdGlmaWNhdGlvbi5kYXRhLmFjdGlvblwiPnt7IG5vdGlmaWNhdGlvbi5kYXRhLmFjdGlvbl90ZXh0IH19PC9hPlxuICAgICAgICAgICAgPC9hcnRpY2xlPlxuICAgICAgICA8L2Rpdj5cbiAgICAgICAgPGRpdiB2LWVsc2UtaWY9XCJsb2FkaW5nXCIga2V5PVwibG9hZGluZ1wiIGNsYXNzPVwiYWxlcnRcIiBkYXRhLWFvcz1cImZhZGVcIj5Mb2FkaW5nLi4uPC9kaXY+XG4gICAgICAgIDxkaXYgdi1lbHNlIGNsYXNzPVwiYWxlcnQgdGV4dC1tdXRlZFwiIGtleT1cImVycm9yXCI+WW91IGhhdmUgbm8gbm90aWZpY2F0aW9ucy48L2Rpdj5cbiAgICA8L3RyYW5zaXRpb24tZ3JvdXA+XG48L3RlbXBsYXRlPlxuPHNjcmlwdD5cbmV4cG9ydCBkZWZhdWx0IHtcbiAgICBwcm9wczogWyd1c2VyaWQnXSxcbiAgICBkYXRhKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgbG9hZGluZzogdHJ1ZSxcbiAgICAgICAgICAgIGVycm9yOiBmYWxzZSxcbiAgICAgICAgICAgIHN1Y2Nlc3M6IGZhbHNlLFxuICAgICAgICAgICAgbm90aWZpY2F0aW9uczogW10sXG4gICAgICAgIH07XG4gICAgfSxcblxuICAgIG1vdW50ZWQoKSB7XG4gICAgICAgIHRoaXMuZ2V0Tm90aWZpY2F0aW9ucygpO1xuICAgICAgICBFY2hvLnByaXZhdGUoYEFwcC5Vc2VyLiR7dGhpcy51c2VyaWR9YCkubm90aWZpY2F0aW9uKChub3RpZmljYXRpb24pID0+IHtcbiAgICAgICAgICAgIHRoaXMubm90aWZpY2F0aW9ucy51bnNoaWZ0KHtcbiAgICAgICAgICAgICAgICBkYXRhOiB7XG4gICAgICAgICAgICAgICAgICAgIHRpdGxlOiBub3RpZmljYXRpb24udGl0bGUsXG4gICAgICAgICAgICAgICAgICAgIG1lc3NhZ2U6IG5vdGlmaWNhdGlvbi5tZXNzYWdlLFxuICAgICAgICAgICAgICAgICAgICBhY3Rpb246IG5vdGlmaWNhdGlvbi5hY3Rpb24sXG4gICAgICAgICAgICAgICAgICAgIGFjdGlvbl90ZXh0OiBub3RpZmljYXRpb24uYWN0aW9uX3RleHQsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICBjcmVhdGVkX2F0OiBtb21lbnQubm93KCksXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfSxcbiAgICBtZXRob2RzOiB7XG4gICAgICAgIHRpbWVzdGFtcDogZnVuY3Rpb24odGltZXN0YW1wKSB7XG4gICAgICAgICAgICByZXR1cm4gbW9tZW50KHRpbWVzdGFtcCkuZnJvbU5vdygpO1xuICAgICAgICB9LFxuXG4gICAgICAgIHJlZGlyZWN0OiBmdW5jdGlvbihub3RpZmljYXRpb24pIHtcbiAgICAgICAgICAgIGxvY2F0aW9uLmhyZWYgPSBub3RpZmljYXRpb24uZGF0YS5hY3Rpb24gPyBub3RpZmljYXRpb24uZGF0YS5hY3Rpb24gOiAnIyc7XG4gICAgICAgIH0sXG5cbiAgICAgICAgZ2V0Tm90aWZpY2F0aW9uczogZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICB0aGlzLmxvYWRpbmcgPSB0cnVlO1xuICAgICAgICAgICAgLy9kYXRhLmFwcGVuZCgnX21ldGhvZCcsICdwdXQnKTsgLy8gYWRkIHRoaXNcbiAgICAgICAgICAgIGF4aW9zXG4gICAgICAgICAgICAgICAgLmdldCgnL2FwaS91c2Vycy8nICsgdGhpcy51c2VyaWQgKyAnL25vdGlmaWNhdGlvbnMnKSAvLyBjaGFuZ2UgdGhpcyB0byBwb3N0IClcbiAgICAgICAgICAgICAgICAudGhlbigocmVzKSA9PiB7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMubm90aWZpY2F0aW9ucyA9IHJlcy5kYXRhO1xuICAgICAgICAgICAgICAgICAgICB0aGlzLmxvYWRpbmcgPSBmYWxzZTtcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2codGhpcy5ub3RpZmljYXRpb25zKTtcbiAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgIC5jYXRjaCgoZXJyb3IpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coZXJyb3IpO1xuICAgICAgICAgICAgICAgICAgICB0aGlzLmxvYWRpbmcgPSBmYWxzZTtcbiAgICAgICAgICAgICAgICAgICAgdGhpcy5lcnJvciA9IHRydWU7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgIH0sXG4gICAgfSxcbn07XG5cbjwvc2NyaXB0PlxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NotificationsComponent.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./resources/js/components/NotificationsComponent.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/NotificationsComponent.vue ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => __WEBPACK_DEFAULT_EXPORT__\n/* harmony export */ });\n/* harmony import */ var _NotificationsComponent_vue_vue_type_template_id_50fb5ac0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./NotificationsComponent.vue?vue&type=template&id=50fb5ac0& */ \"./resources/js/components/NotificationsComponent.vue?vue&type=template&id=50fb5ac0&\");\n/* harmony import */ var _NotificationsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./NotificationsComponent.vue?vue&type=script&lang=js& */ \"./resources/js/components/NotificationsComponent.vue?vue&type=script&lang=js&\");\n/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n/* normalize component */\n;\nvar component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(\n  _NotificationsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,\n  _NotificationsComponent_vue_vue_type_template_id_50fb5ac0___WEBPACK_IMPORTED_MODULE_0__.render,\n  _NotificationsComponent_vue_vue_type_template_id_50fb5ac0___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"resources/js/components/NotificationsComponent.vue\"\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9iaWdzaXRlLy4vcmVzb3VyY2VzL2pzL2NvbXBvbmVudHMvTm90aWZpY2F0aW9uc0NvbXBvbmVudC52dWU/NTdjMCJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7Ozs7O0FBQXFHO0FBQzNCO0FBQ0w7OztBQUdyRTtBQUNBLENBQTZGO0FBQzdGLGdCQUFnQixvR0FBVTtBQUMxQixFQUFFLHlGQUFNO0FBQ1IsRUFBRSw4RkFBTTtBQUNSLEVBQUUsdUdBQWU7QUFDakI7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7O0FBRUE7QUFDQSxJQUFJLEtBQVUsRUFBRSxZQWlCZjtBQUNEO0FBQ0EsaUVBQWUsaUIiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY29tcG9uZW50cy9Ob3RpZmljYXRpb25zQ29tcG9uZW50LnZ1ZS5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IHJlbmRlciwgc3RhdGljUmVuZGVyRm5zIH0gZnJvbSBcIi4vTm90aWZpY2F0aW9uc0NvbXBvbmVudC52dWU/dnVlJnR5cGU9dGVtcGxhdGUmaWQ9NTBmYjVhYzAmXCJcbmltcG9ydCBzY3JpcHQgZnJvbSBcIi4vTm90aWZpY2F0aW9uc0NvbXBvbmVudC52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmXCJcbmV4cG9ydCAqIGZyb20gXCIuL05vdGlmaWNhdGlvbnNDb21wb25lbnQudnVlP3Z1ZSZ0eXBlPXNjcmlwdCZsYW5nPWpzJlwiXG5cblxuLyogbm9ybWFsaXplIGNvbXBvbmVudCAqL1xuaW1wb3J0IG5vcm1hbGl6ZXIgZnJvbSBcIiEuLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvcnVudGltZS9jb21wb25lbnROb3JtYWxpemVyLmpzXCJcbnZhciBjb21wb25lbnQgPSBub3JtYWxpemVyKFxuICBzY3JpcHQsXG4gIHJlbmRlcixcbiAgc3RhdGljUmVuZGVyRm5zLFxuICBmYWxzZSxcbiAgbnVsbCxcbiAgbnVsbCxcbiAgbnVsbFxuICBcbilcblxuLyogaG90IHJlbG9hZCAqL1xuaWYgKG1vZHVsZS5ob3QpIHtcbiAgdmFyIGFwaSA9IHJlcXVpcmUoXCIvVXNlcnMvbXdhcmdhbi9Eb2N1bWVudHMvTU1lZGlhL2JpZ3NpdGUvbm9kZV9tb2R1bGVzL3Z1ZS1ob3QtcmVsb2FkLWFwaS9kaXN0L2luZGV4LmpzXCIpXG4gIGFwaS5pbnN0YWxsKHJlcXVpcmUoJ3Z1ZScpKVxuICBpZiAoYXBpLmNvbXBhdGlibGUpIHtcbiAgICBtb2R1bGUuaG90LmFjY2VwdCgpXG4gICAgaWYgKCFhcGkuaXNSZWNvcmRlZCgnNTBmYjVhYzAnKSkge1xuICAgICAgYXBpLmNyZWF0ZVJlY29yZCgnNTBmYjVhYzAnLCBjb21wb25lbnQub3B0aW9ucylcbiAgICB9IGVsc2Uge1xuICAgICAgYXBpLnJlbG9hZCgnNTBmYjVhYzAnLCBjb21wb25lbnQub3B0aW9ucylcbiAgICB9XG4gICAgbW9kdWxlLmhvdC5hY2NlcHQoXCIuL05vdGlmaWNhdGlvbnNDb21wb25lbnQudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTUwZmI1YWMwJlwiLCBmdW5jdGlvbiAoKSB7XG4gICAgICBhcGkucmVyZW5kZXIoJzUwZmI1YWMwJywge1xuICAgICAgICByZW5kZXI6IHJlbmRlcixcbiAgICAgICAgc3RhdGljUmVuZGVyRm5zOiBzdGF0aWNSZW5kZXJGbnNcbiAgICAgIH0pXG4gICAgfSlcbiAgfVxufVxuY29tcG9uZW50Lm9wdGlvbnMuX19maWxlID0gXCJyZXNvdXJjZXMvanMvY29tcG9uZW50cy9Ob3RpZmljYXRpb25zQ29tcG9uZW50LnZ1ZVwiXG5leHBvcnQgZGVmYXVsdCBjb21wb25lbnQuZXhwb3J0cyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/components/NotificationsComponent.vue\n");

/***/ }),

/***/ "./resources/js/components/NotificationsComponent.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/NotificationsComponent.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => __WEBPACK_DEFAULT_EXPORT__\n/* harmony export */ });\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./NotificationsComponent.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NotificationsComponent.vue?vue&type=script&lang=js&\");\n /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); //# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9iaWdzaXRlLy4vcmVzb3VyY2VzL2pzL2NvbXBvbmVudHMvTm90aWZpY2F0aW9uc0NvbXBvbmVudC52dWU/NDM0OCJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7OztBQUFnTyxDQUFDLGlFQUFlLHdOQUFHLEVBQUMiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY29tcG9uZW50cy9Ob3RpZmljYXRpb25zQ29tcG9uZW50LnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyYuanMiLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgbW9kIGZyb20gXCItIS4uLy4uLy4uL25vZGVfbW9kdWxlcy9iYWJlbC1sb2FkZXIvbGliL2luZGV4LmpzPz9jbG9uZWRSdWxlU2V0LTVbMF0ucnVsZXNbMF0udXNlWzBdIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9pbmRleC5qcz8/dnVlLWxvYWRlci1vcHRpb25zIS4vTm90aWZpY2F0aW9uc0NvbXBvbmVudC52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmXCI7IGV4cG9ydCBkZWZhdWx0IG1vZDsgZXhwb3J0ICogZnJvbSBcIi0hLi4vLi4vLi4vbm9kZV9tb2R1bGVzL2JhYmVsLWxvYWRlci9saWIvaW5kZXguanM/P2Nsb25lZFJ1bGVTZXQtNVswXS5ydWxlc1swXS51c2VbMF0hLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2luZGV4LmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi9Ob3RpZmljYXRpb25zQ29tcG9uZW50LnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/components/NotificationsComponent.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./resources/js/components/NotificationsComponent.vue?vue&type=template&id=50fb5ac0&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/NotificationsComponent.vue?vue&type=template&id=50fb5ac0& ***!
  \*******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationsComponent_vue_vue_type_template_id_50fb5ac0___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationsComponent_vue_vue_type_template_id_50fb5ac0___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationsComponent_vue_vue_type_template_id_50fb5ac0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./NotificationsComponent.vue?vue&type=template&id=50fb5ac0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NotificationsComponent.vue?vue&type=template&id=50fb5ac0&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NotificationsComponent.vue?vue&type=template&id=50fb5ac0&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NotificationsComponent.vue?vue&type=template&id=50fb5ac0& ***!
  \**********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"render\": () => /* binding */ render,\n/* harmony export */   \"staticRenderFns\": () => /* binding */ staticRenderFns\n/* harmony export */ });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\n    \"transition-group\",\n    {\n      staticStyle: { width: \"100%\" },\n      attrs: { name: \"fade\", mode: \"out-in\", tag: \"div\" }\n    },\n    [\n      _vm.notifications.length > 0\n        ? _c(\n            \"div\",\n            { key: \"notifications\" },\n            _vm._l(_vm.notifications, function(notification) {\n              return _c(\n                \"article\",\n                {\n                  staticClass: \"notification\",\n                  staticStyle: { cursor: \"pointer\" },\n                  attrs: { \"data-aos\": \"fade\" },\n                  on: {\n                    click: function($event) {\n                      return _vm.redirect(notification)\n                    }\n                  }\n                },\n                [\n                  _c(\"div\", { staticClass: \"notification-header\" }, [\n                    _c(\"h4\", [_vm._v(_vm._s(notification.data.title))]),\n                    _vm._v(\" \"),\n                    _c(\n                      \"span\",\n                      {\n                        staticClass: \"text-muted\",\n                        class: { \"text-secondary\": !notification.read_at }\n                      },\n                      [_vm._v(_vm._s(_vm.timestamp(notification.created_at)))]\n                    )\n                  ]),\n                  _vm._v(\" \"),\n                  _c(\"p\", { staticStyle: { \"white-space\": \"pre-wrap\" } }, [\n                    _vm._v(_vm._s(notification.data.message))\n                  ]),\n                  _vm._v(\" \"),\n                  notification.data.action_text\n                    ? _c(\n                        \"a\",\n                        {\n                          staticClass: \"button button-primary\",\n                          attrs: { href: notification.data.action }\n                        },\n                        [_vm._v(_vm._s(notification.data.action_text))]\n                      )\n                    : _vm._e()\n                ]\n              )\n            }),\n            0\n          )\n        : _vm.loading\n        ? _c(\n            \"div\",\n            {\n              key: \"loading\",\n              staticClass: \"alert\",\n              attrs: { \"data-aos\": \"fade\" }\n            },\n            [_vm._v(\"Loading...\")]\n          )\n        : _c(\"div\", { key: \"error\", staticClass: \"alert text-muted\" }, [\n            _vm._v(\"You have no notifications.\")\n          ])\n    ]\n  )\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9iaWdzaXRlLy4vcmVzb3VyY2VzL2pzL2NvbXBvbmVudHMvTm90aWZpY2F0aW9uc0NvbXBvbmVudC52dWU/NmI1NiJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7OztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0Esb0JBQW9CLGdCQUFnQjtBQUNwQyxjQUFjO0FBQ2QsS0FBSztBQUNMO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsYUFBYSx1QkFBdUI7QUFDcEM7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLGdDQUFnQyxvQkFBb0I7QUFDcEQsMEJBQTBCLHFCQUFxQjtBQUMvQztBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsaUJBQWlCO0FBQ2pCO0FBQ0EsNkJBQTZCLHFDQUFxQztBQUNsRTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxnQ0FBZ0M7QUFDaEMsdUJBQXVCO0FBQ3ZCO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsMkJBQTJCLGVBQWUsNEJBQTRCLEVBQUU7QUFDeEU7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLGtDQUFrQztBQUNsQyx5QkFBeUI7QUFDekI7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLGFBQWE7QUFDYjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0Esc0JBQXNCO0FBQ3RCLGFBQWE7QUFDYjtBQUNBO0FBQ0EscUJBQXFCLGdEQUFnRDtBQUNyRTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiIuL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9sb2FkZXJzL3RlbXBsYXRlTG9hZGVyLmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/P3Z1ZS1sb2FkZXItb3B0aW9ucyEuL3Jlc291cmNlcy9qcy9jb21wb25lbnRzL05vdGlmaWNhdGlvbnNDb21wb25lbnQudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTUwZmI1YWMwJi5qcyIsInNvdXJjZXNDb250ZW50IjpbInZhciByZW5kZXIgPSBmdW5jdGlvbigpIHtcbiAgdmFyIF92bSA9IHRoaXNcbiAgdmFyIF9oID0gX3ZtLiRjcmVhdGVFbGVtZW50XG4gIHZhciBfYyA9IF92bS5fc2VsZi5fYyB8fCBfaFxuICByZXR1cm4gX2MoXG4gICAgXCJ0cmFuc2l0aW9uLWdyb3VwXCIsXG4gICAge1xuICAgICAgc3RhdGljU3R5bGU6IHsgd2lkdGg6IFwiMTAwJVwiIH0sXG4gICAgICBhdHRyczogeyBuYW1lOiBcImZhZGVcIiwgbW9kZTogXCJvdXQtaW5cIiwgdGFnOiBcImRpdlwiIH1cbiAgICB9LFxuICAgIFtcbiAgICAgIF92bS5ub3RpZmljYXRpb25zLmxlbmd0aCA+IDBcbiAgICAgICAgPyBfYyhcbiAgICAgICAgICAgIFwiZGl2XCIsXG4gICAgICAgICAgICB7IGtleTogXCJub3RpZmljYXRpb25zXCIgfSxcbiAgICAgICAgICAgIF92bS5fbChfdm0ubm90aWZpY2F0aW9ucywgZnVuY3Rpb24obm90aWZpY2F0aW9uKSB7XG4gICAgICAgICAgICAgIHJldHVybiBfYyhcbiAgICAgICAgICAgICAgICBcImFydGljbGVcIixcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICBzdGF0aWNDbGFzczogXCJub3RpZmljYXRpb25cIixcbiAgICAgICAgICAgICAgICAgIHN0YXRpY1N0eWxlOiB7IGN1cnNvcjogXCJwb2ludGVyXCIgfSxcbiAgICAgICAgICAgICAgICAgIGF0dHJzOiB7IFwiZGF0YS1hb3NcIjogXCJmYWRlXCIgfSxcbiAgICAgICAgICAgICAgICAgIG9uOiB7XG4gICAgICAgICAgICAgICAgICAgIGNsaWNrOiBmdW5jdGlvbigkZXZlbnQpIHtcbiAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gX3ZtLnJlZGlyZWN0KG5vdGlmaWNhdGlvbilcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgW1xuICAgICAgICAgICAgICAgICAgX2MoXCJkaXZcIiwgeyBzdGF0aWNDbGFzczogXCJub3RpZmljYXRpb24taGVhZGVyXCIgfSwgW1xuICAgICAgICAgICAgICAgICAgICBfYyhcImg0XCIsIFtfdm0uX3YoX3ZtLl9zKG5vdGlmaWNhdGlvbi5kYXRhLnRpdGxlKSldKSxcbiAgICAgICAgICAgICAgICAgICAgX3ZtLl92KFwiIFwiKSxcbiAgICAgICAgICAgICAgICAgICAgX2MoXG4gICAgICAgICAgICAgICAgICAgICAgXCJzcGFuXCIsXG4gICAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgc3RhdGljQ2xhc3M6IFwidGV4dC1tdXRlZFwiLFxuICAgICAgICAgICAgICAgICAgICAgICAgY2xhc3M6IHsgXCJ0ZXh0LXNlY29uZGFyeVwiOiAhbm90aWZpY2F0aW9uLnJlYWRfYXQgfVxuICAgICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgICAgW192bS5fdihfdm0uX3MoX3ZtLnRpbWVzdGFtcChub3RpZmljYXRpb24uY3JlYXRlZF9hdCkpKV1cbiAgICAgICAgICAgICAgICAgICAgKVxuICAgICAgICAgICAgICAgICAgXSksXG4gICAgICAgICAgICAgICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgICAgICAgICAgICAgX2MoXCJwXCIsIHsgc3RhdGljU3R5bGU6IHsgXCJ3aGl0ZS1zcGFjZVwiOiBcInByZS13cmFwXCIgfSB9LCBbXG4gICAgICAgICAgICAgICAgICAgIF92bS5fdihfdm0uX3Mobm90aWZpY2F0aW9uLmRhdGEubWVzc2FnZSkpXG4gICAgICAgICAgICAgICAgICBdKSxcbiAgICAgICAgICAgICAgICAgIF92bS5fdihcIiBcIiksXG4gICAgICAgICAgICAgICAgICBub3RpZmljYXRpb24uZGF0YS5hY3Rpb25fdGV4dFxuICAgICAgICAgICAgICAgICAgICA/IF9jKFxuICAgICAgICAgICAgICAgICAgICAgICAgXCJhXCIsXG4gICAgICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgIHN0YXRpY0NsYXNzOiBcImJ1dHRvbiBidXR0b24tcHJpbWFyeVwiLFxuICAgICAgICAgICAgICAgICAgICAgICAgICBhdHRyczogeyBocmVmOiBub3RpZmljYXRpb24uZGF0YS5hY3Rpb24gfVxuICAgICAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAgICAgIFtfdm0uX3YoX3ZtLl9zKG5vdGlmaWNhdGlvbi5kYXRhLmFjdGlvbl90ZXh0KSldXG4gICAgICAgICAgICAgICAgICAgICAgKVxuICAgICAgICAgICAgICAgICAgICA6IF92bS5fZSgpXG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgICApXG4gICAgICAgICAgICB9KSxcbiAgICAgICAgICAgIDBcbiAgICAgICAgICApXG4gICAgICAgIDogX3ZtLmxvYWRpbmdcbiAgICAgICAgPyBfYyhcbiAgICAgICAgICAgIFwiZGl2XCIsXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgIGtleTogXCJsb2FkaW5nXCIsXG4gICAgICAgICAgICAgIHN0YXRpY0NsYXNzOiBcImFsZXJ0XCIsXG4gICAgICAgICAgICAgIGF0dHJzOiB7IFwiZGF0YS1hb3NcIjogXCJmYWRlXCIgfVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIFtfdm0uX3YoXCJMb2FkaW5nLi4uXCIpXVxuICAgICAgICAgIClcbiAgICAgICAgOiBfYyhcImRpdlwiLCB7IGtleTogXCJlcnJvclwiLCBzdGF0aWNDbGFzczogXCJhbGVydCB0ZXh0LW11dGVkXCIgfSwgW1xuICAgICAgICAgICAgX3ZtLl92KFwiWW91IGhhdmUgbm8gbm90aWZpY2F0aW9ucy5cIilcbiAgICAgICAgICBdKVxuICAgIF1cbiAgKVxufVxudmFyIHN0YXRpY1JlbmRlckZucyA9IFtdXG5yZW5kZXIuX3dpdGhTdHJpcHBlZCA9IHRydWVcblxuZXhwb3J0IHsgcmVuZGVyLCBzdGF0aWNSZW5kZXJGbnMgfSJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/NotificationsComponent.vue?vue&type=template&id=50fb5ac0&\n");

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