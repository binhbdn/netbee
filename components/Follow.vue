<template>
    <div class="ftco-section-parallax">
        <div class="parallax-img d-flex align-items-center" id="follow">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                        <h2>Đăng ký nhận bản tin du học</h2>
                        <p>Hãy để lại thông tin để nhận bản tin du học hoàn toàn miễn phí.</p>
                        <div class="row d-flex justify-content-center my-3">
                            <div class="col-md-12 col-xl-8 col-12 p-xl-0">
                                <form action="#" class="subscribe-form d-inline-block" >
                                    <div class="form-group d-flex">
                                        <input type="text" style="border-color: #fff !important;" class="form-control" placeholder="Địa chỉ Email">

                                        <button class="submit px-3">
                                            <i class="fa fa-plane"></i> Đăng ký
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'News',
}
</script>
<style>
button.submit.px-3 {
    border-color: #ffb701 !important;
    border-radius: 5px !important;
    border-width: 1px !important;
    width: 200px !important;
    margin: 5px 5px 5px 0px;
}


.fa-plane:before {
    content: "\f072";
    margin-right: 8px;
}

.form-group.d-flex {
    width: 450px;
    height: 40px;
    background-color: white;
    border-radius: 6px !important;
    width: 450px;
    background-color: white;
}
.ftco-section-parallax .parallax-img {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    position: relative;
    padding: 4em 0;
    background: #ffb701;

}
.heading-section.heading-section-white h2 {
    font-size: 40px;
    color: #000;
}
.ftco-section-parallax .heading-section-white h2 {
    font-weight: 400 !important;
}
.heading-section.heading-section-white p {
    color: #000;
    font-size: 16px;
}
.subscribe-form input {
    border: 1px solid #000 !important;
}
.subscribe-form .form-group {
    position: relative;
    margin-bottom: 0;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    border-radius: 0;
}
.subscribe-form .form-group input {
    background: white !important;
    border: 1px solid transparent;
    color: rgba(0, 0, 0, 0.7) !important;
    font-size: 16px;
    border-radius: 5px 0px 0px 5px;
}
.subscribe-form .form-group .submit {
    color: #000 !important;
    background: #ffb701 !important;
    border-radius: 0px 5px 5px 0px;
    font-size: 16px;
    border: 1px solid;
    padding: 0px 5px !important;
}

.subscribe-form .form-group .submit:hover {
    cursor: pointer;
}
.subscribe-form .form-group input::-webkit-input-placeholder {
    /* Chrome/Opera/Safari */
    color: rgba(0, 0, 0, 0.7) !important;
}

.subscribe-form .form-group input::-moz-placeholder {
    /* Firefox 19+ */
    color: rgba(0, 0, 0, 0.7) !important;
}

.subscribe-form .form-group input:-ms-input-placeholder {
    /* IE 10+ */
    color: rgba(0, 0, 0, 0.7) !important;
}

.subscribe-form .form-group input:-moz-placeholder {
    /* Firefox 18- */
    color: rgba(0, 0, 0, 0.7) !important;
}

/* iphone X */
@media (max-width: 400px) {
    .form-group.d-flex{
        width: 350px;
    }
}

/* Iphone 6 7 8 */
@media (max-width: 500px ) and ( min-width: 400px) {
    .form-group.d-flex{
        width: 390px;
    }
}


</style>