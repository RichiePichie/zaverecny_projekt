<?php
$pageTitle = 'Moje cvičení';
include 'src/views/header.php';
?>

<div class="page-header">
    <div>
        <h2>Moje cvičení</h2>
        <p>Přehled vašich všech zaznamenáných cvičebních aktivit</p>
    </div>
    <div>
        <a href="index.php?page=add_exercise" class="btn primary-btn"><i class="fas fa-plus"></i> Přidat cvičení</a>
    </div>
</div>

<?php if (isset($_SESSION['exercise_added']) && $_SESSION['exercise_added']): ?>
    <div class="alert alert-success">
        Cvičení bylo úspěšně přidáno.
    </div>
    <?php unset($_SESSION['exercise_added']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['exercise_updated']) && $_SESSION['exercise_updated']): ?>
    <div class="alert alert-success">
        Cvičení bylo úspěšně aktualizováno.
    </div>
    <?php unset($_SESSION['exercise_updated']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['exercise_deleted']) && $_SESSION['exercise_deleted']): ?>
    <div class="alert alert-success">
        Cvičení bylo úspěšně odstraněno.
    </div>
    <?php unset($_SESSION['exercise_deleted']); ?>
<?php endif; ?>

<?php if (empty($exercises)): ?>
    <div class="empty-state">
        <i class="fas fa-running empty-icon"></i>
        <p>Zatím nemáte žádné zaznamenané cvičení. <a href="index.php?page=add_exercise">Přidejte nové cvičení</a>.</p>
    </div>
<?php else: ?>
    <div class="exercises-grid">
        <?php foreach ($exercises as $exercise): ?>
            <div class="exercise-card">
                <div class="exercise-card-header">
                    <div class="exercise-icon">
                        <?php 
                        $icon = 'dumbbell';
                        if ($exercise['exercise_type'] === 'cardio') {
                            $icon = 'running';
                        } elseif ($exercise['exercise_type'] === 'flexibility') {
                            $icon = 'child';
                        } elseif ($exercise['exercise_type'] === 'balance') {
                            $icon = 'balance-scale';
                        }
                        ?>
                        <i class="fas fa-<?php echo $icon; ?>"></i>
                    </div>
                    <div class="exercise-type-badge">
                        <?php 
                        $typeTranslation = [
                            'cardio' => 'Kardio',
                            'strength' => 'Síla',
                            'flexibility' => 'Flexibilita',
                            'balance' => 'Rovnováha',
                            'other' => 'Ostatní'
                        ];
                        echo $typeTranslation[$exercise['exercise_type']] ?? $exercise['exercise_type']; 
                        ?>
                    </div>
                </div>
                <div class="exercise-card-body">
                    <h3><?php echo htmlspecialchars($exercise['title']); ?></h3>
                    <p class="exercise-date"><i class="far fa-calendar-alt"></i> <?php echo date('d.m.Y', strtotime($exercise['date'])); ?></p>
                    <div class="exercise-details">
                        <span class="exercise-duration"><i class="far fa-clock"></i> <?php echo $exercise['duration']; ?> min</span>
                        <span class="exercise-calories"><i class="fas fa-fire-alt"></i> <?php echo $exercise['calories_burned']; ?> kcal</span>
                    </div>
                    <?php if (!empty($exercise['description'])): ?>
                        <p class="exercise-description"><?php echo nl2br(htmlspecialchars($exercise['description'])); ?></p>
                    <?php endif; ?>
                </div>
                <div class="exercise-card-footer">
                    <a href="index.php?page=edit_exercise&id=<?php echo $exercise['id']; ?>" class="btn small-btn secondary-btn">
                        <i class="fas fa-pencil-alt"></i> Upravit
                    </a>
                    <form action="index.php?action=delete_exercise" method="post" class="d-inline" 
                          onsubmit="return confirm('Opravdu chcete smazat toto cvičení?');">
                        <input type="hidden" name="id" value="<?php echo $exercise['id']; ?>">
                        <button type="submit" class="btn small-btn danger-btn"><i class="fas fa-trash-alt"></i> Smazat</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include 'src/views/footer.php'; ?> 