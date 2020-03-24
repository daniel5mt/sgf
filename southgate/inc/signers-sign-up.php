<?php
/*
 * Save 'Sign Now' gravity-form fields as draft into CPT: Signers
 */

namespace Southgate\SignersSignUp;

add_action('gform_after_submission_'.TSF_SIGN_NOW_GFORM_ID, __NAMESPACE__.'\fillDraftSignerForm', 10, 1);
function fillDraftSignerForm($entry)
{
    $isIndividualForm = rgar($entry, '1') === 'Individual';
    $isChurchForm = rgar($entry, '1') === 'Church/Organization';

    $name = $isIndividualForm ? rgar($entry, '4') : rgar($entry, '15');
    $signer = createNewSignerAsDraft($name);

    if (!is_wp_error($signer)) {
        update_field('field_5da93f62a19e2', $isIndividualForm ? 'individual' : 'church', $signer);    //form_type

        if ($isIndividualForm) {
            update_field('field_5da93feca19e3', rgar($entry, '4'), $signer);    //individual_name
            update_field('field_5da9407ca19e5', rgar($entry, '10'), $signer);    //individual_title
            update_field('field_5da940eda19e6', rgar($entry, '8'), $signer);    //individual_organization
        } else {
            // $isChurchForm
            update_field('field_5da9405ba19e4', rgar($entry, '15'), $signer);    //church_name
            update_field('field_5da9412ba19e7', rgar($entry, '13'), $signer);    //church_denomination
            update_field('field_5da9427722329', rgar($entry, '14'), $signer);    //person_signing_for_church
        }

        update_field('field_5da9415aa19e8', rgar($entry, '12'), $signer);    //email_address
        update_field('field_5da941ac22325', [
            'field_5da941dc22326' => rgar($entry, '11.3'),    //location_city
            'field_5da941f222327' => rgar($entry, '11.4'),    //location_state
            'field_5da9424022328' => rgar($entry, '11.6'),    //location_country
        ], $signer);    //location group
        update_field('field_5da942c92232a', !empty(rgar($entry, '17.3')) ? ["true"] : [], $signer);    //affirmation
        update_field('field_5da9431d2232b', !empty(rgar($entry, '18.1')) ? ["true"] : [], $signer);    //mailchimp

        // delete this g-form entry now
        \GFAPI::delete_entry($entry['id']);
    }
}

/*
 * Create new Signer post as 'draft'
 */
function createNewSignerAsDraft($title)
{
    $signer = wp_insert_post([
        'post_title' => $title,
        'post_status' => 'draft',
        'post_type' => TSF_SIGNERS_CPT_SLUG,
    ], true);

    return $signer;
}

add_action('save_post_'.TSF_SIGNERS_CPT_SLUG, __NAMESPACE__.'\afterSignerStatusChanged', 10, 3);    // runs after post is saved in db.
function afterSignerStatusChanged($postID, $post, $update)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // check if Signer wants newsletter subscription
    if (!get_field('mailchimp', $postID)) {
        return;
    }

    if ($post->post_status === 'publish' && get_post_meta($postID, 'tsf_signer_mailchimp_subscription', true) !== '1') {
        // hence, Signer is approved.
        // hence, subscribe Signer to mailchimp only once.
        require get_template_directory().'/inc/approved-signers-newsletter.php';

        $emailAddress = get_field('email_address', $postID);
        tsfSubscribeEmailToMailchimp($emailAddress, $postID);
    }
}
