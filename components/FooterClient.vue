<template>
    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5" style="margin-bottom:  1rem !important;">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 line1">NETBEE</h2>
                        <p style="line-height: 28px; color: #fff;">{{$t('footer.title')}}</p>
                        <img :src="`/assets/img/QR.png`" alt="Smiley face" height="200" width="auto">
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 line2">{{$t('footer.link.title')}} </h2>
                        <ul class="list-unstyled" style="line-height: 5px;"> 
                            <li><a href="/tin-tuc" class="py-2 d-block a_footer" style="color: #fff;">{{$t('footer.link.news')}}</a></li>
                            <li><a href="/ve-netbee" class="py-2 d-block a_footer" style="color: #fff;">{{$t('footer.link.regulations')}}</a></li>
                            <li><a href="/lien-he" class="py-2 d-block a_footer" style="color: #fff;">{{$t('footer.link.contact')}}</a></li>
                            <li><a href="/ve-netbee" class="py-2 d-block a_footer" style="color: #fff;">{{$t('footer.link.faq')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ">
                        <h2 class="ftco-heading-2 line3">Google Map </h2>  
                        <div class="block-23 mb-3">                                                     
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.494656172276!2d105.7778146153898!3d21.052896792328728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4b54698fad%3A0xdc6d73d2030fac0d!2sHachinet!5e0!3m2!1svi!2s!4v1580379940334!5m2!1svi!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>                          
                       </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 line4">{{$t('footer.contact_info.title')}}</h2>
                        <div class="block-23 ">
                            <ul>
                                <li><span class="fa fa-map-marker-alt" style="color: #fff;"></span><span class="text pl-2" style="color: #fff;">{{$t('footer.contact_info.address')}}</span></li>
                                <li><a href="tel:+842462900388" class="a_footer"><span class="fa fa-phone"></span><span class="pl-2 text">+842462900388</span></a></li>
                                <li><a href="mailto:contact@netbee.vn" class="a_footer"><span class="fa fa-envelope"></span><span class="pl-2 text">Email: contact@netbee.vn</span></a></li>
                            </ul>
                            
                        </div>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                            <li class="ftco-animate"><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="https://www.facebook.com/NetBeevn-107178937322342/"><span class="fab fa-facebook-f"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fab fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright" style="font-size: 15px;">
            Copyright &copy;
            <script>
                document.write(new Date().getFullYear());
            </script> All rights reserved | This template is made with <i class="fas fa-heart text-danger" aria-hidden="true"></i> by <a href="https://netbee.vn" target="_blank">Netbee.vn</a>
        </div>
    </footer>
</template>
<script>
export default {
    
}
</script>
<style scoped>
.line1,.line2,.line3,.line4{
    position: relative;
    border-bottom: 2px solid darkgrey;
}
.line1:before,.line2:before,.line3:before,.line4:before{
     position: absolute;
    background: rgb(255, 183, 1);
    height: 2px;
    content: '';    
    left: 0;
    bottom: -2px;
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

</style>