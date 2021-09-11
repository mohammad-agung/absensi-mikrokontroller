<div class="limiter bg-darkcustom">
    <div class="container-login100">
        <div class="wrap-login100 p-t-50 p-b-90 bg-darkcustom">
            <form class="login100-form validate-form flex-sb flex-w" method="POST" action="<?= base_url('auth'); ?>">
                <span class="login100-form-title p-b-51 text-white">
                    Login
                </span>
                <?= $this->session->flashdata('message'); ?>

                <div class="wrap-input100 validate-input m-b-16">
                    <input class="input100" type="text" id="email" name="email" placeholder="Email" autocomplete="off" value="<?= set_value('email'); ?>">
                    <span class="focus-input100"></span>
                </div>
                <?= form_error('email', '<small class="text-danger pl-3 m-b-16 mt-10">', '</small>'); ?>

                <div class="wrap-input100 validate-input m-b-16">
                    <input class="input100" type="password" id="password" name="password" placeholder="Password" autocomplete="off">
                    <span class="focus-input100"></span>
                </div>
                <?= form_error('password', '<small class="text-danger pl-3 m-b-16 mt-10">', '</small>'); ?>

                <div class="flex-sb-m w-full p-t-3 p-b-24">
                    <div>
                        <a href="<?= base_url('auth/forgotpassword') ?>" class="txt1">
                            Forgot Password?
                        </a>
                    </div>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>