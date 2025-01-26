<!-- autor: Paez Velasco Jimmy Josue -->
<?php require_once HEADER ?>

<main class="container-faqs">
    <!-- Sección para agregar nueva FAQ -->
    <?php
    $errors = $_SESSION['errors'] ?? [];
    $formData = $_SESSION['formData'] ?? [];
    unset($_SESSION['errors'], $_SESSION['formData']); // Limpiar los datos de la sesión después de usarlos
    ?>

    <section class="container-add-faq">
        <h2 class="title-faq">Agregar Nueva Pregunta Frecuente</h2>
        <form method="post" action="index.php?c=faq&f=insert_faq" class="form-add-faq">
            <div class="container-question-answer">
                <label for="question">Pregunta:</label>
                <textarea id="question" name="question" required><?= htmlspecialchars($formData['question'] ?? '') ?></textarea>
                <label for="answer">Respuesta:</label>
                <textarea id="answer" name="answer" required><?= htmlspecialchars($formData['answer'] ?? '') ?></textarea>
            </div>
            <div class="container-author-category">
                <label for="author">Autor:</label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($formData['author'] ?? '') ?>" required>


                <label for="categoryId">Categoría:</label>
                <select id="categoryId" name="categoryId" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="1" <?= isset($formData['categoryId']) && $formData['categoryId'] == 1 ? 'selected' : '' ?>>Devolución</option>
                    <option value="2" <?= isset($formData['categoryId']) && $formData['categoryId'] == 2 ? 'selected' : '' ?>>Soporte</option>
                    <option value="3" <?= isset($formData['categoryId']) && $formData['categoryId'] == 3 ? 'selected' : '' ?>>Garantía</option>
                    <option value="4" <?= isset($formData['categoryId']) && $formData['categoryId'] == 4 ? 'selected' : '' ?>>Privacidad</option>
                </select>
            </div>
            <div class="container-priority-button">
                <label for="priority">Prioridad:</label>
                <select id="priority" name="priority" required>
                    <option value="">Seleccione una prioridad</option>
                    <option value="Baja" <?= isset($formData['priority']) && $formData['priority'] === 'Baja' ? 'selected' : '' ?>>Baja</option>
                    <option value="Media" <?= isset($formData['priority']) && $formData['priority'] === 'Media' ? 'selected' : '' ?>>Media</option>
                    <option value="Alta" <?= isset($formData['priority']) && $formData['priority'] === 'Alta' ? 'selected' : '' ?>>Alta</option>
                </select>
                <button type="submit" class="btn-add-faq">Agregar FAQ</button>
            </div>
            <div class="container-errors">
                <?php if (isset($errors['question'])): ?>
                    <span class="error-message" style="color: red;"><?= htmlspecialchars($errors['question']) ?></span>
                <?php endif; ?>
                <?php if (isset($errors['answer'])): ?>
                    <span class="error-message" style="color: red;"><?= htmlspecialchars($errors['answer']) ?></span>
                <?php endif; ?>
                <?php if (isset($errors['author'])): ?>
                    <span class="error-message" style="color: red;"><?= htmlspecialchars($errors['author']) ?></span>
                <?php endif; ?>
                <?php if (isset($errors['categoryId'])): ?>
                    <span class="error-message" style="color: red;"><?= htmlspecialchars($errors['categoryId']) ?></span>
                <?php endif; ?>
                <?php if (isset($errors['priority'])): ?>
                    <span class="error-message" style="color: red;"><?= htmlspecialchars($errors['priority']) ?></span>
                <?php endif; ?>
            </div>
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
                        if ($faq->getCategoryId() == 1):
                            $category = "Devolucion";
                        elseif ($faq->getCategoryId() == 2):
                            $category = "Soporte";
                        elseif ($faq->getCategoryId() == 3):
                            $category = "Garantia";
                        elseif ($faq->getCategoryId() == 4):
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