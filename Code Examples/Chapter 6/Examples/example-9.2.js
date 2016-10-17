(function() {
	tinymce.create('tinymce.plugins.relatedposts', {
		init : function(ed, url) {
			ed.addButton('relatedposts', {
				title : 'Related posts',
				image : url+'/shortcode-icon.png',
				onclick : function() {
					var limit = prompt("Number of posts to display", "5");

					if (limit != null && limit != '') {
						ed.execCommand('mceInsertContent', false, '[related_posts limit="'+limit+'"]');
					} else {
						ed.execCommand('mceInsertContent', false, '[related_posts]');
					}
				}
			});
		}
	});

	tinymce.PluginManager.add('relatedposts', tinymce.plugins.relatedposts);
})();
