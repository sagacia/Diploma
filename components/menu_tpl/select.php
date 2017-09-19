<option 
    value="<?= $category['cat_id'] ?>" 
    
    <?php if ($category['cat_id'] == $this->model->parent_id) echo "selected";?>
    <?php if ($category['cat_id'] == $this->model->cat_id) echo "disabled";?> > 
    <?= $tab .  $category['cat_name'] ?> </option>

<?php if (isset($category['childs'])): ?>
    <ul>
        <?= $this->getMenuHtml($category['childs'], $tab . '_')  ?>
    </ul>
<?php endif; ?>





