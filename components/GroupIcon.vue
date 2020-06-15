<template>
  <div class="group_icon">
    <div class="btn_home">
      <a class="i" href="#" style="color: #fff;">
        <i class="fa fa-angle-up"></i>
      </a>
    </div>
    <div class="icon-f" style="position: absolute;top: 35%;margin-left: 6px;">
      <a
        class="btn btn-warningg"
        href="https://www.facebook.com/NetBeevn-107178937322342/"
        target="_blank"
        style="border-radius: 20%; width: 25px; height: 37px; font-size: 22px; line-height: 28px;padding: 14% 32%;"
      >
        <i class="fab fa-facebook-f" style="color: #fff;"></i>
      </a>
    </div>
    <div class="icon-m" id="#follow" style="position: absolute; top: 67%;margin-left: 6px; ">
      <a href="#follow"  class="btn btn-warningg"  id="mail_contact"  style="border-radius: 20%; width: 25px; height: 37px; font-size: 19px; line-height: 28px; padding-left: 7px; padding-top: 5px;"
      >
     
        <i class="fa fa-envelope" style="margin-left: -3px;color: #fff;"></i>
      
      </a>
    </div>
  </div>
</template>
<script>
export default {};

</script>
<style>
.group_icon {
  position: fixed;
  top: 60%;
  border-radius: 8px; 
  height: 134px;
  border: #f6f6f6 1px solid;
  background-color: #dddddd;
  width: 40px;
  right: 7px;
}

.btn_home {
  color: black;
  width: 37px;
  height: 35px;
  margin-left: 2px;
  border-radius: 20%;
  margin-top: 6px;
  /* background-color: #ffc107; */
}
a.btn.btn-warningg {    
    
}
button#mail_contact {
  background-color: #ffc107 !important;
}
i.fa.fa-angle-up:hover {
  color: black !important;
}
i.fa.fa-angle-up {
  font-size: 26px;
  margin-left: 10.5px;
  margin-top: 3px;
}
i.fa.fa-envelope:hover {
    color: white !important;
}
i.fab.fa-facebook-f:hover {
    color: white !important;
}
i.fa.fa-angle-up:hover {
    color: white !important;
}
</style>