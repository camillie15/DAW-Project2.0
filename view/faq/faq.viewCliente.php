<?php require_once HEADER 
// autor: Jimmy Josue Paez Velasco
?>

<main class="container-faqs">
<section class="container-faq-search">
        <h2 class="title-faq">Buscar Preguntas Frecuentes</h2>
        <form method="get" action="index.php" class="form-search-faq">
            <input type="hidden" name="c" value="faq">
            <input type="hidden" name="f" value="list_client_view">
            <label for="keyword">Palabra clave:</label>
            <input type="text" id="keyword" name="keyword" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">

            <label for="categoryId">Categoría:</label>
            <select id="categoryId" name="categoryId">
                <option value="">Todas</option>
                <option value="1" <?= isset($_GET['categoryId']) && $_GET['categoryId'] == 1 ? 'selected' : '' ?>>Devolucion</option>
                <option value="2" <?= isset($_GET['categoryId']) && $_GET['categoryId'] == 2 ? 'selected' : '' ?>>Soporte</option>
                <option value="3" <?= isset($_GET['categoryId']) && $_GET['categoryId'] == 3 ? 'selected' : '' ?>>Garantia</option>
                <option value="4" <?= isset($_GET['categoryId']) && $_GET['categoryId'] == 4 ? 'selected' : '' ?>>Privacidad</option>
            </select>

            <button type="submit" class="btn-search-faq">Buscar</button>
        </form>
    </section>
    

    <section class="container-faq-list">
        <h2 class="title-faq">Lista de Preguntas Frecuentes</h2>
        <div class="faq-list">
            <?php if (!empty($faqs)): ?>
                <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item">
                        <h3 class="faq-question"><?= htmlspecialchars($faq->getQuestion()) ?></h3>
                        <p class="faq-answer"><?= htmlspecialchars(substr($faq->getAnswer(), 0, 100)) ?>...</p>
                        <?php 
                            if($faq->getCategoryId()==1):
                                $category = "Devolucion";
                            elseif($faq->getCategoryId()==2):
                                $category = "Soporte";
                            elseif($faq->getCategoryId()==3):
                                $category = "Garantia";
                            elseif($faq->getCategoryId()==4):
                                $category = "Privacidad";
                            endif;
                        ?>
                        <p class="faq-category">Categoría: <?= htmlspecialchars($category) ?></p>
                        <p class="faq-author">Autor: <?= htmlspecialchars($faq->getAuthor()) ?></p>
                        <p class="faq-priority">Prioridad: <strong><?= htmlspecialchars($faq->getPriority()) ?></strong></p>
                        <p class="faq-date">Fecha de creación: <?= (new DateTime($faq->getCreationDate()))->format('d-m-Y') ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-faqs">No hay preguntas frecuentes registradas.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once FOOTER ?>
