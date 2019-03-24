<?php
/**
 * WC Address Book
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$wc_address_book = new WC_Address_Book();
$customer_id = get_current_user_id();
$address_book = $wc_address_book->get_address_book( $customer_id );

// 住所変更画面では、住所録を表示しない。
if ( ! $type ) : 

	$shipping_address = get_user_meta( $customer_id, 'shipping_address_1', true );

	// 配送先住所が入力されてから住所録表示でいいよねー。
	if ( ! empty( $shipping_address ) ) :
		?>

		<hr>
		<div class="address--book">
			<h2>お届け先住所録</h2>

			<p class="myaccount--address">
				<?php echo apply_filters( 'woocommerce_my_account_my_address_book_description', 'お支払時に以下の住所を選択することもできます。' ); ?>
			</p>

			<?php
			if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
				echo '<div class="col2-set addresses address-book">';
			}

			foreach ( $address_book as $name => $fields ) :

				// デフォルトのお届け先住所がここに表示されないように。
				if ( 'shipping' === $name || 'billing' === $name ) {
					continue;
				}

				$address = apply_filters(
					'woocommerce_my_account_my_address_formatted_address',
					array(
						'first_name' => get_user_meta( $customer_id, $name . '_first_name', true ),
						'last_name'  => get_user_meta( $customer_id, $name . '_last_name', true ),
						'company'    => get_user_meta( $customer_id, $name . '_company', true ),
						'address_1'  => get_user_meta( $customer_id, $name . '_address_1', true ),
						'address_2'  => get_user_meta( $customer_id, $name . '_address_2', true ),
						'city'       => get_user_meta( $customer_id, $name . '_city', true ),
						'state'      => get_user_meta( $customer_id, $name . '_state', true ),
						'postcode'   => get_user_meta( $customer_id, $name . '_postcode', true ),
						'country'    => get_user_meta( $customer_id, $name . '_country', true ),
					),
					$customer_id,
					$name
				);

				$formatted_address = WC()->countries->get_formatted_address( $address );

				if ( $formatted_address ) :
					?>

					<div class="wc-address-book-address">
						<div class="wc-address-book-meta">
							<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'shipping/?address-book=' . $name ) ); ?>" class="wc-address-book-edit"><?php echo esc_attr__( 'Edit', 'wc-address-book' ); ?></a>
							<a id="<?php echo esc_attr( $name ); ?>" class="wc-address-book-delete"><?php echo esc_attr__( 'Delete', 'wc-address-book' ); ?></a>
							<a id="<?php echo esc_attr( $name ); ?>" class="wc-address-book-make-primary"><?php echo esc_attr__( 'Make Primary', 'wc-address-book' ); ?></a>
						</div>
						<address>
							<?php echo wp_kses( $formatted_address, array( 'br' => array() ) ); ?>
						</address>
					</div>

				<?php endif; ?>

			<?php endforeach; ?>

		</div>
	<?php endif; ?>

	<?php
	// お届け先住所を追加するためのボタンを追加
	if ( ! empty( get_user_meta( $customer_id, 'shipping_address_1' ) ) ) {
		$wc_address_book->add_additional_address_button();
	}
	?>

<?php endif; ?>
