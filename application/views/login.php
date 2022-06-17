 <style type="text/css">
   body {
     background-color: royalblue !important;
   }
 </style>
 <section class="flexbox-container">
   <div class="col-12 d-flex align-items-center justify-content-center">
     <div class="col-md-4 col-10 box-shadow-2 p-0">
       <div class="card border-grey border-lighten-3 m-0">
         <div class="card-header border-0">
           <div class="card-title text-center">
             <div class="p-1">
               <img src="<?php echo base_url("assets/images/logo sjp.png"); ?>" style="width: 100%; height: auto;">
             </div>
           </div>
           <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
             <span>Login</span>
           </h6>
         </div>
         <div class="card-content">
           <div class="card-body">
             <?= $this->session->flashdata('pesan');
              unset($_SESSION['pesan']); ?>
             <form class="form-horizontal form-simple" method="POST" action="<?php echo base_url('Auth/proses_login'); ?>" novalidate>
               <fieldset class="form-group position-relative has-icon-left mb-1">
                 <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" class="form-control" required>
                 <input type="text" name="username" class="form-control form-control-lg input-lg" id="user-name" placeholder="Your Username" required>
                 <div class="form-control-position">
                   <i class="ft-user"></i>
                 </div>
               </fieldset>
               <fieldset class="form-group position-relative has-icon-left">
                 <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" class="form-control" required>

                 <input type="password" name="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Enter Password" required>
                 <div class="form-control-position">
                   <i class="ft-lock"></i>
                 </div>
               </fieldset>
               <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
               <div class="sso-depok-login-btn mt-1 text-center"></div>
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>
   <img src="<?php echo base_url("assets/images/logo_bsre.jpeg"); ?>" style="position: absolute; right: -10px; bottom: 0; width: 15%;">

   <script type="text/javascript" src="https://dummy.smartcity.co.id/sso-library/api.js" name="tf-login-button" data-client_id="gZk3QRbfIu944YZd"></script>
 </section>
