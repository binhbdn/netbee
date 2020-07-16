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
                                 <div class="main-call" id="meet" ></div>
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
        name: 'JoinCall',
        layout: 'admin',
       
        data(){
            return {
                
            }
        }, 
        head: {
            script: [
                { hid: 'stripe', src: 'https://meet.jit.si/external_api.js', defer: true },
            ]
        },       
        components:{
                     
        },     
        methods: {                   
             fetchdata(){
                let id = this.$route.params.id                   
                const domain = 'meet.jit.si'
                const options = {
                    roomName: id,
                    width: '100%',
                    height: 650,
                    parentNode: document.querySelector('#meet'),
                    interfaceConfigOverwrite : {
                        JITSI_WATERMARK_LINK :  "http://netbee.vn/",
                        APP_NAME: "Netbee Call",
                        DEFAULT_BACKGROUND: '#FFB701',
                        SHOW_JITSI_WATERMARK: false,
                        SHOW_WATERMARK_FOR_GUESTS : false,
                        TOOLBAR_BUTTONS: [
                            'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                                'fodeviceselection', 'hangup', 'profile', 'chat', 'etherpad', 'settings', 'raisehand',
                                'videoquality', 'filmstrip', 'invite', 'feedback', 'stats', 'shortcuts',
                                'tileview', 'download', 'help', 'mute-everyone'           
                        ],
                        SHOW_CHROME_EXTENSION_BANNER: false
                    },
                }
                const api = new JitsiMeetExternalAPI(domain, options)
                   api.executeCommand('displayName', 'thành')
                   const add = api.addEventListener('readyToClose',this.delete)
             },
             delete: function(){
                let id = this.$route.params.id 
                this.$axios.post('lichphongvan/insertHisCall',{                  
                    id_room: id,                 
                    action: 2,
                }).then(response => {                                                                                                  
                        window.location.href = '/admin/call/';                                            
                 })
                 .catch(error => {
                    console.log(error.response);
                });  

            }
        },        
        mounted() {                        
            this.fetchdata();
        }
    };
</script>
<style scoped>
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
</style>
<style>
.main-call{
    margin: 20px;
}
</style>