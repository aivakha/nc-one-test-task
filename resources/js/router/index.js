import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('../views/Home/Index.vue'),
            meta: { title: 'Home' }
        },
    ]
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title

    next()
});

export default router
