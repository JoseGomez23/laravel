<div class="menu">
    <h1>TOTS ELS ARTICLES</h1>
    <div class="content-wrapper">
        <!-- Left Content -->
        <div class="left-content">
            <form method="get">
                <input aria-label="Input per filtrar articles pel seu titol" class="inputs" type="text" name="titolc" placeholder="Titol de l'article" value="<?php echo isset($_POST['titolc']) ? htmlspecialchars($_POST['titolc']) : ''; ?>">
                <p>Articles per pagina<p>
                    
                <input aria-label="Input per determinar quants articles es volen mostrar per pagina" class="inputs" type="number" id="articlesperpag" name="articlesperpag" value="<?php echo isset($_COOKIE['articles_per_page']) ? htmlspecialchars($_COOKIE['articles_per_page']) : ($_POST['articlesperpag'] ?? $_GET['articlesperpag'] ?? '2'); ?>">
                <select class="ordre" name="ordre">
                    <option value="ASC" <?php echo (isset($_GET['ordre']) && $_GET['ordre'] === 'ASC') ? 'selected' : ''; ?>>Ascendent(Nom)</option>
                    <option value="DESC" <?php echo (isset($_GET['ordre']) && $_GET['ordre'] === 'DESC') ? 'selected' : ''; ?>>Descendent(Nom)</option>
                    <option value="ASCD" <?php echo (isset($_GET['ordre']) && $_GET['ordre'] === 'ASCD') ? 'selected' : ''; ?>>Ascendent(Data)</option>
                    <option value="DESCD" <?php echo (isset($_GET['ordre']) && $_GET['ordre'] === 'DESCD') ? 'selected' : ''; ?>>Descendent(Data)</option>
                </select>
                <input class="executar" type="submit" value="Executar">
            </form>
        </div>

        <!-- Carousel -->
        <div class="carousel-container">
            <div class="carousel">
                <div class="carousel-item">
                    <img src="../imatges/postre1.png" alt="Postre de gelat de vainilla ">
                        
                </div>
                <div class="carousel-item">
                    <img src="../imatges/pastisFormatge.jpg" alt="Pastis de formatge">
                    
                </div>
                <div class="carousel-item">
                    <img src="../imatges/cremaCatalana.jpg" alt="Crema catalana">
                    
                </div>
            </div>
            <div class="carousel-buttons">
                <button class="buttonPrev" onclick="moveCarousel(-1)">❮</button>
                <button class="buttonNext" onclick="moveCarousel(1)">❯</button>
            </div>
        </div>
    </div>
</div>