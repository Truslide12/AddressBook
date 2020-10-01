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
        component: home,
    },
    {
        path: '/home',
        component: home,
    },
    {
        path: '/create',
        component: create,
    },
    {
        path: '/createAddress',
        component: createAddress,
    },
    {
        path: '/deleteModal',
        component: deleteModal,
    },
    {
        path: '/details',
        component: details,
    },
    {
        path: '/edit',
        component: edit,
    },
    {
        path: '/editAddress',
        component: editAddress,
    },

    {
        path: '/form_address',
        component: form_address,
    },
    {
        path: '/form_contact',
        component: form_contact,
    },
    {
        path: '/search',
        component: form_search,
    },
]

export default new Router({
    mode: 'history',
    routes,
})
