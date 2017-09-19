<option 
    value="<?= $category['cat_id'] ?>" 
    <?php if($category['cat_id'] == $this->model->category_id) echo 'selected' ?>
   
        >
    <?= $tab . $category['cat_name'] ?></option>

 <?php if( isset($category['childs']) ): ?>
            <ul>
                <?= $this->getMenuHtml($category['childs'], $tab . '- ') ?>
            </ul>
<?php endif; ?>  


