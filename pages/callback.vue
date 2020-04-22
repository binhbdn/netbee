<template>
    <div class="container">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- error 404 -->
                <section class="row flexbox-container">
                    <div class="col-xl-12 col-md-12 col-12 d-flex justify-content-center">
                        <div class="card auth-card bg-transparent shadow-none rounded-0 mb-0 w-100">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <h1>Waiting...</h1>
                                    <img src="/assets/img/loading.gif" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    layout: 'no_layout',
    async mounted() {
        if(this.$route.query.token) {
            this.$axios.$get(`loginfb`,{token: this.$route.query.token}).then((response)=>{
                console.log(response)
            });
        }
        
    }
}
</script>