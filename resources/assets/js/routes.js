import VueRouter from 'vue-router';
import Home from './components/views/Home.vue';
import Contact from './components/views/Contact.vue';
import Notes from './components/views/Notes.vue';

let routes = [
    { path: '/', component: Home },
    { path: '/contact', component: Contact },
    { path: '/notes', component: Notes },
    { path: '/hello', component: Contact }
];

export default new VueRouter({
    routes,
    linkActiveClass: 'active'
});
