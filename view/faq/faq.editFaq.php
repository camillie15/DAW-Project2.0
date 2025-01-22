<?php require_once HEADER ?>

<main class="container-faqs">
    <section class="container-edit-faq">
        <h2 class="title-faq">Editar Pregunta Frecuente</h2>
        
        <?php
        // Comprobar si se ha encontrado la FAQ
        if (isset($faq)) :
        ?>
            <form method="post" action="index.php?c=faq&f=update_faq" class="form-edit-faq">
            <input type="hidden" name="frequentQuestionId" value="<?= $faq->getFaqId() ?>">


                <label for="question">Pregunta:</label>
                <input type="text" id="question" name="question" value="<?= htmlspecialchars($faq->getQuestion()) ?>" required>

                <label for="answer">Respuesta:</label>
                <textarea id="answer" name="answer" required><?= htmlspecialchars($faq->getAnswer()) ?></textarea>

                <label for="author">Autor:</label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($faq->getAuthor()) ?>" required>

                <label for="categoryId">Categoría:</label>
                <select id="categoryId" name="categoryId" required>
                    <option value="1" <?= $faq->getCategoryId() == 1 ? 'selected' : '' ?>>Devolution</option>
                    <option value="2" <?= $faq->getCategoryId() == 2 ? 'selected' : '' ?>>Support</option>
                    <option value="3" <?= $faq->getCategoryId() == 3 ? 'selected' : '' ?>>Warranty</option>
                    <option value="4" <?= $faq->getCategoryId() == 4 ? 'selected' : '' ?>>Privacy</option>
                </select>

                <label for="priority">Prioridad:</label>
                <select id="priority" name="priority" required>
                    <option value="Baja" <?= $faq->getPriority() === 'Baja' ? 'selected' : '' ?>>Baja</option>
                    <option value="Media" <?= $faq->getPriority() === 'Media' ? 'selected' : '' ?>>Media</option>
                    <option value="Alta" <?= $faq->getPriority() === 'Alta' ? 'selected' : '' ?>>Alta</option>
                </select>

                <label for="status">Estado:</label>
                <select id="status" name="status" required>
                    <option value="1" <?= $faq->getStatus() == 1 ? 'selected' : '' ?>>Activo</option>
                    <option value="0" <?= $faq->getStatus() == 0 ? 'selected' : '' ?>>Inactivo</option>
                </select>

                <button type="submit" class="btn-edit-faq">Actualizar FAQ</button>
            </form>
        <?php else: ?>
            <p>No se ha encontrado la FAQ para editar.</p>
        <?php endif; ?>
    </section>
</main>

<?php require_once FOOTER ?>
