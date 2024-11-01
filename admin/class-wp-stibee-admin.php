<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://stibee.com
 * @since      1.0.0
 *
 * @package    Wp_Stibee
 * @subpackage Wp_Stibee/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Stibee
 * @subpackage Wp_Stibee/admin
 * @author     Firdaus Zahari <firdaus@fsylum.net>
 */
class Wp_Stibee_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'Wp_Stibee';

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Stibee_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Stibee_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-stibee-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '_spectrum', plugin_dir_url( __FILE__ ) . 'js/spectrum/spectrum.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Stibee_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Stibee_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-stibee-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '_spectrum', plugin_dir_url( __FILE__ ) . 'js/spectrum/spectrum.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_screen_hook_suffix = add_menu_page(
			'🐝 스티비 구독 폼',
			'스티비 구독 폼',
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' ),
			plugin_dir_url( __FILE__ ) . 'images/icon.png'
		);

		$this->plugin_screen_hook_suffix = add_submenu_page( 
			$this->plugin_name,
			'', 
			'계정 연결', 
			'manage_options', 
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);

		$this->plugin_screen_hook_suffix = add_submenu_page( 
			$this->plugin_name,
			'', 
			'주소록 선택', 
			'manage_options', 
			$this->plugin_name . '&tab=lists',
			array( $this, 'display_options_page' )
		);

		$this->plugin_screen_hook_suffix = add_submenu_page( 
			$this->plugin_name,
			'', 
			'디자인', 
			'manage_options', 
			$this->plugin_name . '&tab=style',
			array( $this, 'display_options_page' )
		);

	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/wp-stibee-admin-display.php';
	}

	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {

		$apitoken = get_option( 'Wp_Stibee_apitoken' );

		add_settings_section(
			$this->option_name . '_general',
			'',
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		// 페이지 분기
		$s1show = array('class' => 'hidden');
		if (!isset($_GET['tab'])) {
			$s1show = array('class' => '');
		}

		add_settings_field(
			$this->option_name . '_apitoken',
			__( '🔑 스티비 API 키', 'wp-stibee' ),
			array( $this, $this->option_name . '_apitoken_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			$s1show,
			array( 'label_for' => $this->option_name . '_apitoken' )
		);
		
		add_settings_field(
			$this->option_name . '_accountinfo',
			__( '👤 연결된 계정', 'wp-stibee' ),
			array( $this, $this->option_name . '_accountinfo_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			$s1show,
			array( 'label_for' => $this->option_name . '_accountinfo' )
		);

		$s2show = array('class' => 'hidden');
		if (isset($_GET['tab']) && $_GET['tab'] == 'lists') {
			$s2show = array('class' => '');
		}

		add_settings_field(
			$this->option_name . '_selectedlist',
			__( '📒 주소록 선택', 'wp-stibee' ),
			array( $this, $this->option_name . '_selectedlist_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			$s2show,
			array( 'label_for' => $this->option_name . '_selectedlist' )
		);
		
		$s3show = array('class' => 'hidden');
		if (isset($_GET['tab']) && $_GET['tab'] == 'style') {
			$s3show = array('class' => '');
		}

		add_settings_field(
			$this->option_name . '_formfields',
			__( '☑ 표시할 필드 선택', 'wp-stibee' ),
			array( $this, $this->option_name . '_formfields_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			$s3show,
			array( 'label_for' => $this->option_name . '_formfields' )
		);

		add_settings_field(
			$this->option_name . '_formstyle',
			__( '👨‍🎨 텍스트, 색상 변경', 'wp-stibee' ),
			array( $this, $this->option_name . '_formstyle_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			$s3show,
			array( 'label_for' => $this->option_name . '_formstyle' )
		);
			
		if (isset($_GET['tab']) && $_GET['tab'] == 'style') {
			add_settings_section(
				$this->option_name . '_useshortcode',
				__( '📝 숏코드 사용 방법', 'wp-stibee' ),
				array( $this, $this->option_name . '_useshortcode_cb' ),
				$this->plugin_name
			);
		}

		register_setting( $this->plugin_name, $this->option_name . '_apitoken' );
		register_setting( $this->plugin_name, $this->option_name . '_selectedlist', array( $this, $this->option_name . '_sanitize_selectedlist' ) );
		register_setting( $this->plugin_name, $this->option_name . '_formfields', array( $this, $this->option_name . '_sanitize_formfields' ) );

		register_setting( $this->plugin_name, $this->option_name . '_formtitle' );
		register_setting( $this->plugin_name, $this->option_name . '_formdesc' );
		register_setting( $this->plugin_name, $this->option_name . '_buttontext' );
		register_setting( $this->plugin_name, $this->option_name . '_buttoncolor' );
		register_setting( $this->plugin_name, $this->option_name . '_buttonbg' );
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function Wp_Stibee_general_cb() {
		?>
		<h1>
			<?php
				if (!isset($_GET['tab'])) { echo "🔑 계정연결"; }
				if (isset($_GET['tab']) && $_GET['tab'] == 'lists') { echo "📒 주소록 선택"; }
				if (isset($_GET['tab']) && $_GET['tab'] == 'style') { echo "👨‍🎨 디자인"; }
			?>
		</h1>
		<br>
		<ul class="wp-stibee-tab hidden">
			<li class="<?php if (!isset($_GET['tab'])) { echo "active"; } ?>" >
				<a href="/wp-admin/admin.php?page=wp-stibee">🔑 스티비 API키</a>
			</li>
			<li class="<?php if (isset($_GET['tab']) && $_GET['tab'] == 'lists') { echo "active"; } ?>">
				<a href="/wp-admin/admin.php?page=wp-stibee&tab=lists">📒 주소록 및 필드</a>
			</li>
			<li class="<?php if (isset($_GET['tab']) && $_GET['tab'] == 'style') { echo "active"; } ?>" >
				<a href="/wp-admin/admin.php?page=wp-stibee&tab=style">👨‍🎨 제목 및 스타일</a>
			</li>
		</ul>
		<?php
	}

	public function Wp_Stibee_accountinfo_cb() {
		$apitoken = get_option( $this->option_name . '_apitoken' );
		if(!empty($apitoken)) {
			$response = wp_remote_request( 'https://stibee.com/api/v1.0/accounts/me',
				array(
					'method' => 'GET',
					'headers' => array(
						'AccessToken' => $apitoken
					)
				)
			);

			$response_body = json_decode(wp_remote_retrieve_body($response));

			if (isset($response_body->Code) && $response_body->Code == 'Errors.Authorization.NoToken') {
				echo '<p>⚠️ 잘못됐거나 만료된 API 키입니다. API 키를 다시 입력하세요.</p>';
			} else {
				echo "<strong>{$response_body->id}</strong>";
			}
		} else {
			echo '<p>⚠️ 연결된 계정이 없습니다. API 키를 입력해 주세요.</p>';
		}
	}

	/**
	 * Render the radio input field for position option
	 *
	 * @since  1.0.0
	 */

	public function Wp_Stibee_apitoken_cb() {
		$apitoken = get_option( $this->option_name . '_apitoken' );
		echo '<input type="text" size="100" name="' . $this->option_name . '_apitoken' . '" id="' . $this->option_name . '_apitoken' . '" value="' . $apitoken . '"> <button class="button" id="wp-stibee-api-remove-button">삭제</button>';
		echo '<p class="description">스티비 API 키를 입력하세요. API 키는 스티비 로그인 후 <a href="https://stibee.com/account/api" target="_blank">[계정 및 결제] > [API 키]</a>에서 만들 수 있습니다. 자세한 내용은 <a href="https://help.stibee.com/%EA%B0%9C%EB%B0%9C-%EA%B0%80%EC%9D%B4%EB%93%9C/%EC%A3%BC%EC%86%8C%EB%A1%9D-api-%EC%82%AC%EC%9A%A9%ED%95%98%EA%B8%B0" target="_blank">주소록 API 사용하기</a>를 참고하세요
		</p>';
	}

	public function Wp_Stibee_selectedlist_cb() {
		$selectedlist = get_option( $this->option_name . '_selectedlist' );
		$apitoken = get_option( $this->option_name . '_apitoken' );

		if(!empty($apitoken)) {
			$endpoint = "https://stibee.com/api/v1.0/lists?limit=999&offset=0&opts=count,empty";
			$response = wp_remote_request( 
				$endpoint,
				array(
					'method' => 'GET',
					'headers' => array(
						'AccessToken' => $apitoken
					)
				)
			);

			$response_body = json_decode(wp_remote_retrieve_body($response));
			if ($response['response']['code'] == 200) {
				$items = $response_body->items;
			?>
				<fieldset>
				<table class="wp-list-table widefat striped">
					<thead>
						<tr>
							<th class="manage-column" style="padding-left: 10px;">주소록 이름</th>
							<th class="manage-column">구독자 수</th>
							<th class="manage-column">마지막 업데이트일</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($items as $val) { 
						?>
							<tr>
								<td>
									<label>
										<input 
											type="radio"  
											name="<?php echo $this->option_name . '_selectedlist' ?>" 
											id="<?php echo $this->option_name . '_selectedlist' ?>" 
											value="<?php echo $val->id; ?>" 
											<?php checked( $selectedlist, $val->id ); ?>
										>
										<?php echo $val->listName; ?>
									</label>
								</td>
								<td>
									<?php echo $val->subscribingCount;?>
								</td>
								<td>
									<?php echo date_format(date_create($val->modifiedTime), 'Y. m. d');?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				</fieldset>
			<?php
			} else {
				echo '⚠️ 올바른 스티비 API 키를 입력해 주세요.';
			}

		} else {
			echo '⚠️ 주소록이 없습니다. 주소록을 생성하거나 API 키를 입력해 주세요.';
		}
		echo '<p class="description">연동할 주소록을 선택하세요.</p>';
	}

	public function Wp_Stibee_formfields_cb() {
		$apitoken = get_option( $this->option_name . '_apitoken' );
		$selectedlist = get_option( $this->option_name . '_selectedlist' );
		$formfields = get_option( $this->option_name . '_formfields' );

		if(!empty($apitoken) && !empty($selectedlist)) {
			$response = wp_remote_request( 'https://stibee.com/api/v1.0/lists/'.$selectedlist.'/vars',
				array(
					'method' => 'GET',
					'headers' => array(
						'AccessToken' => $apitoken
					)
				)
			);

			$response_body = json_decode(wp_remote_retrieve_body($response));
			if ($response['response']['code'] == 200) {
				$items = $response_body;
			?>
				<fieldset>
				<?php
					foreach ($items as $val) { 
						if($val->substitution != 'email') {
				?>
					<label>
						<input 
							type="checkbox" 
							name="<?php echo $this->option_name . '_formfields['.$val->substitution.'__'.$val->label.']' ?>" 
							value="1" 
							<?php checked(1, $formfields[$val->substitution.'__'.$val->label] ); ?>
						>
						<?php echo $val->label; ?>
					</label>
					<br>
					<?php } ?>
				<?php } ?>
				</fieldset>
			<?php
			} else {
				echo '⚠️ 올바른 스티비 API 키를 입력해 주세요.';
			}

		} else {
			echo '⚠️ 선택된 주소록이 없습니다.';
		}
		echo '<p class="description">위젯/숏코드을 통해 구독할 주소록을 선택하세요. 이메일 주소는 기본값입니다.</p>';
	}

	public function Wp_Stibee_formstyle_cb() {
		$apitoken = get_option( $this->option_name . '_apitoken' );
		$selectedlist = get_option( $this->option_name . '_selectedlist' );
		$formtitle = get_option( $this->option_name . '_formtitle' );
		$formdesc = get_option( $this->option_name . '_formdesc' );
		$buttontext = get_option( $this->option_name . '_buttontext' );
		$buttoncolor = get_option( $this->option_name . '_buttoncolor' );
		$buttonbg = get_option( $this->option_name . '_buttonbg' );

		if(!empty($apitoken) && !empty($selectedlist)) {
			$response = wp_remote_request( 'https://stibee.com/api/v1.0/lists/'.$selectedlist.'/vars',
				array(
					'method' => 'GET',
					'headers' => array(
						'AccessToken' => $apitoken
					)
				)
			);

			$response_body = json_decode(wp_remote_retrieve_body($response));
			if ($response['response']['code'] == 200) {
				$items = $response_body;
			?>
				<fieldset>
					<label>
						제목
						<br>
						<input type="text" size="100" name="<?php echo $this->option_name.'_formtitle'; ?>" id="<?php echo $this->option_name.'_formtitle'; ?>" value="<?php if(!empty($formtitle)) { echo $formtitle; }  else { echo "구독을 신청하세요"; }?>">
					</label>					
				</fieldset>
				<fieldset>
					<label>
						내용
						<br>
						<textarea rows="4" cols="98" name="<?php echo $this->option_name.'_formdesc'; ?>" id="<?php echo $this->option_name.'_formdesc'; ?>"><?php echo $formdesc; ?></textarea>
					</label>
				</fieldset>
				<fieldset>
					<label>
						버튼 텍스트
						<input type="text" name="<?php echo $this->option_name.'_buttontext'; ?>" id="<?php echo $this->option_name.'_buttontext'; ?>" value="<?php if(!empty($buttontext)) { echo $buttontext; }  else { echo "구독하기"; }?>">
					</label>
				</fieldset>
				<fieldset>
					<label>
						버튼 텍스트 색상
						<input type="text" name="<?php echo $this->option_name.'_buttoncolor'; ?>" id="<?php echo $this->option_name.'_buttoncolor'; ?>" value="<?php if(!empty($buttoncolor)) { echo $buttoncolor; }  else { echo "#ffffff"; }?>">
					</label>
				</fieldset>
				<fieldset>
					<label>
						버튼 배경 색상
						<input type="text" name="<?php echo $this->option_name.'_buttonbg'; ?>" id="<?php echo $this->option_name.'_buttonbg'; ?>" value="<?php if(!empty($buttonbg)) { echo $buttonbg; }  else { echo "#3e81f6"; }?>">
					</label>
				</fieldset>
			<?php
			} else {
				echo '⚠️ 올바른 스티비 API 키를 입력해 주세요.';
			}

		} else {
			echo '⚠️ 선택된 주소록이 없습니다.';
		}
		echo '<p class="description">구독 폼의 스타일을 설정하세요.</p>';
	}

	public function Wp_Stibee_useshortcode_cb() {
		echo '<p>구독 폼을 글, 페이지 등에 숏코드로 추가하려면 아래의 숏코드를 사용하세요.<br><br>[stibee_form]</pre>';
	}
}

// update_option_hook: 옵션이 업데이트될 때 다른 값도 리셋한다
add_action('update_option_Wp_Stibee_selectedlist', function( $old_value, $value ) {
	update_option('Wp_Stibee_subscribeendpoint', false);
}, 10, 2);

add_action('update_option_Wp_Stibee_apikey', function( $old_value, $value ) {
	update_option('Wp_Stibee_subscribeendpoint', false);
	update_option('update_option_Wp_Stibee_selectedlist', '');
	update_option('update_option_Wp_Stibee_formfields', '');
}, 10, 2);

add_action('update_option_Wp_Stibee_formfields', function( $old_value, $value ) {
	var_dump($value);
}, 10, 2);