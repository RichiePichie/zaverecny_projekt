<?php
$pageTitle = 'Registrace';
include 'src/views/header.php';

// Získání chybových zpráv a dat, pokud existují
$errors = $_SESSION['register_errors'] ?? [];
$data = $_SESSION['register_data'] ?? [];

// Odstranění dat ze session
unset($_SESSION['register_errors']);
unset($_SESSION['register_data']);
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="fas fa-heartbeat"></i>
            </div>
            <h2>Registrace</h2>
            <p>Vytvořte si nový účet a začněte sledovat svou fitness cestu!</p>
        </div>

        <form action="index.php?action=register" method="post">
            <?php if (isset($errors['general'])): ?>
                <div class="alert alert-error"><?php echo $errors['general']; ?></div>
            <?php endif; ?>
            
            <div class="form-group <?php echo isset($errors['username']) ? 'has-error' : ''; ?>">
                <label for="username">Uživatelské jméno</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($data['username'] ?? ''); ?>" placeholder="Zadejte uživatelské jméno" required>
                </div>
                <?php if (isset($errors['username'])): ?>
                    <div class="error-message"><?php echo $errors['username']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group <?php echo isset($errors['email']) ? 'has-error' : ''; ?>">
                <label for="email">Email</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" placeholder="Zadejte email" required>
                </div>
                <?php if (isset($errors['email'])): ?>
                    <div class="error-message"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group <?php echo isset($errors['password']) ? 'has-error' : ''; ?>">
                <label for="password">Heslo</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Zadejte heslo" required>
                </div>
                <?php if (isset($errors['password'])): ?>
                    <div class="error-message"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group <?php echo isset($errors['password_confirm']) ? 'has-error' : ''; ?>">
                <label for="password_confirm">Potvrzení hesla</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="Zadejte heslo znovu" required>
                </div>
                <?php if (isset($errors['password_confirm'])): ?>
                    <div class="error-message"><?php echo $errors['password_confirm']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-row">
                <div class="form-group <?php echo isset($errors['first_name']) ? 'has-error' : ''; ?>">
                    <label for="first_name">Jméno</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-user-tag"></i>
                        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($data['first_name'] ?? ''); ?>" placeholder="Jméno">
                    </div>
                    <?php if (isset($errors['first_name'])): ?>
                        <div class="error-message"><?php echo $errors['first_name']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group <?php echo isset($errors['last_name']) ? 'has-error' : ''; ?>">
                    <label for="last_name">Příjmení</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-user-tag"></i>
                        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($data['last_name'] ?? ''); ?>" placeholder="Příjmení">
                    </div>
                    <?php if (isset($errors['last_name'])): ?>
                        <div class="error-message"><?php echo $errors['last_name']; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn primary-btn">Registrovat se <i class="fas fa-user-plus"></i></button>
            </div>
            
            <div class="form-footer">
                <p>Již máte účet? <a href="index.php?page=login">Přihlaste se</a></p>
            </div>
        </form>
    </div>
</div>

<?php include 'src/views/footer.php'; ?> 