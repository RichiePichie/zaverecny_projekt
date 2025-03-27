<?php
$pageTitle = 'Přihlášení';
include 'src/views/header.php';

// Získání chybových zpráv a emailu, pokud existují
$errors = $_SESSION['login_errors'] ?? [];
$email = $_SESSION['login_email'] ?? '';

// Odstranění dat ze session
unset($_SESSION['login_errors']);
unset($_SESSION['login_email']);
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="fas fa-heartbeat"></i>
            </div>
            <h2>Přihlášení</h2>
            <p>Vítejte zpět! Přihlaste se ke svému účtu.</p>
        </div>

        <form action="index.php?action=login" method="post">
            <?php if (isset($errors['general'])): ?>
                <div class="alert alert-error"><?php echo $errors['general']; ?></div>
            <?php endif; ?>
            
            <div class="form-group <?php echo isset($errors['email']) ? 'has-error' : ''; ?>">
                <label for="email">Email</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Zadejte svůj email" required>
                </div>
                <?php if (isset($errors['email'])): ?>
                    <div class="error-message"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group <?php echo isset($errors['password']) ? 'has-error' : ''; ?>">
                <label for="password">Heslo</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Zadejte své heslo" required>
                </div>
                <?php if (isset($errors['password'])): ?>
                    <div class="error-message"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn primary-btn">Přihlásit se <i class="fas fa-sign-in-alt"></i></button>
            </div>
            
            <div class="form-footer">
                <p>Nemáte účet? <a href="index.php?page=register">Registrujte se</a></p>
            </div>
        </form>
    </div>
</div>

<?php include 'src/views/footer.php'; ?> 