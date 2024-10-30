
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<script type="text/html" id="tmplhero-posts-shortcode">
	<div {{{ _.fusionGetAttributes( wrapperAttributes ) }}}>
		{{{ FusionPageBuilderApp.renderContent( mainContent, cid, false ) }}}
	</div>
</script>