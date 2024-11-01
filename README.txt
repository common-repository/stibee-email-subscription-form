=== 스티비 구독 폼 ===
Contributors: sitbee
Donate link: https://stibee.com
Tags: email, marketing, stibee, 이메일, 마케팅, 스티비, 
Requires at least: 3.0.1
Tested up to: 5.2.1
Requires PHP: 5.2.4
Stable tag: 5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

이메일 뉴스레터 서비스 [스티비(stibee)](https://stibee.com)의 구독 폼 플러그인입니다.

*   스티비의 주소록과 연동된 구독 폼 위젯과 숏코드를 생성할 수 있습니다.
*   구독 폼 위젯을 웹사이트의 사이드바 등에 추가할 수 있습니다.
*   숏코드를 페이지, 푸터 등에 입력해 구독 폼을 추가할 수 있습니다.
*   위젯을 통해 입력된 구독자 정보(이메일 주소, 이름 등)는 연동된 주소록에 저장됩니다.
*   입력받을 구독자 정보 필드를 설정할 수 있습니다.
*   구독 폼 디자인에 대한 간단한 설정을 할 수 있습니다.

이 플러그인은 스티비 구독 폼의 일부 기능(예. 개인정보 수집 및 이용 동의 표시, 광고성 정보 수신 동의 표시, 구독 폼 URL 그룹 파라미터 등)을 지원하지 않습니다.

구독 폼의 모든 기능을 사용하려면 구독 폼을 HTML 코드로 내보내 사용하는 것을 권장합니다. (관련 도움말: [구독 폼을 홈페이지에 넣을 수 있나요?](https://help.stibee.com/ko/articles/5900235-구독-폼을-홈페이지에-넣을-수-있나요)) 복사한 HTML 코드를 워드프레스 홈페이지의 "사용자 정의 HTML" 위젯에 붙여넣거나, 페이지 등에 직접 삽입하면 구독 폼을 추가할 수 있습니다.

스티비 구독 폼에 대한 자세한 내용은 [구독 폼은 어떻게 사용하나요?](https://help.stibee.com/ko/articles/2838904-구독-폼은-어떻게-사용하나요)를 참고해주세요.



== Installation ==

1. 스티비 구독 폼 플러그인 파일을 FTP plugins 디렉토리에 업로드 하거나 워드프레스 관리자 페이지의 플러그인 메뉴에서 업로드하거나, 또는 플러그인 마켓에서 "스티비 구독 폼"을 검색하여 설치합니다.
1. 설치가 완료된 후 플러그인 활성화합니다.
1. [계정 연결] 메뉴에서 스티비에서 발급받은 API 키를 입력하여 계정을 연결합니다.
1. API 키는 스티비 로그인 후 **[계정 및 결제]** > **[API 키]**에서 만들 수 있습니다. (관련 도움말: [주소록 API 사용하기](https://help.stibee.com/ko/articles/1040878-주소록-api-사용하기))
1. **[주소록 선택]** 메뉴에서 연동하려는 주소록을 선택합니다.
1. **[디자인]** 메뉴에서 위젯에 표시할 필드(수집하려는 필드)를 선택하고, 구독 폼의 제목과 내용, 디자인을 설정합니다.
1. **[외모]** > **[위젯]** 메뉴에서 "스티비 구독 폼" 위젯을 원하는 곳에 추가합니다. 또는 숏코드 **[stibee_form]**를 원하는 페이지, 푸터 등에 입력합니다.


== Screenshots ==

1. `/assets/screenshot1.png`

== Changelog ==

= 1.0 =
* 최초 배포

= 1.0.1 =
* $buttonText 오류 수정


