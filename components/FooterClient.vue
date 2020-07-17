<template>
    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5" style="margin-bottom:  1rem !important;">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 line1">NETBEE</h2>
                        <p style="line-height: 28px; color: #fff;">{{$t('footer.title')}}</p>
                        <img v-lazy = "`/assets/img/QR.png`" alt="Smiley face" height="200" width="auto">
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 line2">{{$t('footer.link.title')}} </h2>
                        <ul class="list-unstyled" style="line-height: 5px;"> 
                            <li><a href="/tin-tuc" target="_blank" class="py-2 d-block a_footer" style="color: #fff;">{{$t('footer.link.news')}}</a></li>
                            <li><a href="/lien-he" target="_blank" class="py-2 d-block a_footer" style="color: #fff;">{{$t('footer.link.contact')}}</a></li>
                            <li><a href="/quy-dinh-bao-mat" target="_blank" class="py-2 d-block a_footer" style="color: #fff;">{{$t('footer.link.regulations')}}</a></li>
                            <li><a href="/ve-netbee" target="_blank" class="py-2 d-block a_footer" style="color: #fff;">{{$t('footer.link.faq')}}</a></li>
                            <li><a href="/co-che-netbee" target="_blank" class="py-2 d-block a_footer" style="color: #fff;">Cơ chế giải quyết tranh chấp</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ">
                        <h2 class="ftco-heading-2 line3">Google Map </h2>  
                        <div class="block-23 mb-3">  
                            <a  href="https://www.google.com/maps/place/Hachinet/@21.052892,105.780003,15z/data=!4m5!3m4!1s0x0:0xdc6d73d2030fac0d!8m2!3d21.0528918!4d105.7800033?hl=vi" target="_blank">
                                <img v-lazy = "`/assets/img/mapimg.png`" alt="Smiley face" height="100%"  width="100%">                        
                            </a>
                       </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 line4">{{$t('footer.contact_info.title')}}</h2>
                        <div class="block-23 ">
                            <ul>
                                <li><span class="fa fa-map-marker" style="color: #fff;"></span><span class="text pl-2" style="color: #fff;">{{$t('footer.contact_info.address')}}</span></li>
                                <li><a href="tel:+842462900388" class="a_footer"><span class="fa fa-phone"></span><span class="pl-2 text">+842462900388</span></a></li>
                                <li><a href="mailto:contact@netbee.vn" class="a_footer"><span class="fa fa-envelope"></span><span class="pl-2 text">Email: contact@netbee.vn</span></a></li>
                            </ul>
                            
                        </div>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                            <li class="ftco-animate"><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="https://www.facebook.com/NetBeevn-107178937322342/"><span class="fab fa-facebook-f"></span></a></li>
                            <li class="ftco-animate"><a href="https://www.instagram.com/accounts/login/?next=/netbee.vn/"><span class="fab fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright" style="font-size: 12px; height: 30px; padding-top: 7px">
            Copyright &copy; 2020
            <script>
                document.write(new Date().getFullYear());
            </script>
            All Rights Reserved 
            <a href="https://netbee.vn" target="_blank">Netbee.vn</a> 
            <!-- </script> All rights reserved | This template is made with <i class="fas fa-heart text-danger" aria-hidden="true"></i> by <a href="https://netbee.vn" target="_blank">Netbee.vn</a> -->
        </div>
        <!--ring ring-->
        <div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon" style="left: -50px; bottom: 150px; position: fixed;">
        <div class="phonering-alo-ph-circle"></div>
        <div class="phonering-alo-ph-circle-fill"></div>
        <a href="tel:+842462900388"></a>
        <div class="phonering-alo-ph-img-circle">
        <a href="tel:+842462900388"></a>
        <a href="tel:+842462900388" class="pps-btn-img " title="Liên hệ">
        <img src="https://i.imgur.com/v8TniL3.png" alt="Liên hệ" width="50" onmouseover="this.src='https://i.imgur.com/v8TniL3.png';" onmouseout="this.src='https://i.imgur.com/v8TniL3.png';">
        </a>
        </div>
        </div>
        <a href="tel:+842462900388"></a>
    </footer>
