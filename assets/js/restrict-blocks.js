/**
 * restrict-blocks.js
 */

/**
 * Disable blocks by name
 *
 * @link https://wordpress.stackexchange.com/questions/379612/how-to-remove-the-core-embed-blocks-in-wordpress-5-6
 */
wp.domReady(function () {
  // list all variations
  // console.table(wp.blocks.getBlockVariations('core/embed'));

  /* Disable core embeds */
  const allowedEmbedBlocks = [
    'facebook',
    'instagram',
    'soundcloud',
    'spotify',
    'twitter',
    'vimeo',
    'youtube',
  ];

  wp.blocks.getBlockVariations('core/embed').forEach(function (blockVariation) {
    if (-1 === allowedEmbedBlocks.indexOf(blockVariation.name)) {
      wp.blocks.unregisterBlockVariation('core/embed', blockVariation.name);
    }
  });
});
