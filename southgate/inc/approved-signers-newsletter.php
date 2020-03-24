<?php
/*
 * Subscribe approved(published) Signers to mailchimp
 */

function tsfSubscribeEmailToMailchimp($emailAddress, $postID)
{
    if (!defined('TSF_MAILCHIMP_API_KEY') || !defined('TSF_MAILCHIMP_LIST_ID')) {
        trigger_error("Mailchimp is not configured.");
        return;
    }

    $apiKey = TSF_MAILCHIMP_API_KEY;
    $listID = TSF_MAILCHIMP_LIST_ID;
    $status = 'subscribed';     // unsubscribed, subscribed, cleaned, pending

    $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);    // data-center, it is the part of api key - us5, us8 etc
    $args = [
        'method' => 'POST',
        'timeout' => 30,
        'headers' => ['Authorization' => 'Basic '.base64_encode('user:'.$apiKey)],
        'body' => json_encode([
            'email_address' => $emailAddress,
            'status' => $status
        ])
    ];

    // Add a Contact to a List/Audience
    $response = wp_remote_post('https://'.$dataCenter.'.api.mailchimp.com/3.0/lists/'.$listID.'/members/', $args);
    if (is_wp_error($response)) {
        return;
    }

    $body = json_decode(wp_remote_retrieve_body($response));

    if (((wp_remote_retrieve_response_code($response) >= 200 && wp_remote_retrieve_response_code($response) <= 299) && $body->status == $status)
        || ($body->title == "Member Exists")) {
        // hence, subscribed to mailchimp
        update_post_meta($postID, 'tsf_signer_mailchimp_subscription', '1');
        delete_post_meta($postID, 'tsf_signer_mailchimp_subscription_error');
    } else {
        update_post_meta($postID, 'tsf_signer_mailchimp_subscription_error', $body);
    }
}
