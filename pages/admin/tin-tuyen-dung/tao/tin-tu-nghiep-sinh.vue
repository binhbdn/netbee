<template>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-lg-9 col-sm-6 col-12">
                            <section id="icon-tabs">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Form wizard with icon tabs</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <p>Add <code>.icons-tab-steps</code> class to get desired icons in tab.</p>
                                                    <form action="#" class="icons-tab-steps wizard-circle">

                                                        <!-- Step 1 -->
                                                        <h6><i class="step-icon feather icon-home"></i> Step 1</h6>
                                                        <fieldset>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="firstName11">First Name </label>
                                                                        <input type="text" class="form-control" id="firstName11">
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="lastName11">Last Name</label>
                                                                        <input type="text" class="form-control" id="lastName11">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="emailAddress11">Email</label>
                                                                        <input type="email" class="form-control" id="emailAddress11">
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="location11">City</label>
                                                                        <select class="custom-select form-control" id="location11" name="location">
                                                                            <option value="new-york">New York</option>
                                                                            <option value="chicago">Chicago</option>
                                                                            <option value="san-francisco">San Francisco</option>
                                                                            <option value="boston">Boston</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>

                                                        <!-- Step 2 -->
                                                        <h6><i class="step-icon feather icon-briefcase"></i> Step 2</h6>
                                                        <fieldset>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="proposalTitle11">Proposal Title</label>
                                                                        <input type="text" class="form-control" id="proposalTitle11">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jobtitle11">Job Title</label>
                                                                        <input type="text" class="form-control" id="jobtitle11">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="shortDescription11">Short Description :</label>
                                                                        <textarea name="shortDescription" id="shortDescription11" rows="5" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>

                                                        <!-- Step 3 -->
                                                        <h6><i class="step-icon feather icon-image"></i> Step 3</h6>
                                                        <fieldset>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="eventName11">Event Name :</label>
                                                                        <input type="text" class="form-control" id="eventName11">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="eventType11">Event Status :</label>
                                                                        <select class="custom-select form-control" id="eventType11" data-placeholder="Type to search cities" name="eventType11">
                                                                            <option value="Banquet">Planning</option>
                                                                            <option value="Fund Raiser">In Process</option>
                                                                            <option value="Dinner Party">Finished</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="eventLocation11">Event Location :</label>
                                                                        <select class="custom-select form-control" id="eventLocation11" name="location">
                                                                            <option value="new-york">New York</option>
                                                                            <option value="chicago">Chicago</option>
                                                                            <option value="san-francisco">San Francisco</option>
                                                                            <option value="boston">Boston</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group d-flex align-items-center pt-md-2">
                                                                        <label class="mr-2">Requirements :</label>
                                                                        <div class="c-inputs-stacked">
                                                                            <div class="d-inline-block mr-2">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <input type="checkbox" value="false">
                                                                                    <span class="vs-checkbox">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="">Staffing</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-inline-block">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <input type="checkbox" value="false">
                                                                                    <span class="vs-checkbox">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="">Catering</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body p-2">
                                        <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                            <div class="avatar-content">
                                                <i class="feather icon-heart text-info font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700">Cập nhật thông tin</h2>
                                        <p class="mb-0 line-ellipsis">Cập nhật các thông tin, kỹ năng, học vấn, kinh nghiệm... mà bạn yêu cầu</p>
                                    </div>
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
    name: 'CreateIndexJob',
    layout: 'admin',
    head: {
        title: 'Home page 🚀',
        link: [
            { rel: 'stylesheet', href: '/app-assets/css/plugins/forms/wizard.css' },
        ],
        script: [
            { src: '/app-assets/js/scripts/forms/wizard-steps.js'}
        ]
    },
    data () {
        return {

        }
    },

    methods:{

    },
    mounted () {
    }
  
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
</style>
