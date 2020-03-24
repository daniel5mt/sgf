<?php
/*
 * SignUp Form (for Signers) Modal
 */
?>
<!-- Modal -->
<div class="modal bg-white animatied-popup" id="sign-now" tabindex="-1" role="dialog" aria-labelledby="sign-nowLabel"
     aria-hidden="true">
    <div class="modal-dialog mw-100" role="document">
        <div class="modal-content border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body mx-auto">
                <h2 class="modal-title text-center" id="sign-nowLabel"><?php _e('Sign Now', 'southgate') ?></h2>
                <?php
                gravity_form(TSF_SIGN_NOW_GFORM_ID, false, false, false, null, true);
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