</template>
<script>
export default {
    
}
</script>
<style scoped>
.line1,.line2,.line3,.line4{
    position: relative;
    border-bottom: 2px solid #222831;
}
.line1:before,.line2:before,.line3:before,.line4:before{
     position: absolute;
    background: rgb(255, 183, 1);
    height: 2px;
    content: '';    
    left: 0;
    bottom: -2px;
    border-radius: 12px;
}
.line1:before{
    width: 80px;
}
.line2:before{
    width: 70px;
}
.line3:before{
    width: 110px;
}
.line4:before{
    width: 150px;
}

.ftco-animate :hover{
    color: rgb(255, 183, 1);
}
.ftco-footer .ftco-heading-2 {
    padding-bottom: 6px;
}
.block-23 ul {
    padding: 0;
}

.block-23 ul li,
.block-23 ul li>a {
    display: table;
    line-height: 1.5;
    margin-bottom: 15px;
}

.block-23 ul li span {
    color: rgba(255, 255, 255, 0.7);
}

.block-23 ul li .icon,
.block-23 ul li .text {
    display: table-cell;
    vertical-align: top;
}

.block-23 ul li .icon {
    width: 40px;
    font-size: 18px;
    padding-top: 2px;
    color: white;
}

.copyright {
    background: var(--light);
    color: var(--dark);
    text-align: center;
    position: absolute;
    bottom: 0px;
    width: 100%;
}
.phonering-alo-phone.phonering-alo-static {
    opacity:.6
}

.phonering-alo-phone.phonering-alo-hover,.phonering-alo-phone:hover {
    opacity:1
}

.phonering-alo-ph-circle {
    width:160px;
    height:160px;
    top:20px;
    left:20px;
    position:absolute;
    background-color:transparent;
    border-radius:100% !important;
    border:2px solid rgba(30,30,30,0.4);
    border:2px solid #bfebfc 9;
    opacity:.1;
    -webkit-animation:phonering-alo-circle-anim 1.2s infinite ease-in-out;
    animation:phonering-alo-circle-anim 1.2s infinite ease-in-out;
    transition:all .5s;
    -webkit-transform-origin:50% 50%;
    -ms-transform-origin:50% 50%;
    transform-origin:50% 50%
}

