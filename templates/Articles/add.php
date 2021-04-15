<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="articles form content">
            <?= $this->Form->create($article) ?>
            <fieldset>
                <legend><?= __('Add Article') ?></legend>
                <?php
                   echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
                   echo $this->Form->control('title');
                   echo $this->Form->control('body', ['rows' => '5']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Save Artigo')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
