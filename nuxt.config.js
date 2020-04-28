module.exports = {
    head: {
        title: 'NetBee - Mạng lưới du học duy nhất tại Việt Nam',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: 'Kênh du học quốc tế - Trang kết nối du học của các trung tâm tuyển sinh.' },
            { hid: 'robots', name: 'robots', content: 'noindex,follow' },
            { hid: 'revisit-after', name: 'revisit-after', content: '1 days' },
            { hid: 'og:type', name: 'og:type', content: 'website'},
            { hid: 'og:locale', name: 'og:locale', content: 'vi'},
            { hid: 'fb:app_id', name: 'fb:app_id', content: '1459241224260897'},
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/assets/img/logo.png' },
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
            { rel: 'stylesheet', href: '/assets/css/custom-admin.css' },
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
            { src: '/app-assets/vendors/js/forms/select/select2.full.min.js', },
            { src: '/app-assets/js/scripts/forms/select/form-select2.js', },

        ]
    },
    loading: { color: '#3B8070' },
    modules: [
        '@nuxtjs/axios',
        '@nuxtjs/auth',
        'vue-sweetalert2/nuxt',
        'nuxt-seo'
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
            facebook: {
                client_id: '1459241224260897',
                userinfo_endpoint: 'https://graph.facebook.com/v2.12/me?fields=about,name,picture{url},email,birthday',
                redirect_uri:'https://netbee.vn/callback'
            },
            google: {
                client_id: '867087688208-tevlsbe2csk6hhlb9sh77kom9mjq6brs.apps.googleusercontent.com',
                redirect_uri:'https://netbee.vn/callbackgg'
            },
        },
    },
    router: {
        middleware: ['stats'],
    },
    plugins: [
        '~/plugins/axios.js',
        '~/plugins/helppers.js',
        '~/plugins/vue-lazyload.js',
        '~/plugins/jsonld.js',
        { src: './plugins/vue2-editor', ssr: false },
        { src: '~/plugins/vue-fb-customer-chat.js', ssr: false },
        { src: '~/plugins/infiniteloading', ssr: false }
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