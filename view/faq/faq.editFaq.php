<!-- autor: Paez Velasco Jimmy Josue -->
<?php require_once HEADER ?>

<main class="container-faqs">
    <section class="container-edit-faq">
        <h2 class="title-faq">Editar Pregunta Frecuente</h2>
        
        <?php
        // Comprobar si se ha encontrado la FAQ
        $errors = $_SESSION['errors'] ?? [];
        $formData = $_SESSION['formData'] ?? [];
        unset($_SESSION['errors'], $_SESSION['formData']);
        if (isset($faq)) :
        ?>
            <form method="post" action="index.php?c=faq&f=update_faq" class="form-edit-faq">
                <input type="hidden" name="frequentQuestionId" value="<?= $faq->getFaqId() ?>">

                <label for="question">Pregunta:</label>
                <input 
                    type="text" 
                    id="question" 
                    name="question" 
                    value="<?= htmlspecialchars($formData['question'] ?? $faq->getQuestion()) ?>" 
                    required>
                <?php if (isset($errors['question'])): ?>
                    <p style="color: red; font-size: 0.9em; margin-top: 0.2em;"><?= $errors['question'] ?></p>
                <?php endif; ?>

                <label for="answer">Respuesta:</label>
                <textarea 
                    id="answer" 
                    name="answer" 
                    required><?= htmlspecialchars($formData['answer'] ?? $faq->getAnswer()) ?></textarea>
                <?php if (isset($errors['answer'])): ?>
                    <p style="color: red; font-size: 0.9em; margin-top: 0.2em;"><?= $errors['answer'] ?></p>
                <?php endif; ?>

                <label for="author">Autor:</label>
                <input 
                    type="text" 
                    id="author" 
                    name="author" 
                    value="<?= htmlspecialchars($formData['author'] ?? $faq->getAuthor()) ?>" 
                    required>
                <?php if (isset($errors['author'])): ?>
                    <p style="color: red; font-size: 0.9em; margin-top: 0.2em;"><?= $errors['author'] ?></p>
                <?php endif; ?>

                <label for="categoryId">Categoría:</label>
                <select id="categoryId" name="categoryId" required>
                    <option value="1" <?= ($formData['categoryId'] ?? $faq->getCategoryId()) == 1 ? 'selected' : '' ?>>Devolution</option>
                    <option value="2" <?= ($formData['categoryId'] ?? $faq->getCategoryId()) == 2 ? 'selected' : '' ?>>Support</option>
                    <option value="3" <?= ($formData['categoryId'] ?? $faq->getCategoryId()) == 3 ? 'selected' : '' ?>>Warranty</option>
                    <option value="4" <?= ($formData['categoryId'] ?? $faq->getCategoryId()) == 4 ? 'selected' : '' ?>>Privacy</option>
                </select>
                <?php if (isset($errors['categoryId'])): ?>
                    <p style="color: red; font-size: 0.9em; margin-top: 0.2em;"><?= $errors['categoryId'] ?></p>
                <?php endif; ?>

                <label for="priority">Prioridad:</label>
                <select id="priority" name="priority" required>
                    <option value="Baja" <?= ($formData['priority'] ?? $faq->getPriority()) === 'Baja' ? 'selected' : '' ?>>Baja</option>
                    <option value="Media" <?= ($formData['priority'] ?? $faq->getPriority()) === 'Media' ? 'selected' : '' ?>>Media</option>
                    <option value="Alta" <?= ($formData['priority'] ?? $faq->getPriority()) === 'Alta' ? 'selected' : '' ?>>Alta</option>
                </select>
                <?php if (isset($errors['priority'])): ?>
                    <p style="color: red; font-size: 0.9em; margin-top: 0.2em;"><?= $errors['priority'] ?></p>
                <?php endif; ?>

                <label for="status">Estado:</label>
                <select id="status" name="status" required>
                    <option value="1" <?= ($formData['status'] ?? $faq->getStatus()) == 1 ? 'selected' : '' ?>>Activo</option>
                    <option value="0" <?= ($formData['status'] ?? $faq->getStatus()) == 0 ? 'selected' : '' ?>>Inactivo</option>
                </select>

                <button type="submit" class="btn-edit-faq">Actualizar FAQ</button>
            </form>
        <?php else: ?>
            <p>No se ha encontrado la FAQ para editar.</p>
        <?php endif; ?>
    </section>
</main>

<?php require_once FOOTER ?>
