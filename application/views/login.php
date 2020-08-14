
<style>
  body{
    background-color: royalblue !important;
  }
</style>

<div class="content-body">
  <section class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-md-5 col-sm-5 col-lg-5 col-xs-6 offset-2 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-1">
                        <img src="<?php echo base_url("assets/images/logo sjp.png");?>" width="250" height="70">
                    </div>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2 mb-0">
                    <span>Login</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form class="form-horizontal form-simple" method="POST" action="<?php echo base_url('Auth/proses_login');?>" novalidate>
                      <fieldset class="form-group position-relative has-icon-left mb-1">
                       <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" class="form-control"  required>                        
                        <input type="text" name="username" class="form-control form-control-lg input-lg" id="user-name" placeholder="Your Username"
                        required>
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                       <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" class="form-control"  required>

                        <input type="password" name="password" class="form-control form-control-lg input-lg" id="user-password"
                        placeholder="Enter Password" required>
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                      <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                    </form>
                  </div>
                </div>
            </div>
          </div>
    </div>
  </section>
</div>