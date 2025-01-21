<?php require_once HEADER ?>

<main class="container-faqs">
    <!-- Sección para agregar nueva FAQ -->
    <section class="container-add-faq">
        <h2 class="title-faq">Agregar Nueva Pregunta Frecuente</h2>
        <form method="post" action="index.php?c=faq&f=insert_faq" class="form-add-faq">
            <label for="question">Pregunta:</label>
            <input type="text" id="question" name="question" required>

            <label for="answer">Respuesta:</label>
            <textarea id="answer" name="answer" required></textarea>

            <label for="author">Autor:</label>
            <input type="text" id="author" name="author" required>

            <label for="categoryId">Categoría:</label>
            <select id="categoryId" name="categoryId" required>
                <option value="1">Devolucion</option>
                <option value="2">Soporte</option>
                <option value="3">Garantia</option>
                <option value="4">Privacidad</option>
            </select>

            <label for="priority">Prioridad:</label>
            <select id="priority" name="priority" required>
                <option value="Baja">Baja</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
            </select>

            <button type="submit" class="btn-add-faq">Agregar FAQ</button>
        </form>
    </section>

        <!-- Sección de búsqueda de FAQs -->
        <section class="container-faq-search">
        <h2 class="title-faq">Buscar Preguntas Frecuentes</h2>
        <form method="get" action="index.php" class="form-search-faq">
            <input type="hidden" name="c" value="faq">
            <input type="hidden" name="f" value="list_admin_view">
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
    
    <!-- Sección de lista de FAQs -->
    <section class="container-faq-list">
        <h2 class="title-faq">Lista de Preguntas Frecuentes</h2>
        <div class="faq-list">
            <?php if (!empty($faqs)): ?>
                <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item">
                        <h3 class="faq-question"><?= htmlspecialchars($faq->getQuestion()) ?></h3>
                        <p class="faq-answer"><?= htmlspecialchars(substr($faq->getAnswer(), 0, 100)) ?></p>
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
                        <div class="faq-buttons">
                        <a href="index.php?c=faq&f=editFaq&id=<?= $faq->getFaqId(); ?>" class="btn-edit-faq">Editar</a>
                        <a href="index.php?c=faq&f=delete_faq&id=<?= $faq->getFaqId(); ?>" 
                            class="btn-delete-faq" 
                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta FAQ?');">
                            Eliminar
                        </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-faqs">No hay preguntas frecuentes registradas.</p>
            <?php endif; ?>
        </div>
    </section>

    <?php if (isset($_GET['message'])): ?>
        <p class="message"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
</main>

<?php require_once FOOTER ?>


