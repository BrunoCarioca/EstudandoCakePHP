<h1>Articles</h1>
<?= $this->Html->link('Add Article', ['action' => 'add']) ?>
<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
    </tr>
    <?php foreach ($articleslist as $article): ?>
        <tr>
            <td>
                <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
            </td>
            <td>
                <?= $article->created->format(DATE_RFC850); ?>
            </td>
            <td>
                <?= $this->Html->link('Editar', ['action' => 'edit', $article->slug]);?>
                <?= $this->Form->postLink (
                    'Deletar', ['action' => 'delete', $article->slug],
                    ['confirm' => 'Você tem certeza?']
                )?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

