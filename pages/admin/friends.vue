<template>    
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            <div class="content-body">
                <section id="News"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- img banner -->
                                <div class="main-friends">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="b1" style="margin-left: 23px;">
                                                <center>
                                                    <img v-lazy="`/assets/img/friend1.png`">
                                                    <h3><b>Bước 1: Chia sẻ<br>link giới thiệu</b></h3>
                                                    <p>đến bạn bè qua Email, Facebook,<br> Linkedin và nhiều hơn thế nữa!</p>
                                                </center>                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="b1">
                                                <center>
                                                    <img v-lazy="`/assets/img/friend2.png`">
                                                    <h3><b>Bước 2: Người được giới thiệu đã đăng ký</b></h3>
                                                    <p>và tiến hành làm việc</p>
                                                </center>                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="b1" style="margin-right: 23px;">
                                                <center>
                                                    <img v-lazy="`/assets/img/friend3.png`">
                                                    <h3><b>Bạn được hưởng <br>15.000 VND</b></h3>
                                                    <p>khi bạn bè của bạn có "Hồ sơ đạt"</p>
                                                </center>                                                
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                                <br>
                                 <!--Cach 1  -->
                                <div class="cach1">
                                    <h2><b>Cách 1: Chia sẻ liên kết giới thiệu của bạn</b></h2> 
                                    <div class="input-group">                                
                                        <input type="text" class="form-control" id="link" v-model="linkdangky">
                                        <div class="input-group-addon bg-netbee" style="padding: 10px;">
                                            <a @click="copyLink()" data-toggle="tooltip" data-placement="top" title="Sao chép liên kết">
                                                Sao chép liên kết 
                                            </a>
                                        </div>                                    
                                    </div>
                                    <!-- Chia se? -->
                                    <div class="chiase">
                                        <a class="btn fb-share" style="background-color: #3578E5;color:#000;" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://netbee.vn/&amp;src=sdkpreparse"  data-toggle="tooltip" data-placement="top" title="Chia sẻ lên Facebook">Chia sẻ Facebook</a>
                                        <!-- <a class="btn bg-netbee">Chia sẻ Twitter</a>
                                        <a class="btn bg-netbee">Chia sẻ Gmail</a> -->
                                    </div>                                    
                                </div>    
                                <!--Cach 2  -->
                                <div class="cach2">
                                    <h2><b>Cách 2: Chia sẻ mã cộng tác viên</b></h2><br>
                                    <span><i>Bạn gửi mã CTV của mình cho bạn bè và yêu cầu nhập khi đăng ký tài khoản !</i></span>
                                    <div class="input-group">                                
                                        <input type="text" class="form-control" id="mactv" v-model="usersfirst.introduce_code">
                                        <div class="input-group-addon bg-netbee" style="padding: 10px;">
                                            <a @click="copyMactv()" data-toggle="tooltip" data-placement="top" title="Sao chép mã CTV">
                                                Sao chép mã CTV                                  
                                            </a>
                                        </div>                                    
                                    </div>
                                    <br><br>
                                    <div class="friend-text">
                                    <p><b>Điều Khoản Sử Dụng cho chương trình Giới Thiệu Bạn Bè</b></p>
                                    <p>- Netbee tặng bạn 15.000đ cho mỗi thành viên mới đủ điều kiện mà bạn giới thiệu. Để đủ điều kiện, người được bạn giới thiệu phải đăng ký tài khoản Netbee thông qua (i) liên kết giới thiệu duy nhất của người giới thiệu hoặc trên Netbee, (ii) các phương thức giới thiệu được kể đến trên trang này. Người được bạn giới thiệu phải tiến hành gửi hồ sơ lên hệ thống & được khách hàng duyệt trạng thái “Hồ sơ đạt”.</p>
                                    <p>- Nếu được giới thiệu qua email, bạn của bạn phải nhập mã CTV được giới thiệu khi đăng ký trên Netbee. Bất kỳ hồ sơ nào không được ghi nhận sẽ không được tính .</p>
                                    <p>- Sau đây là danh sách các hoạt động khiến bạn không đủ điều kiện nhận tiền thưởng giới thiệu (danh sách này có thể thay đổi hoặc bổ sung): </p>
                                    <p>(i) Gian lận</p>
                                    <p>(ii) Đấu giá từ khóa cho mục đích tạo lưu lượng truy cập đến các trang có chứa liên kết giới thiệu của bạn.</p>
                                    <p>(iii) Mọi hoạt động tương tự xác định bởi Netbee và Netbee có quyền quyết định khi hoạt động này không phù hợp với mục đích của Chương trình Giới thiệu Bạn bè của Netbee. Netbee có quyền thay đổi các điều khoản và điều kiện của chương trình khuyến mãi này. Bất kỳ sự vi phạm các điều khoản và điều kiện trên sẽ dẫn đến việc mất tất cả các khoản thưởng. Vi phạm nhiều lần sẽ dẫn đến việc đóng tài khoản Netbee của bạn.</p>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>  
    </div>
</template>

<script>           
    var Vue = require('vue');
    
    export default {
        name: 'friends',
        layout: 'admin',
        middleware: 'blockUsers',
        data(){
            return {
                usersfirst:{},
                linkdangky:''
            }
        },        
        components:{
                     
        },
        
        methods: {              
            copyLink(){
                var copyText = document.getElementById("link")
                copyText.select()
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy")
            },
            copyMactv(){
                var copyText = document.getElementById("mactv")
                copyText.select()
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy")
            },
            fetchdata(){
                this.$axios.get('introduce/getidintroduce')
                .then(response => {                                                          
                    this.usersfirst = response.data
                    this.linkdangky = window.location.host +"/dang-ky/chuyen-vien-tuyen-dung/" + this.usersfirst.introduce_code
                    console.log(this.usersfirst)
                 })
                 .catch(error => {
                    console.log(error.response)
                });          
            }
        },        
        mounted() {             
            this.fetchdata();
        }
    };
</script>
<style scoped>
.friend-text {
    text-align: justify;
}
a.fb-share:hover {
    color: #fff !important;
}
    .pagination .page-item.active .page-link{
        background-color: #ffb701 !important;
    }
    [type=radio] { 
    position: absolute;
    opacity: 0;
    width: 100px;
    height: 100px;
    }

    /* IMAGE STYLES */
    [type=radio] + img {
    cursor: pointer;
    }

    /* CHECKED STYLES */
    [type=radio]:checked + img {
    background: #ffb701;
    }
    .modal .modal-footer {
        border-color: rgb(179, 229, 252) !important;
    }
    .b1{
        padding: 30px;
        height: 100%;
        border: solid 1px #eaeaea;
        border-radius: 4px;
        margin-top: 23px;
        margin-bottom: 23px;
    }
    .b1 h3 {
        font-size: 18px;
    }
    .main-friends {
        margin-bottom: 23px;
    }
    .cach1,.cach2{
         margin:0px 23px;
    }
    .cach1 h2, cach2 h2{
        font-size: 25px;        
        margin-bottom: 30px;
    }    
    .chiase{
        margin: 23px 0px;
    }
</style>