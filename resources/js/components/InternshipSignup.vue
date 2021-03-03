<template>
    <div>
        <form method="POST" class="u-center" action="/custom-notifications" key="requestWebsiteForm" v-on:submit.prevent="current_tab === 6 ? updateFile() : (current_tab += 1)" v-show="!success && !error && !loading">
            <!--            <transition-group name="fade">
 -->

            <!-- Intro -->
            <div v-if="current_tab == 0" key="tab_0" style="display: inline-block;">
                <div style="height: 250px; margin: 0 auto; display: flex">
                    <img src="/images/internship/intern.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
                </div>
                <h1 class="u-center-text">Intern at M Media</h1>
                <p class="u-center-text">Join a young and highly dynamic team. Work on real, meaningful, and thought-out projects. Get one to one training on your fields of interest.</p>
            </div>
            <div v-if="current_tab == 1" key="tab_1" style="display: inline-block;">
                <h2 style="margin-top:10rem;">What’s your interest?</h2>
                <div class="form-group row card flex" style="margin-bottom:1.5rem;">
                    <div class="radio-input">
                        <input id="web_dev_input" type="radio" autocomplete="off" placeholder="send_sms" class="form-control" name="interest" v-model="interest" required value="Web development">
                    </div>
                    <label for="web_dev_input" class="col-form-label">
                        Web development
                        <br/>
                        <span class="text-muted" style="font-weight: initial;">You like code, and want to polish your HTML, CSS, and JS skills - sprinkled with some PHP.</span>
                    </label>
                </div>
                <div class="form-group row card flex" style="margin-bottom:1.5rem;">
                    <div class="radio-input">
                        <input id="web_design_input" type="radio" autocomplete="off" placeholder="send_sms" class="form-control" name="interest" v-model="interest" required value="Web design">
                    </div>
                    <label for="web_design_input" class="col-form-label">
                        Web design
                        <br/>
                        <span class="text-muted" style="font-weight: initial;">You love to draw, are interested in UX and UI, and have a great eye for design.</span>
                    </label>
                </div>
                <div class="form-group row card flex" style="margin-bottom:1.5rem;">
                    <div class="radio-input">
                        <input id="marketing_input" type="radio" autocomplete="off" placeholder="send_sms" class="form-control" name="interest" v-model="interest" required value="Marketing">
                    </div>
                    <label for="marketing_input" class="col-form-label">
                        Marketing
                        <br/>
                        <span class="text-muted" style="font-weight: initial;">You know what people are interested in, and can define, plan for, and target them effectively.</span>
                    </label>
                </div>
            </div>
            <div v-if="current_tab == 2" key="tab_2" style="display: inline-block;">
                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">
                    <img src="/images/internship/internship_questions.svg" style="height: 100%; margin: 0 auto;" alt="Person looking at computer screen" />
                </div>
                <h2>You’ll be given a 3 question test now.</h2>
                <p>You have 1 minute per question to answer. If you navigate away or close the browser, you will automatically fail the tests. Do not panic, these tests only check to see if you think logically.</p>
            </div>

            <!-- Questions -->
            <div v-if="current_tab == 3" key="tab_3" style="display: inline-block;">
                <div class="bg-primary text-dark timer">0:{{time_left}}</div>
                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">
                    <img src="/images/internship/question-mark.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
                </div>
                <h2>Question 1.</h2>
                <p>A pen and paper cost £1.10 in total. The pen costs a pound more than the paper. How much does the paper cost?</p>
                <label for="business_title" class="twelve columns col-form-label">Your answer</label>
                <div class="twelve columns">
                    <input name="business_title" v-model="q_1" id="business_title" class="form-control" type="text" minlength="1" maxlength="10" placeholder="Write your answer here" autocomplete="off" required autofocus data-hj-whitelist />
                </div>
            </div>
            <div v-if="current_tab == 4" key="tab_3" style="display: inline-block;">
                <div class="bg-primary text-dark timer">0:{{time_left}}</div>
                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">
                    <img src="/images/internship/question-mark.svg" style="height: 100%; margin: 0 auto; transform: rotate(-15deg);" alt="Shop" />
                </div>
                <h2>Question 2.</h2>
                <p>If it takes 5 developers 5 minutes to make 5 widgets, how long would it take 100 developers to make 100 widgets?</p>
                <label for="q_2" class="twelve columns col-form-label">Your answer</label>
                <div class="twelve columns">
                    <input name="q_2" v-model="q_2" id="q_2" class="form-control" type="text" minlength="1" maxlength="10" placeholder="Write your answer here" autocomplete="off" required autofocus data-hj-whitelist />
                </div>
            </div>
            <div v-if="current_tab == 5" key="tab_3" style="display: inline-block;">
                <div class="bg-primary text-dark timer">0:{{time_left}}</div>
                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">
                    <img src="/images/internship/question-mark.svg" style="height: 100%; margin: 0 auto; transform: rotate(-30deg);" alt="Shop" />
                </div>
                <h2>Last question, 3.</h2>
                <p>In a lake, there is a patch of lily pads. Every day, the patch doubles in size. If it takes 48 days for the patch to cover the entire lake, how long would it take for the patch to cover half the lake?</p>
                <label for="q_3" class="twelve columns col-form-label">Your answer</label>
                <div class="twelve columns">
                    <input name="q_3" v-model="q_3" id="q_3" class="form-control" type="text" minlength="1" maxlength="10" placeholder="Write your answer here" autocomplete="off" required autofocus data-hj-whitelist />
                </div>
            </div>

            <!-- CV upload -->

            <div v-if="current_tab == 6" key="tab_3" style="display: inline-block;">
                <div style="height: 250px; margin: 0 auto; display: flex; margin-top:3rem;">
                    <img src="/images/internship/cv_upload.svg" style="height: 100%; margin: 0 auto;" alt="Shop" />
                </div>
                <h2>Awesome, you’re almost done!</h2>
                <p>Submit your CV with a phone number and email address. If we’re interested, we’ll be in touch!</p>
                <label for="cv_file" class="twelve columns col-form-label">Your CV (PDF)</label>
                <div class="twelve columns">
                    <input name="cv_file" @change="newFile" id="cv_file" class="form-control" type="file" placeholder="Write your answer here" autocomplete="off" required autofocus data-hj-whitelist accept=".pdf" />
                </div>
            </div>

            <div v-if="current_tab == 7" key="tab_4" style="display: inline-block;">
                <div style="height: 250px; margin: 0 auto; display: flex">
                    <img src="/images/tabletshop.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
                </div>
                <h2>Hurray! You’ve applied for an internship. We’ll be in touch soon.</h2>
            </div>
            <div class="form-group row invert-columns" key="tab_buttons" v-if="current_tab !== 7">
                <div class="six columns">
                    <button type="submit" class="button button-primary u-full-width" v-if="current_tab === 6">
                        Apply for an M Media internship
                    </button>
                    <button type="submit" class="button button-primary u-full-width" v-else-if="current_tab === 0">Apply now →</button>
                    <button type="submit" class="button button-primary u-full-width" v-else @click="time_left = 60">Next →</button>
                </div>
                <div class="six columns order-md-6 d-none" v-bind:style="{ visibility: current_tab == 0 ? 'hidden' : 'initial' }">
                    <a class="button" @click="current_tab -= 1"> ← </a>
                </div>
            </div>
            <!--             </transition-group>
 -->
        </form>
        <div class="u-center" role="alert" v-show="loading" key="2">
            Please wait. Your application is being sent...
        </div>
        <div class="u-center" role="alert" v-show="success" key="3">
            <h2>Application sent!</h2>
            <p>If we're interested, we'll be reaching out to you shortly on your email address.</p>
        </div>
        <div v-show="error" key="4">
            <div class="u-center" role="alert">
                Uh oh!
                <div class="w-100 mt-5" v-html="error_msg"></div>
                <br />
                <a href="#" class="button button-primary" v-on:click.prevent="error = false">Go back</a>
            </div>
        </div>
        <!--         </transition-group>
 -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            loading: false,
            error: false,
            error_msg: false,
            success: false,
            progress: 0,
            current_tab: 0,
            time_left: 60,
            timer: null,
            interest: null,
            q_1: null,
            q_2: null,
            q_3: null,
            cv_file: null
        };
    },
    mounted() {
        this.startTimer();
    },
    methods: {
        updateFile: function() {
            let data = new FormData();
            this.loading = true;
            data.append('interest', this.interest);
            data.append('question_1', this.q_1);
            data.append('question_2', this.q_2);
            data.append('question_3', this.q_3);
            data.append('file', this.cv_file);
            window.scrollTo(0, 0);

            //data.append('_method', 'put'); // add this
            axios
                .post('/api/internships', data) // change this to post )
                .then((res) => {
                    this.success = true;
                    this.error = false;
                    console.log(res);
                    this.loading = false;
                    dataLayer.push({ event: 'internship-request' });
                    this.current_tab++;
                })
                .catch((error) => {
                    this.error = true;
                    this.success = false;
                    this.error_msg = Object.entries(error.response.data.errors)
                        .map(([error_name, error_value], i) => `<p class="mb-0">${error_name}: ${error_value[0]}</p>`)
                        .join('\n');
                    console.log(this.error_msg);
                    //console.log(error.response.data.errors);
                    this.loading = false;
                }); //
            //console.log(error);
        },
        newFile(event) {
            let files = event.target.files;
            if (files.length) {
                this.cv_file = files[0];
            }
        },
        startTimer: function() {
            this.timer = setInterval(this.timerReduceTimeLeft, 1000);
        },
        timerReduceTimeLeft: function() {

            if(this.time_left > 0) {
                this.time_left--
            } else {
                if(this.current_tab === 6) {
                    clearInterval(this.timer);
                } else if (this.current_tab > 2) {
                    this.current_tab++;
                    this.time_left = 60;
                }
            }
            if(this.time_left < 10) {
                this.time_left = '0' + this.time_left;
            }
        }
    },
};

</script>
<style scoped>
    .timer {
        background: var(--white);
        border-radius: var(--border-radius);
        padding:0 1rem;
        color: var(--dark);
        margin-top: 1rem;
        position: absolute;
        right:10%;
        top:1.5rem;
    }
    .card > div.radio-input {
        padding: 0;
        align-self: flex-start;
        margin-top: 1rem;
    }

    .card {
        padding-right: 1rem;
        box-sizing: border-box;
    }
</style>