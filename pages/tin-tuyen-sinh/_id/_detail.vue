<template>

</template>
<script>
import NewListPage1 from '~/components/News/NewListPage1';
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate';
import NewItempage2 from '~/components/NewItempage2';
import NewsList from '~/components/News/NewsList'

export default {
    components:{
        NewListPage1,
        JobsList1ColNotCate,
        NewItempage2, 
        NewsList
    },
    async asyncData({$axios, route}) {
        let detailRes = await $axios.$get(`getDetailTinTuyenDung/${route.params.id}`)
        return {
            tintuc: detailRes.data,
        }
    },
    head() {
        return {
            title: this.tintuc.title,
            meta: [
                { hid: 'description', name: 'description', content: this.tintuc.title },
                { hid: 'keywords', name: 'keywords', content: this.tintuc.title.replace(/ /g, ",")},
                { hid: 'og:url', name: 'og:url', content: 'https://netbee.vn'+this.$route.path},
                { hid: 'og:title', name: 'og:title', content: this.tintuc.title},
                { hid: 'og:description', name: 'og:description', content: this.tintuc.title},
                { hid: 'og:image', name: 'og:image', content: this.tintuc.avatar},
            ]
        }
    },
    // jsonld() {
    //     return {
    //         "@context": "http://schema.org/",
    //         "@type":"EmployerAggregateRating",
    //         "itemReviewed":{
    //             "@type":"Organization",
    //             "name": this.tintuc.title,
    //             "sameAs": 'https://netbee.vn'+this.$route.path
    //             },
    //         "ratingValue": "4",
    //         "bestRating": "5",
    //         "worstRating": "3",
    //         "ratingCount": "5"
    //     };
    // },
}
</script>