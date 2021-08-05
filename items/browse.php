<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
<?php echo public_nav_items(array (
    array (
        'label' => __('Browse All'),
        'uri' => url('items/browse')
        ),
    array (
        'label' => __('Images'),
        'uri' => url('items/browse?type=6')
        ),
    array (
        'label' => __('Documents'),
        'uri' => url('items/browse?type=1')
        ),
    array (
        'label' => __('Oral Histories'),
        'uri' => url('items/browse?type=4')
        ),
    array (
        'label' => __('Contributed Items'),
        'uri' => url('items/browse?search=&collection=3')
    ),
)); ?>
</nav>

<?php echo pagination_links(); ?>

<?php if ($total_results > 0): ?>

<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php endif; ?>

<?php foreach (loop('items') as $item): ?>
<div class="item record">
    <h2><?php echo link_to_item(null, array('class'=>'permalink')); ?></h2>
    <div class="item-meta">

    <?php if (metadata('item', 'item_type_name') == 'Still Image'): ?>
    <div class="item-img">
        <?php echo link_to_item(item_image()); ?>
    </div>
    <?php endif; ?>

    <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
    <div class="item-description">
        <?php echo $description; ?>
    </div>
    <?php endif; ?>

    <?php if (metadata('item', 'has tags')): ?>
    <div class="tagsbrowse"><p><?php echo __('Tags'); ?>:
        <?php echo tag_string('items'); ?></p>
    </div>
    <?php endif; ?>

    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

    </div><!-- end class="item-meta" -->
</div><!-- end class="item hentry" -->
<?php endforeach; ?>

<?php echo pagination_links(); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
