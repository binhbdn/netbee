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
                                    <img src="/app-assets/images/pages/404.png" class="img-fluid align-self-center" alt="branding logo">
                                    <h1 class="font-large-2 my-1">404 - Page Not Found!</h1>
                                    <p class="p-2">
                                        Địa chỉ mà bạn truy cập không tồn tại!
                                    </p>
                                    <a class="btn btn-primary btn-lg mt-2" href="/">Back to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- error 404 end -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    layout: 'no_layout',
    data() {
        return {

        }
    },
    head: {
        meta: [
          { hid: 'robots', name: 'robots', content: 'noindex' },
        ],
    },
}
</script>