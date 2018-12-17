
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

window.Vue = require('vue');

Vue.config.productionTip = false;

var VueResource = require('vue-resource');
var VeeValidate = require('vee-validate');
Vue.use(VeeValidate);

import VueHighcharts from 'vue-highcharts';
import Highcharts from 'highcharts/highstock';
Vue.use(VueHighcharts, { Highcharts });

import Vue2Filters from 'vue2-filters';
Vue.use(Vue2Filters);

var SocialSharing = require('vue-social-sharing');
Vue.use(SocialSharing);


var VueFuse = require('vue-fuse');
Vue.use(VueFuse);

var VueFormWizard = require('vue-form-wizard');
Vue.use(VueFormWizard);

var CardJS = require('card-js');
Vue.use(CardJS);

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

// settings
Vue.prototype.settings = (key) => {
    return _.get(window.stg, key, key);
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('quiz-question', require('../components/frontend/user/quiz/question.vue'));
Vue.component('quiz', require('../components/frontend/user/quiz/quiz.vue'));

Vue.component('avatar-upload', require('../components/frontend/AvatarUpload.vue'));
Vue.component('braintree-payment', require('../components/frontend/Braintree.vue'));
Vue.component('razorpay-form', require('../components/frontend/Razorpay.vue'));

Vue.component('affiliate-button', require('../components/frontend/user/affiliate-button.vue'));
Vue.component('google-adsense', require('../components/frontend/Adsense.vue'));
Vue.component('grid-loader', require('vue-spinner/src/GridLoader.vue'));
Vue.component('checkout', require('../components/frontend/Checkout.vue'));
Vue.component('edit-course', require('../components/frontend/author/course/edit-course.vue'));
Vue.component('manage-section', require('../components/frontend/author/section/manage-section.vue'));
Vue.component('coupons', require('../components/frontend/author/coupon/coupon.vue'));
Vue.component('edit-lesson', require('../components/frontend/author/lesson/edit-lesson.vue'));
Vue.component('create-lesson', require('../components/frontend/author/lesson/create-lesson.vue'));
Vue.component('video-upload', require('../components/frontend/author/video/video-upload.vue'));
Vue.component('create-question', require('../components/frontend/author/quiz/create-question.vue'));
Vue.component('edit-question', require('../components/frontend/author/quiz/edit-question.vue'));
Vue.component('create-article', require('../components/frontend/author/article/create-article.vue'));
Vue.component('edit-article', require('../components/frontend/author/article/edit-article.vue'));
Vue.component('all-earnings', require('../components/frontend/author/charts/all-earnings.vue'));
Vue.component('wishlist', require('../components/frontend/user/wishlist.vue'));
Vue.component('question-follow', require('../components/frontend/user/question-follow.vue'));
Vue.component('answer-mark', require('../components/frontend/user/answer-mark.vue'));
Vue.component('announcement-comments', require('../components/frontend/user/announcements.vue'));
Vue.component('questions', require('../components/frontend/user/questions/questions.vue'));
Vue.component('answers', require('../components/frontend/user/questions/answers.vue'));
Vue.component('user-avatar', require('../components/frontend/user/user-avatar.vue'));

Vue.component('threads', require('../components/frontend/messaging/threads.vue'));
Vue.component('messages', require('../components/frontend/messaging/messages.vue'));
Vue.component('reviews', require('../components/frontend/review/reviews.vue'));
Vue.component('stars', require('../components/frontend/review/stars.vue'));

const app = new Vue({
    el: '#page-wrap',
    data: window.application
});