module.exports = {
    mode: 'universal',
    head: {
        title: 'NetBee - Mạng lưới du học duy nhất tại Việt Nam',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: 'Kênh du học quốc tế - Trang kết nối du học của các trung tâm tuyển sinh.' }
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: 'https://netbee.vn/site/assets/images/logo.png' },
            { rel: 'stylesheet', href: '/app-assets/vendors/css/vendors.min.css' },
            { rel: 'stylesheet', href: '/app-assets/vendors/css/charts/apexcharts.css' },
            { rel: 'stylesheet', href: '/app-assets/vendors/css/extensions/tether-theme-arrows.css' },
            { rel: 'stylesheet', href: '/app-assets/vendors/css/extensions/tether.min.css' },
            { rel: 'stylesheet', href: '/app-assets/vendors/css/forms/select/select2.min.css' },
            { rel: 'stylesheet', href: '/app-assets/vendors/css/pickers/pickadate/pickadate.css' },
            { rel: 'stylesheet', href: '/app-assets/css/bootstrap.css' },
            { rel: 'stylesheet', href: '/app-assets/css/bootstrap-extended.css' },
            { rel: 'stylesheet', href: '/app-assets/css/colors.css' },
            { rel: 'stylesheet', href: '/app-assets/css/components.css' },
            { rel: 'stylesheet', href: '/app-assets/css/themes/dark-layout.css' },
            { rel: 'stylesheet', href: '/app-assets/css/core/menu/menu-types/vertical-menu.css' },
            { rel: 'stylesheet', href: '/app-assets/css/core/colors/palette-gradient.css' },
            { rel: 'stylesheet', href: '/app-assets/css/plugins/forms/validation/form-validation.css' },
            { rel: 'stylesheet', href: '/assets/css/style.css' },
            { rel: 'stylesheet', href: '/assets/css/custom-client.css' },
            { rel: 'stylesheet', href: '/assets/css/bootstrap-custom.css' },
            { rel: 'stylesheet', href: '/assets/css/header.css' },
            { rel: 'stylesheet', href: '/app-assets/css/pages/dashboard-analytics.css' },
            { rel: 'stylesheet', href: '/app-assets/css/pages/card-analytics.css' },
            { rel: 'stylesheet', href: '/assets/fontawesome-pro/css/all.css' },

        ],
        script: [
            { src: '/app-assets/vendors/js/vendors.min.js' },
            { src: '/app-assets/js/core/app-menu.js' },
            { src: '/app-assets/js/core/app.js' },
            { src: '/app-assets/js/scripts/components.js' },


        ]
    },
    /*
     ** Customize the progress bar color
     */
    loading: { color: '#3B8070' },
    modules: [
        '@nuxtjs/axios',
        '@nuxtjs/auth',
        'vue-sweetalert2/nuxt'
    ],
    auth: {
        redirect: false,
        //rewriteRedirects: false,
        strategies: {
            local: {
                endpoints: {
                    login: { url: '/login', method: 'post', propertyName: 'data.token' },
                    register: { url: '/register', method: 'get', propertyName: 'data' },
                    user: { url: '/user', method: 'get', propertyName: 'data' },
                    logout: { url: '/logout', method: 'get', propertyName: false }
                }
            },
        },
    },
    router: {
        middleware: ['stats'],
    },
    plugins: [
        '~/plugins/axios.js',
        '~/plugins/helppers.js',
        { src: './plugins/vue2-editor', ssr: false }
    ],
    vue: {
        config: {
            productionTip: true,
            devtools: true
        }
    },

    build: {
        /*
         ** Run ESLint on save
         */
        // extend (config, ctx) {
        //   if (ctx.dev && ctx.isClient) {
        //     config.module.rules.push({
        //       enforce: 'pre',
        //       test: /\.(js|vue)$/,
        //       loader: 'eslint-loader',
        //       options: {
        //         fix: true
        //       },
        //       exclude: /(node_modules)/
        //     })
        //   }
        // }
    },
}