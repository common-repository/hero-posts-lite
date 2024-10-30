/**
 * Adding Hero Posts block to Gutenberg page builder
 */

( function( blocks, editor, i18n, element, blockEditor ) {
	var el				= element.createElement;
	var __				= i18n.__;
	var RichText		= editor.RichText;
	var BlockControls	= editor.BlockControls;
	var useBlockProps	= blockEditor.useBlockProps;

	var useSelect		= wp.data.useSelect;
	var useDispatch		= wp.data.useDispatch;
	var SelectControl	= wp.components.SelectControl;

	var InspectorControls = wp.blockEditor.InspectorControls;

	var blockStyleLabel = {
		margin: '1px',
		height: '32px',
		fontSize: '20px',
		color: '#0693e3'
	};

	var blockStyleSelect = {
		backgroundColor: '#f0f0f0',
		margin: '1px',
		height: '32px',
		fontSize: '18px'
	};

	blocks.registerBlockType( 'bbl/hero-posts', {
			title:			__( 'BoldThemes Hero Posts', 'hero-posts'),
			description:	__( 'Shortcode outputs BoldThemes Hero Posts.', 'hero-posts'),
			icon:			'universal-access-alt',
			category:		'widgets',		
			keywords:		['hero', 'post', 'bold', 'themes'],
			attributes: {
				postID: {
					type:  'string',
					default: '0',
				}
			},
			example: {
				attributes: {
					postID: '0'
				},
			},
			edit: function( props ) {
				var postID = props.attributes.postID;	
				
				function onChangePost( newPost ) {
					props.setAttributes( {
						postID: newPost === undefined ? '0' : newPost,
					} );
				}

				var posttypeOptions = [ {  label: __( 'Select Hero Post ...', 'hero-posts'), value: 0 } ];
				
				var query = {
					status:		'publish',
					orderby:	'title',
					order:		'asc',
					per_page:	-1
				}
				var posts = useSelect((select) => {
					return select('core').getEntityRecords('postType', 'hero-posts', query);
				});
				if ( posts)
				{
					Object.values(posts).forEach(post => {
						  posttypeOptions.push(  { label: post.title.rendered, value: post.id } );
					});					
				}

				return [
					el(
						SelectControl, useBlockProps( {
							key: 'postID',
							label: el( 'h3', {style: blockStyleLabel}, __( 'Hero Posts', 'hero-posts' ) ),
							value: postID,
							options: posttypeOptions,
							onChange: onChangePost,
							style: blockStyleSelect,							
					} ) ),

				];
			},
			save: function( props ) {
			},
	} );
}( window.wp.blocks, window.wp.editor, window.wp.i18n, window.wp.element, window.wp.blockEditor ) );