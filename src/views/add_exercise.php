<?php
$pageTitle = 'Přidat nové cvičení';
include 'src/views/header.php';

$errors = $_SESSION['exercise_errors'] ?? [];
$data = $_SESSION['exercise_data'] ?? [
    'title' => '',
    'description' => '',
    'exercise_type' => '',
    'duration' => '',
    'calories_burned' => '',
    'date' => date('Y-m-d')
];

unset($_SESSION['exercise_errors'], $_SESSION['exercise_data']);
?>

<div class="page-header">
    <div>
        <h2>Přidat nové cvičení</h2>
        <p>Zaznamenejte si svou aktivitu a sledujte svůj pokrok</p>
    </div>
</div>

<div class="form-container">
    <form action="index.php?action=add_exercise" method="post" class="form-card">
        <div class="form-group <?php echo isset($errors['title']) ? 'has-error' : ''; ?>">
            <label for="title">Název cvičení *</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-heading"></i>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($data['title']); ?>" placeholder="Např. Ranní běh" required>
            </div>
            <?php if (isset($errors['title'])): ?>
                <div class="error-message"><?php echo $errors['title']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group <?php echo isset($errors['description']) ? 'has-error' : ''; ?>">
            <label for="description">Popis</label>
            <textarea id="description" name="description" rows="3" placeholder="Zadejte podrobnosti o cvičení"><?php echo htmlspecialchars($data['description']); ?></textarea>
        </div>

        <div class="form-group <?php echo isset($errors['exercise_type']) ? 'has-error' : ''; ?>">
            <label for="exercise_type">Typ cvičení *</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-tag"></i>
                <select id="exercise_type" name="exercise_type" required>
                    <option value="">Vyberte typ cvičení</option>
                    <option value="cardio" <?php echo $data['exercise_type'] === 'cardio' ? 'selected' : ''; ?>>Kardio</option>
                    <option value="strength" <?php echo $data['exercise_type'] === 'strength' ? 'selected' : ''; ?>>Posilování</option>
                    <option value="flexibility" <?php echo $data['exercise_type'] === 'flexibility' ? 'selected' : ''; ?>>Flexibilita</option>
                    <option value="balance" <?php echo $data['exercise_type'] === 'balance' ? 'selected' : ''; ?>>Balance</option>
                    <option value="other" <?php echo $data['exercise_type'] === 'other' ? 'selected' : ''; ?>>Ostatní</option>
                </select>
            </div>
            <?php if (isset($errors['exercise_type'])): ?>
                <div class="error-message"><?php echo $errors['exercise_type']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-row">
            <div class="form-group <?php echo isset($errors['duration']) ? 'has-error' : ''; ?>">
                <label for="duration">Doba trvání (minuty) *</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-clock"></i>
                    <input type="number" id="duration" name="duration" value="<?php echo htmlspecialchars($data['duration']); ?>" placeholder="Doba v minutách" required min="1">
                </div>
                <?php if (isset($errors['duration'])): ?>
                    <div class="error-message"><?php echo $errors['duration']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="calories_burned">Spálené kalorie</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-fire"></i>
                    <input type="number" id="calories_burned" name="calories_burned" value="<?php echo htmlspecialchars($data['calories_burned']); ?>" placeholder="Počet kalorií" min="0">
                </div>
            </div>
        </div>

        <div class="form-group <?php echo isset($errors['date']) ? 'has-error' : ''; ?>">
            <label for="date">Datum *</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-calendar"></i>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($data['date']); ?>" required>
            </div>
            <?php if (isset($errors['date'])): ?>
                <div class="error-message"><?php echo $errors['date']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn primary-btn"><i class="fas fa-plus"></i> Přidat cvičení</button>
            <a href="index.php?page=exercises" class="btn secondary-btn"><i class="fas fa-times"></i> Zrušit</a>
        </div>
    </form>
</div>

<?php include 'src/views/footer.php'; ?> 