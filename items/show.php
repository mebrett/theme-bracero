<?php
$title = metadata('item', 'display_title');
echo head(array('title' => $title, 'bodyclass' => 'items show'));
?>
<!-- define collection name -->
<?php $cname = metadata('item', 'Collection Name'); ?>

<h1><?php echo metadata('item', 'rich_title', array('no_escape' => true)); ?></h1>

<!-- Display file fullsize before metadata -->
<?php if (metadata('item', 'has files')): ?>
    <?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
<?php endif; ?>

<!-- Lesson plans have different metadata displayed -->

<?php if (metadata('item', 'item_type_name') == 'Lesson Plan'): ?>
<?php echo "Lesson Plan" ?>

<h2><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h2>

<h3>Description</h3>
<p><?php echo metadata('item', array('Dublin Core', 'Description')); ?></p>

<h3>Duration</h3>
<p><?php echo metadata('item', array('Item Type Metadata', 'Duration')); ?></p>


<h3>Objectives</h3>
<p><?php echo metadata('item', array('Item Type Metadata', 'Objectives')); ?></p>


<h3>Materials</h3>
<p><?php echo metadata('item', array('Item Type Metadata', 'Materials')); ?></p>


<h3>Lesson Plan Text</h3>
<p><?php echo metadata('item', array('Item Type Metadata', 'Lesson Plan Text')); ?></p>

<!-- metadata display for everything else -->
<?php else: ?>
<!-- Check if public contribution -->
    <?php if ($cname == 'Public Contributions'): ?>
    <div id="contributed-item">
                <p>This item was contributed by a user and has not been curated by a project historian.</p>
     </div>
     <?php endif ?>

<?php echo all_element_texts('item'); ?>

<!-- end the IF statement for Lesson plans vs other metadata -->
<?php endif; ?>

<!-- The following prints a list of all tags associated with the item -->
<?php if (metadata('item', 'has tags')): ?>
<div id="item-tags" class="element">
    <h3><?php echo __('Tags'); ?></h3>
    <div class="element-text"><?php echo tag_string('item'); ?></div>
</div>
<?php endif;?>

<!-- The following prints a citation for this item. -->
<div id="item-citation" class="element">
    <h3><?php echo __('Citation'); ?></h3>
    <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
</div>
<!-- Hiding output formats
<div id="item-output-formats" class="element">
    <h3><?php echo __('Output Formats'); ?></h3>
    <div class="element-text"><?php echo output_format_list(); ?></div>
</div>
-->
<?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

<nav>
<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>
</nav>

<?php echo foot(); ?>