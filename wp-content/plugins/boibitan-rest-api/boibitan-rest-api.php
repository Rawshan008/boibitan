<?php 
/**
 * Plugin Name:       Boibitan Rest Api
 * Plugin URI:        #
 * Description:       Boibitan for woocommerce rest api
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Rawshan ali
 * Author URI:        #
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       boibitan-rest
 * Domain Path:       /languages
 */

function order_details_by_id( $data ) {
  $order = wc_get_order( $data['id'] );
  
 
  if ( empty( $order ) ) {
    return null;
  }

  $order_data = $order->get_data();
  

  $response = [
    'order_id' => $order->get_id(),
    'customer_id' => $order_data['customer_id'],
    'order_status' => $order->get_status(),
    'payment_method' => $order->get_payment_method_title(),
    'date_created' => $order_data['date_created']->date('Y-m-d H:i:s'),
    'total' => $order_data['total'],
    'total_discount' => $order_data['discount_total'],
    'first_name' => $order_data['billing']['first_name'],
    'last_name' => $order_data['billing']['last_name'],
    'customer_mail' => $order_data['billing']['email'],
    'customer_phone' => $order_data['billing']['phone'],
  ];
 
  return $response;
} 

 add_action('rest_api_init', function() {
  register_rest_route('boibitan/v1', '/order/(?P<id>\d+)', [
    'method' => 'GET',
    'callback' => 'order_details_by_id',
  ]);

  register_rest_route('boibitan/v1', '/ordermail/(?P<mail>\d+)', [
    'method' => 'GET',
    'callback' => 'order_details_by_mail',
  ]);
 });