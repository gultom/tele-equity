<div id="menu">
    <ul>
<?php foreach ($menu as $key => $value): ?>
        <li><?= $this->Html->link($key, $value); ?></li>
<?php endforeach; ?>
    </ul>
</div>