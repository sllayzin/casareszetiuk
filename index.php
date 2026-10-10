<?php
declare(strict_types=1);

$whatsapp = '5551997201985';
$pedidoLink = 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode('Olá! Vim pelo site da Casa Reszetiuk e gostaria de fazer um pedido.');
$itemOrderLink = static fn (string $item): string => 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode('Olá! Vim pelo site da Casa Reszetiuk e gostaria de pedir: ' . $item . '. Pode confirmar, por favor?');
$money = static fn (float $value): string => 'R$ ' . number_format($value, 2, ',', '.');
$sections = [
    [
        'title' => 'Frangos assados',
        'note' => 'Acompanham polenta frita ou batata assada.',
        'items' => [
            ['name' => 'Tradicional', 'price' => 60],
            ['name' => 'Recheado com farofa da casa', 'price' => 70],
            ['name' => 'Recheado com queijo coalho, calabresa e batata rústica', 'price' => 75],
        ],
    ],
    [
        'title' => 'Prato da casa',
        'note' => 'Arroz, polenta frita, salada e maionese da casa.',
        'items' => [
            ['name' => 'Salsichão', 'price' => 40],
            ['name' => 'Coxa e sobrecoxa', 'price' => 40],
        ],
    ],
    [
        'title' => 'Kits',
        'note' => 'Acompanham batata assada ou polenta frita.',
        'items' => [
            ['name' => '3 coxa e sobrecoxa', 'price' => 40],
            ['name' => '3 coxa e sobrecoxa + 3 salsichões', 'price' => 50],
        ],
    ],
    [
        'title' => 'Alaminutas caseiras',
        'items' => [
            ['name' => 'Alaminuta caseira', 'price' => 29, 'prefix' => 'A partir de'],
        ],
    ],
    [
        'title' => 'Guarnições',
        'items' => [
            ['name' => 'Polenta frita'],
            ['name' => 'Batata assada'],
            ['name' => 'Maionese da casa'],
            ['name' => 'Espaguete ao molho sugo'],
            ['name' => 'Aipim com cebola e bacon'],
        ],
    ],
    [
        'title' => 'Bebidas',
        'items' => [
            ['name' => 'Refrigerantes'],
            ['name' => 'Sucos'],
            ['name' => 'Cervejas'],
            ['name' => 'Água'],
        ],
    ],
    [
        'title' => 'Sobremesas',
        'items' => [
            ['name' => 'Pudim — 120 g', 'price' => 12],
            ['name' => 'Sagu com creme', 'price' => 10],
            ['name' => 'Potes de frutas', 'price' => 10],
            ['name' => 'Salada de frutas — 500 ml', 'price' => 12],
        ],
    ],
];
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#21130e">
    <title>Casa Reszetiuk | Cardápio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <a class="brand" href="#inicio" aria-label="Casa Reszetiuk, início">
            <span class="brand-small">Casa</span>
            <span class="brand-name">Reszetiuk</span>
            <span class="brand-tag">Da nossa casa para a sua!</span>
        </a>
        <a class="top-order" href="<?= htmlspecialchars($pedidoLink, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Pedir pelo WhatsApp</a>
    </header>

    <main id="inicio">
        <section class="hero">
            <div class="hero-copy">
                <p class="eyebrow">SABOR E TRADIÇÃO EM CADA PEDAÇO</p>
                <h1>Nosso <span>Cardápio</span></h1>
                <p class="hero-tagline">Da nossa casa para a sua!</p>
                <a class="button" href="#cardapio">Conheça o cardápio <span aria-hidden="true">↓</span></a>
            </div>
            <div class="hero-plate" aria-hidden="true"><span>🍗</span><b>Feito com carinho</b></div>
        </section>

        <section class="menu-section" id="cardapio">
            <div class="section-heading">
                <p class="eyebrow">COMIDA CASEIRA</p>
                <h2>Nosso cardápio</h2>
                <p>Da nossa casa para a sua!</p>
            </div>
            <div class="menu-grid">
                <?php foreach ($sections as $index => $section): ?>
                    <article class="menu-card <?= $index === 0 ? 'featured' : '' ?>">
                        <div class="card-heading"><span class="card-number"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span><h3><?= htmlspecialchars($section['title'], ENT_QUOTES, 'UTF-8') ?></h3></div>
                        <?php if (!empty($section['note'])): ?><p class="card-note"><?= htmlspecialchars($section['note'], ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
                        <ul class="menu-items">
                            <?php foreach ($section['items'] as $item): ?>
                                <li class="menu-row">
                                    <span class="menu-item-name"><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <span class="menu-item-actions">
                                        <?php if (isset($item['price'])): ?>
                                            <strong><?php if (!empty($item['prefix'])): ?>A partir de <?php endif; ?><?= $money((float) $item['price']) ?></strong>
                                        <?php endif; ?>
                                        <a class="order-link" href="<?= htmlspecialchars($itemOrderLink($item['name']), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="Pedir <?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?> pelo WhatsApp">Pedir ↗</a>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                <?php endforeach; ?>
            </div>
            <p class="price-note">Valores conforme o cardápio. Consulte pelo WhatsApp os preços de bebidas e guarnições.</p>
        </section>

        <section class="delivery" id="entrega">
            <div class="delivery-title"><span class="delivery-icon" aria-hidden="true">⌂</span><div><p class="eyebrow">TELE-ENTREGA</p><h2>Entregamos no conforto da sua casa!</h2></div></div>
            <div class="delivery-details">
                <div><span class="detail-label">ENDEREÇO</span><p>Rua Marechal Rondon, 1128<br>Bairro Niterói — Canoas/RS</p></div>
                <div><span class="detail-label">TAXA DE ENTREGA</span><p>Bairro Niterói <strong>R$ 5,00</strong><br>Demais bairros <strong>R$ 13,00</strong></p></div>
            </div>
            <a class="whatsapp-button" href="<?= htmlspecialchars($pedidoLink, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer"><span aria-hidden="true">◉</span> Peça pelo WhatsApp <strong>(51) 99720-1985</strong></a>
        </section>
    </main>

    <footer><a class="footer-brand" href="#inicio">Casa Reszetiuk</a><span>Da nossa casa para a sua!</span><a href="<?= htmlspecialchars($pedidoLink, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Fale com a gente ↗</a></footer>
</body>
</html>
