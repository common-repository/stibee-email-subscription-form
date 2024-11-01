<?php

// TODO : 필드를 사용자가 선택하도록...

class Wp_Stibee_Subscribeform {
    public function __construct()
    {
        $this->js_url = 'https://s3.ap-northeast-2.amazonaws.com/qa-resource.stibee.com/subscribe/stb_subscribe_form.js';
		$this->css_url = 'https://s3.ap-northeast-2.amazonaws.com/qa-resource.stibee.com/subscribe/stb_subscribe_form_style.css';
    }
     
    public function wp_stibee_Subscribeform()
    {
        $apitoken = get_option( 'Wp_Stibee_apitoken' );
        $selectedlist = get_option( 'Wp_Stibee_selectedlist' );
        $subscribeendpoint = get_option( 'Wp_Stibee_subscribeendpoint' );
        $formfields = get_option( 'Wp_Stibee_formfields' );
        $formtitle = get_option( 'Wp_Stibee_formtitle' );
        $formdesc = get_option( 'Wp_Stibee_formdesc' );
        $buttontext = get_option( 'Wp_Stibee_buttontext' );
        $buttoncolor = get_option( 'Wp_Stibee_buttoncolor' );
        $buttonbg = get_option( 'Wp_Stibee_buttonbg' );

        if (empty($apitoken) || empty($selectedlist)) {
            echo '<p>⚠️ 설정을 확인해 주세요.</p>';
            return;
        }

        if (!$subscribeendpoint) {
            $response = wp_remote_request( 'https://stibee.com/api/v1.0/lists/' . $selectedlist . '/public/subscribers',
                array(
                    'method' => 'GET',
                    'headers' => array(
                        'AccessToken' => $apitoken
                    )
                )
            );
            $subscribeendpoint = wp_remote_retrieve_body($response);
            update_option('Wp_Stibee_subscribeendpoint', $subscribeendpoint);
        }
        
        ?>
            <link rel="stylesheet" href="<?php echo $this->css_url; ?>">
                <div id="stb_subscribe">
                    <form action="<?php echo $subscribeendpoint; ?>" method="POST" target="_blank" accept-charset="utf-8" class="stb_form" name="stb_subscribe_form" id="stb_subscribe_form" novalidate="">
                        <h1 class="stb_form_title">
                            <?php 
                            if (!empty($formtitle)) {
                                echo $formtitle; 
                            } else {
                                echo "제목";
                            }
                            ?>
                        </h1>
                        <?php if(!empty($formdesc)) { ?>
                            <div class="desc" style="padding: 0 0 15px 0;font-size:13px;">
                                <?php echo $formdesc; ?>
                            </div>
                        <?php } ?>
                        <fieldset class="stb_form_set">
                            <label for="stb_email" class="stb_form_set_label">이메일 주소</label>
                            <input type="email" class="stb_form_set_input" id="stb_email" name="email">
                            <div class="stb_form_msg_error" id="stb_email_error"></div>
                        </fieldset>
                        <?php 
                        if (!empty($formfields)) {
                            foreach ($formfields as $key => $value) {
                                $substitution = explode('__', $key)[0];
                                $label = explode('__', $key)[1];
                                if ($value == 1) { 
                                    echo "<fieldset class='stb_form_set'>";
                                    echo "<label for='stb_{$substitution}' class='stb_form_set_label'>{$label}</label>";
                                    echo "<input type='text' class='stb_form_set_input' id='stb_{$substitution}' name='{$substitution}'>";
                                    echo "</fieldset>";
                                }
                            }
                        }
                        ?>                                                  
                        <fieldset class="stb_form_set_submit">
                            <button 
                                type="submit" 
                                class="stb_form_submit_button" 
                                id="stb_form_submit_button"
                                style="
                                <?php if(!empty($buttoncolor)) { echo "color: {$buttoncolor};"; } ?>
                                <?php if(!empty($buttonbg)) { echo "background-color: {$buttonbg};"; } ?>
                                "
                            >
                                <?php if(!empty($buttontext)) { echo $buttontext; } else { echo "구독하기"; } ?>
                            </button>
                        </fieldset>
                    </form>
                    <div class="stb_form_result" id="stb_form_result">
                    </div>
                </div>
            <script type="text/javascript" src="<?php echo $this->js_url; ?>"></script>
        <?php
    }
}

$wpStibeeSubscribeform = new Wp_Stibee_Subscribeform();