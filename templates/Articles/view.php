<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link('Voltar', ['action' => 'index']); ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <p><?= h($article->body) ?></p>
        <p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>
        <p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>
    </div>
</div>
