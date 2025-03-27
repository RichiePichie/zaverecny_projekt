<?php
$pageTitle = 'Domů';
include 'src/views/header.php';
?>

<div class="hero">
    <div class="container">
        <div class="hero-content">
            <h2>Sledujte své fitness cíle s Fitness Tracker</h2>
            <p>Jednoduché a efektivní sledování cvičení, nastavování cílů a sledování pokroku na vaší fitness cestě.</p>
            
            <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="cta-buttons">
                    <a href="index.php?page=register" class="btn primary-btn">Začít zdarma <i class="fas fa-arrow-right"></i></a>
                    <a href="index.php?page=login" class="btn secondary-btn">Přihlásit se</a>
                </div>
            <?php else: ?>
                <div class="cta-buttons">
                    <a href="index.php?page=dashboard" class="btn primary-btn">Přejít na dashboard <i class="fas fa-arrow-right"></i></a>
                </div>
            <?php endif; ?>
        </div>
        <div class="hero-image">
            <img src="public/images/fitness-tracker.png" alt="Fitness Tracker" onerror="this.style.display='none'">
        </div>
    </div>
</div>

<div class="container">
    <div class="section-heading">
        <h2>Proč použít Fitness Tracker?</h2>
        <p>Naše aplikace vám pomůže dosáhnout vašich fitness cílů</p>
    </div>
    
    <div class="features">
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-dumbbell"></i>
            </div>
            <h3>Sledujte své cvičení</h3>
            <p>Zaznamenávejte různé typy cvičení, jejich trvání a spálené kalorie s jednoduchým rozhraním.</p>
        </div>
        
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-trophy"></i>
            </div>
            <h3>Nastavte si cíle</h3>
            <p>Vytvářejte si vlastní fitness cíle, sledujte svůj pokrok a oslavujte dosažené milníky.</p>
        </div>
        
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>Sledujte statistiky</h3>
            <p>Zobrazujte si statistiky svého cvičení a pokroku v čase pomocí přehledných vizualizací.</p>
        </div>
    </div>
</div>

<div class="how-it-works">
    <div class="container">
        <div class="section-heading">
            <h2>Jak to funguje?</h2>
            <p>Začít je jednoduché, stačí jen pár kroků</p>
        </div>
        
        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Vytvořte si účet</h3>
                <p>Registrujte se zdarma během několika sekund a vytvořte si svůj profil.</p>
            </div>
            
            <div class="step">
                <div class="step-number">2</div>
                <h3>Přidejte cvičení</h3>
                <p>Zaznamenávejte vaše cvičení, aktivity a důležité metriky.</p>
            </div>
            
            <div class="step">
                <div class="step-number">3</div>
                <h3>Nastavte si cíle</h3>
                <p>Vytvářejte si osobní cíle, kterých chcete dosáhnout v určitém časovém období.</p>
            </div>
            
            <div class="step">
                <div class="step-number">4</div>
                <h3>Sledujte pokrok</h3>
                <p>Prohlížejte si statistiky a sledujte svůj pokrok na cestě ke svým cílům.</p>
            </div>
        </div>
    </div>
</div>

<div class="cta-section">
    <div class="container">
        <h2>Připraveni začít svou fitness cestu?</h2>
        <p>Zaregistrujte se ještě dnes a začněte sledovat své fitness cíle!</p>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="index.php?page=register" class="btn primary-btn">Vytvořit účet zdarma</a>
        <?php else: ?>
            <a href="index.php?page=dashboard" class="btn primary-btn">Přejít na dashboard</a>
        <?php endif; ?>
    </div>
</div>

<?php include 'src/views/footer.php'; ?> 