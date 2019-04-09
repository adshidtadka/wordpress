<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'wordpress' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'root' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'root' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '4#Ka>jD{YjG;&x?(})/vew6y>5rS|HWFL[Y,@O>GCbBC3j&bbEtU|2;N|9~-na]$' );
define( 'SECURE_AUTH_KEY',  '4*^Y&>1,Aq0ml9EKv:Z:{Y|$pZ|lw#iLE|Fr*y#2IhO~!2d-4!&^mk[#7`Q$9/,`' );
define( 'LOGGED_IN_KEY',    'yFGRyG%3i`UY5AV5!x6%Yz9[j-*%Ve>*^_>hHFRp^c ntOGz&=YK3KA]*o>I$|gY' );
define( 'NONCE_KEY',        '?M`Gxp/lYw(gqVFcpI3*|&M ]$bR=-sM[`g @blr$k&?7I>vXI$qf&{iV]bLt4!5' );
define( 'AUTH_SALT',        'N8f;6b}G?QE]>}Q43w b(PEi;@IP56773A_95yN,*d lLo)u=5Q3*C7xYc-A9Qa4' );
define( 'SECURE_AUTH_SALT', 'La#H pL<m0v0Vx w`PhlP8%]Tc$[C2f6$e+3wbiW/|cz!Pm4WqLs{!P%%.W3onVA' );
define( 'LOGGED_IN_SALT',   ']p2ST%E]?VW5@%),#aw]Fq(Z49)UZwt<Lb/O8aZJwc2&+``|P/|shQ0)$Q#4c:7j' );
define( 'NONCE_SALT',       '8OIZ|T*6v]ezzy!?~TV@2^njDMeXy)v|?&=BsS86Q:Mh!(xL^&N2t0nuGzY1E!/t' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
