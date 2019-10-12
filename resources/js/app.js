/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import PortalVue from 'portal-vue';
import { stringify } from 'querystring';

Vue.use(PortalVue);

Vue.component('laravel-token', {
    functional: true,
    render: function (h) {
        return h('input', {
            attrs: {
                type: 'hidden',
                name: '_token',
                value: LARAVEL_TOKEN
            }
        });
    }
});

Vue.component('request-method', {
    functional: true,
    props: {
        method: {
            type: String,
            required: true
        }
    },
    render: function (h, context) {
        return h('input', {
            attrs: {
                type: 'hidden',
                name: '_method',
                value: context.props.method
            }
        })
    }
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('topic-list', require('./components/TopicList.vue').default);
Vue.component('topic', require('./components/Topic.vue').default);
Vue.component('comment', require('./components/Comment.vue').default);
Vue.component('follow-list', require('./components/FollowList').default);

const app = new Vue({
    el: '#app',
});
