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
        const urlParams = new URLSearchParams(this.$route.fullPath);
        let token = urlParams.get('access_token');
        if(token) {
            this.$axios.$post(`loginfb`,{token: token}).then((response)=>{
                if(response.status == 200) {
                    this.$auth.setToken('local', 'Bearer ' +response.data.token);
                    this.$auth.setStrategy('local');
                    this.$auth.fetchUser().then(() => {
                       window.location.href = '/admin';
                    }).catch((e) => {
                        this.$auth.logout();
                        window.location.href = '/';
                    })
                }
            }).catch(()=> {
                this.$swal(
                    'Lỗi!',
                    'Token không hợp lệ',
                    'error'
                )
            });
        }
        
    }
}
</script>