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
        <div class="modal fade" id="chooseRole" tabindex="-1" role="dialog" aria-labelledby="editTodoTask" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <section class="todo-form">
                        <form id="form-edit-todo" class="todo-input">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTodoTask">Chọn loại tài khoản</h5>
                            </div>
                            <div class="modal-body"> 
                                <fieldset class="form-group" >
                                    <button class="btn bg-netbee" @click="chooseRole(1)" style="width: 33%">ỨNG VIÊN</button>
                                    <button class="btn bg-netbee" @click="chooseRole(2)" style="width: 32.5%">NHÀ TUYỂN DỤNG</button>
                                    <button class="btn bg-netbee" @click="chooseRole(3)" style="width: 33%">CHUYÊN VIÊN TUYỂN SINH</button>
                                </fieldset>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    layout: 'no_layout',
    methods: {
        chooseRole(role) {
            const urlParams = (this.$route.hash);
            let token = urlParams.split('=')[1]
            if(token) {
                this.$axios.$post(`loginfb`,{token: token,role: role}).then((response)=>{
                    if(response.status == 200) {
                        this.$auth.setToken('local', 'Bearer ' +response.data.token);
                        this.$auth.setStrategy('local');
                        this.$auth.fetchUser().then(() => {
                        window.location.href = '/admin';
                        }).catch((e) => {
                            this.$auth.logout();
                            window.location.href = '/';
                        })
                    }else if(response.status == 201){
                        this.$auth.logout();
                        $('#chooseRole').modal({backdrop: 'static', keyboard: false});
                    }
                }).catch(error => {
                        console.log(error.response)
                        this.$swal(
                            'Lỗi!',
                            'Token không hợp lệ',
                            'error'
                        );
                    })
                    
            }
        }
    },
    async mounted() {
        const urlParams = (this.$route.hash);
        let token = urlParams.split('=')[1]
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
                }else if(response.status == 201){
                    this.$auth.logout();
                    $('#chooseRole').modal({backdrop: 'static', keyboard: false});
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