.phonering-alo-phone.phonering-alo-active .phonering-alo-ph-circle {
    -webkit-animation:phonering-alo-circle-anim 1.1s infinite ease-in-out!important;
    animation:phonering-alo-circle-anim 1.1s infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-static .phonering-alo-ph-circle {
    -webkit-animation:phonering-alo-circle-anim 2.2s infinite ease-in-out!important;
    animation:phonering-alo-circle-anim 2.2s infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-hover .phonering-alo-ph-circle,.phonering-alo-phone:hover .phonering-alo-ph-circle {
    border-color:#00aff2;
    opacity:.5
}

.phonering-alo-phone.phonering-alo-green.phonering-alo-hover .phonering-alo-ph-circle,.phonering-alo-phone.phonering-alo-green:hover .phonering-alo-ph-circle {
    border-color:#75eb50 ;
    border-color:#baf5a7;
    opacity:.5
}

.phonering-alo-phone.phonering-alo-green .phonering-alo-ph-circle {
    border-color:#00aff2 ;
    border-color:#bfebfc;
    opacity:.5
}

.phonering-alo-phone.phonering-alo-gray.phonering-alo-hover .phonering-alo-ph-circle,.phonering-alo-phone.phonering-alo-gray:hover .phonering-alo-ph-circle {
    border-color:#ccc;
    opacity:.5
}

.phonering-alo-phone.phonering-alo-gray .phonering-alo-ph-circle {
    border-color:#75eb50 ;
    opacity:.5
}

.phonering-alo-ph-circle-fill {
    width:100px;
    height:100px;
    top:50px;
    left:50px;
    position:absolute;
    background-color: #000;
    border-radius:100% !important;
    border:2px solid transparent;
    -webkit-animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    transition:all .5s;
    -webkit-transform-origin:50% 50%;
    -ms-transform-origin:50% 50%;
    transform-origin:50% 50%
}

.phonering-alo-phone.phonering-alo-active .phonering-alo-ph-circle-fill {
    -webkit-animation:phonering-alo-circle-fill-anim 1.7s infinite ease-in-out!important;
    animation:phonering-alo-circle-fill-anim 1.7s infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-static .phonering-alo-ph-circle-fill {
    -webkit-animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out!important;
    animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out!important;
    opacity:0!important
}

.phonering-alo-phone.phonering-alo-hover .phonering-alo-ph-circle-fill,.phonering-alo-phone:hover .phonering-alo-ph-circle-fill {
    background-color:rgba(0,175,242,0.5);
    background-color:#00aff2 9;
    opacity:.75!important
}

.phonering-alo-phone.phonering-alo-green.phonering-alo-hover .phonering-alo-ph-circle-fill,.phonering-alo-phone.phonering-alo-green:hover .phonering-alo-ph-circle-fill {
    background-color:rgba(117,235,80,0.5);
    background-color:#baf5a7 9;
    opacity:.75!important
}

.phonering-alo-phone.phonering-alo-green .phonering-alo-ph-circle-fill {
    background-color:rgba(0,175,242,0.5);
    background-color:#a6e3fa 9
}

.phonering-alo-phone.phonering-alo-gray.phonering-alo-hover .phonering-alo-ph-circle-fill,.phonering-alo-phone.phonering-alo-gray:hover .phonering-alo-ph-circle-fill {
    background-color:rgba(204,204,204,0.5);
    background-color:#ccc 9;
    opacity:.75!important
}

.phonering-alo-phone.phonering-alo-gray .phonering-alo-ph-circle-fill {
    background-color:rgba(117,235,80,0.5);
    opacity:.75!important
}

.phonering-alo-ph-img-circle {
    width:60px;
    height:60px;
    top:70px;
    left:70px;
    position:absolute;
    background:rgba(30,30,30,0.1) url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAAB/ElEQVR42uya7W3CMBCG31QM4A1aNggTlG6QbpBMkHYC1AloJ4BOABuEDcgGtBOETnD9c1ERCH/lwxeaV8oPFGP86Hy+DxMREW5Bd7gRjSDSNGn4/RiAOvm8C0ZCRD5PSkQVXSr1nK/xE3mcWimA1ZV3JYBZCIO4giQANoYxMwYS6+xKY4lT5dJPreWZY+uspqSCKPYN27GJVBDXheVSQe494ksiEWTuMXcu1dld9SARxDX1OAJ4lgjy4zDnFsC076A4adEiRwAZg4hOUSpNoCsBPDGM+HqkNGynYBCuILuWj+dgWysGsNe8nwL4GsrW0m2fxZBq9rW0rNcX5MOQ9eZD8JFahcG5g/iKT671alGAYQggpYWvpEPYWrU/HDTOfeRIX0q2SL3QN4tGhZJukVobQyXYWw7WtLDKDIuM+ZSzscyCE9PCy5IttCvnZNaeiGLNHKuz8ZVh/MXTVu/1xQKmIqLEAuJ0fNo3iG5B51oSkeKnsBi/4bG9gYB/lCytU5G9DryFW+3Gm+JLwU7ehbJrwTjq4DJU8bHcVbEV9dXXqqP6uqO5e2/QZRYJpqu2IUAA4B3tXvx8hgKp05QZW6dJqrLTNkB6vrRURLRwPHqtYgkC3cLWQAcDQGGKH13FER/NATzi786+BPDNjm1dMkfjn2pGkBHkf4D8DgBJDuDHx9BN+gAAAABJRU5ErkJggg==) no-repeat center center;
    border-radius:100% !important;
    border:2px solid transparent;
    -webkit-animation:phonering-alo-circle-img-anim 1s infinite ease-in-out;
    animation:phonering-alo-circle-img-anim 1s infinite ease-in-out;
    -webkit-transform-origin:50% 50%;
    -ms-transform-origin:50% 50%;
    transform-origin:50% 50%
}

.phonering-alo-phone.phonering-alo-active .phonering-alo-ph-img-circle {
    -webkit-animation:phonering-alo-circle-img-anim 1s infinite ease-in-out!important;
    animation:phonering-alo-circle-img-anim 1s infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-static .phonering-alo-ph-img-circle {
    -webkit-animation:phonering-alo-circle-img-anim 0 infinite ease-in-out!important;
    animation:phonering-alo-circle-img-anim 0 infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-hover .phonering-alo-ph-img-circle,.phonering-alo-phone:hover .phonering-alo-ph-img-circle {
    background-color:#00aff2
}

.phonering-alo-phone.phonering-alo-green.phonering-alo-hover .phonering-alo-ph-img-circle,.phonering-alo-phone.phonering-alo-green:hover .phonering-alo-ph-img-circle {
    background-color:#75eb50;
    background-color:#75eb50 9
}

.phonering-alo-phone.phonering-alo-green .phonering-alo-ph-img-circle {
    background-color:#00aff2;
    background-color:#00aff2 9
}

.phonering-alo-phone.phonering-alo-gray.phonering-alo-hover .phonering-alo-ph-img-circle,.phonering-alo-phone.phonering-alo-gray:hover .phonering-alo-ph-img-circle {
    background-color:#ccc
}

.phonering-alo-phone.phonering-alo-gray .phonering-alo-ph-img-circle {
    background-color:#75eb50
}

@-webkit-keyframes phonering-alo-circle-anim {
    0% {
        -webkit-transform:rotate(0) scale(.5) skew(1deg);
        -webkit-opacity:.1
    }

    30% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
        -webkit-opacity:.5
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
        -webkit-opacity:.1
    }
}

@-webkit-keyframes phonering-alo-circle-fill-anim {
    0% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
        opacity:.2
    }

    100% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }
}

@-webkit-keyframes phonering-alo-circle-img-anim {
    0% {
        -webkit-transform:rotate(0) scale(1) skew(1deg)
    }

    10% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg)
    }

    20% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg)
    }

    30% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg)
    }

    40% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg)
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg)
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg)
    }
}

