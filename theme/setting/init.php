<?php

class Zenith_Admin {

	public static $version = '0.0.0';

	// define( 'Bill_URL', get_template_directory_uri() );

	public static function init() {
		add_action( 'admin_menu' , array( __CLASS__, 'add_admin_menu'), 10, 2);
		add_action( 'admin_init' , array( __CLASS__, 'admin_init'), 10, 2);
		add_action( 'admin_print_styles-toplevel_page_options-zenith', array( __CLASS__, 'admin_enqueue_scripts' ) );
	}

	public static function add_admin_menu() 
	{
		$page_title = '見積書・請求書の設定';
		$menu_title = '見積/請求書';
		$capability = 'administrator';
		$menu_slug  = 'options-zenith';
		$function	= array( __CLASS__, 'setting_page');
		// $icon_url	= '';
		// $position	= '';
		add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $menu_slug, $function );
	}

	public static function setting_page()
	{
		// delete_option('bill-setting');
		?>
		<div class="wrap">
		<h2>見積書・請求書の設定</h2>
		<form id="bill-setting-form" method="post" action="">
		<?php wp_nonce_field( 'bill-nonce-key', 'options-zenith' );?>
		<?php $options = get_option('bill-setting', Zenith_Admin::options_default());?>
		<table class="form-table">
		<tr>
		<th>請求者名</th>
		<td><input class="regular-text" type="text" name="bill-setting[own-name]" value="<?php echo esc_attr( $options['own-name'] ) ?>"></td>
		</tr>
		<tr>
		<th>住所</th>
		<td><textarea class="regular-text" name="bill-setting[own-address]" rows="4"><?php echo esc_textarea( $options['own-address'] ) ?></textarea></td>
		</tr>
		<tr>
		<th>ロゴ画像</th>
		<td>
		<?php
		$attr = array(
			'id'    => 'thumb_own-logo',
			'class' => 'input_thumb',
		);
		// no image 画像
		$no_image = '<img src="'.get_template_directory_uri().'/assets/img/no-image.png" id="thumb_own-logo" alt="" class="input_thumb" style="width:150px;height:auto;">';
		if ( isset( $options['own-logo'] ) && $options['own-logo'] ){
			if ( wp_get_attachment_image( $options['own-logo'], 'medium', false, $attr ) ) {
				echo wp_get_attachment_image( $options['own-logo'], 'medium', false, $attr );
			} else {
				// 画像自体がメディアから削除されてしまった場合
				echo $no_image;
			}
		} else {
			echo $no_image;
		}
		?>
		<input type="hidden" name="bill-setting[own-logo]" id="own-logo" value="<?php echo esc_attr( $options['own-logo'] ) ?>" style="width:60%;" />  
		<button id="media_own-logo" class="media_btn btn btn-default button button-default">画像を選択</button></td>
		</tr>
		<tr>
		<th>印鑑画像</th>
		<td>
		<?php
		$attr = array(
			'id'    => 'thumb_own-seal',
			'class' => 'input_thumb',
		);
		$no_image = '<img src="'.get_template_directory_uri().'/assets/img/no-image.png" id="thumb_own-seal" alt="" class="input_thumb" style="width:150px;height:auto;">';
		if ( isset( $options['own-seal'] ) && $options['own-seal'] ){
			if ( wp_get_attachment_image( $options['own-seal'], 'medium', false, $attr ) ) {
				echo wp_get_attachment_image( $options['own-seal'], 'medium', false, $attr );
			} else {
				// 画像自体がメディアから削除されてしまった場合
				echo $no_image;
			}
		} else {
			echo $no_image;
		}
		?>
		<input type="hidden" name="bill-setting[own-seal]" id="own-seal" value="<?php echo esc_attr( $options['own-seal'] ) ?>" style="width:60%;" />  
		<button id="media_own-seal" class="media_btn btn btn-default button button-default">画像を選択</button></td>
		</tr>
		<tr>
		<th>振込先</th>
		<td><textarea class="regular-text" name="bill-setting[own-payee]" rows="3"><?php echo esc_textarea( $options['own-payee'] ) ?></textarea></td>
		</tr>
		<tr>
		<th>備考（請求）</th>
		<?php $remarks_bill  = ( isset( $options['remarks-bill'] ) )  ? $options['remarks-bill'] : '' ;?>
		<td><textarea class="regular-text" name="bill-setting[remarks-bill]" rows="4"><?php echo esc_textarea( $remarks_bill ) ?></textarea></td>
		</tr>
		<tr>
		<th>備考（見積）</th>
		<?php $remarks_estimate  = ( isset( $options['remarks-estimate'] ) )  ? $options['remarks-estimate'] : '' ;?>
		<td><textarea class="regular-text" name="bill-setting[remarks-estimate]" rows="4"><?php echo esc_textarea( $remarks_estimate ) ?></textarea></td>
		</tr>
		<tr>
		<th>送付状メッセージ</th>
		<?php $client_doc_message  = ( isset( $options['client-doc-message'] ) )  ? $options['client-doc-message'] : '' ;?>
		<td><textarea class="regular-text" name="bill-setting[client-doc-message]" rows="4"><?php echo esc_textarea( $client_doc_message ) ?></textarea></td>
		</tr>
		</table>
		<p><input type="submit" value="設定を保存" class="button button-primary button-large"></p>
		</form>
		</div>
		<?php
	}

	public static function options_default(){
	$default = array(
			'own-name'    => '日進印刷株式会社',
			'own-address'   => '〒733-0001
広島市西区大芝一丁目19番20号
TEL : （082）237-1611',
			'own-logo'    => '',
			'own-seal'    => '',
			'own-payee'   => '広島銀行 本店営業部 当座 0656925
もみじ銀行 三篠支店 普通 1734646',
			'remarks-bill'     => 'お振込手数料はご負担いただきますようお願い申し上げます。',
			'remarks-estimate' => '本見積もりの有効期限は1ヶ月となります。',
			'client-doc-message' => '平素は格別のお引き立てにあずかり、厚く御礼申し上げます。
早速ではございますが下記書類をお送りします。御査収の上よろしく御取計らいの程お願い申し上げます。',
		);
		return $default;
	}

	public static function admin_enqueue_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_media();
		wp_enqueue_script( 'vk_mediauploader', get_template_directory_uri().'/assets/js/mediauploader.js', array( 'jquery' ), self::$version );
		wp_enqueue_style( 'options-zenith-style', get_template_directory_uri().'/assets/css/setting-page.css', array(), self::$version, 'all' );
	}

	public static function admin_init()
	{

		if ( isset( $_POST['options-zenith'] ) && $_POST['options-zenith'] ) {
					
			if ( check_admin_referer( 'bill-nonce-key', 'options-zenith' ) ) {
				// 保存処理

				if ( isset( $_POST['bill-setting'] ) && $_POST['bill-setting'] ) {
					update_option( 'bill-setting', $_POST['bill-setting'] );
				} else {
					update_option( 'bill-setting', '' );
				}

				wp_safe_redirect( menu_page_url( 'options-zenith', false ) );
			}
		}
	}

}

Zenith_Admin::init();
