<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'kellyshow');

/** MySQL数据库用户名 */
define('DB_USER', 'zdy');

/** MySQL数据库密码 */
define('DB_PASSWORD', '123456');

/** MySQL主机 */
define('DB_HOST', '120.79.4.11');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'f|4CG`ffb)yf${LGIkA?q>w!$0xXd~qlRP07.pT7zBY7~L%+W,}d&G4<*3jj!M>u');
define('SECURE_AUTH_KEY',  'Jo?W;Zl^=F5Cnd0jjtfL![(/[A&4NsRem%<6_.yYP9ypu3~ OkzbtVc+y=V)Y/sO');
define('LOGGED_IN_KEY',    'G1hL$,-:ES@Z<!7/w77| ;@/Pu3dk`Rjt[sAbCF(Rr(H939`%AsBl3.?pn1 XKmK');
define('NONCE_KEY',        'f/x&0,z4-wL_uj:;E~|n l!s.z!RbM_oLw@*nJd]?ltWEK]Dm2%k7j@l tW5R/Hx');
define('AUTH_SALT',        '*m)%ci+Gf{c&Y]RX YN_GFAP}g3gb/)|El01a(0$Zw!n8DoP>N>~t,LSa0V!{~-K');
define('SECURE_AUTH_SALT', 'NQ{|g!*?z1ug{LfvAii4MGO:S6)1DA-aW*IeSJssZq)V]bW(vwcx7CnoK(^Xs(j]');
define('LOGGED_IN_SALT',   '7q{:^fS}lpm#`~5,7Rpipr<H7lNqG8Z,cjjOQ&W<N P?K.$f>sK._UiECK;R.`3)');
define('NONCE_SALT',       'n# r%KaKp:}A(,3Kst1ro!UZd&O@#G>e]$?7D~e<`bv}[D8]us;uVpC>=-j&dl|S');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'show_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');

define("FS_METHOD","direct");
define("FS_CHMOD_DIR", 0777);
define("FS_CHMOD_FILE", 0777);
