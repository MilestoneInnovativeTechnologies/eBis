const routes = [
  {
    path: '/',
    component: () => import('layouts/DashboardLayout.vue'),
    children: [
      {path: '/', name: 'index', component: () => import('pages/Index.vue')},
      {path: 'page/:id', name: 'page', props: true, component: () => import('pages/Page.vue')},
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
