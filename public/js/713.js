(self.webpackChunkbigsite=self.webpackChunkbigsite||[]).push([[713],{9782:(e,t,n)=>{"use strict";n.d(t,{Z:()=>o});var i=n(4015),r=n.n(i),a=n(3645),s=n.n(a)()(r());s.push([e.id,".timer[data-v-48de6218]{background:var(--white);border-radius:var(--border-radius);padding:0 1rem;color:var(--dark);margin-top:1rem;position:absolute;right:10%;top:1.5rem}.card>div.radio-input[data-v-48de6218]{padding:0;align-self:flex-start;margin-top:1rem}.card[data-v-48de6218]{padding-right:1rem;box-sizing:border-box}","",{version:3,sources:["webpack://./resources/js/components/InternshipSignup.vue"],names:[],mappings:"AAyOA,wBACA,uBAAA,CACA,kCAAA,CACA,cAAA,CACA,iBAAA,CACA,eAAA,CACA,iBAAA,CACA,SAAA,CACA,UACA,CACA,uCACA,SAAA,CACA,qBAAA,CACA,eACA,CAEA,uBACA,kBAAA,CACA,qBACA",sourcesContent:['<template>\n    <div>\n        <form method="POST" class="u-center" action="/custom-notifications" key="requestWebsiteForm" v-on:submit.prevent="current_tab === 6 ? updateFile() : (current_tab += 1)" v-show="!success && !error && !loading">\n            \x3c!--            <transition-group name="fade">\n --\x3e\n\n            \x3c!-- Intro --\x3e\n            <div v-if="current_tab == 0" key="tab_0" style="display: inline-block;">\n                <div style="height: 250px; margin: 0 auto; display: flex">\n                    <img src="/images/internship/intern.svg" style="height: 100%; margin: 0 auto" alt="Shop" />\n                </div>\n                <h1 class="u-center-text">Intern at M Media</h1>\n                <p class="u-center-text">Join a young and highly dynamic team. Work on real, meaningful, and thought-out projects. Get one to one training on your fields of interest.</p>\n            </div>\n            <div v-if="current_tab == 1" key="tab_1" style="display: inline-block;">\n                <h2 style="margin-top:10rem;">What’s your interest?</h2>\n                <div class="form-group row card flex" style="margin-bottom:1.5rem;">\n                    <div class="radio-input">\n                        <input id="web_dev_input" type="radio" autocomplete="off" placeholder="send_sms" class="form-control" name="interest" v-model="interest" required value="Web development">\n                    </div>\n                    <label for="web_dev_input" class="col-form-label">\n                        Web development\n                        <br/>\n                        <span class="text-muted" style="font-weight: initial;">You like code, and want to polish your HTML, CSS, and JS skills - sprinkled with some PHP.</span>\n                    </label>\n                </div>\n                <div class="form-group row card flex" style="margin-bottom:1.5rem;">\n                    <div class="radio-input">\n                        <input id="web_design_input" type="radio" autocomplete="off" placeholder="send_sms" class="form-control" name="interest" v-model="interest" required value="Web design">\n                    </div>\n                    <label for="web_design_input" class="col-form-label">\n                        Web design\n                        <br/>\n                        <span class="text-muted" style="font-weight: initial;">You love to draw, are interested in UX and UI, and have a great eye for design.</span>\n                    </label>\n                </div>\n                <div class="form-group row card flex" style="margin-bottom:1.5rem;">\n                    <div class="radio-input">\n                        <input id="marketing_input" type="radio" autocomplete="off" placeholder="send_sms" class="form-control" name="interest" v-model="interest" required value="Marketing">\n                    </div>\n                    <label for="marketing_input" class="col-form-label">\n                        Marketing\n                        <br/>\n                        <span class="text-muted" style="font-weight: initial;">You know what people are interested in, and can define, plan for, and target them effectively.</span>\n                    </label>\n                </div>\n            </div>\n            <div v-if="current_tab == 2" key="tab_2" style="display: inline-block;">\n                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">\n                    <img src="/images/internship/internship_questions.svg" style="height: 100%; margin: 0 auto;" alt="Person looking at computer screen" />\n                </div>\n                <h2>You’ll be given a 3 question test now.</h2>\n                <p>You have 1 minute per question to answer. If you navigate away or close the browser, you will automatically fail the tests. Do not panic, these tests only check to see if you think logically.</p>\n            </div>\n\n            \x3c!-- Questions --\x3e\n            <div v-if="current_tab == 3" key="tab_3" style="display: inline-block;">\n                <div class="bg-primary text-dark timer">0:{{time_left}}</div>\n                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">\n                    <img src="/images/internship/question-mark.svg" style="height: 100%; margin: 0 auto" alt="Shop" />\n                </div>\n                <h2>Question 1.</h2>\n                <p>A pen and paper cost £1.10 in total. The pen costs a pound more than the paper. How much does the paper cost?</p>\n                <label for="business_title" class="twelve columns col-form-label">Your answer</label>\n                <div class="twelve columns">\n                    <input name="business_title" v-model="q_1" id="business_title" class="form-control" type="text" minlength="1" maxlength="10" placeholder="Write your answer here" autocomplete="off" required autofocus data-hj-whitelist />\n                </div>\n            </div>\n            <div v-if="current_tab == 4" key="tab_3" style="display: inline-block;">\n                <div class="bg-primary text-dark timer">0:{{time_left}}</div>\n                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">\n                    <img src="/images/internship/question-mark.svg" style="height: 100%; margin: 0 auto; transform: rotate(-15deg);" alt="Shop" />\n                </div>\n                <h2>Question 2.</h2>\n                <p>If it takes 5 developers 5 minutes to make 5 widgets, how long would it take 100 developers to make 100 widgets?</p>\n                <label for="q_2" class="twelve columns col-form-label">Your answer</label>\n                <div class="twelve columns">\n                    <input name="q_2" v-model="q_2" id="q_2" class="form-control" type="text" minlength="1" maxlength="10" placeholder="Write your answer here" autocomplete="off" required autofocus data-hj-whitelist />\n                </div>\n            </div>\n            <div v-if="current_tab == 5" key="tab_3" style="display: inline-block;">\n                <div class="bg-primary text-dark timer">0:{{time_left}}</div>\n                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">\n                    <img src="/images/internship/question-mark.svg" style="height: 100%; margin: 0 auto; transform: rotate(-30deg);" alt="Shop" />\n                </div>\n                <h2>Last question, 3.</h2>\n                <p>In a lake, there is a patch of lily pads. Every day, the patch doubles in size. If it takes 48 days for the patch to cover the entire lake, how long would it take for the patch to cover half the lake?</p>\n                <label for="q_3" class="twelve columns col-form-label">Your answer</label>\n                <div class="twelve columns">\n                    <input name="q_3" v-model="q_3" id="q_3" class="form-control" type="text" minlength="1" maxlength="10" placeholder="Write your answer here" autocomplete="off" required autofocus data-hj-whitelist />\n                </div>\n            </div>\n\n            \x3c!-- CV upload --\x3e\n\n            <div v-if="current_tab == 6" key="tab_3" style="display: inline-block;">\n                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">\n                    <img src="/images/internship/cv_upload.svg" style="height: 100%; margin: 0 auto;" alt="Shop" />\n                </div>\n                <h2>Awesome, you’re almost done!</h2>\n                <p>Submit your CV with a phone number and email address. If we’re interested, we’ll be in touch!</p>\n                <label for="cv_file" class="twelve columns col-form-label">Your CV (PDF)</label>\n                <div class="twelve columns">\n                    <input name="cv_file" @change="newFile" id="cv_file" class="form-control" type="file" placeholder="Write your answer here" autocomplete="off" required autofocus data-hj-whitelist accept=".pdf" />\n                </div>\n            </div>\n\n            <div v-if="current_tab == 7" key="tab_4" style="display: inline-block;">\n                <div style="height: 250px; margin: 0 auto; display: flex">\n                    <img src="/images/tabletshop.svg" style="height: 100%; margin: 0 auto" alt="Shop" />\n                </div>\n                <h2>Hurray! You’ve applied for an internship. We’ll be in touch soon.</h2>\n            </div>\n            <div class="form-group row invert-columns" key="tab_buttons" v-if="current_tab !== 7">\n                <div class="six columns">\n                    <button type="submit" class="button button-primary u-full-width" v-if="current_tab === 6">\n                        Apply for an M Media internship\n                    </button>\n                    <button type="submit" class="button button-primary u-full-width" v-else-if="current_tab === 0">Apply now →</button>\n                    <button type="submit" class="button button-primary u-full-width" v-else @click="time_left = 60">Next →</button>\n                </div>\n                <div class="six columns order-md-6 d-none" v-bind:style="{ visibility: current_tab == 0 ? \'hidden\' : \'initial\' }">\n                    <a class="button" @click="current_tab -= 1"> ← </a>\n                </div>\n            </div>\n            \x3c!--             </transition-group>\n --\x3e\n        </form>\n        <div class="u-center" role="alert" v-show="loading" key="2">\n            Please wait. Your application is being sent...\n        </div>\n        <div class="u-center" role="alert" v-show="success" key="3">\n            <h2>Application sent!</h2>\n            <p>If we\'re interested, we\'ll be reaching out to you shortly on your email address.</p>\n        </div>\n        <div v-show="error" key="4">\n            <div class="u-center" role="alert">\n                Uh oh!\n                <div class="w-100 mt-5" v-html="error_msg"></div>\n                <br />\n                <a href="#" class="button button-primary" v-on:click.prevent="error = false">Go back</a>\n            </div>\n        </div>\n        \x3c!--         </transition-group>\n --\x3e\n    </div>\n</template>\n<script>\nexport default {\n    data() {\n        return {\n            loading: false,\n            error: false,\n            error_msg: false,\n            success: false,\n            progress: 0,\n            current_tab: 0,\n            time_left: 60,\n            timer: null,\n            interest: null,\n            q_1: null,\n            q_2: null,\n            q_3: null,\n            cv_file: null\n        };\n    },\n    mounted() {\n        this.startTimer();\n    },\n    methods: {\n        updateFile: function() {\n            let data = new FormData();\n            this.loading = true;\n            data.append(\'interest\', this.interest);\n            data.append(\'question_1\', this.q_1);\n            data.append(\'question_2\', this.q_2);\n            data.append(\'question_3\', this.q_3);\n            data.append(\'file\', this.cv_file);\n            window.scrollTo(0, 0);\n\n            //data.append(\'_method\', \'put\'); // add this\n            axios\n                .post(\'/api/internships\', data) // change this to post )\n                .then((res) => {\n                    this.success = true;\n                    this.error = false;\n                    console.log(res);\n                    this.loading = false;\n                    dataLayer.push({ event: \'internship-request\' });\n                    this.current_tab++;\n                })\n                .catch((error) => {\n                    this.error = true;\n                    this.success = false;\n                    this.error_msg = Object.entries(error.response.data.errors)\n                        .map(([error_name, error_value], i) => `<p class="mb-0">${error_name}: ${error_value[0]}</p>`)\n                        .join(\'\\n\');\n                    console.log(this.error_msg);\n                    //console.log(error.response.data.errors);\n                    this.loading = false;\n                }); //\n            //console.log(error);\n        },\n        newFile(event) {\n            let files = event.target.files;\n            if (files.length) {\n                this.cv_file = files[0];\n            }\n        },\n        startTimer: function() {\n            this.timer = setInterval(this.timerReduceTimeLeft, 1000);\n        },\n        timerReduceTimeLeft: function() {\n\n            if(this.time_left > 0) {\n                this.time_left--\n            } else {\n                if(this.current_tab === 6) {\n                    clearInterval(this.timer);\n                } else if (this.current_tab > 2) {\n                    this.current_tab++;\n                    this.time_left = 60;\n                }\n            }\n            if(this.time_left < 10) {\n                this.time_left = \'0\' + this.time_left;\n            }\n        }\n    },\n};\n\n<\/script>\n<style scoped>\n    .timer {\n        background: var(--white);\n        border-radius: var(--border-radius);\n        padding:0 1rem;\n        color: var(--dark);\n        margin-top: 1rem;\n        position: absolute;\n        right:10%;\n        top:1.5rem;\n    }\n    .card > div.radio-input {\n        padding: 0;\n        align-self: flex-start;\n        margin-top: 1rem;\n    }\n\n    .card {\n        padding-right: 1rem;\n        box-sizing: border-box;\n    }\n</style>'],sourceRoot:""}]);const o=s},3645:e=>{"use strict";e.exports=function(e){var t=[];return t.toString=function(){return this.map((function(t){var n=e(t);return t[2]?"@media ".concat(t[2]," {").concat(n,"}"):n})).join("")},t.i=function(e,n,i){"string"==typeof e&&(e=[[null,e,""]]);var r={};if(i)for(var a=0;a<this.length;a++){var s=this[a][0];null!=s&&(r[s]=!0)}for(var o=0;o<e.length;o++){var l=[].concat(e[o]);i&&r[l[0]]||(n&&(l[2]?l[2]="".concat(n," and ").concat(l[2]):l[2]=n),t.push(l))}},t}},4015:e=>{"use strict";function t(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if("undefined"==typeof Symbol||!(Symbol.iterator in Object(e)))return;var n=[],i=!0,r=!1,a=void 0;try{for(var s,o=e[Symbol.iterator]();!(i=(s=o.next()).done)&&(n.push(s.value),!t||n.length!==t);i=!0);}catch(e){r=!0,a=e}finally{try{i||null==o.return||o.return()}finally{if(r)throw a}}return n}(e,t)||function(e,t){if(!e)return;if("string"==typeof e)return n(e,t);var i=Object.prototype.toString.call(e).slice(8,-1);"Object"===i&&e.constructor&&(i=e.constructor.name);if("Map"===i||"Set"===i)return Array.from(e);if("Arguments"===i||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i))return n(e,t)}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,i=new Array(t);n<t;n++)i[n]=e[n];return i}e.exports=function(e){var n=t(e,4),i=n[1],r=n[3];if("function"==typeof btoa){var a=btoa(unescape(encodeURIComponent(JSON.stringify(r)))),s="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(a),o="/*# ".concat(s," */"),l=r.sources.map((function(e){return"/*# sourceURL=".concat(r.sourceRoot||"").concat(e," */")}));return[i].concat(l).concat([o]).join("\n")}return[i].join("\n")}},3379:(e,t,n)=>{"use strict";var i,r=function(){return void 0===i&&(i=Boolean(window&&document&&document.all&&!window.atob)),i},a=function(){var e={};return function(t){if(void 0===e[t]){var n=document.querySelector(t);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(e){n=null}e[t]=n}return e[t]}}(),s=[];function o(e){for(var t=-1,n=0;n<s.length;n++)if(s[n].identifier===e){t=n;break}return t}function l(e,t){for(var n={},i=[],r=0;r<e.length;r++){var a=e[r],l=t.base?a[0]+t.base:a[0],c=n[l]||0,u="".concat(l," ").concat(c);n[l]=c+1;var d=o(u),m={css:a[1],media:a[2],sourceMap:a[3]};-1!==d?(s[d].references++,s[d].updater(m)):s.push({identifier:u,updater:f(m,t),references:1}),i.push(u)}return i}function c(e){var t=document.createElement("style"),i=e.attributes||{};if(void 0===i.nonce){var r=n.nc;r&&(i.nonce=r)}if(Object.keys(i).forEach((function(e){t.setAttribute(e,i[e])})),"function"==typeof e.insert)e.insert(t);else{var s=a(e.insert||"head");if(!s)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");s.appendChild(t)}return t}var u,d=(u=[],function(e,t){return u[e]=t,u.filter(Boolean).join("\n")});function m(e,t,n,i){var r=n?"":i.media?"@media ".concat(i.media," {").concat(i.css,"}"):i.css;if(e.styleSheet)e.styleSheet.cssText=d(t,r);else{var a=document.createTextNode(r),s=e.childNodes;s[t]&&e.removeChild(s[t]),s.length?e.insertBefore(a,s[t]):e.appendChild(a)}}function p(e,t,n){var i=n.css,r=n.media,a=n.sourceMap;if(r?e.setAttribute("media",r):e.removeAttribute("media"),a&&"undefined"!=typeof btoa&&(i+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(a))))," */")),e.styleSheet)e.styleSheet.cssText=i;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(i))}}var v=null,h=0;function f(e,t){var n,i,r;if(t.singleton){var a=h++;n=v||(v=c(t)),i=m.bind(null,n,a,!1),r=m.bind(null,n,a,!0)}else n=c(t),i=p.bind(null,n,t),r=function(){!function(e){if(null===e.parentNode)return!1;e.parentNode.removeChild(e)}(n)};return i(e),function(t){if(t){if(t.css===e.css&&t.media===e.media&&t.sourceMap===e.sourceMap)return;i(e=t)}else r()}}e.exports=function(e,t){(t=t||{}).singleton||"boolean"==typeof t.singleton||(t.singleton=r());var n=l(e=e||[],t);return function(e){if(e=e||[],"[object Array]"===Object.prototype.toString.call(e)){for(var i=0;i<n.length;i++){var r=o(n[i]);s[r].references--}for(var a=l(e,t),c=0;c<n.length;c++){var u=o(n[c]);0===s[u].references&&(s[u].updater(),s.splice(u,1))}n=a}}}},4960:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>u});function i(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if("undefined"==typeof Symbol||!(Symbol.iterator in Object(e)))return;var n=[],i=!0,r=!1,a=void 0;try{for(var s,o=e[Symbol.iterator]();!(i=(s=o.next()).done)&&(n.push(s.value),!t||n.length!==t);i=!0);}catch(e){r=!0,a=e}finally{try{i||null==o.return||o.return()}finally{if(r)throw a}}return n}(e,t)||function(e,t){if(!e)return;if("string"==typeof e)return r(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return r(e,t)}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function r(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,i=new Array(t);n<t;n++)i[n]=e[n];return i}const a={data:function(){return{loading:!1,error:!1,error_msg:!1,success:!1,progress:0,current_tab:0,time_left:60,timer:null,interest:null,q_1:null,q_2:null,q_3:null,cv_file:null}},mounted:function(){this.startTimer()},methods:{updateFile:function(){var e=this,t=new FormData;this.loading=!0,t.append("interest",this.interest),t.append("question_1",this.q_1),t.append("question_2",this.q_2),t.append("question_3",this.q_3),t.append("file",this.cv_file),window.scrollTo(0,0),axios.post("/api/internships",t).then((function(t){e.success=!0,e.error=!1,console.log(t),e.loading=!1,dataLayer.push({event:"internship-request"}),e.current_tab++})).catch((function(t){e.error=!0,e.success=!1,e.error_msg=Object.entries(t.response.data.errors).map((function(e,t){var n=i(e,2),r=n[0],a=n[1];return'<p class="mb-0">'.concat(r,": ").concat(a[0],"</p>")})).join("\n"),console.log(e.error_msg),e.loading=!1}))},newFile:function(e){var t=e.target.files;t.length&&(this.cv_file=t[0])},startTimer:function(){this.timer=setInterval(this.timerReduceTimeLeft,1e3)},timerReduceTimeLeft:function(){this.time_left>0?this.time_left--:6===this.current_tab?clearInterval(this.timer):this.current_tab>2&&(this.current_tab++,this.time_left=60),this.time_left<10&&(this.time_left="0"+this.time_left)}}};var s=n(3379),o=n.n(s),l=n(9782),c={insert:"head",singleton:!1};o()(l.Z,c);l.Z.locals;const u=(0,n(1900).Z)(a,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("form",{directives:[{name:"show",rawName:"v-show",value:!e.success&&!e.error&&!e.loading,expression:"!success && !error && !loading"}],key:"requestWebsiteForm",staticClass:"u-center",attrs:{method:"POST",action:"/custom-notifications"},on:{submit:function(t){t.preventDefault(),6===e.current_tab?e.updateFile():e.current_tab+=1}}},[0==e.current_tab?n("div",{key:"tab_0",staticStyle:{display:"inline-block"}},[e._m(0),e._v(" "),n("h1",{staticClass:"u-center-text"},[e._v("Intern at M Media")]),e._v(" "),n("p",{staticClass:"u-center-text"},[e._v("Join a young and highly dynamic team. Work on real, meaningful, and thought-out projects. Get one to one training on your fields of interest.")])]):e._e(),e._v(" "),1==e.current_tab?n("div",{key:"tab_1",staticStyle:{display:"inline-block"}},[n("h2",{staticStyle:{"margin-top":"10rem"}},[e._v("What’s your interest?")]),e._v(" "),n("div",{staticClass:"form-group row card flex",staticStyle:{"margin-bottom":"1.5rem"}},[n("div",{staticClass:"radio-input"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.interest,expression:"interest"}],staticClass:"form-control",attrs:{id:"web_dev_input",type:"radio",autocomplete:"off",placeholder:"send_sms",name:"interest",required:"",value:"Web development"},domProps:{checked:e._q(e.interest,"Web development")},on:{change:function(t){e.interest="Web development"}}})]),e._v(" "),e._m(1)]),e._v(" "),n("div",{staticClass:"form-group row card flex",staticStyle:{"margin-bottom":"1.5rem"}},[n("div",{staticClass:"radio-input"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.interest,expression:"interest"}],staticClass:"form-control",attrs:{id:"web_design_input",type:"radio",autocomplete:"off",placeholder:"send_sms",name:"interest",required:"",value:"Web design"},domProps:{checked:e._q(e.interest,"Web design")},on:{change:function(t){e.interest="Web design"}}})]),e._v(" "),e._m(2)]),e._v(" "),n("div",{staticClass:"form-group row card flex",staticStyle:{"margin-bottom":"1.5rem"}},[n("div",{staticClass:"radio-input"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.interest,expression:"interest"}],staticClass:"form-control",attrs:{id:"marketing_input",type:"radio",autocomplete:"off",placeholder:"send_sms",name:"interest",required:"",value:"Marketing"},domProps:{checked:e._q(e.interest,"Marketing")},on:{change:function(t){e.interest="Marketing"}}})]),e._v(" "),e._m(3)])]):e._e(),e._v(" "),2==e.current_tab?n("div",{key:"tab_2",staticStyle:{display:"inline-block"}},[e._m(4),e._v(" "),n("h2",[e._v("You’ll be given a 3 question test now.")]),e._v(" "),n("p",[e._v("You have 1 minute per question to answer. If you navigate away or close the browser, you will automatically fail the tests. Do not panic, these tests only check to see if you think logically.")])]):e._e(),e._v(" "),3==e.current_tab?n("div",{key:"tab_3",staticStyle:{display:"inline-block"}},[n("div",{staticClass:"bg-primary text-dark timer"},[e._v("0:"+e._s(e.time_left))]),e._v(" "),e._m(5),e._v(" "),n("h2",[e._v("Question 1.")]),e._v(" "),n("p",[e._v("A pen and paper cost £1.10 in total. The pen costs a pound more than the paper. How much does the paper cost?")]),e._v(" "),n("label",{staticClass:"twelve columns col-form-label",attrs:{for:"business_title"}},[e._v("Your answer")]),e._v(" "),n("div",{staticClass:"twelve columns"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.q_1,expression:"q_1"}],staticClass:"form-control",attrs:{name:"business_title",id:"business_title",type:"text",minlength:"1",maxlength:"10",placeholder:"Write your answer here",autocomplete:"off",required:"",autofocus:"","data-hj-whitelist":""},domProps:{value:e.q_1},on:{input:function(t){t.target.composing||(e.q_1=t.target.value)}}})])]):e._e(),e._v(" "),4==e.current_tab?n("div",{key:"tab_3",staticStyle:{display:"inline-block"}},[n("div",{staticClass:"bg-primary text-dark timer"},[e._v("0:"+e._s(e.time_left))]),e._v(" "),e._m(6),e._v(" "),n("h2",[e._v("Question 2.")]),e._v(" "),n("p",[e._v("If it takes 5 developers 5 minutes to make 5 widgets, how long would it take 100 developers to make 100 widgets?")]),e._v(" "),n("label",{staticClass:"twelve columns col-form-label",attrs:{for:"q_2"}},[e._v("Your answer")]),e._v(" "),n("div",{staticClass:"twelve columns"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.q_2,expression:"q_2"}],staticClass:"form-control",attrs:{name:"q_2",id:"q_2",type:"text",minlength:"1",maxlength:"10",placeholder:"Write your answer here",autocomplete:"off",required:"",autofocus:"","data-hj-whitelist":""},domProps:{value:e.q_2},on:{input:function(t){t.target.composing||(e.q_2=t.target.value)}}})])]):e._e(),e._v(" "),5==e.current_tab?n("div",{key:"tab_3",staticStyle:{display:"inline-block"}},[n("div",{staticClass:"bg-primary text-dark timer"},[e._v("0:"+e._s(e.time_left))]),e._v(" "),e._m(7),e._v(" "),n("h2",[e._v("Last question, 3.")]),e._v(" "),n("p",[e._v("In a lake, there is a patch of lily pads. Every day, the patch doubles in size. If it takes 48 days for the patch to cover the entire lake, how long would it take for the patch to cover half the lake?")]),e._v(" "),n("label",{staticClass:"twelve columns col-form-label",attrs:{for:"q_3"}},[e._v("Your answer")]),e._v(" "),n("div",{staticClass:"twelve columns"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.q_3,expression:"q_3"}],staticClass:"form-control",attrs:{name:"q_3",id:"q_3",type:"text",minlength:"1",maxlength:"10",placeholder:"Write your answer here",autocomplete:"off",required:"",autofocus:"","data-hj-whitelist":""},domProps:{value:e.q_3},on:{input:function(t){t.target.composing||(e.q_3=t.target.value)}}})])]):e._e(),e._v(" "),6==e.current_tab?n("div",{key:"tab_3",staticStyle:{display:"inline-block"}},[e._m(8),e._v(" "),n("h2",[e._v("Awesome, you’re almost done!")]),e._v(" "),n("p",[e._v("Submit your CV with a phone number and email address. If we’re interested, we’ll be in touch!")]),e._v(" "),n("label",{staticClass:"twelve columns col-form-label",attrs:{for:"cv_file"}},[e._v("Your CV (PDF)")]),e._v(" "),n("div",{staticClass:"twelve columns"},[n("input",{staticClass:"form-control",attrs:{name:"cv_file",id:"cv_file",type:"file",placeholder:"Write your answer here",autocomplete:"off",required:"",autofocus:"","data-hj-whitelist":"",accept:".pdf"},on:{change:e.newFile}})])]):e._e(),e._v(" "),7==e.current_tab?n("div",{key:"tab_4",staticStyle:{display:"inline-block"}},[e._m(9),e._v(" "),n("h2",[e._v("Hurray! You’ve applied for an internship. We’ll be in touch soon.")])]):e._e(),e._v(" "),7!==e.current_tab?n("div",{key:"tab_buttons",staticClass:"form-group row invert-columns"},[n("div",{staticClass:"six columns"},[6===e.current_tab?n("button",{staticClass:"button button-primary u-full-width",attrs:{type:"submit"}},[e._v("\n                       Apply for an M Media internship\n                   ")]):0===e.current_tab?n("button",{staticClass:"button button-primary u-full-width",attrs:{type:"submit"}},[e._v("Apply now →")]):n("button",{staticClass:"button button-primary u-full-width",attrs:{type:"submit"},on:{click:function(t){e.time_left=60}}},[e._v("Next →")])]),e._v(" "),n("div",{staticClass:"six columns order-md-6 d-none",style:{visibility:0==e.current_tab?"hidden":"initial"}},[n("a",{staticClass:"button",on:{click:function(t){e.current_tab-=1}}},[e._v(" ← ")])])]):e._e()]),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:e.loading,expression:"loading"}],key:"2",staticClass:"u-center",attrs:{role:"alert"}},[e._v("\n           Please wait. Your application is being sent...\n       ")]),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:e.success,expression:"success"}],key:"3",staticClass:"u-center",attrs:{role:"alert"}},[n("h2",[e._v("Application sent!")]),e._v(" "),n("p",[e._v("If we're interested, we'll be reaching out to you shortly on your email address.")])]),e._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:e.error,expression:"error"}],key:"4"},[n("div",{staticClass:"u-center",attrs:{role:"alert"}},[e._v("\n               Uh oh!\n               "),n("div",{staticClass:"w-100 mt-5",domProps:{innerHTML:e._s(e.error_msg)}}),e._v(" "),n("br"),e._v(" "),n("a",{staticClass:"button button-primary",attrs:{href:"#"},on:{click:function(t){t.preventDefault(),e.error=!1}}},[e._v("Go back")])])])])}),[function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticStyle:{height:"250px",margin:"0 auto",display:"flex"}},[t("img",{staticStyle:{height:"100%",margin:"0 auto"},attrs:{src:"/images/internship/intern.svg",alt:"Shop"}})])},function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("label",{staticClass:"col-form-label",attrs:{for:"web_dev_input"}},[e._v("\n                       Web development\n                       "),n("br"),e._v(" "),n("span",{staticClass:"text-muted",staticStyle:{"font-weight":"initial"}},[e._v("You like code, and want to polish your HTML, CSS, and JS skills - sprinkled with some PHP.")])])},function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("label",{staticClass:"col-form-label",attrs:{for:"web_design_input"}},[e._v("\n                       Web design\n                       "),n("br"),e._v(" "),n("span",{staticClass:"text-muted",staticStyle:{"font-weight":"initial"}},[e._v("You love to draw, are interested in UX and UI, and have a great eye for design.")])])},function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("label",{staticClass:"col-form-label",attrs:{for:"marketing_input"}},[e._v("\n                       Marketing\n                       "),n("br"),e._v(" "),n("span",{staticClass:"text-muted",staticStyle:{"font-weight":"initial"}},[e._v("You know what people are interested in, and can define, plan for, and target them effectively.")])])},function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticStyle:{height:"250px",margin:"0 auto",display:"flex","margin-top":"3rem"}},[t("img",{staticStyle:{height:"100%",margin:"0 auto"},attrs:{src:"/images/internship/internship_questions.svg",alt:"Person looking at computer screen"}})])},function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticStyle:{height:"250px",margin:"0 auto",display:"flex","margin-top":"3rem"}},[t("img",{staticStyle:{height:"100%",margin:"0 auto"},attrs:{src:"/images/internship/question-mark.svg",alt:"Shop"}})])},function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticStyle:{height:"250px",margin:"0 auto",display:"flex","margin-top":"3rem"}},[t("img",{staticStyle:{height:"100%",margin:"0 auto",transform:"rotate(-15deg)"},attrs:{src:"/images/internship/question-mark.svg",alt:"Shop"}})])},function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticStyle:{height:"250px",margin:"0 auto",display:"flex","margin-top":"3rem"}},[t("img",{staticStyle:{height:"100%",margin:"0 auto",transform:"rotate(-30deg)"},attrs:{src:"/images/internship/question-mark.svg",alt:"Shop"}})])},function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticStyle:{height:"250px",margin:"0 auto",display:"flex","margin-top":"3rem"}},[t("img",{staticStyle:{height:"100%",margin:"0 auto"},attrs:{src:"/images/internship/cv_upload.svg",alt:"Shop"}})])},function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticStyle:{height:"250px",margin:"0 auto",display:"flex"}},[t("img",{staticStyle:{height:"100%",margin:"0 auto"},attrs:{src:"/images/tabletshop.svg",alt:"Shop"}})])}],!1,null,"48de6218",null).exports},1900:(e,t,n)=>{"use strict";function i(e,t,n,i,r,a,s,o){var l,c="function"==typeof e?e.options:e;if(t&&(c.render=t,c.staticRenderFns=n,c._compiled=!0),i&&(c.functional=!0),a&&(c._scopeId="data-v-"+a),s?(l=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),r&&r.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(s)},c._ssrRegister=l):r&&(l=o?function(){r.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:r),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(e,t){return l.call(t),u(e,t)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:e,options:c}}n.d(t,{Z:()=>i})}}]);
//# sourceMappingURL=713.js.map