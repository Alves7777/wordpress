<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do banco de dados - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wordpress' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'santos' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'La@07021994' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '%_EP^I}-q03{q~*4qBw5~px8yEy)W0dhL|)PK!rF`o86 l=3JY[uv81{luSj5c$M' );
define( 'SECURE_AUTH_KEY',  'VQ]a{o_^:VX:o3baBa)/u:<-_K&E$c*cvt4Q?sQXV$1+xW*%gz8)0hUYE6F(z*Ov' );
define( 'LOGGED_IN_KEY',    'C1$Q&YgvSkK[5j5^ k$@YC*:R|IFXQ/@k$_iG!`MQL9uIV}8,E@|lVM{V5}0<^zv' );
define( 'NONCE_KEY',        'yBH=ii4ktcYXD1kI~HG<<#{4C6T^(amKUduo 6hu~XV&hM%d=c(KUhs%W],*kf`Y' );
define( 'AUTH_SALT',        '?X0Y1]GwR?%s9(GPGDtmJ%GIKY ?fRM<E9zTSKpcE8;is&6n#Q#4)0/J)AA+EjsW' );
define( 'SECURE_AUTH_SALT', 'E)}+]ZC08@I)D<Z0{%pZG:osM?y9vr0qe3IDe1aMK1P(g)*R/p)bdVF#+5X{7K[Y' );
define( 'LOGGED_IN_SALT',   'N/bQ2PFO3b4!P%${2P9GMb]@qb(b#Dy.VvE7vQW*7`}f2u!)%r+0mA.]U:)WQnoR' );
define( 'NONCE_SALT',       ':|9HJisi~N-~=&:5Kzt`:r8r.n76A|T3kva,=d>.@Fk~AoRG8t@u$%t?Je}V>c]&' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
