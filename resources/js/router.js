import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

// test routes
import create from './components/pages/contacts/create'
import createAddress from './components/pages/contacts/createAddress'
import deleteModal from './components/pages/contacts/deleteModal'
import details from './components/pages/contacts/details'
import edit from './components/pages/contacts/edit'
import editAddress from './components/pages/contacts/editAddress'
import home from './components/pages/home'
import form_address from './components/pages/contacts/form_address'
import form_contact from './components/pages/contacts/form_contact'
import form_search from './components/pages/contacts/form_search'

const routes = [
    // Project routes
    {
        path: '/',
        name: home,
        component: home,
    },
    {
        path: '/home',
        name: home,
        component: home,
    },
    {
        path: '/create',
        name: create,
        component: create,
    },
    {
        path: '/createAddress',
        name: createAddress,
        component: createAddress,
    },
    {
        path: '/deleteModal',
        name: deleteModal,
        component: deleteModal,
    },
    {
        path: '/details',
        name: details,
        component: details,
    },
    {
        path: '/edit',
        name: edit,
        component: edit,
    },
    {
        path: '/editAddress',
        name: editAddress,
        component: editAddress,
    },

    {
        path: '/form_address',
        name: form_address,
        component: form_address,
    },
    {
        path: '/form_contact',
        name: form_contact,
        component: form_contact,
    },
    {
        path: '/search',
        name: form_search,
        component: form_search,
    },
]

export default new Router({
    mode: 'history',
    routes,
})