@-webkit-keyframes fadeInRight {
    0% {
        opacity:0;
        -webkit-transform:translate3d(100%,0,0);
        -ms-transform:translate3d(100%,0,0);
        transform:translate3d(100%,0,0)
    }

    100% {
        opacity:1;
        -webkit-transform:none;
        -ms-transform:none;
        transform:none
    }
}

@keyframes fadeInRight {
    0% {
        opacity:0;
        -webkit-transform:translate3d(100%,0,0);
        -ms-transform:translate3d(100%,0,0);
        transform:translate3d(100%,0,0)
    }

    100% {
        opacity:1;
        -webkit-transform:none;
        -ms-transform:none;
        transform:none
    }
}

@-webkit-keyframes fadeOutRight {
    0% {
        opacity:1
    }

    100% {
        opacity:0;
        -webkit-transform:translate3d(100%,0,0);
        -ms-transform:translate3d(100%,0,0);
        transform:translate3d(100%,0,0)
    }
}

@keyframes fadeOutRight {
    0% {
        opacity:1
    }

    100% {
        opacity:0;
        -webkit-transform:translate3d(100%,0,0);
        -ms-transform:translate3d(100%,0,0);
        transform:translate3d(100%,0,0)
    }
}

@-webkit-keyframes phonering-alo-circle-anim {
    0% {
        -webkit-transform:rotate(0) scale(.5) skew(1deg);
                transform:rotate(0) scale(.5) skew(1deg);
        opacity:.1
    }

    30% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.5
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg);
        opacity:.1
    }
}

@keyframes phonering-alo-circle-anim {
    0% {
        -webkit-transform:rotate(0) scale(.5) skew(1deg);
                transform:rotate(0) scale(.5) skew(1deg);
        opacity:.1
    }

    30% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.5
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg);
        opacity:.1
    }
}

@-webkit-keyframes phonering-alo-circle-fill-anim {
    0% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg);
        opacity:.2
    }

    100% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }
}

@keyframes phonering-alo-circle-fill-anim {
    0% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg);
        opacity:.2
    }

    100% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }
}

@-webkit-keyframes phonering-alo-circle-img-anim {
    0% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }

    10% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg);
                transform:rotate(-25deg) scale(1) skew(1deg)
    }

    20% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg);
                transform:rotate(25deg) scale(1) skew(1deg)
    }

    30% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg);
                transform:rotate(-25deg) scale(1) skew(1deg)
    }

    40% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg);
                transform:rotate(25deg) scale(1) skew(1deg)
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }
}

@keyframes phonering-alo-circle-img-anim {
    0% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }

    10% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg);
                transform:rotate(-25deg) scale(1) skew(1deg)
    }

    20% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg);
                transform:rotate(25deg) scale(1) skew(1deg)
    }

    30% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg);
                transform:rotate(-25deg) scale(1) skew(1deg)
    }

    40% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg);
                transform:rotate(25deg) scale(1) skew(1deg)
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }
}
</style>