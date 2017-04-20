<?php echo yii\widgets\Menu::widget([
    'items' => [
        ['label' => 'О нас', 'url' => ['site/index']],
        ['label' => 'Ассортимент',
            'options'=>['class'=>'dropdown'],
            'items' => [
                ['label' => 'Дерево', 'url' => ['site/products', 'id' => 'tree', 'name' => 'Дерево']],
                ['label' => 'Камень', 'url' => ['site/products', 'id' => 'rock', 'name' => 'Камень']],
                ['label' => 'Садовая мебель', 'url' => ['site/products', 'id' => 'garden_furnitur', 'name' => 'Садовая мебель']],
                ['label' => 'Ретро сувениры', 'url' => ['site/products', 'id' => 'retro_souvenirs', 'name' => 'Ретро сувениры']],
            ],
        ],
        ['label' => 'Наши работы', 'url' => ['site/our-works']],
        ['label' => 'Контакты', 'url' => ['site/contacts']],
    ],
    'options' => [
        'class' => 'sf-menu sf-js-enabled','data'=>'menu',
    ],
    'activeCssClass' => 'active',
    'activateParents' => true,
    'submenuTemplate' => "\n<ul class='dropdown-menu' role='menu'>\n{items}\n</ul>\n",
]); ?>