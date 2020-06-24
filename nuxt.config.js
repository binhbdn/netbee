const axios = require('axios')

function ChangeToSlug(slugs) {
    //Lấy text từ thẻ input title 
    let title = slugs;

    //Đổi chữ hoa thành chữ thường
    let slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    return slug;
}
module.exports = {
    head: {
        title: 'NetBee - Mạng lưới du học duy nhất tại Việt Nam',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: 'Kênh du học quốc tế - Trang kết nối du học của các trung tâm tuyển sinh.' },
            { hid: 'robots', name: 'robots', content: 'index,follow' },
            { hid: 'revisit-after', name: 'revisit-after', content: '1 days' },
            { hid: 'og:type', name: 'og:type', content: 'website' },
            { hid: 'og:locale', name: 'og:locale', content: 'vi' },
            { hid: 'fb:app_id', name: 'fb:app_id', content: '1459241224260897' },
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/assets/img/logo.png' },
            // { rel: 'stylesheet', href: '/app-assets/vendors/css/vendors.min.css' , defer: true},
            // { rel: 'stylesheet', href: '/app-assets/vendors/css/extensions/tether-theme-arrows.css' },
            // { rel: 'stylesheet', href: '/app-assets/vendors/css/extensions/tether.min.css' },
            { rel: 'stylesheet', href: '/app-assets/css/bootstrap.css', async: true },
            { rel: 'stylesheet', href: '/app-assets/css/bootstrap-extended.css', async: true },
            // { rel: 'stylesheet', href: '/app-assets/css/colors.css', defer: true },
            { rel: 'stylesheet', href: '/app-assets/css/components.css', async: true },
            // { rel: 'stylesheet', href: '/app-assets/css/themes/dark-layout.css' , defer: true},
            // { rel: 'stylesheet', href: '/app-assets/css/core/menu/menu-types/vertical-menu.css', defer: true },
            // { rel: 'stylesheet', href: '/app-assets/css/core/colors/palette-gradient.css', defer: true },
            // { rel: 'stylesheet', href: '/app-assets/css/plugins/forms/validation/form-validation.css', defer: true },
            { rel: 'stylesheet', href: '/assets/css/style.css', async: true },
            { rel: 'stylesheet', href: '/assets/css/custom-client.css', async: true },
            { rel: 'stylesheet', href: '/assets/css/bootstrap-custom.css', async: true },
            { rel: 'stylesheet', href: '/assets/css/header.css', async: true },
            // { rel: 'stylesheet', href: '/app-assets/css/pages/dashboard-analytics.css' , defer: true},
            // { rel: 'stylesheet', href: '/app-assets/css/pages/card-analytics.css' },
            { rel: 'stylesheet', href: '/assets/fontawesome-pro/css/all.css', async: true },

        ],
        script: [
            { hid: 'stripe', src: '/app-assets/vendors/js/vendors.min.js', defer: true },
            { hid: 'stripe', src: '/app-assets/js/core/app-menu.js', defer: true },
            { hid: 'stripe', src: '/app-assets/js/core/app.js', defer: true },
            { hid: 'stripe', src: '/app-assets/js/scripts/components.js', defer: true },
            // { src: '/app-assets/vendors/js/forms/select/select2.full.min.js', },
            // { src: '/app-assets/js/scripts/forms/select/form-select2.js', },

        ]
    },
    loading: { color: '#3B8070' },
    modules: [
        '@nuxtjs/axios',
        '@nuxtjs/auth',
        // 'vue-sweetalert2/nuxt',
        'nuxt-sweetalert2',
        'nuxt-seo',
        '@nuxtjs/sitemap', ['@nuxtjs/google-analytics', {
            id: 'UA-164963357-1'
        }],
        ['@nuxtjs/component-cache', { maxAge: 1000 * 60 * 60 }],
        ["nuxt-compress", { gzip: { cache: true }, brotli: { threshold: 10240 } }],
        '@nuxtjs/robots'
    ],
    robots: {   
        UserAgent: '*',
        Disallow: '/admin',
        Sitemap: 'https://netbee.vn/sitemap.xml'
    },
    //map sitemap
    sitemap: {
        hostname: 'https://netbee.vn',
        gzip: true,
        exclude: [
            '/admin/**'
        ],
        routes: async() => {
            const tintuc = await axios.get('https://netbee.vn/api/getTinTucSiteMap')
            const arrayTinTuc = tintuc.data.data.tintuc.map((user) => ({
                    url: `tin-tuc/${user.id}/${ChangeToSlug(user.title)}`,
                    changefreq: 'daily',
                    priority: 1,
                }))
                // const tintuc = await axios.get('https://netbee.vn/api/getTinTucNewLoading')
                // const b = tintuc.data.data.tintuc.data.map((user) => ({
                //     url: `http://netbee.vn/tin-tuc/${user.id}/${ChangeToSlug(user.title)}`,
                //     changefreq: 'daily',
                //     priority: 1,
                // }))
            return [{
                    url: `tin-tuc/tin-moi`,
                    changefreq: 'daily',
                    priority: 1,
                },
                {
                    url: `tin-tuc/du-hoc`,
                    changefreq: 'daily',
                    priority: 1,
                },
                {
                    url: `tin-tuc/cam-nang`,
                    changefreq: 'daily',
                    priority: 1,
                },
                {
                    url: `tin-tuc/xuat-khau-lao-dong`,
                    changefreq: 'daily',
                    priority: 1,
                },
                ...arrayTinTuc
            ]
        }
    },
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
                redirect_uri: 'https://netbee.vn/callback'
            },
            google: {
                client_id: '867087688208-tevlsbe2csk6hhlb9sh77kom9mjq6brs.apps.googleusercontent.com',
                redirect_uri: 'https://netbee.vn/callbackgg'
            },
        },
    },
    router: {
        middleware: ['stats'],
        middleware: ['i18n']
    },
    plugins: [
        '~/plugins/axios.js',
        '~/plugins/helppers.js',
        '~/plugins/vue-lazyload.js',
        '~/plugins/jsonld.js',        
        { src: './plugins/vue2-editor', ssr: false },
        { src: '~/plugins/full-calendar.js', ssr: false },
        { src: '~/plugins/infiniteloading', ssr: false },
        { src: '~/plugins/chart', ssr: false },
        { src: '~/plugins/hchs-vue-charts', ssr: false },
        { src: '~/plugins/i18n.js', ssr: true },
        { src: '~/plugins/vue-particles.js', ssr: false },
    ],
    vue: {
        config: {
            productionTip: true,
            devtools: true,
            silent: true
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