/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import ProductFormComponent from './components/ProductFormComponent.vue';
import ProductListComponent from './components/ProductListComponent.vue';

const app = createApp({
    components: {
        ProductFormComponent,
        ProductListComponent
    }
});


app.mount('#app');
