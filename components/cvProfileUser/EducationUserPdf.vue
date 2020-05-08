<template>
    <div style="padding-left:10px;padding-right:10px;" class="main-edu-cv">                      
        <div class="education-cv">
            <div class="row">
                <div class="col-md-8">
                    <span class="a">{{edu.name_education}}</span>                    
                </div>
                <div class="col-md-4" style="text-align: right; padding-left:0px;">
                    <div class="row">
                        <div class="col-md-6" style="padding:0;">
                            <span class="a" style="font-size: 12px;">{{edu.from_datetime_education}}</span>
                        </div>
                        <div class="col-md-6" style="padding-left:0px;">
                            <span class="a" style="font-size: 12px;">{{edu.to_datetime_education}}</span>
                        </div>
                    </div>                   
                </div>
            </div>                                
        </div>                  
        <div class="education-khoa">
            <span class="a">{{edu.learning_education}}</span>
        </div>                  
        <div class="education-cap">
            <span class="a">{{edu.business_education}}</span>            
        </div>                                                                                                              
    </div>
</template>
<script>

export default {
    name: 'EducationUserPdf',
    props: {
        edu: Object
    }, 
    data() {
        return {
        }
    },
    methods: {
       
    },
    mounted() {
        
    }
}
</script>
<style>
</style>
